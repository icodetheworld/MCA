<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class MessageController extends HomeController
{
    public function retry(){
        $data=DB::table('sms_failed')->get();
        DB::transaction(function() use($data){
            foreach($data as $item){
                $content=$item->message;
                $phone=$item->phone;
                $url='http://www.way2sms.com/api/v1/sendCampaign/?apikey=F0V1JHSDJVKWXXO3498MA9TYCG7AZHPM&secret=4UVZVBT0CU9286U9&usetype=prod&senderid=CEMSED&phone='.urlencode($phone).'&message='.urlencode($content);
                $json = file_get_contents($url);
                $object=json_decode($json);
                if($object->code=='200 OK'){ 
                    DB::table('sms_failed')->where('id',$item->id)->delete();
                    DB::table('settings')->where('field','sms_bal')->update([
                        'value'   =>  $object->balacne,
                    ]);
                }
                }
        });
        return back()->withErrors(['Done', 'Done']);
    }
    public function clear(){
        if(DB::table('sms_failed')->delete()){
            return back()->withErrors(['Successfully Cleared', 'Successfully Cleared']);
        }
        else{
            return back()->withErrors(['Something Went Wrong', 'Something Went Wrong']);
        }
    }
    public function index(){
        $data=DB::table('sms_failed')->orderby('created_at','DESC')->get();
        $room=DB::table('room')->orderby('class')->get();
        return view('admin.messages')->with('data',$data)->with('room',$room);
    }
    public function send(Request $request){
        $request->validate([
            'content'   =>  'required | max:160',
            'group'     =>  'required',
        ]);
        $content = $request->input('content');
        if($request->input('group')=='all_teachers'){
            $stud=DB::table('teachers')->get();
            DB::transaction(function() use($content,$stud){
                foreach($stud as $item){
                $phone=$item->phone;
                $url='http://www.way2sms.com/api/v1/sendCampaign/?apikey=F0V1JHSDJVKWXXO3498MA9TYCG7AZHPM&secret=4UVZVBT0CU9286U9&usetype=prod&senderid=CEMSED&phone='.urlencode($phone).'&message='.urlencode($content);
                $json = file_get_contents($url);
                $object=json_decode($json);
                if($object->code!='200 OK')
                { DB::table('sms_failed')->insert([
                    'phone'     =>  $phone,
                    'message'   =>  $content,
                ]);
                }
                else{
                    DB::table('settings')->where('field','sms_bal')->update([
                        'value'   =>  $object->balacne,
                    ]);
                }
                }
            });
        }elseif($request->input('group')=='all_parents'){
            $stud=DB::table('parents')->get();
            DB::transaction(function() use($content,$stud){
                foreach($stud as $item){
                $phone=$item->phone;
                $url='http://www.way2sms.com/api/v1/sendCampaign/?apikey=F0V1JHSDJVKWXXO3498MA9TYCG7AZHPM&secret=4UVZVBT0CU9286U9&usetype=prod&senderid=CEMSED&phone='.urlencode($phone).'&message='.urlencode($content);
                $json = file_get_contents($url);
                $object=json_decode($json);
                if($object->code!='200 OK')
                { DB::table('sms_failed')->insert([
                    'phone'     =>  $phone,
                    'message'   =>  $content,
                ]);
                }
                else{
                    DB::table('settings')->where('field','sms_bal')->update([
                        'value'   =>  $object->balacne,
                    ]);
                }
                }
            });
        }elseif($request->input('group')=='trans'){
            $stud=DB::table('students')->where('bus','Yes')->get();
            DB::transaction(function() use($content,$stud){
                foreach($stud as $item){
                $phone=$item->phone;
                $url='http://www.way2sms.com/api/v1/sendCampaign/?apikey=F0V1JHSDJVKWXXO3498MA9TYCG7AZHPM&secret=4UVZVBT0CU9286U9&usetype=prod&senderid=CEMSED&phone='.urlencode($phone).'&message='.urlencode($content);
                $json = file_get_contents($url);
                $object=json_decode($json);
                if($object->code!='200 OK')
                { DB::table('sms_failed')->insert([
                    'phone'     =>  $phone,
                    'message'   =>  $content,
                ]);
                }
                else{
                    DB::table('settings')->where('field','sms_bal')->update([
                        'value'   =>  $object->balacne,
                    ]);
                }
                }
            });
        }else{
            $room=$request->input('group');
            $stud=DB::table('students')->where('room',$room)->get();
            DB::transaction(function() use($content,$stud){
                foreach($stud as $item){
                $phone=$item->phone;
                $url='http://www.way2sms.com/api/v1/sendCampaign/?apikey=F0V1JHSDJVKWXXO3498MA9TYCG7AZHPM&secret=4UVZVBT0CU9286U9&usetype=prod&senderid=CEMSED&phone='.urlencode($phone).'&message='.urlencode($content);
                $json = file_get_contents($url);
                $object=json_decode($json);
                if($object->code!='200 OK')
                { DB::table('sms_failed')->insert([
                    'phone'     =>  $phone,
                    'message'   =>  $content,
                ]);
                }
                else{
                    DB::table('settings')->where('field','sms_bal')->update([
                        'value'   =>  $object->balacne,
                    ]);
                }
                }
            });
        }
        return back()->withErrors(['Sent Succesfully', 'Sent Succesfully']);
    }
}
