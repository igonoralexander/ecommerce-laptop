<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\UploadMedia;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'shipping_address',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function media()
    {
        return $this->hasMany(UploadMedia::class,  'user_id', 'id');
    }

    public function availabilties()
    {
        return $this->hasMany(Availability::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

     /**
     * A user can have many bookings.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'client_id', 'id');
    }

    /**
     * A user can have multiple invoices.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'invoice_id', 'id');
    }

    /**
     * A user can have multiple contracts.
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'contract_id', 'id');
    }
}
