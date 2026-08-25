<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /* ── Register ── */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'nullable|email|unique:users,email',
            'phone'    => 'nullable|string|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (empty($request->email) && empty($request->phone)) {
            return response()->json([
                'message' => 'يجب إدخال البريد الإلكتروني أو رقم الهاتف'
            ], 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => $request->password,
            'role'     => 'user',
            'balance'  => 0,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'  => $this->userResource($user),
            'token' => $token,
        ], 201);
    }

    /* ── Login ── */
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',   // email or phone
            'password' => 'required|string',
        ]);

        // Find by email or phone
        $user = User::where('email', $request->login)
                    ->orWhere('phone', $request->login)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['بيانات الدخول غير صحيحة'],
            ]);
        }

        if (!$user->is_active) {
            return response()->json(['message' => 'الحساب موقوف'], 403);
        }

        // Revoke old tokens
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'  => $this->userResource($user),
            'token' => $token,
        ]);
    }

    /* ── Logout ── */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'تم تسجيل الخروج']);
    }

    /* ── Get Profile ── */
    public function profile(Request $request)
    {
        return response()->json($this->userResource($request->user()));
    }

    /* ── Update Profile ── */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'  => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|string|unique:users,phone,' . $user->id,
        ]);

        $user->update($request->only('name', 'email', 'phone'));

        return response()->json($this->userResource($user));
    }

    /* ── Upload Avatar ── */
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = $request->user();

        // Delete old avatar
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        return response()->json([
            'avatar_url' => $user->avatar_url,
        ]);
    }

    /* ── Change Password ── */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'كلمة المرور الحالية غير صحيحة'], 422);
        }

        $user->update(['password' => $request->password]);
        return response()->json(['message' => 'تم تغيير كلمة المرور بنجاح']);
    }

    /* ── Helper ── */
    private function userResource(User $user): array
    {
        return [
            'id'                 => $user->id,
            'name'               => $user->name,
            'email'              => $user->email,
            'phone'              => $user->phone,
            'role'               => $user->role,
            'avatar_url'         => $user->avatar_url,
            'balance'            => $user->balance,
            'is_active'          => $user->is_active,
            'total_requests'     => $user->totalRequests(),
            'completed_requests' => $user->completedRequests(),
            'created_at'         => $user->created_at,
        ];
    }
}
