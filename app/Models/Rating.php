<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'worker_id',
        'labor_request_id',
        'rating',
        'comment',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function laborRequest()
    {
        return $this->belongsTo(LaborRequest::class);
    }
}
