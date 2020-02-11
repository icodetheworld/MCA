<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\room;
use App\teachers;
use Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index(){
        $room=room::orderby('class','ASC')->orderby('division','ASC')->get();
        $house=DB::table('house')->get();
        $data=DB::table('teachers')->get();
        return view('admin.teachers.all')->with('data',$data)->with('room',$room)->with('house',$house);
    }
    public function teacher($id){
        $data=DB::table('teachers')->where('id',$id)->first();
        return view('admin.teachers.details')->with('data',$data);
    }
    public function add(){
        
        return view('admin.students.add');
    }
    public function suck(Request $request){
        $request->validate([
            'email'     => 'required | unique:users| max:191',
            'email'     => 'required | unique:teachers| max:191'
        ]);
        DB::transaction(function() use($request){
            DB::table('teachers')->insert([
                'doj' => $request->input('doj'),
                'name'    =>  $request->input('name'),
                'qualification'    =>  $request->input('qualification'),
                'gender'    =>  $request->input('gender'),
                'dob'    =>  $request->input('dob'),
                'email'    =>  $request->input('email'),
                'room_id'    =>  $request->input('room'),
                'phone'    =>  $request->input('phone'),
                'address'    =>  $request->input('address'),
                'created_by'    =>  Auth::user()->id,
            ]);
            $id=DB::table('teachers')->where('email',$request->input('email'))->first()->id;
            DB::table('users')->insert([
                'name'      =>  $request->input('name'),
                'email'     =>  $request->input('email'),
                'role'      =>  'teacher',
                'by'        =>  Auth::user()->id,
                'password'  =>  Hash::make($request->input('phone')),
                'teacher_id' =>  $id
            ]);

        });
        return redirect('/all_teachers')->withErrors(['Successfully Added', 'Successfully Added']);
    }
    public function delete($id){
        if(DB::table('teachers')->where('id',$id)->delete()){
            return redirect('/all_teachers')->withErrors(['Successfully Deleted', 'Successfully Deleted']);
        }
        return redirect('/all_teachers')->withErrors(['Failed, Try Again', 'Failed, Try Again']);
    }
    public function edit_view($id){
        $room=room::orderby('class','ASC')->orderby('division','ASC')->get();
        $house=DB::table('house')->get();
        $data=DB::table('teachers')->where('id',$id)->first();
        return view('admin.teachers.edit')->with('data',$data)->with('room',$room)->with('house',$house);
    }
    
    public function edit(Request $request){
        $id=$request->input('id');
        if(teachers::where('id',$id)->update([
            'doj' => $request->input('doj'),
            'name'    =>  $request->input('name'),
            'qualification'    =>  $request->input('qualification'),
            'gender'    =>  $request->input('gender'),
            'dob'    =>  $request->input('dob'),
            'room_id'  =>  $request->input('room'),
            'email'    =>  $request->input('email'),
            'phone'    =>  $request->input('phone'),
            'address'    =>  $request->input('address'),
        ])){
            return redirect('/all_teachers')->withErrors(['Successfully Updated', 'Successfully Updated']);
        }else{
            return redirect('/all_teachers')->withErrors(['Failed, Try Again', 'Failed, Try Again']);
        }
    }
}
