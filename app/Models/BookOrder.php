<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subtotal',
        'delivery_charge',
        'service_charge',
        'discount',
        'total',
        'status',
    ];

    // Relationship with books
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_order_items')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
