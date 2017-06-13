<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class Category
 */
class Vw_users extends Model
{

    use EntrustUserTrait;

    protected $table = "vw_users";

    protected $guarded = [];

    protected $fillable = [];

    protected $primaryKey = 'user_id';

    public function scopeFromView($query){
        $query->whereLang(\Session::get("lang"));
    }

    public function getLevelMax()
  	{
  		$roles = [];
  		foreach($this->roles as $role)
  		{
  			$roles[] = $role->level;
  		}

  		return max($roles);
  	}

    public function detachAllRoles()
    {
        \DB::table('role_user')->where('user_id', $this->user_id)->delete();

        return $this;
    }
}
