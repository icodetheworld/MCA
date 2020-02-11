<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\carbon;
class AtdController extends Controller
{
    public function index(){
        $data=DB::table('room')->orderby('class')->get();
        return view('admin.attendance.all')->with('data',$data);
    }
    public function class(Request $request){
        $data=DB::table('students')->where('room',$request->input('class'))->get();
        $date=$request->input('date');
        $check=DB::table('atd_room')->where('room_id',$request->input('class'))->where('day',$request->input('date'))->first();
        if($check==null)
            return view('admin.attendance.add')->with('data',$data)->with('date',$date)->with('state','add')->with('room',$request->input('class'));
        else{
            $atd=DB::table('attendance')->where('day',$request->input('date'))->where('room',$request->input('class'))->get();
            return view('admin.attendance.add')->with('data',$atd)->with('date',$date)->with('state','edit')->with('room',$request->input('class'));
        }
    }
    public function add(Request $request){
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
            return redirect('/attendance');
        }elseif($state=='edit'){
            DB::transaction(function() use($room,$date,$data,$request){
                foreach($data as $item){
                    DB::table('attendance')->where('stud_id',$item->id)->where('day',$date)->where('room',$room)->update([
                    'state' => $request->input($item->id)
                ]);}
            });
        return redirect('/attendance');
        }else{
            echo "error";
        }
    }
    public function view_all(){
        $data=DB::table('room')->orderby('class')->get();
        $abs=DB::table('attendance')->where('state','on')->where('day',Carbon::now()->toDateString())->orderby('room')->get();
        return view('admin.attendance.class')->with('stat',1)->with('data',$data)->with('abs',$abs);
    }
    public function view(Request $request){
        $start = new Carbon('first day of this month');
        $data=DB::table('attendance')->where('room',$request->input('class'))->where('day',$request->input('date'))->where('state','on')->get();
        return view('admin.attendance.class')->with('stat',0)->with('data',$data)->with('date',$request->input('date'))->with('room',$request->input('class'));
    }
    public function sms(){
        $abs=DB::table('attendance')->where('state','on')->where('sms',0)->where('day',Carbon::now()->toDateString())->orderby('room')->get();
        foreach($abs as $item){
            DB::transaction(function() use($item){
                $stud=DB::table('students')->where('id',$item->stud_id)->first();
                $name=$stud->f_name.' '.$stud->l_name;
                $date=Carbon::now()->toDateString();
                $phone=$stud->phone;
                $message=$name.' is absent for the day '.$date.'. Thank you ';
                $url='http://www.way2sms.com/api/v1/sendCampaign/?apikey=F0V1JHSDJVKWXXO3498MA9TYCG7AZHPM&secret=4UVZVBT0CU9286U9&usetype=prod&senderid=CEMSED&phone='.urlencode($phone).'&message='.urlencode($message);
                $json = file_get_contents($url);
                $object=json_decode($json);
                if($object->code=='200 OK')
                { DB::table('attendance')->where('id',$item->id)->update([
                    'sms'   =>  '1',
                ]);
                DB::table('settings')->where('field','sms_bal')->update([
                    'value'   =>  $object->balacne,
                ]);
            }
            
            });
        }
        return back();
    }
    public function bday(){
        $t=Carbon::now()->toDateString();
        $day=date('d',strtotime($t));
        $month=date('m',strtotime($t));
        $data=DB::table('bday')->where('day',$day)->where('month',$month)->get();
        foreach($data as $item)
        {
            DB::transaction(function() use($item){
                $message='Happy Birthday '.$item->name;
                $url='http://www.way2sms.com/api/v1/sendCampaign/?apikey=F0V1JHSDJVKWXXO3498MA9TYCG7AZHPM&secret=4UVZVBT0CU9286U9&usetype=prod&senderid=CEMSED&phone='.urlencode($item->phone).'&message='.urlencode($message);
                $json = file_get_contents($url);
                $object=json_decode($json);
                if($object->code=='200 OK'){ 
                    DB::table('bday')->where('id',$item->id)->update([
                        'wished'   =>  Carbon::now()->toDateTimeString(),
                    ]);
                    echo "success";
                    DB::table('settings')->where('field','sms_bal')->update([
                        'value'   =>  $object->balacne,
                    ]);
                }
            });
            
        }
    }
}
