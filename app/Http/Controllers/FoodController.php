<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use App\Food_type;
use App\Food_ingridient;
use App\Food_image;
use App\Ingridient;
use App\Cart;
use Auth;
use Validator;

use Storage;
use File;
use DB;

class FoodController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $food = Food::all();
        //dd($food);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (!Auth::user()) {

            return redirect('/');
            
        }else{
            if(Auth::user()->user_type=="Admin"){
                $food_types = Food_type::all();
                return view('admin.add-food')->with('food_types', $food_types);
            }elseif(Auth::user()->user_type=="Kitchen"){
                return redirect('/kot');
            }else{
                return redirect('/');
            }
            
        }

        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate all the fields
        Validator::make($request->all(), [
            'ingridient_id' => 'required|array',
            'ingridient_id.*' => 'numeric',
            'amount' => 'required|array',
            'amount.*' => 'numeric',

            'food_img' => 'required|array',
            'food_img.*' => 'required|file|mimes:jpeg,png',

            'food_type_id'    => 'required|numeric',
            'food_name'    => 'required',
            'description'    => 'required',
            'price'    => 'required|numeric',
            'serve'    => 'required|numeric',
            'chef'    => 'required',
            'cooking_hours'    => 'required|numeric',
            'calories'    => 'required|numeric',
            ])->validate();

        $food = new Food;

        $food->food_type_id = $request->food_type_id;
        $food->name         = $request->food_name;
        $food->description  = $request->description;
        $food->price        = $request->price;
        $food->serve        = $request->serve;
        $food->chef         = $request->chef;
        $food->cooking_hours = $request->cooking_hours;
        $food->calories     = $request->calories;
        $food->total_vote   = 0;
        $food->total_rating_point     = 0;

        $food->save();

        

        //for food image
        $photos = $request->file('food_img');
        $paths  = [];

        foreach ($photos as $photo) {
            $extension = $photo->getClientOriginalExtension();
            $filename  = 'img' . uniqid() . '.' . $extension;
            $paths[]   = $photo->storeAs('foods', $filename);

            $paths[] = Storage::disk('public_food')->put($filename, file_get_contents($photo));

            //upload food image name to databse
            $foodImage = new Food_image;
            $foodImage->food_id = $food->id;
            $foodImage->img_name = $filename;
            $foodImage->save();
        }

        //for food ingridient
        for ($i=0; $i < count($request->ingridient_id); $i++) { 
            //upload food ingridien name to databse
            $foodIngridient = new Food_ingridient;
            $foodIngridient->food_id = $food->id;
            $foodIngridient->ingridient_id = $request->ingridient_id[$i];
            $foodIngridient->qty = $request->amount[$i];
            $foodIngridient->save();
        }
        

        //dd($paths);
        return redirect(URL('/admin/foods'));



        
    }

    public function getFoodDetails($id){
        $foodIngridient = Food_ingridient::where('food_ingridients.food_id', '=', $id)
                                            ->join('ingridients', 'food_ingridients.ingridient_id', '=', 'ingridients.id')
                                            ->get();
        $foodImage = Food_image::where('food_images.food_id', '=', $id)->get();

        $response[]  = array('foodImage' =>  $foodImage);
        $response[]  = array('foodIngridient' =>  $foodIngridient);

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $food = Food::find($id);

        $similarFoods = Food::where('food_type_id', '=', $food->food_type_id)->where('visible_status', '=', 1)->get();

        //dd($similarFoods);


        //if user is not login
        if (empty(Auth::user()->id)) {

            return view('user.food-details')->with('food', $food)->with('similarFoods', $similarFoods);

        }else{

            $foodInUserCart = Cart::where('food_id', '=', $id)->where('user_id', '=', Auth::user()->id)->get();

            //if food_id in not in user cart
            if (empty($foodInUserCart[0]->food_id)) {
                
                return view('user.food-details')->with('food', $food)->with('similarFoods', $similarFoods);

            }else{
                //if food_available in user cart table

                return view('user.food-details')->with('food', $food)->with('foodInUserCart', $foodInUserCart)->with('similarFoods', $similarFoods);

            }

        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $food_types = Food_type::all();
        $food = Food::find($id);
        $ingridients = Ingridient::all();
        $food_ingridients = Food_ingridient::where('food_id', '=', $id)->get();
        return view('admin.edit-food')->with('food', $food)->with('food_types', $food_types)->with('food_ingridients', $food_ingridients)->with('ingridients', $ingridients);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //validate all the fields
        Validator::make($request->all(), [
            'ingridient_id' => 'required|array',
            'ingridient_id.*' => 'numeric',
            'amount' => 'required|array',
            'amount.*' => 'numeric',

            'food_img' => 'required|array',
            'food_img.*' => 'required|file|mimes:jpeg,png',

            'food_type_id'    => 'required|numeric',
            'food_name'    => 'required',
            'description'    => 'required',
            'price'    => 'required|numeric',
            'serve'    => 'required|numeric',
            'chef'    => 'required',
            'cooking_hours'    => 'required|numeric',
            'calories'    => 'required|numeric',
            ])->validate();


        // DB::table('foods')
        //     ->where('id', $id)
        //     ->update(['food_type_id' => $request->food_type_id,
        //                 'name' => $request->food_name, 
        //                 'description' => $request->description, 
        //                 'price' => $request->price, 
        //                 'serve' => $request->serve,
        //                 'chef' => $request->chef, 
        //                 'cooking_hours' => $request->cooking_hours, 
        //                 'calories' => $request->calories]);


        $food = Food::find($id);

        $food->food_type_id = $request->food_type_id;
        $food->name = $request->food_name;
        $food->description = $request->description;
        $food->price = $request->price;
        $food->serve = $request->serve;
        $food->chef = $request->chef;
        $food->cooking_hours = $request->cooking_hours;
        $food->calories = $request->calories;
        $food->save();

        //for food ingridient
        if( count($request->ingridient_id) > 0){

            //delete preivious ingridient
            DB::table('food_ingridients')->where('food_id', '=', $id)->delete();


            for ($i=0; $i < count($request->ingridient_id); $i++) { 
                //upload food ingridien name to databse
                $foodIngridient = new Food_ingridient;
                $foodIngridient->food_id = $food->id;
                $foodIngridient->ingridient_id = $request->ingridient_id[$i];
                $foodIngridient->qty = $request->amount[$i];
                $foodIngridient->save();
            }
        }


        //for food image
        if( count($request->food_img) > 0){

            //delete preivious image
            DB::table('food_images')->where('food_id', '=', $id)->delete();


            $photos = $request->file('food_img');
            $paths  = [];

            foreach ($photos as $photo) {
                $extension = $photo->getClientOriginalExtension();
                $filename  = 'img' . uniqid() . '.' . $extension;
                $paths[]   = $photo->storeAs('foods', $filename);

                $paths[] = Storage::disk('public_food')->put($filename, file_get_contents($photo));

                //upload food image name to databse
                $foodImage = new Food_image;
                $foodImage->food_id = $food->id;
                $foodImage->img_name = $filename;
                $foodImage->save();
            }

        }
        


        return redirect(URL('/admin/foods'));

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
