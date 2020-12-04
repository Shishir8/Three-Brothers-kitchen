<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Item;
use App\Models\Aboutus;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::all();
        $aboutuss = Aboutus::all();
        $categories = Category::all();
        $items = Item::all();
        $menus = Menu::all();
        return view('welcome',compact('sliders','items','categories','aboutuss','menus'));
        
    }
}
