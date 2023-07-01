<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\User;
use App\Models\Status;
class Prospek extends Model
{
    use HasFactory;
    protected $table = 'prospeks';
    protected $fillable = [
        'produk_id',
        'user_id',
        'status_id',
        'fullname',
        'email',
        'phone',
        'address',
        'city',
        'province',
        'zip_code',
        'identity_img',
    ];

    // relationship with produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    // relationship with user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // relationship with status
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
