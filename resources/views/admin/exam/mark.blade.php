@extends('layouts.main')    
@if($stat==0)
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
                    <a href="{{url('/mark/clear/')}}" onclick="return confirm('This will clear all previous marks data, clear only if the acadamic year is over')">
                        <div class="media media-none--xs " style="background:red;">
                            <div class="media-body space-md " >
                                <h5 class="item-title" style="color:white">Clear Previous Data</h5>
                            </div>
                        </div>
                    </a><br>
                    @foreach($data as $item)
                    <a href="{{url('/marks/'.$item->id)}}">
                        <div class="media media-none--xs ">
                            <div class="media-body space-md">
                                <h5 class="item-title">{{DB::table('class')->where('id',$item->class)->first()->class.' - '.$item->division}}</h5>
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
@else 

@section('content')
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div> 
@endif
<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Students list</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table bs-table table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>reg id</th>
                                <th class="text-left">Students</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=0; ?>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$item->id}}</td>
                                    <td class="text-left">{{$item->f_name.' '.$item->l_name}}</td>
                                    <td><a href="{{url('/student/add/mark/'.$item->id)}}" class="btn btn-danger form-control">Add</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif