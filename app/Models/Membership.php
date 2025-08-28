<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'duration'
    ];

    // Optional: if you want to relate memberships to users
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_memberships')
                    ->withPivot('start_date', 'end_date', 'status')
                    ->withTimestamps();
    }
    public function getDurationAttribute()
    {
        return $this->duration_days;
    }
}
