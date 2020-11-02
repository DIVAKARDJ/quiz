<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\HomeSlider;

class IndexController extends Controller
{
    //

    public function index()
    {
        $data['homeSliders'] = HomeSlider::all();
        $data['categories'] = Category::with('count_sub_category')->orderBy('serial',
            'ASC')->whereNull('parent_id')->get();
        return view('web.index', $data);
    }
}
