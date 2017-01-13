<?php

namespace App\Http\Controllers;

use App\Goal;
use App\Http\Requests;
use App\Run;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Session\Session;

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
    public function index(Request $request)
    {
        $message = $request->session()->get("message");
        $goal = Goal::where("goal_year","=",date("Y"))->first();
        return view('home')->with('runs', Auth::user()->runs)->with("message", $message)->with("goal", $goal);
    }

    public function runs(Request $request)
    {
        $run = new Run();
        $run->distance = $request->get("distance");
        $run->run_date = date("Y-m-d", strtotime($request->get("runDate")));
        $hours = $minutes = $seconds = 0;
        sscanf($request->get("runTime"), "%d:%d:%d", $hours, $minutes, $seconds);
        $run->run_time = $hours * 3600 + $minutes * 60 + $seconds;
        $run->user_id = Auth::user()->id;
        $run->save();
        $request->session()->flash("message", sprintf("Your run of %s miles in %s on %s has been saved.", $run->distance, $run->run_time, $run->run_date));
        return redirect()->back();
    }

    public function getGoal(Request $request)
    {
        $date = date("Y");
        return view('goals')->with("date", $date);
    }

    public function postGoal(Request $request)
    {
        $goal = Goal::where("goal_year","=",date("Y"))->first();
        if (null == $goal) {
            $goal = new Goal();
            $goal->user_id = Auth::user()->id;
        }
        $goal->goal_year = date("Y");
        $goal->goal_miles = $request->get("goal");
        $goal->save();
        $request->session()->flash("message", sprintf("Congratulations you updated your goal to %s miles by the end of %s", $goal->goal_miles, $goal->goal_year));
        return redirect(url("/"));
    }
}
