<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [ 'client_id', 'booked_by', 'package_id', 'client_name', 'client_email', 'client_phone', 'date', 'time', 'status', ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }
    
    public function bookedBy()
    {
        return $this->belongsTo(User::class, 'booked_by', 'id');
    }


    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'payment_id', 'id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'invoice_id', 'id');
    }

    public function contract()
    {
        return $this->hasOne(Contract::class, 'contract_id', 'id');
    }

}
