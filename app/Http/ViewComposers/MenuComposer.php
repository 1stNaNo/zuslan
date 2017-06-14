<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Models\Views\Vw_category;
use App\Models\Language;
use App\Models\Banner;
use App\Models\Link;
use App\Models\Views\Vw_title;
use Session;
use Auth;
class MenuComposer
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
      $categories = Vw_category::fromViewShowed()->where('parent_id', 0)->orderBy('parent_id')->orderBy('order_num', 'asc');
      $subcategories = Vw_category::fromViewShowed()->where('parent_id', '<>', 0)->orderBy('parent_id')->orderBy('order_num', 'asc');
      return $view->with(compact('categories', 'subcategories'));
    }
}
