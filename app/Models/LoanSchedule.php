<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_id',
        'date_of_payment',
        'month_number',
        'starting_balance',
        'monthly_payment',
        'principal_component',
        'interest_component',
        'ending_balance',
    ];
}
