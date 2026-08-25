<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentRefCode extends Model
{
    protected $fillable = ['agent_id', 'code', 'is_active'];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    /** Generate a unique referral code for an agent */
    public static function generateFor(int $agentId): self
    {
        do {
            $code = 'AGT-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 6));
        } while (self::where('code', $code)->exists());

        return self::create(['agent_id' => $agentId, 'code' => $code]);
    }
}
