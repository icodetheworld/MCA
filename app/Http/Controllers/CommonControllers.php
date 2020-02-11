<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CommonControllers extends Controller
{
    public function classes(){
        $data=DB::table('room')->orderby('class')->paginate(15);
        $class=DB::table('class')->orderby('class','DESC')->get();
        $house=DB::table('house')->orderby('name')->get();
        return view('admin.classes')->with('data',$data)->with('class',$class)->with('house',$house);
    }
    public function add_house(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:house|max:255',
        ]);
        if(DB::table('house')->insert([
            'name'     =>      $request->input('name')
        ])){
            return back()->withErrors(['Added Succesfully', 'Added Succesfully']);;
        }
        return back()->withErrors(['Something went wrong', 'Something went wrong']);;
        }
    public function add_class(Request $request){
        $validatedData = $request->validate([
            'class' => 'required|unique:class|max:255',
        ]);
        if(DB::table('class')->insert([
            'class'     =>      $request->input('class')
        ])){
            return back()->withErrors(['Added Succesfully', 'Added Succesfully']);;
        }
        return back()->withErrors(['Something went wrong', 'Something went wrong']);;
        }
    public function add_room(Request $request){
        $check=DB::table('room')->where('class',$request->input('class'))->where('division',$request->input('division'))->first();
        if($check==null){
            if(DB::table('room')->insert([
                'class'     =>      $request->input('class'),
                'division'  =>      $request->input('division')
            ])){
                return back()->withErrors(['Added Succesfully', 'Added Succesfully']);;
            }
            return back()->withErrors(['Failed to create', 'Failed to create']);;
        }
       
        return back()->withErrors(['Already Have  ', 'Already Have  ']);;
    }
    public function timetable()
    {
        $data = DB::table('room')->orderby('class')->get();
        return view('admin.timetable')->with('data',$data)->with('stat',0);
    }
    public function timetable_class($id)
    {
        $mon = DB::table('timetable')->where('room',$id)->where('day','monday')->orderby('section')->get();
        $tue = DB::table('timetable')->where('room',$id)->where('day','tuesday')->orderby('section')->get();
        $wed = DB::table('timetable')->where('room',$id)->where('day','wednessday')->orderby('section')->get();
        $thu = DB::table('timetable')->where('room',$id)->where('day','thursday')->orderby('section')->get();
        $fri = DB::table('timetable')->where('room',$id)->where('day','friday')->orderby('section')->get();
        $room = DB::table('room')->where('id',$id)->first();
        $subjects=DB::table('subjects')->where('class_id',$room->class)->get();
        return view('admin.timetable')->with('stat',1)->with('room',$room)->with('subjects',$subjects)->with('mon',$mon)->with('tue',$tue)->with('wed',$wed)->with('thu',$thu)->with('fri',$fri);
    }
    public function timetable_add(Request $request){
        $id=$request->input('id');
        $day=$request->input('day');
        $period=$request->input('period');
        $subject=$request->input('subject');

        $check=DB::table('timetable')->where('room',$id)->where('day',$day)->where('section',$period)->first();
        if($check==null){
            if(DB::table('timetable')->insert([
                'room'      =>  $id,
                'day'       =>  $day,
                'section'   =>  $period,
                'subject'   =>  $subject,
            ])){
                return back()->withErrors(['Added Succesfully', 'Added Succesfully']);;
            }else{
                return back()->withErrors(['Failed to add', 'Failed to add']);;
            }
        }else if(DB::table('timetable')->where('room',$id)->where('day',$day)->where('section',$period)->update([
            'subject'   => $subject
        ])){
            return back()->withErrors(['Existing field updated', 'Existing field updated']);;
        }
        else{
            return back()->withErrors(['Already Exist', 'Already Exist']);
        }
    }


    // exams----------------
    public function exam(){
        $data = DB::table('class')->orderby('class')->get();
        return view('admin.exam.timetable')->with('data',$data)->with('stat',0);
    }
    public function exam_class($id){
        $data=DB::table('exam_schedule')->where('class',$id)->orderby('date')->get();
        $subjects=DB::table('subjects')->where('class_id',$id)->get();
        return view('admin.exam.timetable')->with('stat',1)->with('data',$data)->with('id',$id)->with('subject',$subjects);
    }
    public function exam_add(Request $request){
        $date=$request->input('date');
        $time=$request->input('time');
        $subject=$request->input('subject');
        $id=$request->input('id');
        $check=DB::table('exam_schedule')->where('class',$id)->where('subject',$subject)->first();
        if($check==null){
            if(DB::table('exam_schedule')->insert([
                'class'     => $id,
                'subject'   => $subject,
                'date'      => $date,
                'time'      => $time
            ])){
                return back()->withErrors(['Schedule added Succesfully', 'Schedule added Succesfully']);
            }
            return back()->withErrors(['Failed to create schedule', 'Failed to create schedule']);
        }else{
            return back()->withErrors(['Already Exists, Check the table', 'Already Exists, Check the table']);
        }   
    }
    public function exam_delete($id){
        if(DB::table('exam_schedule')->where('id',$id)->delete()){
            return back()->withErrors(['Schedule Deleted', 'Schedule Deleted']);
        }
        return back()->withErrors(['Failed to Delete schedule', 'Failed to Delete schedule']);
    }
    public function exam_clear(){
        if(DB::table('exam_schedule')->delete())
            {return redirect('/exam')->withErrors(['Data Cleared', 'Data Cleared']);}
        else
            return redirect('/exam')->withErrors(['Something went wrong', 'Something went wrong']);
    }


    // marks -----------
    public function marks(){
        $data = DB::table('room')->orderby('class')->get();
        return view('admin.exam.mark')->with('data',$data)->with('stat',0);
    }
    public function marks_class($id){
        $data=DB::table('students')->where('room',$id)->get();
        $subjects=DB::table('subjects')->where('class_id',$id)->get();
        return view('admin.exam.mark')->with('stat',1)->with('data',$data)->with('id',$id)->with('subject',$subjects);
    }
    public function student_mark($id){
        $stud=DB::table('students')->where('id',$id)->first();
        $subs=DB::table('subjects')->where('class_id',$stud->class)->get();
        return view('admin.exam.mark_single')->with('stud',$stud)->with('subs',$subs);
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
        return redirect('/marks/'.$room)->withErrors(['Successfully Completed', 'Successfully Completed']);;
    }
    public function result(){
        return view('admin.exam.result')->with('stat',0);
    }
    public function flush(Request $request){
        return redirect('/result/'.$request->input('id'));
    }
    public function result_view($id){
        $stud=DB::table('students')->where('id',$id)->first();
        if($stud){
            $subjects=DB::table('subjects')->where('class_id',$stud->class)->get();
            return view('admin.exam.result')->with('stat',1)->with('stud',$stud)->with('subs',$subjects);
        }
        return view('admin.exam.result')->with('stat',2);
    }
    public function clear(){
        DB::table('marks')->delete();
        return back()->withErrors(['All Marks Cleared','All Marks Cleared']);
    }
}

