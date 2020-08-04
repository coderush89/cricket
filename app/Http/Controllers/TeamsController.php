<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Auth; 
use App\Teams;
use App\Points;
use Illuminate\Support\Facades\Validator;

class TeamsController extends Controller
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
        $this->data['title']='Teams'; 
        $this->data['teams']= Teams::all();
        
        return view('admin/teams',$this->data);
    }

    public function add() {
        $this->data['title']='Add Teams';

        return view('admin/addteams',$this->data);
    }

    public function postTeam(Request $request) {
          
        $v = Validator::make($request->all(), [
            'team_name' => ['required', 'string', 'max:255'],
            'team_state' => ['required', 'string', 'max:255'],  
            'team_logo' => 'sometimes|mimes:jpeg,bmp,png,jpg,svg|max:5120'
        ]);

        if ($v->fails())
        { 
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        $profileUpdate = ''; 

           $teamLogo = '';
           if ($request->file('team_logo')) {
                $teamLogo = $this->storeLogo($request->file('team_logo'));
           }

           $obj = new Teams;

           $obj->team_name=$request->team_name;
           $obj->state=$request->team_state; 

           if($teamLogo) {
            $obj->team_logo = $teamLogo;             
           }

           $teamSave = $obj->save();   
          
         
        if($teamSave) {
           \Session::flash('success', 'Team created successfully'); 
        } else {
           \Session::flash('error', 'Unable to create team');
        }

        return redirect()->back(); 
    }

       public function storeLogo($file) {

        $destinationPath = storage_path('app/public/images/teams/');

        $image_name = time() . '.' . $file->getClientOriginalExtension();
        $img = \Image::make($file->getRealPath());
        $img->save($destinationPath . '/' . $image_name);
        // $img->resize(200, 200, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destinationPath . '/thumbnails/' . $image_name);
        return $image_name;
    }

    public function managePoints($id="") {
        $this->data['title']='Manage Team Point';
        $this->data['id']=$id;
        $this->data['points'] = Points::where('team_id',$id)->get()->first();

        return view('admin/managepoints',$this->data);
    }

    public function postPoints(Request $request,$id=''){
        $v = Validator::make($request->all(), [
            'points' => ['required', 'string', 'max:255']
        ]);

        if ($v->fails())
        { 
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

           $pointSave = ''; 
 
           $obj = Points::firstOrNew(['team_id'=>$id]);


           $obj->points=$request->points;
           $obj->team_id=$id; 
 
           $pointSave = $obj->save();   
          
         
        if($pointSave) {
           \Session::flash('success', 'Points saved successfully'); 
        } else {
           \Session::flash('error', 'Unable to save points');
        }

        return redirect()->back(); 
    }
 
}
