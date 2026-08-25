<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOfficiantOnboarded
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === UserRole::Officiant) {
            if ($request->routeIs(
                'officiant.profile-setup',
                'officiant.profile-setup.save',
                'officiant.application-pending',
                'officiant.application-rejected'
            )) {
                return $next($request);
            }

            $profile = $user->officiantProfile;

            if (! $profile) {
                return redirect()->route('officiant.application-pending');
            }

            if ($profile->status === 'pending') {
                return redirect()->route('officiant.application-pending');
            }

            if ($profile->status === 'rejected') {
                return redirect()->route('officiant.application-rejected');
            }
        }

        return $next($request);
    }
}
