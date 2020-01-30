<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Task;
use App\Product;
use App\Ingredient;
use Illuminate\Support\Facades\DB;
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
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::orderBy('date', 'asc')->orderBy('id')->paginate(5, ['*'], 'orders');
            $notes = Task::orderBy('initdate', 'asc')->paginate(5, ['*'], 'notes');
            if ($request['table']) {
                return view('ajax.tasks', compact('notes'))->render();
            } else {
                return view('ajax.orders', compact('orders'))->render();
            }
        }
        $notes = Task::orderBy('initdate', 'asc')->paginate(5, ['*'], 'notes');
        $orders = Order::orderBy('date', 'asc')->orderBy('id')->get();
        $price = 0;
        foreach ($orders as $pedido) {
            $order = Order::findOrFail($pedido->id);
            foreach ($order->products as $prod) {
                $price += $prod->pivot->Quantity * $prod->price;
            }
            $order->update(['price' => $price]);
            $price = 0;
        }
        $orders = Order::orderBy('date', 'asc')->orderBy('id')->paginate(5, ['*'], 'orders');
        $orderss = Order::all();
        $ordersRestantes = Order::where('finished',1)->get();
        $ordersRestantes = $ordersRestantes->count();

        $products = Product::all();
        $ingredientes = array();
        foreach ($products as $pr) {
            foreach ($pr->ingredients as $ingrSuelto) {
                array_push($ingredientes, $ingrSuelto->name);
            }
        }

        return view('dashboard', compact('orders', 'orderss', 'notes', 'ingredientes'));
    }
}
