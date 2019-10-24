<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Order;
use App\Order_item;
use App\Ingridient;
use App\Ingridient_log;
use App\Food_ingridient;

class OrderController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function userOrderList(){

    	$runningOrder = Order::where('user_id', '=', Auth::user()->id)
                                ->where('order_status', '=', 0)
                                ->orderBy('id', 'desc')
                                ->get();
    	$completedOrder = Order::where('user_id', '=', Auth::user()->id)
                                ->where('order_status', '=', 2)
                                ->orderBy('id', 'desc')
                                ->get();

    	// foreach ( $userOrder as $Order ) {
    	// 	print_r($Order->id.'</br>');  

    	// }

    	//  echo "string</br>";

    	//  foreach ( $userOrder as $Order ) {
    	// 	foreach ($Order->orderItem as $orderItem) {
    	// 		print_r($orderItem->food_id);   
    	// 	}
    	// }


    	
    	return view('user.order-history')->with('runningOrder', $runningOrder)->with('completedOrder', $completedOrder);

    }

    public function cancelOrderItemFromOrder(Request $request){

        $order_item = Order_item::find($request->itemId);

        $foodIngridients = Food_ingridient::where('food_id', '=', $order_item->food_id)
                                            ->join('foods', 'food_id', 'id')
                                            ->get();

        foreach ($foodIngridients as $eachFoodIngridient) {
            
            $ingridient = Ingridient::where('id', '=', $eachFoodIngridient->ingridient_id)->first();
            $currentStock = $ingridient->stock;

            $ingridientLog = new Ingridient_log;
            $ingridientLog->ingridient_id = $eachFoodIngridient->ingridient_id;
            $ingridientLog->name = $eachFoodIngridient->name." ".$eachFoodIngridient->qty." * ".$order_item->qty." cancel";
            $ingridientLog->type = 'Debit';
            $ingridientLog->amount = $eachFoodIngridient->qty*$order_item->qty;
            $ingridientLog->net_amount = $currentStock+$ingridientLog->amount;

            //save
            $ingridientLog->save();

            //update stock collumn of ingridient stock
            DB::table('ingridients')
                ->where('id', $eachFoodIngridient->ingridient_id)
                ->update(['stock' => $currentStock+($eachFoodIngridient->qty*$order_item->qty)]);
        }

        //now delete order item
        Order_item::where('id', '=', $request->itemId)->delete();


        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'Order Item has been remove from order Sucessfully';

        return json_encode($response);




    }
}
