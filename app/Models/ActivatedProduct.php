<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivatedProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_id",
        "is_activated",
        "activation_allowed",
        "activation_done",
        "activation_key",
        "expiry_date_time",
        "customer_id"

    ];

    public function Product(){
        return $this->belongsTo(Product::class,"product_id");
    }

    public function Customer(){
        return $this->belongsTo(Customer::class,"customer_id");
    }
}
