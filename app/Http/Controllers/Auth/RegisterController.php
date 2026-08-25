<?php

namespace App\Http\Controllers\Auth;

use App\Enums\HallStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\HallVerificationDocument;
use App\Models\PartnerService;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function showForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        // Public registration creates 'user' only — privileged roles are created by supervisor
        $request->validate([
            'first_name'       => ['required', 'string', 'max:30'],
            'father_name'      => ['required', 'string', 'max:30'],
            'grandfather_name' => ['required', 'string', 'max:30'],
            'email'            => ['required', 'email', 'unique:users,email'],
            'phone'            => ['required', 'string', 'max:20'],
            'country'          => ['nullable', 'string', 'max:80'],
            'password'         => ['required', 'confirmed', Password::min(8)],
            'terms_agreed'     => ['required', 'accepted'],
        ]);

        $fullName = trim($request->first_name . ' ' . $request->father_name . ' ' . $request->grandfather_name);

        $user = User::create([
            'name'     => $fullName,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'country'  => $request->country,
            'role'     => UserRole::User,
            'password' => Hash::make($request->password),
        ]);

        // TODO: إعادة تفعيل OTP بعد حل مشكلة الإيميل
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('halls.list');
    }

    public function showOfficiantForm(): View
    {
        return view('auth.register_officiant');
    }

    public function registerOfficiant(Request $request): RedirectResponse
    {
        $request->validate([
            'full_name'        => ['required', 'string', 'max:150'],
            'phone'            => ['required', 'string', 'max:20'],
            'email'            => ['required', 'email', 'unique:users,email'],
            'password'         => ['required', 'confirmed', Password::min(8)],
            'license_number'   => ['required', 'string', 'max:60'],
            'national_address' => ['required', 'string', 'size:8', 'regex:/^[A-Za-z]{4}[0-9]{4}$/'],
            'doc_work_license' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'doc_wl_expiry'    => ['required', 'date', 'after:today'],
            'profile_photo'    => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:3072'],
            'terms_agreed'     => ['required', 'accepted'],
        ], [
            'national_address.regex' => 'العنوان الوطني يجب أن يكون 4 أحرف ثم 4 أرقام — مثال: JHHA3454',
            'national_address.size'  => 'العنوان الوطني يجب أن يكون 8 خانات بالضبط',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name'     => $request->full_name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'role'     => UserRole::Officiant,
                'password' => Hash::make($request->password),
            ]);

            $profilePhotoPath = null;
            if ($request->hasFile('profile_photo')) {
                $profilePhotoPath = $request->file('profile_photo')->store('officiants/photos', 'public');
            }

            \App\Models\Officiant::create([
                'user_id'        => $user->id,
                'license_number' => $request->license_number,
                'address'        => strtoupper($request->national_address),
                'phone'          => $request->phone,
                'profile_photo'  => $profilePhotoPath,
                'status'         => 'pending',
            ]);

            $licensePath = $request->file('doc_work_license')->store('officiants/documents', 'public');
            HallVerificationDocument::create([
                'hall_id'       => null,
                'owner_id'      => $user->id,
                'document_type' => 'work_license',
                'file_path'     => $licensePath,
                'expiry_date'   => $request->doc_wl_expiry,
                'status'        => 'pending',
            ]);

            Auth::login($user);
        });

        return redirect()->route('officiant.application-pending')
            ->with('success', 'تم تقديم طلبك بنجاح! سيتم مراجعته وتفعيل حسابك قريباً.');
    }

    public function showOwnerForm(): View
    {
        $partnerCategories = \App\Models\PartnerCategory::orderBy('name')->get();
        return view('auth.register_owner', compact('partnerCategories'));
    }

    public function registerOwner(Request $request): RedirectResponse
    {
        $request->validate([
            'account_type'              => ['required', 'in:hall,service,officiant'],
            // Manager info (optional — rep data used as fallback)
            'first_name'                => ['nullable', 'string', 'max:60'],
            'father_name'               => ['nullable', 'string', 'max:60'],
            'grandfather_name'          => ['nullable', 'string', 'max:60'],
            'manager_phone'             => ['nullable', 'string', 'max:20'],
            // System representative (owner of the account)
            'officiant_full_name'       => ['required_if:account_type,officiant', 'nullable', 'string', 'max:150'],
            'rep_first_name'            => ['required_unless:account_type,officiant', 'nullable', 'string', 'max:60'],
            'rep_father_name'           => ['required_unless:account_type,officiant', 'nullable', 'string', 'max:60'],
            'rep_grandfather_name'      => ['required_unless:account_type,officiant', 'nullable', 'string', 'max:60'],
            'phone'                     => ['required', 'string', 'max:20'],
            'email'                     => ['required', 'email', 'unique:users,email'],
            'password'                  => ['required', 'confirmed', Password::min(8)],
            // Venue
            'venue_name'                => ['required', 'string', 'max:150'],
            'entity_type'               => ['nullable', 'in:individual,institution,company,officiant'],
            'venue_type'                => ['nullable', 'in:wedding_hall,retreat,chalet'],
            'description'               => ['nullable', 'string', 'max:1000'],
            'address'                   => ['required_unless:account_type,officiant', 'nullable', 'string', 'max:255'],
            'building_number'           => ['nullable', 'string', 'max:20'],
            'street'                    => ['nullable', 'string', 'max:255'],
            'floor'                     => ['nullable', 'string', 'max:20'],
            'office_number'             => ['nullable', 'string', 'max:20'],
            'city'                      => ['required_unless:account_type,officiant', 'nullable', 'string', 'max:100'],
            'country'                   => ['nullable', 'string', 'max:100'],
            'unified_number'            => ['nullable', 'string', 'max:60'],
            'commercial_reg_number'     => ['nullable', 'string', 'max:60'],
            'latitude'                  => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'                 => ['nullable', 'numeric', 'between:-180,180'],
            // Venue contact info
            'venue_phone'               => ['required_unless:account_type,officiant', 'nullable', 'string', 'max:20'],
            'venue_email'               => ['nullable', 'email', 'max:150'],
            'user_phone'                => ['nullable', 'string', 'max:20'],
            // Officiant-specific fields
            'officiant_license_number'  => ['required_if:account_type,officiant', 'nullable', 'string', 'max:60'],
            'officiant_working_hours'   => ['nullable', 'string', 'max:100'],
            'officiant_bank_account'    => ['nullable', 'string', 'max:60'],
            'officiant_iban'            => ['nullable', 'string', 'max:34'],
            'terms_agreed'              => ['required', 'accepted'],
            // Documents — not required for officiant
            'doc_commercial_register'   => ['required_unless:account_type,officiant', 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'doc_municipal_license'     => ['required_unless:account_type,officiant', 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'doc_operating_license'     => ['required_unless:account_type,officiant', 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'doc_civil_defense'         => ['required_unless:account_type,officiant', 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'doc_cr_expiry'             => ['required_unless:account_type,officiant', 'nullable', 'date', 'after:today'],
            'doc_ml_expiry'             => ['required_unless:account_type,officiant', 'nullable', 'date', 'after:today'],
            'doc_ol_expiry'             => ['required_unless:account_type,officiant', 'nullable', 'date', 'after:today'],
            'doc_cd_expiry'             => ['required_unless:account_type,officiant', 'nullable', 'date', 'after:today'],
            'doc_work_license'          => ['required_if:account_type,officiant', 'nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'doc_wl_expiry'             => ['required_if:account_type,officiant', 'nullable', 'date', 'after:today'],
            'price_per_day'             => ['nullable', 'numeric', 'min:0'],
            'base_price'                => ['nullable', 'numeric', 'min:0'],
            'partner_category_id'       => ['nullable', 'exists:partner_categories,id'],
        ]);

        $isOfficiant = $request->account_type === 'officiant';
        $role        = match($request->account_type) {
            'hall'      => UserRole::Owner,
            'officiant' => UserRole::Officiant,
            default     => UserRole::Partner,
        };

        // Representative name (system account holder)
        $repFullName = $isOfficiant
            ? $request->officiant_full_name
            : trim($request->rep_first_name . ' ' . $request->rep_father_name . ' ' . $request->rep_grandfather_name);

        DB::transaction(function () use ($request, $role, $repFullName, $isOfficiant) {

            // 1. Create the user account (representative data)
            $user = User::create([
                'name'             => $repFullName,
                'father_name'      => $isOfficiant ? null : $request->rep_father_name,
                'grandfather_name' => $isOfficiant ? null : $request->rep_grandfather_name,
                'email'            => $request->email,
                'phone'            => $request->phone,
                'role'             => $role,
                'password'         => Hash::make($request->password),
            ]);

            // Shared extra fields for hall/partner (not used for officiant)
            $extraFields = [
                'entity_type'              => $request->entity_type,
                'building_number'          => $request->building_number,
                'street'                   => $request->street,
                'floor'                    => $request->floor,
                'office_number'            => $request->office_number,
                'unified_number'           => $request->unified_number,
                'venue_phone'              => $request->venue_phone,
                'venue_email'              => $request->venue_email,
                'user_phone'               => $request->user_phone,
                'manager_first_name'       => $request->first_name       ?? $request->rep_first_name,
                'manager_father_name'      => $request->father_name       ?? $request->rep_father_name,
                'manager_grandfather_name' => $request->grandfather_name  ?? $request->rep_grandfather_name,
                'manager_phone'            => $request->manager_phone     ?? $request->phone,
                'rep_first_name'           => $request->rep_first_name,
                'rep_father_name'          => $request->rep_father_name,
                'rep_grandfather_name'     => $request->rep_grandfather_name,
            ];

            // 2. Create the respective record
            if ($role === UserRole::Owner) {
                $entity = \App\Models\Hall::create(array_merge([
                    'owner_id'              => $user->id,
                    'name'                  => $request->venue_name,
                    'venue_type'            => $request->venue_type,
                    'description'           => $request->description,
                    'location'              => $request->address,
                    'city'                  => $request->city,
                    'country'               => $request->country,
                    'commercial_reg_number' => $request->commercial_reg_number,
                    'latitude'              => $request->latitude,
                    'longitude'             => $request->longitude,
                    'capacity'              => 0,
                    'max_tables'            => 0,
                    'price_per_day'         => $request->price_per_day ?? 0,
                    'status'                => \App\Enums\HallStatus::Pending,
                ], $extraFields));

            } elseif ($isOfficiant) {
                $entity = \App\Models\Officiant::create([
                    'user_id'                  => $user->id,
                    'license_number'           => $request->officiant_license_number,
                    'working_hours'            => $request->officiant_working_hours,
                    'bank_account'             => $request->officiant_bank_account,
                    'iban'                     => $request->officiant_iban,
                    'phone'                    => $request->phone,
                    'manager_first_name'       => $request->first_name       ?? $request->rep_first_name,
                    'manager_father_name'      => $request->father_name      ?? $request->rep_father_name,
                    'manager_grandfather_name' => $request->grandfather_name ?? $request->rep_grandfather_name,
                    'manager_phone'            => $request->manager_phone    ?? $request->phone,
                    'rep_first_name'           => $request->rep_first_name,
                    'rep_father_name'          => $request->rep_father_name,
                    'rep_grandfather_name'     => $request->rep_grandfather_name,
                    'status'                   => 'pending',
                ]);

            } else {
                // Partner (service provider)
                $entity = \App\Models\Partner::create(array_merge([
                    'user_id'               => $user->id,
                    'company_name'          => $request->venue_name,
                    'description'           => $request->description,
                    'city'                  => $request->city,
                    'country'               => $request->country,
                    'commercial_reg_number' => $request->commercial_reg_number,
                    'address'               => $request->address,
                    'phone'                 => $request->phone,
                    'type'                  => 'account',
                    'category_id'           => $request->partner_category_id ?: null,
                    'status'                => 'pending',
                ], $extraFields));

                \App\Models\PartnerService::create([
                    'partner_id'  => $entity->id,
                    'title'       => $request->venue_name,
                    'price'       => $request->base_price ?? 0,
                    'sort_order'  => 0,
                ]);
            }

            // 3. Store required licence documents
            $documents = [];

            if (! $isOfficiant) {
                $documents = [
                    'commercial_register' => [
                        'file'   => 'doc_commercial_register',
                        'expiry' => 'doc_cr_expiry',
                        'label'  => 'السجل التجاري',
                    ],
                    'municipal_license' => [
                        'file'   => 'doc_municipal_license',
                        'expiry' => 'doc_ml_expiry',
                        'label'  => 'الرخصة البلدية',
                    ],
                    'operating_license' => [
                        'file'   => 'doc_operating_license',
                        'expiry' => 'doc_ol_expiry',
                        'label'  => 'رخصة التشغيل',
                    ],
                    'civil_defense' => [
                        'file'   => 'doc_civil_defense',
                        'expiry' => 'doc_cd_expiry',
                        'label'  => 'موافقة الدفاع المدني',
                    ],
                ];
            }

            if ($isOfficiant && $request->hasFile('doc_work_license')) {
                $documents['work_license'] = [
                    'file'   => 'doc_work_license',
                    'expiry' => 'doc_wl_expiry',
                    'label'  => 'رخصة العمل',
                ];
            }

            foreach ($documents as $type => $meta) {
                $path = $request->file($meta['file'])->store('halls/documents', 'public');
                HallVerificationDocument::create([
                    'hall_id'       => $role === UserRole::Owner ? $entity->id : null,
                    'owner_id'      => $user->id,
                    'document_type' => $type,
                    'file_path'     => $path,
                    'expiry_date'   => $request->input($meta['expiry']),
                    'status'        => 'pending',
                ]);
            }

            Auth::login($user);
        });

        $redirectRoute = match($role) {
            UserRole::Owner     => 'owner.application-pending',
            UserRole::Officiant => 'officiant.application-pending',
            default             => 'partner.application-pending',
        };

        return redirect()->route($redirectRoute)
            ->with('success', 'تم تسجيل منشأتك بنجاح! سيتم مراجعة الطلب وتفعيل الحساب قريباً.');
    }
}
