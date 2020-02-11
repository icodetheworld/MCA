<?php

namespace App;
use App\marks;
use App\room;
use Illuminate\Database\Eloquent\Model;
use DB;

class student extends Model
{
    protected $table='students';

    public function marks(){
        return marks::where('student_id',$this->id)->get();
    }
    public function room(){
        return room::where('id',$this->room)->first();
    }
    public function attendance(){
        return attendance::where('stud_id',$this->id)->get();
    }
    public function abs(){
        return attendance::where('stud_id',$this->id)->where('state','on')->get();
    }
}
