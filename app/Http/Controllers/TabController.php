<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table;
use App\Table_cart;
use App\Food;
use App\Food_type;
use App\Ingridient;
use App\Ingridient_log;
use App\Food_ingridient;
use App\Order;
use App\Order_item;
use Session;
use DB;

class TabController extends Controller
{
    public function getIndex($tblId){

    	session()->put('tableid' , $tblId );

    	$food_type = Food_type::all();
    	$foods = Food::where('visible_status', '=', 1)->get();
    	return view('tab.manu')->with('food_type', $food_type)->with('foods', $foods);
    }

    public function foodDetails($id){

        $tableCartItem = Table_cart::where('table_carts.table_id', '=', session('tableid'))
                                    ->where('table_carts.food_id', '=', $id)
                                    ->get();

        if (count($tableCartItem) > 0 ) {
            //already in cart
            $food = Food::find($id);
            return view('tab.food-details')->with('food', $food)->with('isInCart', 1);
        }else{

             $food = Food::find($id);

            return view('tab.food-details')->with('food', $food);

        }
	
    	
    }

    public function cart() {

    	$foodCart = [];

        $tableCartItem = DB::table('table_carts')
                            ->where('table_carts.table_id', '=', session('tableid'))
                            ->join('foods', 'table_carts.food_id', '=', 'foods.id')
                            ->select('foods.id', 'name', 'price', 'qty')
                            ->get();

    	return view('tab.cart')->with('foodCart', $tableCartItem);
    }

    public function order($tblId) {

    	$table = Table::find($tblId);

    	$order = Order::find($table->order_id);

    	//dd($order);

        return view('tab.order')->with('order', $order);
    	

    }


    public function confirmOrder(Request $request) {

        $table_carts = DB::table('table_carts')
                            ->where('table_carts.table_id', '=', session('tableid'))
                            ->select('food_id', 'qty')
                            ->get();

        

        if (count($table_carts) > 0) {

             //now check stock
            $ingridientsStocks = array();
            $isStock = true;
            foreach ($table_carts as $eachItem ) {
                $food_ingridients = Food_ingridient::where('food_id', '=', $eachItem->food_id)->get();

                foreach ($food_ingridients as $eachFoodIngridient) {

                    if ( array_key_exists($eachFoodIngridient->ingridient_id, $ingridientsStocks) ) {
                        //echo 'exist '.$ingridientsStocks[$eachFoodIngridient->ingridient_id]."</br>";
                        $ingridientsStocks[$eachFoodIngridient->ingridient_id] = $ingridientsStocks[$eachFoodIngridient->ingridient_id]-$eachFoodIngridient->qty*$eachItem->qty;
                        //echo  'exist after minus '.$ingridientsStocks[$eachFoodIngridient->ingridient_id]."</br>";

                    }else{
                        $ingridient = Ingridient::where('id', '=', $eachFoodIngridient->ingridient_id)->first();
                        //echo  'not exist '.$ingridient->stock."</br>";
                        $ingridientsStocks += array($eachFoodIngridient->ingridient_id => $ingridient->stock-$eachFoodIngridient->qty*$eachItem->qty); 
                        //echo  'not exist after minus '.$ingridientsStocks[$eachFoodIngridient->ingridient_id]."</br>";
                    }

                    

                    if ($ingridientsStocks[$eachFoodIngridient->ingridient_id] >= 0 ) {
                        //echo "stock avialble";
                    }else{
                        //echo "Food no ".$eachItem->food_id."and ingridientn no ".$eachFoodIngridient->ingridient_id." Out of stock. if qty is more than 1 then reduce for avilablity</br>";
                        Session::flash('stock_check_message', 'Food no '.$eachItem->food_id.' Out of stock. if qty is more than 1 then reduce for avilablity otherwise remove this item form order cart.'); 
                        $isStock = false;
                        //brak food ngridient Loop
                        break;
                    }
                }

                if ( $isStock==false ) {
                    //brak userCardLoop
                    break;
                }

            }


            if ($isStock) { 

                    $table = Table::find(session('tableid'));

                    if (is_null($table->order_id)) {
                        //creat new order 
                        $order = new Order;
                        $order->user_id = 2; //2=all dinning order
                        $order->order_type = 1;
                        $order->serve_type = 0;
                        $order->order_status = 0;
                        $order->save();

                    }else{
                        //add new item on exiting order
                        $order = Order::find($table->order_id);
                        $order->serve_type = 0;
                        $order->order_status = 0;
                        $order->save();

                    }

                    //now store order item on this ordet id
                    foreach ($table_carts as $cartItem) {
                        $orderItem = new Order_item;

                        $orderItem->order_id     = $order->id;
                        $orderItem->food_id      = $cartItem->food_id;
                        $orderItem->qty          = $cartItem->qty;
                        $orderItem->cook_status  = 0;
                        $orderItem->serve_status = 0;

                        $orderItem->save();
                    }

                    //delete previous all order order table cart
                    DB::table('table_carts')
                        ->where('table_carts.table_id', '=', session('tableid'))
                        ->delete();

                    //now update the ingridients stock
                    foreach ($table_carts as $cartItem) {
                        $food_ingridients = Food_ingridient::where('food_id', '=', $cartItem->food_id)
                                                            ->join('foods', 'food_id', 'id')
                                                            ->get();
                                                            

                        foreach ($food_ingridients as $eachFoodIngridient) {
                            //echo $eachFoodIngridient->name;
                            //dd($food_ingridients);
                            $ingridient = Ingridient::where('id', '=', $eachFoodIngridient->ingridient_id)->first();
                            $currentStock = $ingridient->stock;

                            $ingridientLog = new Ingridient_log;
                            $ingridientLog->ingridient_id = $eachFoodIngridient->ingridient_id;
                            $ingridientLog->name = $eachFoodIngridient->name." ".$eachFoodIngridient->qty." * ".$cartItem->qty." sell";
                            $ingridientLog->type = 'Credit';
                            $ingridientLog->amount = $eachFoodIngridient->qty*$cartItem->qty;
                            $ingridientLog->net_amount = $currentStock-$ingridientLog->amount;

                            //save
                            $ingridientLog->save();

                            //update stock collumn of ingridient stock
                            DB::table('ingridients')
                                ->where('id', $eachFoodIngridient->ingridient_id)
                                ->update(['stock' => $currentStock-($eachFoodIngridient->qty*$cartItem->qty)]);
                        }
                    }

                     //update table orderid collumn of new order 
                    DB::table('tables')
                        ->where('id', session('tableid'))
                        ->update(['order_id' => $order->id, 'syn' => 0]);


                    return  redirect('/tab/order/'.session('tableid'));

            }else{
                return  redirect('/tab/dining/cart');

            }





            
        }else{

            return  redirect('/tab/dining/cart');
        }
    
    }

