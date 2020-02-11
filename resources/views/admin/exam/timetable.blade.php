@extends('layouts.main')    
@if($stat==1)
@section('content')
    <!-- Exam Schedule Area Start Here -->
    @if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div>                
@endif 
    <div class="row">
            <div class="col-4-xxxl col-12">
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <?php $class = DB::table('class')->where('id',$id)->first()?>
                                <h3>Add New Exam for class :{{$class->class}} </h3>
                            </div>
                        </div>
                        <form class="new-added-form" action="{{url('/exam/add')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Date *</label>
                                    <input type="text" name="id" value="{{$id}}" style="display:none;">
                                    <input type="date" name="date" class="form-control">
                                </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                        <label>Subject *</label>
                                        <select name="subject" class="select2 form-control">
                                            @foreach ($subject as $item)
                                                <option value="{{$item->id}}">{{$item->code.' - '.$item->subject}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Select Time</label>
                                    <input type="time" name="time" class="form-control">
                                </div>
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8-xxxl col-12">
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Exam Schedule of :{{$class->class}} </h3>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject Code</th>
                                        <th>Subject</th>
                                        <th>Class</th>
                                        <th>Time</th>
                                        <th>Date</th>
                                        <th>Day</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count=0;?>
                                    @foreach ($data as $item)
                                    <?php 
                                    $sub=DB::table('subjects')->where('id',$item->subject)->first();
                                    ?>
                                    <tr>
                                        <td>{{++$count}}</td>
                                        <td>{{$sub->code}}</td>
                                        <td>{{$sub->subject}}</td>
                                        <td>{{DB::table('class')->where('id',$item->class)->first()->class}}</td>
                                        <td>{{date('H:i', strtotime($item->time))}}</td>
                                        <td>{{date('jS F, Y ', strtotime($item->date))}}</td>
                                        <td>{{date('l', strtotime($item->date))}}</td>
                                        <th><a href="{{url('/exam/schedule/delete/'.$item->id)}}" class="btn btn-danger  form-control" onclick="return confirm('Do you want to delete this exam schedule, This cannot be undone')">Delete</a> </th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Exam Schedule Area End Here -->
@endsection

@else
@section('content')
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div> 
@endif
<div class="col-12-xxxl col-xl-12">
        <div class="card account-settings-box height-auto">
            <div class="card-body">
                <div class="heading-layout1 mg-b-20">
                    <div class="item-title">
                        <h3>Pick Class</h3>
                    </div>
                </div>
                <div class="all-user-box">
                    <a href="{{url('/exam/clear/')}}" onclick="return confirm('This will clear all previous exam timetable data, clear only if the exams are over')">
                        <div class="media media-none--xs " style="background:red;">
                            <div class="media-body space-md " >
                                <h5 class="item-title" style="color:white">Clear Previous Data</h5>
                            </div>
                        </div>
                    </a><br>
                    @foreach($data as $item)
                    <a href="{{url('/exam/'.$item->id)}}">
                        <div class="media media-none--xs ">
                            <div class="media-body space-md">
                                <h5 class="item-title">{{$item->class}}</h5>
                            </div>
                        </div>
                    </a>
                    <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@endif