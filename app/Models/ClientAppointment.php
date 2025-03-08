<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'appointment_date', 'status', 'notes'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

}
