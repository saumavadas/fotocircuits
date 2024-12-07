<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'schedule_date', 'seller_id'];

    // Define the relationship to the Seller (user)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