    public function cancelOrderItem(Request $request) {

        $order_item = Order_item::find($request->itemId);

        //dd($order_item);

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


        $order = Order::find($order_item->order_id);

        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'This food added in cart Successfully ...';

        return json_encode($response);
        

    } 

    public function addToCart(Request $request){

    	//remove all seasion data
    	//Session::forget('cartItems');

        $tableCartItem = Table_cart::where('table_carts.table_id', '=', session('tableid'))
                                    ->where('table_carts.food_id', '=', $request->foodId)
                                    ->get();

        if (count($tableCartItem) > 0 ) {
            //already in cart
        }else{

             $table_cart = new Table_cart;

             $table_cart->table_id = session('tableid');
             $table_cart->food_id = $request->foodId;
             $table_cart->qty = 1;

             $table_cart->save();



        }




    	//session()->put('cartItems.'.$request->foodId, ['id' => $request->foodId, 'qty' => 1] );

    	$response = array();
        $response['status']  = 'success';
        $response['message'] = 'This food added in cart Successfully ...';

        //return json_encode( session('cartItems') );
        // return $response;
    	
    }

    public function incrementQty(Request $request){

    	$tableCartItems = DB::table('table_carts')
                            ->where('table_carts.table_id', '=', session('tableid'))
                            ->where('table_carts.food_id', '=', $request->foodId)
                            ->select('id')
                            ->get();



        foreach ($tableCartItems as $item) {
            $tableCartItem = Table_cart::find($item->id);
            $tableCartItem->qty = $tableCartItem->qty+1;
            //dd($tableCartItem);
            $tableCartItem->save();
        }
        
    	
    	$response = array();
        $response['status']  = 'success';
        $response['message'] = 'This food added in cart Successfully ...';

        return $response;
    	
    }

    public function decrementQty(Request $request){

    	$tableCartItems = DB::table('table_carts')
                            ->where('table_carts.table_id', '=', session('tableid'))
                            ->where('table_carts.food_id', '=', $request->foodId)
                            ->select('id')
                            ->get();

                        

        foreach ($tableCartItems as $item) {
            $tableCartItem = Table_cart::find($item->id);
            $tableCartItem->qty = $tableCartItem->qty-1;
            $tableCartItem->save();
        }
    	
    	$response = array();
        $response['status']  = 'success';
        $response['message'] = 'This food added in cart Successfully ...';

        //return $response;
    	
    }

    public function removeFromCart(Request $request){

        $tableCartItem = DB::table('table_carts')
                            ->where('table_carts.table_id', '=', session('tableid'))
                            ->where('table_carts.food_id', '=', $request->foodId)
                            ->delete();


        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'This food added in cart Successfully ...';

        return $response;
        
    }


    public function checkout(){
    	//update checkout_status collumn of tables
    	if (Session::has('tableid')) {
    		DB::table('tables')
            ->where('id', session('tableid'))
            ->update(['checkout_status' => 1]);

        return  redirect('/tab/order/'.session('tableid'));
    	}
        
    }

    public function checkoutWithRating(Request $request){

    	if (Session::has('tableid')) {

    		foreach ($request->food_id as $foodId) {
	    		if ($request->input($foodId)) {
	    			Food::find($foodId)->increment('total_vote');
	    			Food::find($foodId)->increment('total_rating_point', $request->input($foodId) );
	    		}
	    	}

	    	DB::table('tables')
	            ->where('id', session('tableid'))
	            ->update(['checkout_status' => 1]);

	        Session::flash('message', 'Thanks you so much.. Come again sir...');

            return  redirect(url('/tab').'/'.session('tableid'));

    	}
    	
    }



}
