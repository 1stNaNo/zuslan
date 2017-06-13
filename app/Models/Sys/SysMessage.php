<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysMessage
 */
class SysMessage extends Model
{
    protected $table = 'sys_message';

    public $timestamps = true;

    protected $fillable = [
        'sender_id',
        'message',
        'thread_id'
    ];

    protected $guarded = [];


}
