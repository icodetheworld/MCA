<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Carbon\carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class TController extends Controller
{
    public function index(){
        $data=DB::table('teachers')->where('id',Auth::user()->teacher_id)->first();
        return view('teacher.index')->with('data',$data);
    }
    public function atd_all(){
        $data=DB::table('room')->orderby('class')->get();
        $room=DB::table('teachers')->where('id',Auth::user()->teacher_id)->first()->room_id;
        return view('teacher.atd')->with('stat',1)->with('data',$data)->with('room',$room);
    }
    public function atd_view(Request $request){
        $start = new Carbon('first day of this month');
        $data=DB::table('attendance')->where('room',$request->input('class'))->where('day',$request->input('date'))->where('state','on')->get();
        return view('teacher.atd')->with('stat',0)->with('data',$data)->with('date',$request->input('date'))->with('room',$request->input('class'));
    }
    public function take(){
        $data=DB::table('room')->orderby('class')->get();
        $room=DB::table('teachers')->where('id',Auth::user()->teacher_id)->first()->room_id;
        return view('teacher.atd')->with('stat',2)->with('data',$data)->with('room',$room);
    }
    public function class(Request $request){
        $data=DB::table('students')->where('room',$request->input('class'))->get();
        $date=$request->input('date');
        $check=DB::table('atd_room')->where('room_id',$request->input('class'))->where('day',$request->input('date'))->first();
        if($check==null)
            return view('teacher.atd2')->with('data',$data)->with('date',$date)->with('state','add')->with('room',$request->input('class'));
        else{
            $atd=DB::table('attendance')->where('day',$request->input('date'))->where('room',$request->input('class'))->get();
            return view('teacher.atd2')->with('data',$atd)->with('date',$date)->with('state','edit')->with('room',$request->input('class'));
        }
    }

    public function class2(Request $request){
        $data=DB::table('students')->where('room',$request->input('class'))->get();
        $date=$request->input('date');
        $state=$request->input('state');
        $room=$request->input('class');
        if($state=='add'){
            DB::transaction(function() use($room,$date,$data,$request){
                DB::table('atd_room')->insert([
                    'room_id'   =>  $request->input('class'),
                    'day'       =>  $date,
                ]);
                foreach($data as $item){
                    DB::table('attendance')->insert([
                        'stud_id'       =>  $item->id,
                        'state'         =>  $request->input($item->id),
                        'day'          =>  $request->input('date'), 
                        'room'         =>   $room,
                    ]);
                }
            });
            return redirect('/take_attendance');
        }elseif($state=='edit'){
            DB::transaction(function() use($room,$date,$data,$request){
                foreach($data as $item){
                    DB::table('attendance')->where('stud_id',$item->id)->where('day',$date)->where('room',$room)->update([
                    'state' => $request->input($item->id)
                ]);}
            });
        return redirect('/take_attendance');
        }else{
            echo "error";
        }
    }
    public function marks_class(){
        $id=DB::table('teachers')->where('id',Auth::user()->teacher_id)->first()->room_id;
        if($id!=''){
        $data=DB::table('students')->where('room',$id)->get();
        $subjects=DB::table('subjects')->where('class_id',$id)->get();
        return view('teacher.mark1')->with('stat',1)->with('data',$data)->with('id',$id)->with('subject',$subjects);}
    }
    public function add_marks(Request $request){
        $class=$request->input('class');
        $id=$request->input('id');
        $subs=DB::table('subjects')->where('class_id',$class)->get();
        $check=DB::table('marks')->where('student_id',$id)->where('class',$class)->first();
        DB::transaction(function() use($request,$subs,$id,$class,$check){
            if($check){
                foreach($subs as $sub){
                DB::table('marks')->where('student_id',$id)->where('subject_id',$sub->id)->update([
                    'mark'              =>  $request->input($sub->id),
                ]);
                }
            }
            else{
            foreach($subs as $sub){
                DB::table('marks')->insert([
                    'student_id'        =>  $id,
                    'subject_id'        =>  $sub->id,
                    'mark'              =>  $request->input($sub->id),
                    'class'             => $class
                ]);
            }
        }
        });
        $room=DB::table('students')->where('id',$id)->first()->room;
        return redirect('/add_marks/')->withErrors(['Successfully Completed', 'Successfully Completed']);
    }
    public function student_mark($id){
        $stud=DB::table('students')->where('id',$id)->first();
        $teacher=DB::table('teachers')->where('id',Auth::user()->teacher_id)->first();
        if($stud!='' && $stud->room==$teacher->room_id){
        $subs=DB::table('subjects')->where('class_id',$stud->class)->get();
        return view('teacher.mark2')->with('stud',$stud)->with('subs',$subs);}
        else return back();
    }
    public function result(){
        return view('teacher.results')->with('stat',0);
    }
    public function result_view($id){
        $stud=DB::table('students')->where('id',$id)->first();
        if($stud){
            $subjects=DB::table('subjects')->where('class_id',$stud->class)->get();
            return view('teacher.results')->with('stat',1)->with('stud',$stud)->with('subs',$subjects);
        }
        return view('teacher.results')->with('stat',2);
    }
    public function flush(Request $request){
        return redirect('/results/'.$request->input('id'));
    }
    public function pwd(Request $request){
        $request->validate([
            'password'  =>  'required | min:6',
            'id'        =>  'required'
        ]);
            DB::table('users')->where('id',$request->input('id'))->update([
                'password'      =>  Hash::make($request->input('password'))
            ]);
            return back()->withErrors(['Password changed', 'Password changed']);
    }
}
