<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'labor_request_id',
        'status',
        'application_message',
        'start_date',
        'end_date',
        'agreed_wage',
        'rejection_reason',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function laborRequest()
    {
        return $this->belongsTo(LaborRequest::class);
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isAccepted()
    {
        return $this->status === 'accepted';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}
