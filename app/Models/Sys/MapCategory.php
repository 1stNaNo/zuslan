<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MapCategory
 */
class MapCategory extends Model
{
    protected $table = 'map_category';

    public $timestamps = false;

    protected $fillable = [
        'value'
    ];

    protected $guarded = [];


}
