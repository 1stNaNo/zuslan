<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysThrMessageUser
 */
class SysThrMessageUser extends Model
{
    protected $table = 'sys_thr_message_user';

    public $timestamps = false;

    protected $fillable = [
        'thread_id',
        'user_id'
    ];

    protected $guarded = [];


}
