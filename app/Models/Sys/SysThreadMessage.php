<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysThreadMessage
 */
class SysThreadMessage extends Model
{
    protected $table = 'sys_thread_message';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [];


}
