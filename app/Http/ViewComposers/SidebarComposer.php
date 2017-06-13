<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Models\Views\Vw_poll;
use App\Models\Views\Vw_answer;
use App\Models\Views\Vw_news;
use App\Models\Views\Vw_weblinks;
use App\Models\Link;
use App\Models\Views\Vw_filetype;

class SidebarComposer
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
      $poll = Vw_poll::fromView()->first();
      $answers = Vw_answer::fromView($poll->id)->get();
      $video = Link::byType('video')->first();

      $latest = Vw_news::latestNews()->paginate(6);
      $viewed = Vw_news::mostViewed()->paginate(6);
      $comment = Vw_news::mostComment()->paginate(6);

      $filetypes = Vw_filetype::where('lang', \Session::get('lang'))->get();
      $weather = Link::byType('weather')->get();

      $weblinks = Vw_weblinks::fromView()->get();

      return $view->with(compact('poll', 'answers','video','latest','viewed','comment','filetypes','weather','weblinks'));
    }
}
