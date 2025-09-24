<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Address extends Model
{
    use HasUuids;

    protected $table = 'delivery_addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'city',
        'city_ref',
        'present',
        'area',
        'parent_region_code',
        'parent_region_types',
        'settlement_type_code',
        'street',
        'apartment',
    ];
}
