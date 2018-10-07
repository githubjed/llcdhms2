<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use DB;
use Datatables;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    function index()
    {
        if(!Gate::allows('isAdmin')){
            abort(404,"Sorry, You can do this actions");
        }
    	return view('show_users');
    }
    function getempdata()
    {   

    	$users = User::where('user_role','=',0)
                    ->where('id', '!=' , auth()->user()->id)
                    ->withTrashed()->get();

    	return Datatables::of($users)
                    	->addcolumn('action', function($user){

                                $action_status = $user->user_status == 'Active' ? 'Deactivate' : 'Activate';

                                $btnType = $user->user_status == 'Active' ? 'btn-danger' : 'btn-primary';

                                return '<a href="#" class="btn btn-xs btn-success editemp" id="'.$user->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="#" class="btn btn-xs '.$btnType.' delete" id="'.$user->id.'"><i class="glyphicon glyphicon-eye-open"></i>'.$action_status.'</a>';
                    	})
                    	->make(true);
    }

    function fetchempdata(Request $request)
    {
    	$id = $request->input('id');
    	$user = User::withTrashed()->find($id);

    	$output = array(
    		'user_id'	  => $user->id,
    		'name'   	  => $user->name,
    		'email'   	  => $user->email,
    		'user_role'   => $user->user_role,
    		'show_type'   => $user->user_type,
    		'user_type'	  => $user->user_type,
    		'user_status' => $user->user_status,
    		// 'password'    => $user->password,
    		'avatar'      => $user->avatar
    	);
    	echo json_encode($output);
    }

    public function postempdata()
    {

    //     $validation = Validator::make(request() , [
    //             'name'      => 'required',
    //             'email'     => 'required | email',
    //             'user_type' => 'required'           

    //     ]);
        $error_array = array();
        $success_output = '';

        $role_id = Role::whereName(lcfirst(request()->user_type))->first()->id;


        $user = User::updateOrCreate(['id' => request()->user_id],
                                     [
                                       'email' => request()->email,
                                       'user_role' => $role_id,
                                       'name' => request()->names,
                                       'password' => Hash::make(request()->password)
                                     ]);
        $user->role()->detach();
        $user->role()->attach($role_id);

        $success_output = '<div class="alert alert-success">Data Inserted</div>';

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);

        // if ($validation->fails())
        // {
        //     foreach ($validation->messages()->getMessages() as $field_name => $messages)
        //     {
        //         $error_array[] = $messages; 
        //     }
        // }else{

        //     $id = 

        //     $user = User::updateOrCreate([
        //         'id' => 
        //     ],[

        //     ])


        // }

    }

    public function activation()
    { 
        $user = User::withTrashed()->find(request()->id);

        $user->user_status == 'Active' ? $user->delete() : $user->restore();

        return response()->json([$user] , 201);
    }

    public function resetPassword()
    {
      $id = request()->id;

      $user = User::find($id);

      $user->password = //haspass;
      $user->save();

      return response()->json([$user] , 201);

    }

  // function postempdata(Request $request)
  //   {
  //       $validation = Validator::make($request->all(), [
  //           'user_id'   =>  "required",
  //           'names'        =>  "required",
  //           'email'        =>  "required",
  //           'user_type'        =>  "required",
  //       ]);
        
  //       $error_array = array();
  //       $success_output = '';
  //       if ($validation->fails ())
  //       {
  //           foreach ($validation->messages()->getMessages() as $field_name => $messages)
  //           {
  //               $error_array[] = $messages; 
  //           }
  //       }
  //       else
  //       {
  //           if($request->get('button_action') == 'insert')
  //           {
  //               $user = new User([
  //                   'user_id'   =>  $request->get('user_id'),
  //                   'name'        =>  $request->get('names'),
  //                   'email'        =>  $request->get('email'),
  //                   'user_type'        =>  $request->get('user_type'),
  //               ]);
  //               $user->save();
  //               $success_output = '<div class="alert alert-success">Data Inserted</div>';
  //           }

  //           if($request->get('button_action') == 'update')
  //           {
  //               $user = User::find($request->get('p_id'));

  //                   $user->user_id =  $request->get('user_id');
  //                   $user->name      =  $request->get('name');
  //                   $user->email      =  $request->get('email');
  //                   $user->user_type      =  $request->get('user_type');
  //               $user_type->save();
  //               $success_output = '<div class="alert alert-success">Data Updated</div>';
  //           }
            
  //       }
        
  //       $output = array(
  //           'error'     =>  $error_array,
  //           'success'   =>  $success_output
  //       );
  //       echo json_encode($output);
  //   }

}
