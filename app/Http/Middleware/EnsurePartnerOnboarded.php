<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controls partner access based on their profile approval status.
 *
 * pending  → redirect to "application pending" page
 * rejected → redirect to "application rejected" page
 * active   → full access
 * no profile yet → redirect to profile setup
 */
class EnsurePartnerOnboarded
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === UserRole::Partner) {
            // Always accessible
            if ($request->routeIs(
                'partner.profile-setup',
                'partner.profile-setup.save',
                'partner.application-pending',
                'partner.application-rejected'
            )) {
                return $next($request);
            }

            $profile = $user->partnerProfile;

            if (! $profile) {
                return redirect()->route('partner.profile-setup');
            }

            if ($profile->status === 'pending') {
                return redirect()->route('partner.application-pending');
            }

            if ($profile->status === 'rejected') {
                return redirect()->route('partner.application-rejected');
            }
        }

        return $next($request);
    }
}
