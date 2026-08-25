<?php

namespace App\Http\Middleware;

use App\Models\AgentRefCode;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreReferralCode
{
    public function handle(Request $request, Closure $next): Response
    {
        $ref = $request->query('ref');

        if ($ref) {
            $code = AgentRefCode::where('code', $ref)->where('is_active', true)->first();

            if ($code) {
                // Store in session for 24 hours (session lifetime handled by config)
                session(['referral_code' => $ref, 'referral_code_stored_at' => now()->timestamp]);
            }
        }

        // Expire stored referral code after 24 hours
        if (session('referral_code_stored_at')) {
            $storedAt = session('referral_code_stored_at');
            if (now()->timestamp - $storedAt > 86400) {
                session()->forget(['referral_code', 'referral_code_stored_at']);
            }
        }

        return $next($request);
    }
}
