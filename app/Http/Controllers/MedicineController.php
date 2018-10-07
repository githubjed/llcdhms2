<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MedPurchase;
use App\Medicine;
use Illuminate\Support\Carbon;
use DB;
use DateTime;
use Auth;

class MedicineController extends Controller
{
    //  public function index(){
    //     return view('show_medicine');
    // }
 
    public function getMedicines(){
        $medicines = DB::table('medicines')
                   // ->join('med_ins', 'medicines.med_id','=', 'med_ins.med_id')
                    ->paginate(3);

        return view('show_medicine', compact('medicines'));
    }
 
    public function save(Request $request){

        // $now = new DateTime();
        // $medicine = new Medicine;
        // $medicine->med_id = $request->input('med_id');
        // $medicine->med_name = $request->input('med_name');
        // $medicine->med_cat = $request->input('med_cat');
        // $medicine->med_price = $request->input('med_price');
        // $medicine->med_qty = $request->input('med_qty');
        // $medicine->save();

        // $med_in = new MedIn;
        // $med_in->med_id = $request->input('med_id');
        // $med_in->medIn_qty = $request->input('med_qty');
        // $med_in->added_by = Auth::user()->name;
        // $med_in->date_added = $now->format('Y-m-d H:i:s');
        // $med_in->expiry_date = $request->input('expiry_date');
        // $med_in->save();    

        $medicine = Medicine::updateOrCreate([
            'med_name' => $request->input('med_name')
        ],[
            'med_cat'   =>$request->input('med_cat'),
            'quantity'  =>$request->input('quantity'),
            'med_price' =>$request->input('med_price'),
            'expiration_date' => $request->input('expiry_date')
         ]
        );

        $medPurchase = MedPurchase::create([
                            'user_id'     => auth()->user()->id,
                            'medicine_id' => $medicine->id,
                            'number_received' => $request->input('quantity'),
                            'purchase_date'   => Carbon::now()->format('Y-m-d H:m:i')
                        ]);

    //  	$medicine = new Medicine;
    // 	    $medicine->med_name = $request->input('med_name');
    //      $medicine->med_cat = $request->input('med_cat');
    //      $medicine->quantity = $request->input('quantity');
    // 	    $medicine->med_price = $request->input('med_price');
  	//      $medicine->save();
 
        return redirect('/medicines');
    }
    public function add_med(Request $request, $id){
        
        $now = new DateTime();
        $values = array(
            'med_id'    => $request->input('med_id'),
            'medIn_qty' => $request->input('medin_qty'),
            'expiry_date' => $request->input('exp_date'),
            'added_by' => Auth::user()->name,
            'date_added' => $now

        );  
        DB::table('med_ins')
            ->where('med_id','=',$id)
            ->insert($values);

        $new_qty = $request->input('medin_qty') + $request->input('med_qty');
        $insert = array(
                'med_qty' => $new_qty
        );

        DB::table('medicines')
            ->where('med_id','=',$id)
            ->insert($insert);
            return redirect('/medicines');
    }

    public function update(Request $request, $id){
        $medicine = Medicine::find($id);
        $input = $request->all();
        $medicine->fill($input)->save();
 
        return redirect('/medicines');
    }
 
    public function delete($id)
    {
        $medicines = Medicine::find($id);
        $medicines->delete();
 
        return redirect('/medicines');
    }

    /*
    *  This function will subtract the medicine ordered
    *  from the medicine's inventory.
    *  
    *   @Params medicine_name, users_id, quantity, patient_id
    */
    public function order()
    {
        // $medicine_name = Medicine::whereName(request()->name)->get();



    }

    public function history()
    {
        $medicines = Medicine::with(['purchases' , 'orders'])->get();

        return $medicines;
    }
}
