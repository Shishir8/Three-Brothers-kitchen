<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\ReservationConfirmed;
use App\Models\Reservation;
use Session;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservation.index',compact('reservations'));
    }
    public function status($id){
        $reservation = Reservation::find($id);
        $reservation->status = true;
        $reservation->save();
        Session::flash('success','Reservation successfully confirmed');
        return redirect()->back();
    }
    public function destory($id){
        Reservation::find($id)->delete();
        Session::flash('success','Reservation successfully deleted!');
        return redirect()->back();
    }
}
