<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controls owner access based on their hall's approval status.
 *
 * pending / under_review → redirect to "application pending" page
 * rejected               → redirect to "application rejected" page
 * active                 → full access
 * no hall yet            → redirect to hall-info onboarding
 */
class EnsureOwnerOnboarded
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === UserRole::Owner) {
            // These routes are always accessible regardless of status
            if ($request->routeIs(
                'owner.hall-info',
                'owner.hall-info.save',
                'owner.application-pending',
                'owner.application-rejected'
            )) {
                return $next($request);
            }

            $hall = $user->halls()->first();

            // No hall yet → send to onboarding
            if (! $hall) {
                return redirect()->route('owner.hall-info')
                    ->with('onboarding_required', true);
            }

            $status = $hall->status->value;

            // Rejected → dedicated page showing reason
            if ($status === 'rejected') {
                return redirect()->route('owner.application-rejected');
            }

            // Pending or under review → waiting page, no dashboard access
            if ($status !== 'active') {
                return redirect()->route('owner.application-pending');
            }
        }

        return $next($request);
    }
}
