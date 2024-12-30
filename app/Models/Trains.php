<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trains extends Model
{
    use HasFactory;
     // Define fillable fields
     protected $fillable = [
        'instructor_id',
        'subscription_id',
    ];

    public function instructor()
    {
        return $this->belongsTo(Trainor::class, 'instructor_id');
    }

    /**
     * Relationship with Subscription
     */
    public function subscription()
    {
        return $this->belongsTo(Payment::class, 'subscription_id');
    }
}
