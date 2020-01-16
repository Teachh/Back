<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Task;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $notes = Task::orderBy('initdate','asc')->limit(6)->get();
        $orders = Order::orderBy('date','asc')->orderBy('id')->limit(10)->get();
        return view('dashboard',compact('orders','notes'));
    }
}
