<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Payment;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $fillable = [
        'client_id',
        'user_id',
        'number',
        'date',
        'due_date',
        'total',
        'total_tax',
        'note',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id', 'id');
    }
}
