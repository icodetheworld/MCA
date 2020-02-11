<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class subject extends Model
{
    protected $table='subjects';

    public function class(){
        return DB::table('class')->where('id',$this->class_id)->first()->class;
    }
}
