<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::all();
    }

    public function indexDash()
    {
        $orders = Order::all();
        return view('apartados.orders', compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::where('id', $id)->get();
    }
    // DYlan aqui esta
    public function showDash($id)
    {
        $order = Order::findOrFail($id);
        $price = 0;
        foreach ($order->products as $prod) {
            $price += $prod->pivot->Quantity * $prod->price;
        }
        return view('apartados.orders-individual', compact('order', 'price'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function searchDash(Request $request)
    {
        $q = $request->input('q');

        $orders = Order::where('id', 'LIKE', '%' . $q . '%')->get();
        return view('apartados.orders', compact('orders'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->all());

        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return response()->json($order, 200);
    }

    public function deleteDash($id)
    {
        $orders = Order::all();
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect('/home')->withStatus(__('web.order-deleted'));
    }

    public function setEntregado($id){
      $order = Order::find($id);
      if($order->finished){
        $order->finished = false;
      }
      else{
        $order->finished = true;
      }
      $order->save();
      return redirect('/home');
    }
}
