@extends('layouts.main')    

@section('content')
    
<div class="col-4-xxxl col-12">
        <div class="card dashboard-card-ten">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        
                    </div>
                    
                </div>
                <div class="student-info">
                    <div class="media media-none--xs">
                        <div class="item-img">
                            <img src="{{asset('img/figure/student.png')}}" class="media-img-auto" alt="student">
                        </div>
                        <div class="media-body"><br>
                            <h3 class="item-title">{{$data->name}}</h3>
                        </div>
                    </div>
                    <div class="table-responsive info-table">
                        <table class="table text-nowrap">
                            <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td class="font-medium text-dark-medium">{{$data->name}}</td>
                                </tr>
                                <tr>
                                    <td>Gender:</td>
                                    <td class="font-medium text-dark-medium">{{$data->gender}}</td>
                                </tr>
                                <tr>
                                    <td>Date Of Birth:</td>
                                    <td class="font-medium text-dark-medium">{{$data->dob}}</td>
                                </tr>
                                <tr>
                                    <td>Qualification:</td>
                                    <td class="font-medium text-dark-medium">{{$data->qualification}}</td>
                                </tr>
                                <tr>
                                    <td>E-Mail:</td>
                                    <td class="font-medium text-dark-medium">{{$data->email}}</td>
                                </tr>
                                <tr>
                                    <td>Joining Date:</td>
                                    <td class="font-medium text-dark-medium">{{$data->doj}}</td>
                                </tr>
                                <tr>
                                    <td>Class:</td>
                                    <?php
                                    if($data->room_id!=''){
                                    $div=DB::table('room')->where('id',$data->room_id)->first();
                                    $cls=DB::table('class')->where('id',$div->class)->first()->class;
                                    ?>
                                    <td class="font-medium text-dark-medium">{{$cls.' - '.$div->division}}</td>
                                <?php }?>
                                </tr>
                                <tr>
                                    <td>Adress:</td>
                                    <td class="font-medium text-dark-medium">{{$data->address}}</td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td class="font-medium text-dark-medium">{{$data->phone}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection