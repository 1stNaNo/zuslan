<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Map
 */
class Map extends Model
{
    protected $table = 'map';

    public $timestamps = false;

    protected $fillable = [
        'cat_id',
        'name',
        'latitude',
        'longitude',
        'radius'
    ];

    protected $guarded = [];


}
