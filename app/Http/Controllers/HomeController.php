<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use Charts;
use DB;
use App\Patient;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('dashboard');
    // }

    public function admin()
    {
        
        $products = Patient::where(DB::raw("(DATE_FORMAT(created_at, '%Y'))"),date('Y'))->get();
        $chart = Charts::database($products, 'bar', 'highcharts')
                  ->title("Sale Details")
                  ->colors(['#30a5ff'])
                  ->elementLabel("Total Sales")
                  ->dimensions(1000, 500)
                  ->responsive(true)
                  ->groupByMonth(date('Y'), true);
        $year = new DateTime();
        $areaspline_chart = Charts::multi('bar', 'highcharts')
                    ->title('Pat=>, Details')
                    ->colors(['green', '#8ad919'])
                    ->elementLabel("No. of Patients")
                    ->labels([
                        'January, '.$year->format('Y'),
                        'February, '.$year->format('Y'),
                        'March, '.$year->format('Y'), 
                        'April, '.$year->format('Y'), 
                        'May, '.$year->format('Y'),
                        'June, '.$year->format('Y'),
                        'July, '.$year->format('Y'),
                        'August, '.$year->format('Y'),
                        'September, '.$year->format('Y'),
                        'October, '.$year->format('Y'),
                        'November, '.$year->format('Y'),
                        'December, '.$year->format('Y'),
                    ])
                    ->dataset('In-Patient', [10, 15, 20, 25, 30, 35, 30, 40, 45, 48, 50, 45])
                    ->dataset('Out-Patient',  [14, 19, 26, 32, 40, 50, 55, 53,58, 60, 65, 70]);
       
        return view('dashboard', compact('chart','areaspline_chart'));
    }
    public function profile()
    {
        return view('profile', array('user' => Auth::user()));
    }
    public function update_avatar(Request $request)
    {
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' .  $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/uploads/'. $filename ));
 
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
            return view('profile', array('user' => Auth::user()));
    }
}
