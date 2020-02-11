<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class marks extends Model
{
    protected $table='marks';
    public function subject(){
        return DB::table('subjects')->where('id',$this->subject_id)->first();
    }
}
