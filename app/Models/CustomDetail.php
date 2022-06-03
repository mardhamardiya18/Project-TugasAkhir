<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_id', 'estimasi_pengerjaan', 'estimasi_biaya', 'status_pengerjaan', 'payment_status', 'photos_confirm'
    ];

    public function custom()
    {
        return $this->hasOne(Custom::class, 'id', 'custom_id');
    }
}
