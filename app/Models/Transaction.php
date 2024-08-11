<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_uuid',
        'receiver_uuid',
        'sender_money',
        'receiver_money'
    ];

    public function senderAccount(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_uuid', 'user_uuid');
    }

    public function receiverAccount(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_uuid', 'user_uuid');
    }
}
