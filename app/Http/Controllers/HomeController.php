<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $order = 0;
        $process = 0;
        $finished = 0;
        $costumer = 0;
        if (auth()->user()->role == 'admin') {
            $order = Order::all()->count();
            $process = Order::where('status', '!=', 0)->where('status', '!=', 5)->get()->count();
            $finished = Order::where('status', 5)->get()->count();
            $costumer = User::where('role', 'customer')->get()->count();
        } else {
            $order = Order::all()->count();
            $process = Order::where('status', '!=', 0)->where('status', '!=', 5)->where('user_id', auth()->user()->id)->get()->count();
            $finished = Order::where('status', 5)->where('user_id', auth()->user()->id)->get()->count();
        }

        return view('home', compact('order', 'process', 'finished', 'costumer'));
    }
}