<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Vw_sys_message_users extends Model
{

    protected $table = "vw_sys_message_users";

    protected $guarded = [];

    protected $fillable = [];

    protected $primaryKey = 'id';

    public function scopeByThreadId($query, $thread_id){
      $query->where('thread_id', $thread_id);
    }

}
