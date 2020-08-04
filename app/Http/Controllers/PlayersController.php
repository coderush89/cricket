<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Auth; 
use App\Players;
use App\Stats;
use App\Teams;
use DB;
use Illuminate\Support\Facades\Validator;

class PlayersController extends Controller
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
        $this->data['title']='Players'; 
        $this->data['players'] = DB::table('tbl_player as p')
                                  ->select('p.id','p.firstname','p.lastname','p.country','p.jersey_number','p.status','t.team_name as playerteam')
                                  ->join('tbl_teams as t','p.team_id','=','t.id') 
                                  ->get(); 
 


        return view('admin/players',$this->data);
    }

    public function add() {
        $this->data['title']='Add Teams';
        $this->data['teams']=Teams::where('status','1')->get();

        return view('admin/addplayer',$this->data);
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
        $this->data['stats']=Stats::where('player_id',$id)->get()->first();
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
            'highest_score' => ['required', 'string', 'max:255'],   
        ]);

        if ($v->fails())
        { 
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        $playerStats = ''; 
 
           $obj = Stats::firstOrNew(['player_id'=>$id]);

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
