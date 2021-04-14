<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Stock;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
use Carbon\Carbon;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('selected', 'medicine-inventory');

        $medicines = Medicine::all();

      return view('medicine-inventory.index', compact('medicines'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inventory(Request $request)
    {

         $stocks = DB::table('stocks')
        ->join('medicines', 'medicine_id', 'medicine_id_fk')
        ->selectRaw('*, sum(qty_changed) as pulled_out')
        ->where('stocks.desc', 'removed')
        ->whereMonth('stocks.created_at', Carbon::now()->month)
        ->orderBy('stocks.created_at', 'asc')
        ->groupBy('medicine_id')
        
        ->get();
        // ->groupBy(function($item) {
        //     return \Carbon\Carbon::parse($item->created_at)->timestamp;
        // });

        $transactions = DB::table('stocks')
        ->join('medicines', 'medicine_id', 'medicine_id_fk')
        ->selectRaw('*, sum(qty_changed) as pulled_out')
        ->orderBy('stocks.created_at', 'asc')
        ->groupBy('medicine_id')
        ->groupBy('desc')
        ->get()
        ->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->created_at)->timestamp;
        });
  
    //      $stocks = Stock::where('stocks.created_at', '>=', Carbon::now()->month())
    //    ->join('medicines', 'medicine_id_fk', 'medicine_id')
    //    ->whereMonth('stocks.created_at', Carbon::now()->month)
    //                         // ->groupBy(DB::raw("DATE_FORMAT(stocks.created_at, '%Y-%m-%d')"))
    //                         ->orderBy('stocks.created_at', 'ASC')
    //                         ->get(array(
    //                             DB::raw('medicines.name as drug'),
    //                             DB::raw('Date(stocks.created_at) as date'),
    //                             DB::raw('sum(stocks.qty_changed) as "qty"'),
    //                             DB::raw('medicine_id_fk as "medicine_id"'),
                                
    //                         ));

    return view('medicine-inventory.inventory', compact('stocks','transactions'));

    }

    public function dashboard(Request $request)
    {

        Session::put('selected', 'medicine-inventory');

         $medicines = DB::table('medicines')->where('quantity','<=',100)->get();

      return view('medicine-inventory.dashboard', compact('medicines'));
    
    }

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
    public function store(Request $request)
    {
        $medicine = new Medicine;
        $medicine->name = $request->name;
        $medicine->brand = $request->brand;
        $medicine->mg = $request->mg;
        $medicine->quantity = $request->quantity;
        $medicine->expiration = $request->expiration;
        $medicine->save();

        return back()->with('success', 'Medicine added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit($medicine_id)
    {
        $medicine = Medicine::findOrFail($medicine_id);

         $stocks = DB::table('medicines')
        ->join('stocks', 'medicine_id', 'medicine_id_fk')
        ->join('users', 'user_id_fk', 'id')
        ->select('*', 'stocks.created_at as date', 'users.name as user')
        ->where('medicine_id', $medicine_id)
        ->orderBy('stocks.created_at', 'desc')
        ->groupBy('stock_id')
        ->get();

        return view('medicine-inventory.edit', compact('medicine', 'stocks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $medicine_id)
    {

         $current_stock = Medicine::findOrFail($medicine_id)->quantity;
       

        if($request->qty > $current_stock){
        $diff = ($request->qty-$current_stock );
           $stock = new Stock();
           $stock->medicine_id_fk = $medicine_id;
           $stock->user_id_fk = Auth::user()->id;
           $stock->qty_changed = $diff;
           $stock->desc = 'added';
           $stock->save();
       }else{
        $diff = ($current_stock - $request->qty);
            $stock = new Stock();
            $stock->medicine_id_fk = $medicine_id;
            $stock->user_id_fk = Auth::user()->id;
            $stock->qty_changed = $diff;
            $stock->desc = 'removed';
            $stock->save();
       }

        $medicine = Medicine::findOrFail($medicine_id);
        $medicine->name = $request->name;
        $medicine->brand = $request->brand;
        $medicine->mg = $request->mg;
        $medicine->quantity = $request->qty;
        $medicine->expiration = $request->expiration;
        $medicine->save();

       

        return redirect()->back()->with('success', 'Changes saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        //
    }
}
