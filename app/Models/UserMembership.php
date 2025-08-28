<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{
    protected $fillable = [
        'user_id', 'status', 'start_date', 'end_date'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->end_date >= now();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
