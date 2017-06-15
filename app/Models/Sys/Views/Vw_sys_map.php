<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Vw_sys_map extends Model
{

    protected $table = "vw_sys_map";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeFromView($query, $poll_id){
        $query;
    }
}
