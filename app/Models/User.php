<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Memberships
    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Membership::class, 'user_memberships')
                    ->withPivot('start_date', 'end_date', 'status')
                    ->withTimestamps();
    }

    public function hasMembership(): bool
    {
        return $this->memberships()->wherePivot('status', 'active')->exists();
    }

    // Issued Books
    public function issuedBooks(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'issued_books')
                    ->withPivot('issued_date', 'return_date')
                    ->withTimestamps();
    }

    // Cart Books
public function cartBooks(): BelongsToMany
{
    return $this->belongsToMany(Book::class, 'cart_books')
                ->withPivot('quantity')
                ->withTimestamps();
}

}
