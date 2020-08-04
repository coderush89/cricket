<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Auth; 
use App\Players;
use App\Stats;
use App\Teams;
use App\Points;
use DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    private $data = array();

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');  
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['title'] = 'Dashboard';

        return view('user/dashboard',$this->data);
    }


    public function teams()
    {
        $this->data['title'] = 'Teams'; 
        $this->data['teams'] = Teams::all(); 

        return view('user/teams',$this->data);
    }

    public function getTeamPlayers($id='')
    {
        $this->data['title'] = 'Players'; 
       $this->data['players'] = DB::table('tbl_player as p')
                                  ->select('p.id','p.profile_pic','p.firstname','p.lastname','p.country','p.jersey_number','p.status','t.team_name as playerteam')
                                  ->join('tbl_teams as t','p.team_id','=','t.id') 
                                  ->where('p.id',$id)
                                  ->get(); 
 

        return view('user/players',$this->data);
    }
    
    public function matches() {
    	$this->data['title']='Matches'; 
        $this->data['matches'] = DB::table('tbl_matches as m')
                                  ->select('m.match_date','m.id','t1.team_name as teamone','t2.team_name as teamtwo')
                                  ->join('tbl_teams as t1','m.team_one_id','=','t1.id')
                                  ->join('tbl_teams as t2','m.team_two_id','=','t2.id') 
                                  ->get(); 
 
        return view('user/matches',$this->data);
    }

    public function points() { 
        $this->data['title']='Points';  
        $this->data['points'] = DB::table('tbl_points as p')
                                  ->select('p.points','t.team_name')
                                  ->join('tbl_teams as t','p.team_id','=','t.id')  
                                  ->get();

        return view('user/points',$this->data);
    }
}