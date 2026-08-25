<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $userRole = $request->user()->role;

        $effectiveRoles = [$userRole->value];

        // supervisor gets manager-level access
        if ($userRole === UserRole::Supervisor) {
            $effectiveRoles[] = 'manager';
        }


        foreach ($roles as $r) {
            if (in_array($r, $effectiveRoles)) {
                return $next($request);
            }
        }

        abort(403, 'غير مصرح لك بالوصول.');
    }
}
