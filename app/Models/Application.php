<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'service_name',
        'sent_data',
        'details_data',
        'received_data',
        'path_to_QR',
        'member_id',
        'application_sbk_id',
        'member_name',
        'member_identifier',
        'status_str',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}




















