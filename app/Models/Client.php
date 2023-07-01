<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable = [
        'added_from',
        'produk_id',
        'fullname',
        'email',
        'phone',
        'address',
        'city',
        'province',
        'zip_code',
        'status'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
}
