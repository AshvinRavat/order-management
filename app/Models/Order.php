<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'grand_total',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function customer()  
    {
        return $this->belongsTo(Customer::class);
    }
}
