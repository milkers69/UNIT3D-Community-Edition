<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepackSubscription extends Model
{
    public function ModerationAction(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModerationAction::class, 'action_id');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
