<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'username',
        'timezone',
        'language',
        'email_notifications',
        'push_notifications',
        'sms_notifications',
        'theme',
        'layout',
        'font_size',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //
}
