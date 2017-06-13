<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Models\Views\Vw_users;
use App\User;
use App\Models\Language;
use Session;
use Auth;
class ChatUsersComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

      $permission_id = 1;

      $users = User::whereHas('roles', function($query) use ($permission_id) {

          $query->whereHas('perms', function($query) use ($permission_id) {

              $query->where('id', '=', $permission_id);

          });

      })->get();

      $userIds = array();
      foreach($users as $item){
        array_push($userIds, $item->user_id);
      }

      // $userIds = array_merge($userIds , array_diff($userIds, array(\Auth::user()->user_id)));
      // $userIds = array_unique($userIds);
      // var_dump($userIds);

      $infoUsers = Vw_users::whereIn('user_id', $userIds)->get();

      return $view->with(compact('users','infoUsers'));
    }
}
