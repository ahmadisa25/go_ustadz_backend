<?php

namespace App\Http\Controllers;

use App\Order;

use App\Http\Requests\OrderStoreRequest;
use App\CustomMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(15);

        return $orders;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {
        $order = new Order;
        $order->client_id = $request->client_id;
        $order->server_id = $request->server_id;
        $order->paket_id = $request->paket_id;
        $order->topic_id = $request->topic_id;
        $order->is_active = $request->is_active;
        $order->save();
        $to_name = 'TO_NAME';
        $to_email = 'enasni.redrum@gmail.com';
        $data = array('name'=>"Sam Jose", "body" => "Test mail");
            
        Mail::send('custom_mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Artisans Web Testing Mail');
            $message->from('xunil.malsi@gmail.com','Artisans Web');
        });
        //Gmail sending limits = 2000 mail(to, subject, message)s/day
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
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
