<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\student;
class testController extends Controller
{
    public function index(){
        return view('test');
    }
}
