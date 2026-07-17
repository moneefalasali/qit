<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaborRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'service_type',
        'number_of_workers',
        'start_date',
        'end_date',
        'description',
        'daily_wage',
        'status',
        'assigned_workers',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function applications()
    {
        return $this->hasMany(WorkerApplication::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isInProgress()
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }
}
