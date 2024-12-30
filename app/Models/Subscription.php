<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'plans';

    // Define fillable fields
    protected $fillable = [
        'name',
        'description',
        'month',
        'price'
    ];

    public function trains()
    {
        return $this->hasMany(Trains::class, 'subscription_id', 'id');
    }
}
