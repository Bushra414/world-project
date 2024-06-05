<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class countrylanguage extends Model
{
    protected $fillable = [
        'CountryCode',
        'Language',
        'IsOfficial',
        'Percentage',

    ];
    protected $table = 'countrylanguage';

    use HasFactory;
}
