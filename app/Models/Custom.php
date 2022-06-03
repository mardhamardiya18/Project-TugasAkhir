<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Custom extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'users_id', 'phone_number', 'address_one', 'address_two', 'needs', 'categories', 'photos', 'caption', 'code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
