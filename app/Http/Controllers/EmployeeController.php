<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Datatables;
use App\Employees;
use Gate;
class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return Datatables::of(Employees::query())->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function getemployees(){
         if(!Gate::allows('isAdmin')){
            abort(404,"Sorry, You can do this actions");
        }
    	 return view('show_employee');
    }
 
    public function save(Request $request){
    	$employee = new Employees;
    	$employee->firstname = $request->input('firstname');
    	$employee->lastname = $request->input('lastname');
  		$employee->save();
 
  		return redirect('/employees');
    }
 
    public function update(Request $request, $id){
    	$employee = Employees::find($id);
    	$input = $request->all();
		$employee->fill($input)->save();
 
    	return redirect('/employees');
    }
 
    public function delete($id)
    {
        $employees = Employees::find($id);
        $employees->delete();
 
        return redirect('/employees');
    }
}
