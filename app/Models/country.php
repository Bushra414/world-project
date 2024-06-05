<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $fillable = [
        'Code',
        'Name',
        'Continent',
        'Region',
        'SurFacAarea',
        'IndepYear',
        'Population',
        'LifeExpectancy',
        'GNP',
        'GNPOId',
        'LocalName',
        'GovernmentForm',
        'HeadOfState',
        'Capital',
        'Code2',
    ];
    protected $primaryKey = 'Code';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $table = 'country';

    use HasFactory;
}
