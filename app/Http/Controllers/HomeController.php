<?php

namespace App\Http\Controllers;
use App\Order;
use App\User;
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
        $orders = Order::all();
        
        // $orders=DB::table('orders')
        // ->select('orders.*','users.id','users.name','users.email','users.avatar')

        // ->join(DB::raw('(SELECT id,name,email,avatar FROM users) as users'), 
        // function($join)
        // {
        //    $join->on('users.id', '=', 'orders.user_id');
        // })
        // ->orderBy('orders.date', 'DESC')
        // ->get();

        return view('dashboard',compact('orders'));
    }
}
