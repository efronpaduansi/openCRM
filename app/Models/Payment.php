<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'number',
        'invoice_id',
        'invoice_number',
        'client_id',
        'date',
        'method',
        'total',
        'status',
    ];
}
