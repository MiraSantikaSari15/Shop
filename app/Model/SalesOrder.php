<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Customer;
use App\Model\Product;

class SalesOrder extends Model
{
    protected $table = 'sales_order';

	protected $guarded = [];

	public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
