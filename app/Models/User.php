<?php

namespace App\Models;

use App\Mail\BareMail;
use App\Notifications\UserPasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //ユーザー用にカスタマイズしたパスリセット情報の上書き
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserPasswordResetNotification($token, new BareMail()));
    }

    public function reviews(): HasMany
    {
        return $this->hasMany('App\Models\Review');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Article', 'likes')->withTimestamps();
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

}
