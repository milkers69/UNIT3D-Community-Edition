<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModerationAction extends Model
{

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function moderator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'moderator_id');
    }
    public function torrent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class);
    }
    public function repackSubscription(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RepackSubscription::class, 'action_id');
    }
    public function autoReject(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(AutoReject::class, 'action_id');
    }
}
