<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Vw_sys_thr_user extends Model
{

    protected $table = "vw_sys_thr_user";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeByUserId($query, $user_id){
      $query->where('user_id', $user_id);
    }

}
