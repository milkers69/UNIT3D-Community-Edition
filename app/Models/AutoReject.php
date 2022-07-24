<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoReject extends Model
{
    public function ModerationAction(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModerationAction::class, 'action_id');
    }
    public function moderator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'moderator_id');
    }
}
