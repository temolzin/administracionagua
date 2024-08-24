<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Debt;
use App\Models\Customer;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'debt_id',
        'amount',
        'note',
    ];

    public $timestamps = false;

    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }
}
