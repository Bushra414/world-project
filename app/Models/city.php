<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $fillable = [
        'Name',
        'CountryCode',
        'District',
        'Population',

    ];
    protected $table = 'city';

    use HasFactory;
}
