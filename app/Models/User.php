<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role', 'phone', 'address', 'city', 'region', 'is_active'];
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function farmer()
    {
        return $this->hasOne(Farmer::class);
    }

    public function worker()
    {
        return $this->hasOne(Worker::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function isFarmer()
    {
        return $this->role === 'farmer';
    }

    public function isWorker()
    {
        return $this->role === 'worker';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
