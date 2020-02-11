<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\student;
use Illuminate\Support\Facades\Hash;
class PController extends Controller
{

    public function index(){
        $id=Auth::user()->parent_id;
        $data=DB::table('parents')->where('id',$id)->first();
        $kids=DB::table('parent_relation')->where('parent_id',$id)->get();
        return view('parent.index')->with('data',$data)->with('kids',$kids);
    }
    public function view($id){
        $check=DB::table('parent_relation')->where('student_id',$id)->where('parent_id',Auth::user()->parent_id)->first();
        if($check==null) return back();
        else{
            $data=student::where('id',$id)->first();
            $id=$data->room;
            $mon = DB::table('timetable')->where('room',$id)->where('day','monday')->orderby('section')->get();
            $tue = DB::table('timetable')->where('room',$id)->where('day','tuesday')->orderby('section')->get();
            $wed = DB::table('timetable')->where('room',$id)->where('day','wednessday')->orderby('section')->get();
            $thu = DB::table('timetable')->where('room',$id)->where('day','thursday')->orderby('section')->get();
            $fri = DB::table('timetable')->where('room',$id)->where('day','friday')->orderby('section')->get();
            $room = DB::table('room')->where('id',$id)->first();
            $subjects=DB::table('subjects')->where('class_id',$room->class)->get();    
        return view('parent.stud')->with('data',$data)->with('room',$room)->with('subjects',$subjects)->with('mon',$mon)->with('tue',$tue)->with('wed',$wed)->with('thu',$thu)->with('fri',$fri);
        }
    }
    public function settings(Request $request)
    {   
        $password = $request->input('pass');
        if($password!='')
        {DB::table('users')->where('id',Auth::user()->id)->update([
            'password'      =>  Hash::make($password)
        ]);
        return back()->withErrors(['Password Changed', 'Password Changed']);}
        return back();
    }
}
