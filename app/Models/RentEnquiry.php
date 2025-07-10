<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentEnquiry extends Model
{
    use HasFactory;

    protected $table = 'rent_enquiries';
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'message',
        'start_date',
        'end_date',
        'status'
    ];
}
