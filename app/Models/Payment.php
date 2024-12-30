<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
     // Define the table name
     protected $table = 'subscriptions';

     public $timestamps = false;


     // Define fillable fields
     protected $fillable = [
         'member_id',
         'subscription_type',
         'subscription_start_date',
         'subscription_expiry_date',
         'amount',
         'payment_date',
         'subscription_status'
     ];

     public function trains()
     {
         return $this->hasMany(Trains::class, 'subscription_id');
     }
}
