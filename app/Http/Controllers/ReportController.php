<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;
class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {

        if (Auth::user()->user_type=="Admin") {


            //start today sell report
            $todaySellReport=[];
            $highestTodayValue=0;

            for ($i=0; $i < 12; $i++) { 
                $startDAte = Carbon::now()->setTime(12+$i, 0, 0);
                $endDAte = Carbon::now()->setTime(12+$i, 59, 59);
                //echo $startDAte."  -  ".$startDAte->format('H')."  -  ".$endDAte;
                //echo "</br>";

                $today = DB::table('orders')
                                ->where('created_at', '>=', $startDAte)
                                ->where('created_at', '<=', $endDAte)
                                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                                ->join('foods', 'order_items.food_id', '=', 'foods.id')
                                ->select(DB::raw('SUM(foods.price*order_items.qty) as total'))
                                ->get();


                if (is_null($today[0]->total)) {

                    $todaySellReport[] = array(
                                                    "hour" => $startDAte->format('H'),
                                                    "amount" => 0
                                                    
                                                );

                    
                }else{
                    
                    $todaySellReport[] = array(
                                                    "hour" => $startDAte->format('H'),
                                                    "amount" => $today[0]->total
                                                    
                                                );
                    if ($today[0]->total > $highestTodayValue) {
                        $highestTodayValue = $today[0]->total;
                    }
                }
                
            }

            //end today sell report


            
            //start 7days sell report
            $last7DaysSellReport=[];
            $highest7DaysValue=0;

            for ($i=0; $i < 7; $i++) { 
                $startDAte = Carbon::now()->subDays($i)->setTime(23, 59, 59);
                $endDAte = Carbon::now()->subDays($i)->setTime(0, 0, 0);
                //echo $startDAte."  -  ".$startDAte->subDays($i)->format('D')."  -  ".Carbon::now()->subDays($i)."  -  ".Carbon::now()->subDays($i)->format('D');
                //echo "</br>";

                $last7Days = DB::table('orders')
                                ->where('created_at', '<=', $startDAte)
                                ->where('created_at', '>=', $endDAte)
                                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                                ->join('foods', 'order_items.food_id', '=', 'foods.id')
                                ->select(DB::raw('SUM(foods.price*order_items.qty) as total'))
                                ->get();


                if (is_null($last7Days[0]->total)) {

                    $last7DaysSellReport[] = array(
                                                    "day" => Carbon::now()->subDays($i)->format('D'),
                                                    "amount" => 0
                                                    
                                                );

                    
                }else{
                    
                    $last7DaysSellReport[] = array(
                                                    "day" => Carbon::now()->subDays($i)->format('D'),
                                                    "amount" => $last7Days[0]->total
                                                    
                                                );
                    if ($last7Days[0]->total > $highest7DaysValue) {
                        $highest7DaysValue = $last7Days[0]->total;
                    }
                }
                
            }
            //end 7days sell report


            //start 30 days sell report
            $last30DaysSellReport=[];

            for ($i=0; $i < 30; $i++) { 
                $startDAte = Carbon::now()->subDays($i)->setTime(23, 59, 59);
                $endDAte = Carbon::now()->subDays($i)->setTime(0, 0, 0);
                //echo $startDAte."  -  ".$startDAte->subDays($i)->format('D')."  -  ".Carbon::now()->subDays($i)."  -  ".Carbon::now()->subDays($i)->format('D');
                //echo "</br>";

                $last30Days = DB::table('orders')
                                ->where('created_at', '<=', $startDAte)
                                ->where('created_at', '>=', $endDAte)
                                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                                ->join('foods', 'order_items.food_id', '=', 'foods.id')
                                ->select(DB::raw('SUM(foods.price*order_items.qty) as total'))
                                ->get();


                if (is_null($last30Days[0]->total)) {

                    $last30DaysSellReport[] = array(
                                                    "day" => Carbon::now()->subDays($i)->format('d'),
                                                    "amount" => 0
                                                    
                                                );

                    
                }else{
                    
                    $last30DaysSellReport[] = array(
                                                    "day" => Carbon::now()->subDays($i)->format('d'),
                                                    "amount" => $last30Days[0]->total
                                                    
                                                );
                
                }
                
            }
            //end 30 days sell report
            

            //start last week ingridients pediction stock report
            $oneWeekIngridientPredictionReport=[];
            $higestOneWeekIngridientPredictionReport=0;

            $startDAte = Carbon::now();
            $endDAte = Carbon::now()->subDays(7)->setTime(0, 0, 0);

            $oneWeekIngridientPrediction = DB::table('ingridients')
                                                ->where('created_at', '<=', $startDAte)
                                                ->where('created_at', '>=', $endDAte)
                                                ->where('ingridient_logs.type', '=', 'Credit')
                                                ->join('ingridient_logs', 'ingridients.id', '=', 'ingridient_logs.ingridient_id')
                                                ->select(DB::raw('ingridients.id, ingridients.stock, SUM(ingridient_logs.amount) as total'))
                                                ->groupBy('ingridient_logs.ingridient_id')
                                                ->orderBy('ingridients.id', 'asc')
                                                ->get();

            foreach ($oneWeekIngridientPrediction as  $value) {
                $oneWeekIngridientPredictionReport[] = array(
                                                    "amount" => $value->total,
                                                    "stock" => $value->stock,
                                                    "id" => $value->id,
                                                    
                                                );
                //echo $value->stock." - ".$value->total."<br/>";
                if ($value->stock > $higestOneWeekIngridientPredictionReport) {
                        $higestOneWeekIngridientPredictionReport = $value->stock;
                }
            }
            //end last week ingridients pediction stock report


            //start 15days last week ingridients pediction stock report
            $fifteenDsIngridientsReports=[];
            $higestfifteenDsIngridientsReports=0;

            $startDAte = Carbon::now();
            $endDAte = Carbon::now()->subDays(15)->setTime(0, 0, 0);

            $fifteendaysIngridientPrediction = DB::table('ingridients')
                                                ->where('created_at', '<=', $startDAte)
                                                ->where('created_at', '>=', $endDAte)
                                               ->where('ingridient_logs.type', '=', 'Credit')
                                                ->join('ingridient_logs', 'ingridients.id', '=', 'ingridient_logs.ingridient_id')
                                                ->select(DB::raw('ingridients.id, ingridients.stock, SUM(ingridient_logs.amount) as total'))
                                                ->groupBy('ingridient_logs.ingridient_id')
                                                ->orderBy('ingridients.id', 'asc')
                                                ->get();

            foreach ($fifteendaysIngridientPrediction as  $value) {
                $fifteenDsIngridientsReports[] = array(
                                                    "amount" => $value->total,
                                                    "stock" => $value->stock,
                                                    "id" => $value->id,
                                                    
                                                );
                //echo $value->stock." - ".$value->total."<br/>";
                if ($value->stock > $higestfifteenDsIngridientsReports) {
                        $higestfifteenDsIngridientsReports = $value->stock;
                }
            }
            //end last week ingridients pediction stock report



            //start order status report
            $orderStatusReport=[];
            $sumOfOrderStatus=0;

            //$startDAte = Carbon::now();
            //$endDAte = Carbon::now()->subDays(7)->setTime(0, 0, 0);

            $delivered = DB::table('orders')
                                                //->where('created_at', '<=', $startDAte)
                                                //->where('created_at', '>=', $endDAte)
                                                ->where('orders.order_status', '=', 2)
                                                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                                                ->select(DB::raw('COUNT(order_items.id) as total'))
                                                ->get();

            $onCookingStage = DB::table('orders')
                                                //->where('created_at', '<=', $startDAte)
                                                //->where('created_at', '>=', $endDAte)
                                                ->where('orders.order_status', '!=', 2)
                                                ->where('order_items.cook_status', '<', 2)
                                                ->where('order_items.serve_status', '=', 0)
                                                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                                                ->select(DB::raw('COUNT(order_items.id) as total'))
                                                ->get();
            
            $onServingStage = DB::table('orders')
                                                //->where('created_at', '<=', $startDAte)
                                                //->where('created_at', '>=', $endDAte)
                                                ->where('orders.order_status', '!=', 2)
                                                ->where('order_items.cook_status', '=', 1)
                                                ->where('order_items.serve_status', '=', 1)
                                                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                                                ->select(DB::raw('COUNT(order_items.id) as total'))
                                                ->get();

                                                 

            
            $orderStatusReport[] = array("total" => $delivered[0]->total);
            //echo $delivered[0]->total."<br/>";

            $orderStatusReport[] = array("total" => $onCookingStage[0]->total);
            //echo $onCookingStage[0]->total."<br/>";

            $orderStatusReport[] = array("total" => $onServingStage[0]->total);
            /////echo $onServingStage[0]->total."<br/>";

            $sumOfOrderStatus = $delivered[0]->total+$onCookingStage[0]->total+$onServingStage[0]->total;

            //end order status report


            ///pie chart report
            $startDAte = Carbon::now()->setTime(0, 0, 0);
            //$endDAte = Carbon::now()->subDays(7)->setTime(0, 0, 0);
            $dineinResult = DB::table('orders')
                                        ->where('created_at', '<=', $startDAte)
                                        // //->where('created_at', '>=', $endDAte)
                                        // ->where('orders.order_status', '!=', 2)
                                        // ->where('order_items.cook_status', '=', 1)
                                        ->where('orders.order_type', '=', 1)
                                        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                                        ->select(DB::raw('COUNT(order_items.id) as total'))
                                        ->get();

            $takeAwayResult = DB::table('orders')
                                        ->where('created_at', '<=', $startDAte)
                                        // //->where('created_at', '>=', $endDAte)
                                        // ->where('orders.order_status', '!=', 2)
                                        // ->where('order_items.cook_status', '=', 1)
                                        ->where('orders.order_type', '=', 2)
                                        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                                        ->select(DB::raw('COUNT(order_items.id) as total'))
                                        ->get();

            $sum= $dineinResult[0]->total+$takeAwayResult[0]->total;

            if ($sum) {
                $dineIn = $dineinResult[0]->total*100/$sum;
                $takeAway = $takeAwayResult[0]->total*100/$sum;
            }else{

                $dineIn = 0;
                $takeAway = 0;
            }

        




            return view("admin.reports")->with('last7DaysSellReport', $last7DaysSellReport)
                                        ->with('highest7DaysValue', $highest7DaysValue)
                                        ->with('todaySellReport', $todaySellReport)
                                        ->with('highestTodayValue', $highestTodayValue)
                                        ->with('last30DaysSellReport', $last30DaysSellReport)
                                        ->with('oneWeekIngridientPredictionReport', $oneWeekIngridientPredictionReport)
                                        ->with('higestOneWeekIngridientPredictionReport', $higestOneWeekIngridientPredictionReport)
                                        ->with('fifteenDsIngridientsReports', $fifteenDsIngridientsReports)
                                        ->with('higestfifteenDsIngridientsReports', $higestfifteenDsIngridientsReports)
                                        ->with('orderStatusReport', $orderStatusReport)
                                        ->with('sumOfOrderStatus', $sumOfOrderStatus)
                                        ->with('dineIn', $dineIn)
                                        ->with('takeAway', $takeAway);


                
        }elseif(Auth::user()->user_type=="Kitchen"){
            return redirect('/kot');
        }else{
            return redirect('/');
        }

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
