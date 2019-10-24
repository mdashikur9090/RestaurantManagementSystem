<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon; 
use PDF;

class KotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Auth::user()) {

            return redirect('/');
            
        }else{
            if(Auth::user()->user_type=="Admin"){
                return redirect('admin'); 
            }elseif(Auth::user()->user_type=="Kitchen"){
                return view('admin.kot'); 
            }else{
                return redirect('/');
            }
            
        }
          
    }

    public function getDinningOrder() {

        //for kot get orders
        $user_lists = DB::table('orders')
                    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->join('foods', 'order_items.food_id', '=', 'foods.id')
                    ->where([
                                ['orders.order_type', '=', 1],
                                ['orders.order_status', '!=', 2],
                            ])
                    ->select('*')
                    ->get();



        $response = [];

        foreach ($user_lists as $row) {

            $processed = false;

            for( $i = 0; $i < count($response); $i++ ){
                if($row->order_id == $response[$i]['orderID']){
                    
                    $response[$i]['orderItem'][] = array(
                        "food_id"       => $row->food_id,
                        "food_name"     => $row->name,
                        "qty"           => $row->qty,
                        "cook_status"   => $row->cook_status,
                        "serve_status"  => $row->serve_status
                    );

                    $processed = true;
                }
            }


            if($processed) continue;


            $response[] = array(
                "orderID" => $row->order_id,
                "orderItem" => array(
                    array(
                        "food_id"       => $row->food_id,
                        "food_name"     => $row->name,
                        "qty"           => $row->qty,
                        "cook_status"   => $row->cook_status,
                        "serve_status"  => $row->serve_status
                    )
                )
            );
            
        }


        return json_encode($response);
                     
    }

    public function getTakeAwayOrder() {

        //for kot get orders
        $user_lists = DB::table('orders')
                    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->join('foods', 'order_items.food_id', '=', 'foods.id')
                    ->where([
                                ['orders.order_type', '=', 2],
                                ['orders.order_status', '!=', 2],
                            ])
                    ->select('*')
                    ->get();



        $response = [];

        foreach ($user_lists as $row) {

            $processed = false;

            for( $i = 0; $i < count($response); $i++ ){
                if($row->order_id == $response[$i]['orderID']){
                    
                    $response[$i]['orderItem'][] = array(
                        "food_id"       => $row->food_id,
                        "food_name"     => $row->name,
                        "qty"           => $row->qty,
                        "cook_status"   => $row->cook_status,
                        "serve_status"  => $row->serve_status
                    );

                    $processed = true;
                }
            }


            if($processed) continue;


            $response[] = array(
                "orderID" => $row->order_id,
                "orderItem" => array(
                    array(
                        "food_id"       => $row->food_id,
                        "food_name"     => $row->name,
                        "qty"           => $row->qty,
                        "cook_status"   => $row->cook_status,
                        "serve_status"  => $row->serve_status
                    )
                )
            );
            
        }


        return json_encode($response);
                     
    }

    
    
    public function updateCookAndServeStatus(Request $request){
        if($request->cStatus == "cStatus"){ 

            $completedStatus = true;
            $orderItems = DB::table('order_items')
                            ->where('order_id', '=', $request->orderId)
                            ->select('*')
                            ->get();

            foreach ($orderItems as $item) {
                if ($item->cook_status==0) {
                    $completedStatus = false;


                }elseif($item->serve_status==0){
                    $completedStatus = false;
                }
            }


            if ($completedStatus==true) {
                DB::table('orders')
                    ->where('id', '=', $request->orderId)
                    ->update(['order_status' => 2]);

                    $response = array();
                    $response['status']  = 'success';
                    $response['message'] = 'Successfull';
                    $response['taskStatus'] = true;
                    $response['order_id'] = $request->orderId;
            }else{
                $response = array();
                $response['status']  = 'error';
                $response['message'] = 'Please cook and serve item first.';
                $response['taskStatus'] = false;
            }
                            

        

        return json_encode($response);


        }else if ($request->cook_or_serve == "cook") {


                DB::table('order_items')
                ->where([
                            ['order_id', '=', $request->order_id],
                            ['food_id', '=', $request->food_id],
                        ])
                ->update(['cook_status' => 1]);


            

        }else{


            $order_items = DB::table('order_items')
                                ->where([
                                            ['order_id', '=', $request->order_id],
                                            ['food_id', '=', $request->food_id],
                                        ])
                                ->get();

            if($order_items[0]->cook_status == 1){

                DB::table('order_items')
                ->where([
                            ['order_id', '=', $request->order_id],
                            ['food_id', '=', $request->food_id],
                        ])
                ->update(['serve_status' => 1]);

            }




        }

        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'Successfully Updated...';

        return json_encode($response);
        
    }


    public function invoice($id){

        //$user = DB::

        $order_items = DB::table('order_items')
                        ->join('foods', 'order_items.food_id', '=', 'foods.id')
                        ->where('order_items.order_id', '=', $id)
                        ->select('foods.*', 'order_items.order_id', 'order_items.qty')
                        ->get();

        $response = [];

        foreach ($order_items as $row) {
            $response[] = array(
                    "food_name" => $row->name,
                    "price" => $row->price,
                    "qty" => $row->qty,
                    "order_id" => $row->order_id,
                    "c_date" => Carbon::now()
                );
        }


        // $table = Table::find($id);
        // $table->order_id = null;
        // $table->checkout_status = 0;
        // $table->save();





        //$pdf = PDF::loadView('notes.list_notes', $data);
        //$pdf = PDF::loadView('admin.invoice');
        $pdf = PDF::loadView('admin.invoice', ['order_items' => $response])->setPaper('a5')->setWarnings(false)->save('invoice_'.$id.'.pdf');

        //$pdf->download('invoice.pdf');
   
        return $pdf->stream('admin.kotinvoice.pdf');



        //return view("admin.invoice");
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
        //
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
