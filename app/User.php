<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'role_pending'
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

    public function Post() {
      return $this->hasMany(Post::class);
    }

    public function post_comment() {
      return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function isAdmin() {
      if ($this->role == 'admin') {
        return $this->role == 'admin';
      } else {
        return 0;
      }
    }

    public function Dashboard() {
      if ($this->role != 'pending') {
        return 1;
      } else {
        return 0;
      }
    }

    public function Permission() {
      if ($this->role == 'admin') {
        return 1;
      } else {
        return 0;
      }
    }

    public function checkStatus() {
      if ($this->role != 'pending' && $this->role != 'reader') {
        if ($this->role_pending == 'noapprove') {
          return 0;
        } else {
          return 1;
        }
      } else {
        return 0;
      }
    }
}
