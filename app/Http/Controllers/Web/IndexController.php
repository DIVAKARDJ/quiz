<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\HomeSlider;

class IndexController extends Controller
{
    //

    public function index()
    {
        $data['homeSliders'] = HomeSlider::all();

        return view('web.index', $data);
    }
}
