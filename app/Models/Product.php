<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mass', 'price', 'quantity'];
    public function cartItems()
{
    return $this->hasMany(Cart::class);
}

}
