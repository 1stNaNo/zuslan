<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Models\Views\Vw_shorter;

class ShorterComposer
{
    public function compose(View $view)
    {

      $data = Vw_shorter::fromView()->orderBy('insert_date')->get();

      return $view->withModel($data)->with('type',$view->type);
    }
}
