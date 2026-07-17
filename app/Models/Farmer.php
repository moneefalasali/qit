<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'farm_name',
        'farm_description',
        'farm_location',
        'farm_area',
        'farm_type',
        'number_of_workers',
        'is_verified',
        'verification_notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laborRequests()
    {
        return $this->hasMany(LaborRequest::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
