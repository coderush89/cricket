<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Auth; 
use App\Players;
use App\Stats;
use App\Teams;
use App\Matches;
use DB;
use Illuminate\Support\Facades\Validator;

class MatchesController extends Controller
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
        $this->data['title']='Matches'; 
        $this->data['matches'] = DB::table('tbl_matches as m')
                                  ->select('m.match_date','m.id','t1.team_name as teamone','t2.team_name as teamtwo')
                                  ->join('tbl_teams as t1','m.team_one_id','=','t1.id')
                                  ->join('tbl_teams as t2','m.team_two_id','=','t2.id') 
                                  ->get(); 
 
        return view('admin/matches',$this->data);
    }

    public function addMatch() {
      $this->data['title']='Add Match';
      $this->data['teams']=Teams::where('status','1')->get(); 

      return view('admin/addmatch',$this->data);
    }

    public function postMatch(Request $request) {
        $v = Validator::make($request->all(), [
            'team_one' => ['required', 'string', 'max:255'],
            'team_two' => ['required', 'string', 'max:255'],  
            'match_date' => ['required','date_format:d-m-Y H:i'],  
        ]);

        if ($v->fails())
        { 
          return redirect()->back()->withErrors($v->errors())->withInput();
        }

        //check match exists 
        $matchSave = '';
        $checkMatch = Matches::where(function($query) use ($request) {
                            $query->where('team_one_id',$request->team_one)
                                    ->where('team_two_id',$request->team_two)
                                    ->where('match_date',date('Y-m-d H:i:s',strtotime($request->match_date))); 
                            })->orWhere('team_one_id',$request->team_two)
                                    ->where('team_two_id',$request->team_one)
                                    ->where('match_date',date('Y-m-d H:i:s',strtotime($request->match_date)))
                                    ->get();   
                             

        if($checkMatch->isEmpty()) {

            $matchSave = ''; 
     
            $obj = new Matches;

            $obj->team_one_id=$request->team_one;
            $obj->team_two_id=$request->team_two;
            $obj->match_date=date('Y-m-d H:i:s',strtotime($request->match_date)); 


            $matchSave = $obj->save();

            if($matchSave) {
               \Session::flash('success', 'Match added successfully'); 
            } else {
               \Session::flash('error', 'Unable to add match');
            }   
          
        } else {
            \Session::flash('success', 'Match already exists');
        }

        return redirect()->back(); 
    }

    public function postPlayer(Request $request) {
          
        $v = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],  
            'country' => ['required', 'string', 'max:255'], 
            'jersey_number' => ['required', 'string', 'max:255'],   
            'team_id' => ['required', 'string', 'max:255'],   
            'profile_pic' => 'sometimes|mimes:jpeg,bmp,png,jpg,svg|max:5120'
        ]);

        if ($v->fails())
        { 
            return redirect()->back()->withErrors($v->errors());
        }

        $playerSave = ''; 

           $profilePic = '';
           if ($request->file('profile_pic')) {
                $profilePic = $this->storePic($request->file('profile_pic'));
           }

           $obj = new Players;

           $obj->firstname=$request->firstname;
           $obj->lastname=$request->lastname;
           $obj->jersey_number=$request->jersey_number;
           $obj->country=$request->country;
           $obj->team_id=$request->team_id;
 
           if($profilePic) {
            $obj->profile_pic = $profilePic;             
           }

           $playerSave = $obj->save();   
          
         
        if($playerSave) {
           \Session::flash('success', 'Player added successfully'); 
        } else {
           \Session::flash('error', 'Unable to add team');
        }

        return redirect()->back(); 
    }

    public function manageStats($id) {
        $this->data['title']='Manage Stats';
        $this->data['stats']=Stats::first();
        $this->data['id']=$id;
        
        return view('admin/playerstats',$this->data);
    }

       public function storePic($file) {

        $destinationPath = storage_path('app/public/images/player/');

        $image_name = time() . '.' . $file->getClientOriginalExtension();
        $img = \Image::make($file->getRealPath());
        $img->save($destinationPath . '/' . $image_name);
        // $img->resize(200, 200, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destinationPath . '/thumbnails/' . $image_name);
        return $image_name;
    }

    public function postManageStats(Request $request,$id='') {
        $v = Validator::make($request->all(), [
            'matches' => ['required', 'string', 'max:255'],
            'runs' => ['required', 'string', 'max:255'],   
        ]);

        if ($v->fails())
        { 
            return redirect()->back()->withErrors($v->errors());
        }

        $playerStats = ''; 
 
           $obj = new Stats;

           $obj->matches=$request->matches;
           $obj->runs=$request->runs;
           $obj->highest_score=$request->highest_score;
           $obj->fifties=$request->fifties;
           $obj->hundreds=$request->hundreds;
           $obj->player_id=$id;

           $playerStats = $obj->save();   
          
         
        if($playerStats) {
           \Session::flash('success', 'Player stats added successfully'); 
        } else {
           \Session::flash('error', 'Unable to add player stats');
        }

        return redirect()->back(); 
    }

 
}
