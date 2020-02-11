<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
class ParentController extends Controller
{
    public function index(){
        $data=DB::table('parents')->get();
        return view('admin.parents.all')->with('data',$data);
    }
    public function view($id){
        $data=DB::table('parents')->where('id',$id)->first();
        $kids=DB::table('parent_relation')->where('parent_id',$id)->get();
        return view('admin.parents.details')->with('data',$data)->with('kids',$kids);
    }
    public function add(Request $request){
        $request->validate([
            'email'     => 'required | unique:users| max:191',
            'email'     => 'required | unique:parents| max:191'
        ]);
        DB::transaction(function() use($request){
            DB::table('parents')->insert([
                'name'      =>  $request->input('name'),
                'job'       =>  $request->input('job'),
                'gender'    =>  $request->input('gender'),
                'email'     =>  $request->input('email'),
                'phone'     =>  $request->input('phone'),
                'phone2'    =>  $request->input('phone2'),
                'address'   =>  $request->input('address')
            ]);
            $id=DB::table('parents')->where('email',$request->input('email'))->first()->id;
            DB::table('users')->insert([
                'name'      =>  $request->input('name'),
                'email'     =>  $request->input('email'),
                'role'      =>  'parent',
                'by'        =>  Auth::user()->id,
                'password'  =>  Hash::make($request->input('phone')),
                'parent_id' =>  $id
            ]);
        });
        return back()->withErrors(['Successfullly added', 'Successfullly added']);
    }
    public function delete($id){
        DB::table('parents')->where('id',$id)->delete();
        return back()->withErrors(['Records deleted successfully', 'Records deleted successfully']);
    }
    public function edit($id){
        $data=DB::table('parents')->where('id',$id)->first();
        if($data!=null)
            return view('admin.parents.edit')->with('data',$data);
        return back()->withErrors(['User not found', 'User not found']);
    }
    public function edit_post(Request $request){
        $data=DB::table('parents')->where('id',$request->input('id'))->update([
            'name'      =>  $request->input('name'),
            'job'       =>  $request->input('job'),
            'email'     =>  $request->input('email'),
            'phone'     =>  $request->input('phone'),
            'phone2'    =>  $request->input('phone2')
            ]);
            if($data)
                return back()->withErrors(['Updated Succesfully', 'Updated Succesfully']);
            return back()->withErrors(['Something went wrong', 'Something went wrong']);
    }
}
