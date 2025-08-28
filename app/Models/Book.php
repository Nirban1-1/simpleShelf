<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'image',
        'description',
        'rating',
        'reviews',
        'price'
    ];
    public function issuedBooks()
    {
        return $this->hasMany(IssuedBook::class);
    }

    
    public function issuedBy()
{
    return $this->belongsToMany(User::class, 'issued_books')
                ->withPivot('issued_date', 'return_date')
                ->withTimestamps();
}

public function orders()
{
    return $this->belongsToMany(BookOrder::class, 'book_order_items')
                ->withPivot('quantity', 'price')
                ->withTimestamps();
}


}

