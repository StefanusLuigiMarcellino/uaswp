<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hobbies() {
        return $this->belongsToMany(Hobby::class);
    }

    public function sentFriendRequests(){
        return $this->hasMany(Friend::class, 'sender_id');
    }

    public function receivedFriendRequests(){
        return $this->hasMany(Friend::class, 'recipient_id');
    }

    public function friends(){
        return $this->belongsToMany(User::class, 'friends', 'sender_id', 'recipient_id')
                    ->where('status', 'accepted')
                    ->orWhere(function ($query) {
                        $query->where('sender_id', $this->id)
                              ->where('status', 'accepted');
                    });
    }
}
