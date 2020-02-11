<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
class BaseController extends HomeController
{
    public function notice(){
        $data= DB::table('notice')->orderby('i_date','DESC')->get();
        return view('admin.notice')->with('data',$data);
    }
    public function notice_add(Request $request){
        if(
            DB::table('notice')->insert([
                'title'     =>  $request->input('title'),
                'content'   =>  $request->input('content'),
                'i_date'    =>  $request->input('date')
            ]))
            return back()->withErrors(['Notice Addedd Succesfully', 'Notice Addedd Succesfully']);

        return back()->withErrors(['Something went wrong', 'Something went wrong']);
    }
    public function notice_delete($id){
        if(
            DB::table('notice')->where('id',$id)->delete())
            return back()->withErrors(['Notice Deleted Succesfully', 'Notice Deleted Succesfully']);

        return back()->withErrors(['Something went wrong', 'Something went wrong']);
    }
    public function settings(){
        $admin=DB::table('users')->where('role','admin')->get();
        $parent=DB::table('users')->where('role','parent')->get();
        $teacher=DB::table('users')->where('role','teacher')->get();
        return view('admin.settings')->with('admin',$admin)->with('parent',$parent)->with('teacher',$teacher);
    }
    public function pwd(Request $request){
        $request->validate([
            'password'     => 'required| min:6',
            'id'           =>   'required',
        ]);
        if($request->input('password')!=''){
        DB::table('users')->where('id',$request->input('id'))->update([
            'password'  =>  Hash::make($request->input('password'))
        ]);
        return back()->withErrors(['Password Updated', 'Password Updated']);}

        return back();
    }
    public function add(Request $request){
        $request->validate([
            'name'      =>  'required',
            'email'     => 'required | unique:users| max:191',
            'password'     => 'required| min:6'
        ]);
        DB::table('users')->insert([
            'name'      =>  $request->input('name'),
            'email'     =>  $request->input('email'),
            'password'  =>  Hash::make($request->input('password')),
            'role'      =>  'admin',
            'by'        =>  Auth::user()->id
        ]);
        return back()->withErrors(['User Added', 'User Added']);
    }
}
