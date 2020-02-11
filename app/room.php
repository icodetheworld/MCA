<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\clss;
use DB;
class room extends Model
{
    protected $table='room';

    public function class(){
        return DB::table('class')->where('id',$this->class)->first()->class;
    }
}
