<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Food;
use App\Food_type;
use App\Food_image;
use App\Food_comment;
use App\Table;
use App\User;
use PDF;
use Auth;
use Carbon\Carbon;                                            

class UserPagesController extends Controller
{
    
    public function getIndex() {

        if (!Auth::user()) {

            $food_type = Food_type::all();
            $foods = Food::all();
            return view('user.index')->with('food_type', $food_type)->with('foods', $foods);
            
        }else{
            if(Auth::user()->user_type=="Admin"){
                return redirect('/admin');
            }elseif(Auth::user()->user_type=="Kitchen"){
                return redirect('/kot');
            }else{
                $food_type = Food_type::all();
                $foods = Food::all();
                return view('user.index')->with('food_type', $food_type)->with('foods', $foods);
            }
            
        }


        
    }

    public function getAdminIdex() {

        if (!Auth::user()) {

            return redirect('/');
            
        }else{
            if(Auth::user()->user_type=="Admin"){
                $table = Table::all();
                return view('admin.index')->with('tables', $table);
            }elseif(Auth::user()->user_type=="Kitchen"){
                return redirect('/kot');
            }else{
                return redirect('/');
            }
            
        }

    }

    public function getAllFoods(){

        if (!Auth::user()) {

            return redirect('/');
            
        }else{
            if(Auth::user()->user_type=="Admin"){
                $foods = Food::all();
                return view('admin.foods')->with('foods', $foods);
            }elseif(Auth::user()->user_type=="Kitchen"){
                return redirect('/kot');
            } else{
                return redirect('/');
            }
            
        }
        
    }


    public function getFoodMenu() {
    	$food_type = Food_type::all();
    	$foods = Food::where('visible_status', '=', 1)->get();
    	return view('user.food-menu')->with('food_type', $food_type)->with('foods', $foods);
    	
    }


    public function storeTable(Request $request) {

        $tbl = new Table;
        $tbl->name = $request->name;
        $tbl->person = $request->person;
        $tbl->syn = 0;
        $tbl->checkout_status = 0;

        $tbl->save();

        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'Product Added Successfully ...';

        return json_encode($response);
      
    }

    public function order_details(Request $request) {

        if ($request->tableID) {
            //for dine in orders
            $user_lists = DB::table('tables')
                        ->join('order_items', 'tables.order_id', '=', 'order_items.order_id')
                        ->join('foods', 'order_items.food_id', '=', 'foods.id')
                        ->where('tables.id', '=', $request->tableID)
                        ->select('*')
                        ->get();
  
        }else{

            //for take away orders
            $user_lists = DB::table('orders')
                        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                        ->join('foods', 'order_items.food_id', '=', 'foods.id')
                        ->where('orders.id', '=', $request->orderId)
                        ->select('*')
                        ->get();
        }


        $response = [];

        foreach ($user_lists as $row) {
            $response[] = array(
                    "food_name" => $row->name,
                    "price" => $row->price,
                    "qty" => $row->qty
                );
        }


        return json_encode($response);
                     
    }


    public function get_table_order(){

        // $order_lists = DB::table('tables')
        //                 ->join('orders', 'tables.order_id', '=', 'orders.id')
        //                 ->join('order_items', 'tables.order_id', '=', 'order_items.order_id')
        //                 ->where('tables.syn', '=', '0')
        //                 ->select('*')
        //                 ->get();

        $order_lists = DB::table('tables')
                        //->where('tables.syn', '=', '0')
                        ->select('*')
                        ->get();

        $response = [];

        foreach ($order_lists as $row) {
            $response[] = array(
                    "table_id" => $row->id,
                    "order_id" => $row->order_id,
                    "checkout_status" => $row->checkout_status,
                );
        }

        return json_encode($response);

                        
    }

    public function take_away(){

        if (!Auth::user()) {

            return redirect('/');
            
        }else{
            if(Auth::user()->user_type=="Admin"){
                $order_lists = DB::table('orders')
                        ->where([
                                    ['order_type', '=', '2'],
                                    ['order_status', '!=', '2'],
                                ])
                        ->select('*')
                        ->get();


                return view('admin.take-away')->with('order_lists', $order_lists);

            }else{
                return redirect('/');
            }
            
        }
 

                        
    }

    public function store_food_type(Request $request){

        $food_type = new Food_type;

        $food_type->name = $request->food_type_name;

        $food_type->save();

        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'Food type Added Successfully ...';

        return json_encode($response);


    }

    public function storeComment(Request $request){

        $food_comment = new Food_comment;

        $food_comment->food_id = $request->food_id;
        $food_comment->user_id = $request->user_id;
        $food_comment->comment = $request->comment;

        $food_comment->save();

        return redirect('food/'.$request->food_id);


    }

    public function gallery(){

        $galleryImage = Food_image::all();
        return view("user.gallery")->with('galleryImage', $galleryImage);
    }


    public function checkout(Request $request){

        $response = [];

        $response['payment']  = 1;

        return $response;
    }

    public function invoice($id){

        //$user = DB::

        $order_items = DB::table('tables')
                        ->join('order_items', 'tables.order_id', '=', 'order_items.order_id')
                        ->join('foods', 'order_items.food_id', '=', 'foods.id')
                        ->where('tables.id', '=', $id)
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


        $table = Table::find($id);
        $table->order_id = null;
        $table->checkout_status = 0;
        $table->save();





        //$pdf = PDF::loadView('notes.list_notes', $data);
        //$pdf = PDF::loadView('admin.invoice');
        $pdf = PDF::loadView('admin.invoice', ['order_items' => $response])->setPaper('a5')->setWarnings(false)->save('invoice_'.$id.'.pdf');

        //$pdf->download('invoice.pdf');
   
        return $pdf->stream('admin.invoice.pdf');



        //return view("admin.invoice");
    }


    public function changeFoodVisibleStatus($id) {

        $food = Food::find($id);

        if ($food->visible_status == 1) {
            $food->visible_status=0;
            $food->save();
        }else{
            $food->visible_status=1;
            $food->save();
        }

        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'Food type Added Successfully ...';

        return $response;


    }

    

    
}
