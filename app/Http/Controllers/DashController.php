<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\student;
use App\room;
use Illuminate\Support\Facades\Hash;
use App\subject;
use DB;
use Auth;

class DashController extends HomeController
{
    public function all_students(){
        $data=student::get();
        return view('admin.students.all')->with('data',$data);
    }
    public function student($id){
        $data=student::where('id',$id)->first();
        return view('admin.students.details')->with('data',$data);
    }
    public function admission(){
        $room=room::orderby('class','ASC')->orderby('division','ASC')->get();
        $house=DB::table('house')->get();
        return view('admin.students.add')->with('room',$room)->with('house',$house);
    }
    public function another(Request $request){
        $class=DB::table('room')->where('id',$request->input('room'))->first()->class;
        $request->validate([
            'email'     =>  'required | unique:students| max : 191',
            'email1'    =>  '  unique:parents | max:191',
        ]);
        $s=DB::transaction(function() use($request,$class){
            DB::table('students')->insert([
                'date_of_admission' =>  $request->input('doa'),
                'ad_no'             =>  $request->input('ad_no'),
                'f_name'            =>  $request->input('f_name'),
                'l_name'            =>  $request->input('l_name'),
                'gender'            =>  $request->input('gender'),
                'dob'               =>  $request->input('dob'),
                'name_of_father'    =>  $request->input('father'),
                'name_of_mother'    =>  $request->input('mother'),
                'cast'              =>  $request->input('cast'),
                'religion'          =>  $request->input('religion'),
                'email'             =>  $request->input('email'),
                'room'              =>  $request->input('room'),
                'house'             =>  $request->input('house'),
                'phone'             =>  $request->input('phone'),
                'address'           =>  $request->input('address'),
                'bus'               =>  $request->input('bus'),
                'class'             => $class,
                'created_by'        =>  Auth::user()->id,
            ]);
            $id=DB::table('students')->where('email',$request->input('email'))->first()->id;
            DB::table('bday')->insert([
                'name'      =>  $request->input('f_name').' '.$request->input('l_name'),
                'phone'     =>  $request->input('phone'),
                'month'     =>  date('m',strtotime($request->input('dob'))),
                'day'       =>  date('d',strtotime($request->input('dob'))),
                'stud_id'   =>  $id
            ]);
        });
        $id=DB::table('students')->where('email',$request->input('email'))->first()->id;
        return redirect('all_students')->withErrors(['Registared, Reg No :'.$id, 'Registared, Reg No :'.$id]);
    }
    public function subject(){
        $data=subject::orderby('class_id','desc')->get();
        $class=DB::table('class')->get();
        return view('admin.subjects')->with('data',$data)->with('class',$class);
    }
    public function add_subject(Request $request){
        $validatedData = $request->validate([
            'code' => 'required|unique:subjects|max:255',
        ]);
        if(
            DB::table('subjects')->insert([
                'code'  =>  $request->input('code'),
                'class_id'  =>  $request->input('class'),
                'subject'  =>  $request->input('name'),
                'max'  =>  $request->input('max')
            ])
        )return back();
        else echo "error on adding subject";
    }




//edit student
    public function edit_view($id){
        $room=room::orderby('class','ASC')->orderby('division','ASC')->get();
        $house=DB::table('house')->get();
        $data=student::where('id',$id)->first();
        return view('admin.students.edit')->with('data',$data)->with('room',$room)->with('house',$house);
    }
    public function edit(Request $request){
        if(student::where('id',$request->input('id'))->update([
            'ad_no'     =>$request->input('ad_no'),
            'date_of_admission' => $request->input('doa'),
            'f_name'    =>  $request->input('f_name'),
            'l_name'    =>  $request->input('l_name'),
            'gender'    =>  $request->input('gender'),
            'dob'    =>  $request->input('dob'),
            'name_of_father'    =>  $request->input('father'),
            'name_of_mother'    =>  $request->input('mother'),
            'cast'    =>  $request->input('cast'),
            'religion'    =>  $request->input('religion'),
            'email'    =>  $request->input('email'),
            'room'    =>  $request->input('room'),
            'bus'               =>  $request->input('bus'),
            'house'    =>  $request->input('house'),
            'phone'    =>  $request->input('phone'),
            'address'    =>  $request->input('address'),
            'updated_by'    =>  '1',
        ])){
            return back()->withErrors(['Successfully Updated', 'Successfully Updated']);
        }else{
            return back()->withErrors(['Failed Try Again', 'Failed Try Again']);
        }
    }

    public function delete($id){
        if(student::where('id',$id)->delete()){
            return back()->withErrors(['Deleted Successfully', 'Deleted Successfully']);
        }
        return back()->withErrors(['Something went wrong', 'Something went wrong']);
    }

    public function relation(Request $request){
        $id=$request->input('id');
        $av=DB::table('students')->where('id',$id)->first()->id;
        $tak=DB::table('parent_relation')->where('student_id',$id)->first();
        if($av!=$id){
            return back()->withErrors(['No student record Available', 'No student record Available']);
        }elseif($tak!=null){
            return back()->withErrors(['Currently this student has one parent', 'Currently this student has one parent']);
        }else{
            $c=DB::table('parent_relation')->insert([
                'student_id'       =>  $id,
                'parent_id'     =>  $request->input('par')
            ]);
            if($c) 
                return back()->withErrors(['Successfull Added ', 'Successfull Added ']);
            return back()->withErrors(['Something went wrong', 'Something went wrong']);
        }
    }
    public function promo(){
        $room=DB::table('room')->orderby('class')->get();
        return view('admin.promotion')->with('room',$room);
    }
    public function promotion(Request $request){
        $to=$request->input('to');

        $from=$request->input('from');
        if($to=='done'){
            DB::transaction(function() use($from,$to){
                DB::table('students')->where('room',$from)->delete();
                DB::table('attendance')->where('room',$from)->delete();
            });
            return back()->withErrors(['Students removed from records', 'Students removed from records']);
        }else{
            DB::transaction(function() use($to,$from){
                $room=DB::table('room')->where('id',$to)->first();
                $cls=DB::table('class')->where('id',$room->class)->first();
                DB::table('attendance')->where('room',$to)->delete();
                DB::table('students')->where('room',$from)->update([
                    'class'     =>  $cls->id,
                    'room'      =>  $to
                ]);
            });
            return back()->withErrors(['Students Promoted', 'Students Promoted']);
        }
    }

    public function subject_edit($id){
        $data=DB::table('subjects')->where('id',$id)->first();
        $class=DB::table('class')->get();
        return view('admin.edit_sub')->with('data',$data)->with('class',$class);
    }
    public function edit_subject(Request $request){
            $check=DB::table('subjects')->where('id',$request->input('id'))->update([
                'code'      =>  $request->input('code'),
                'subject'   =>  $request->input('subject'),
                'max'       =>  $request->input('max'),
                'class_id'  =>  $request->input('class')
            ]);
            if($check){
                return back()->withErrors(['Edited Succesfully', 'Edited Succesfully']);
            }
            else{
                return back()->withErrors(['Something went wrong', 'Something went wrong']);
            }
    }
    public function student_room($id){
        $data=student::where('room',$id)->get();
        return view('admin.students.all')->with('data',$data);
    }
    public function student_trans($id){
        $data=student::where('bus','Yes')->get();
        return view('admin.students.all')->with('data',$data);
    }
    public function student_room_t($id){
        $tid=Auth::user()->teacher_id;
        $id=DB::table('teachers')->where('id',$tid)->first()->room_id;
        $data=student::where('room',$id)->get();
        return view('admin.students.all')->with('data',$data);
    }
}

