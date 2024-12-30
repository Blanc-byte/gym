<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainor extends Model
{
    use HasFactory;
    protected $table = 'trainors';

    // Disable automatic handling of timestamps
    public $timestamps = false;

    // Define fillable fields
    protected $fillable = [
        'name',
        'age',
        'gender',
        'specialty',
        'duration',
    ];

}
