<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Order_item;
use App\Order;
use App\Food_ingridient;
use App\Ingridient;
use App\Ingridient_log;
use DB;
use Auth;
use Session;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //if user is not login
        if (empty(Auth::user()->id)) {
            echo "you must login first";

        }else{
            $cart = Cart::where('user_id', '=', Auth::user()->id)->get();

            return view('user.cart')->with('cart', $cart);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $cart = new Cart;

        $cart->user_id  = $request->input('user_id');
        $cart->food_id  = $request->input('food_id');
        $cart->qty      = $request->input('qty');

        $cart->save();
        
        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'This food added in your cart Successfully ...';

        return json_encode($response);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function qtyPlus(Request $request)
    {
        Cart::where('user_id', '=', Auth::user()->id)->where('food_id', '=', $request->food_id)->increment('qty');

        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'Item has has been increment Successfully ...';

        return json_encode($response);


        
    }

    public function qtyMinus(Request $request)
    {
        Cart::where('user_id', '=', Auth::user()->id)->where('food_id', '=', $request->food_id)->decrement('qty');

        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'Item has been remove decrement Successfully ...';

        return json_encode($response);
        
    }


    public function removeFromCart(Request $request)
    {
        
        //delete previous all foods form the cart for this user
        Cart::where('user_id', $request->user_id)->where('food_id', $request->food_id)->delete();

           

        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'Item has been remove from cart Successfully ...';

        return json_encode($response);

    }

    public function confirmOrder(){

        //get all the item form user cart
        $userCart = Cart::where('user_id', Auth::user()->id)->get();

        
            //check item is avail on user cart
        if ($userCart) {

            //now check stock
            $ingridientsStocks = array();
            $isStock = true;
            foreach ($userCart as $cartItem) {
                $food_ingridients = Food_ingridient::where('food_id', '=', $cartItem->food_id)->get();

                foreach ($food_ingridients as $eachFoodIngridient) {

                    if ( array_key_exists($eachFoodIngridient->ingridient_id, $ingridientsStocks) ) {
                        //echo 'exist '.$ingridientsStocks[$eachFoodIngridient->ingridient_id]."</br>";
                        $ingridientsStocks[$eachFoodIngridient->ingridient_id] = $ingridientsStocks[$eachFoodIngridient->ingridient_id]-$eachFoodIngridient->qty*$cartItem->qty;
                        //echo  'exist after minus '.$ingridientsStocks[$eachFoodIngridient->ingridient_id]."</br>";

                    }else{
                        $ingridient = Ingridient::where('id', '=', $eachFoodIngridient->ingridient_id)->first();
                        //echo  'not exist '.$ingridient->stock."</br>";
                        $ingridientsStocks += array($eachFoodIngridient->ingridient_id => $ingridient->stock-$eachFoodIngridient->qty*$cartItem->qty); 
                        //echo  'not exist after minus '.$ingridientsStocks[$eachFoodIngridient->ingridient_id]."</br>";
                    }

                    

                    if ($ingridientsStocks[$eachFoodIngridient->ingridient_id] >= 0 ) {
                        //echo "stock avialble";
                    }else{
                        //echo "Food no ".$cartItem->food_id."and ingridientn no ".$eachFoodIngridient->ingridient_id." Out of stock. if qty is more than 1 then reduce for avilablity</br>";
                        Session::flash('stock_check_message', 'Food no '.$cartItem->food_id.' Out of stock. if qty is more than 1 then reduce for avilablity otherwise remove this item form order cart.'); 
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

            //if stock is availble then place confirm orders to order que
            if ($isStock) {
                //creat new order 
                $order = new Order;
                $order->user_id = Auth::user()->id;
                $order->order_type = 2;
                $order->serve_type = 0;
                $order->order_status = 0;
                $order->save();

                //now store order item on this ordet id
                foreach ($userCart as $cartItem) {
                    $orderItem = new Order_item;

                    $orderItem->order_id     = $order->id;
                    $orderItem->food_id      = $cartItem->food_id;
                    $orderItem->qty          = $cartItem->qty;
                    $orderItem->cook_status  = 0;
                    $orderItem->serve_status = 0;

                    $orderItem->save();
                }

                //delete previous all foods form the cart for this user
                Cart::where('user_id', Auth::user()->id)->delete();

                //now update the ingridients stock
                foreach ($userCart as $cartItem) {
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


                return  redirect('/cart');

            }else{

                return  redirect('/cart');
            }

   
        }

        

    }


}
