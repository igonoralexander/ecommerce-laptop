<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo', 'favicon', 'breadcrumb_image', 'site_name', 'site_tagline', 'contact_email', 'phone_number',
        'address', 'country', 'timezone', 'currency', 'social_links', 'business_hours', 'site_language',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
