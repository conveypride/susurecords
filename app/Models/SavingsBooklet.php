<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsBooklet extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'bookletId',
        'customerid',
        'maxpages',
        'status',
        'companyId'
    ];

}
