<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'block',
        'street',
        'interior_number',
        'marital_status',
        'partner_name',
        'has_water_connection',
        'has_store',
        'connection_holder',
        'has_all_payments',
        'has_water_day_night',
        'occupants_number',
        'water_days',
        'has_water_pressure',
        'has_cistern',
    ];
}
