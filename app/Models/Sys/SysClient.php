<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysClient
 */
class SysClient extends Model
{
    protected $table = 'sys_clients';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [];


}
