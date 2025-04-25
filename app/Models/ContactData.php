<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactData extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'message',
    ];
}
