<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainor extends Model
{
    use HasFactory;
    protected $table = 'trainors';

    // Define fillable fields
    protected $fillable = [
        'name',
        'age',
        'gender',
    ];


    // public function trains()
    // {
    //     return $this->hasMany(Trains::class, 'instructor_id', 'id');
    // }
}
