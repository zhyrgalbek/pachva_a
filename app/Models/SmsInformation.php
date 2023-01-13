<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsInformation extends Model
{
    use HasFactory;

    protected $table = 'sms_information';
    protected $guarded = false;
}
