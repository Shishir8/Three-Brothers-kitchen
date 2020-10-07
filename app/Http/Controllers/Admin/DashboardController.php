<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Contact;
use App\Item;
use App\Reservation;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
