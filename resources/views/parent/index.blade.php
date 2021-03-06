@extends('layouts.main')    

@section('content')
  
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div>                
@endif      
<div class="col-4-xxxl col-12">
        <div class="card dashboard-card-ten">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                    </div>
                </div>
                <div class="student-info">
                    <div class="media media-none--xs">
                        
                        <div class="media-body">
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
                                    <td>Occupation:</td>
                                    <td class="font-medium text-dark-medium">{{$data->job}}</td>
                                </tr>
                                <tr>
                                    <td>E-Mail:</td>
                                    <td class="font-medium text-dark-medium">{{$data->email}}</td>
                                </tr>
                                <tr>
                                    <form action="{{url('/password/reset')}}" method="post">
                                        @csrf
                                    <td>Password</td>
                                    <td class="font-medium text-dark-medium"><input type="password" name="pass" class="form-control"></td>
                                    <td><input type="submit" class="btn btn-primary" value="Update"></td>
                                    </form>
                                </tr>
                                <tr>
                                    <td>Adress:</td>
                                    <td class="font-medium text-dark-medium">{{$data->address}}</td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td class="font-medium text-dark-medium">{{$data->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Phone 2:</td>
                                    <td class="font-medium text-dark-medium">{{$data->phone2}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Dashboard summery Start Here -->
     <div class="row gutters-20">
         @foreach($kids as $item)
         <?php
                $stud=\App\student::where('id',$item->student_id)->first();
         ?>
         
            <div class="col-xl-4 col-sm-6 col-12">
                    <a href="{{url('/dashboard/'.$stud->id)}}">
                <div class="dashboard-summery-one mg-b-20">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="item-icon bg-light-green ">
                                <i class="flaticon-user text-green"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="item-content">
                                <div class="item-title">{{$stud->f_name.' '.$stud->l_name}}</div>
                                <div class="item-number"><span class="counter" data-num="{{$stud->id}}">{{$stud->id}}</span></div>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>
        @endforeach
        </div>
        
@endsection