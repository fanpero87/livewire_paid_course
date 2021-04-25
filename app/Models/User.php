<?php

namespace App\Models;


use Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatarUrl()
    {
        // return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));

        return $this->avatar
            ? Storage::disk('avatars')->url($this->avatar)
            : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
    }
}
