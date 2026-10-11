<?php

namespace App\Models;

use Database\Factories\DistributorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    /** @use HasFactory<DistributorFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'country',
        'logo_path',
    ];
}
