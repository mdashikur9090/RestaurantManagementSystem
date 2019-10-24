<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingridient;
use App\Ingridient_log;
use DB;
use Auth;

class IngridientController extends Controller
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
                $ingridients = Ingridient::all();
                return view('admin.ingridient')->with('ingridients', $ingridients);
            }elseif(Auth::user()->user_type=="Kitchen"){
                return redirect('/kot');
            }else{
                return redirect('/');
            }
            
        }

        
    }

    public function allIngridient()
    {
        return $ingridients = Ingridient::orderBy('name', 'asc')->get();
    }

    public function ingridientLog(Request $request){
        $ingridientLogs = Ingridient_log::where('ingridient_id', '=', $request->ingridientId)->orderBy('id', 'desc')->get();

        return $ingridientLogs;
    }

    public function addIngridientStock(Request $request)
    {

         $ingridient = Ingridient::find($request->ingridientId);
         $currentStock = $ingridient->stock;

         $ingridientLog = new Ingridient_log;
         $ingridientLog->ingridient_id = $request->ingridientId;
         $ingridientLog->name = $request->name;
         $ingridientLog->type = 'Debit';
         $ingridientLog->amount = $request->amount;
         $ingridientLog->net_amount = $currentStock+$request->amount;

        //save
        $ingridientLog->save();

        //update stock collumn of ingridient stock
        DB::table('ingridients')
            ->where('id', $request->ingridientId)
            ->update(['stock' => $currentStock+$request->amount]);

        $response = array();
        $response['status']  = 'success';
        $response['message'] = $request->ingridientId;

        return json_encode($response);
    }

    public function removeIngridientStock(Request $request){

        $ingridient = Ingridient::find($request->ingridientId);
         $currentStock = $ingridient->stock;

         $ingridientLog = new Ingridient_log;
         $ingridientLog->ingridient_id = $request->ingridientId;
         $ingridientLog->name = $request->name;
         $ingridientLog->type = 'Credit';
         $ingridientLog->amount = $request->amount;
         $ingridientLog->net_amount = $currentStock-$request->amount;

        //save
        $ingridientLog->save();

        //update stock collumn of ingridient
        DB::table('ingridients')
            ->where('id', $request->ingridientId)
            ->update(['stock' => $currentStock-$request->amount]);

        $response = array();
        $response['status']  = 'success';
        $response['message'] = $request->ingridientId;

        return json_encode($response);
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
        $ingridient = new Ingridient;

        $ingridient->name          = $request->ingridient_name;
        $ingridient->measure_as    = $request->measure_as;
        $ingridient->stock         = 0;

        $ingridient->save();

        $response = array();
        $response['status']  = 'success';
        $response['message'] = 'Ingridient Added Successfully ...';

        return json_encode($response);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ingridient::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "string";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $ingridient = Ingridient::find($request->ingridient_id);

        $ingridient->name = $request->ingridient_name;
        $ingridient->measure_as = $request->measure_as;

        $ingridient->save();

        return redirect('ingridient');
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
