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

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'قيد المراجعة',
            'approved' => 'تمت الموافقة',
            'waiting_for_payment' => 'في انتظار الدفع',
            'in_progress' => 'قيد التنفيذ',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            default => 'جديد',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'badge bg-warning-subtle text-warning',
            'approved' => 'badge bg-info-subtle text-info',
            'waiting_for_payment' => 'badge bg-secondary-subtle text-secondary',
            'in_progress' => 'badge bg-primary-subtle text-primary',
            'completed' => 'badge bg-success-subtle text-success',
            'cancelled' => 'badge bg-danger-subtle text-danger',
            default => 'badge bg-light text-dark',
        };
    }
}
