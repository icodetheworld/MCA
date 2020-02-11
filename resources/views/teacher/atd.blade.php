@extends('layouts.main')    
@if($stat==1)
@section('content')
<div class="col-12-xxxl col-xl-12">
        <div class="card account-settings-box height-auto">
            <div class="card-body">
                <div class="heading-layout1 mg-b-20">
                    <div class="item-title">
                        <h3>Pick Date</h3>
                    </div>
                </div>
                @if($room!='')
                <form action="{{url('/atd/view')}}" method="post">
                    @csrf
                    <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="class">Class *</label>
                        <select name="class" id="class" class="select2 form-control">
                            <?php  $item=DB::table('room')->where('id',$room)->first();  ?>
                                <option value="{{$item->id}}">{{DB::table('class')->where('id',$item->class)->first()->class.' '.$item->division}}</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Date *</label>
                        <input type="date" name="date"  required class="form-control air-datepicker" data-position='bottom right'>
                    </div>
                </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                    </div>
                </form>
                @else
                <p>Sorry, No class room is yet assigned for you </p>
                @endif
            </div>
        </div>
    </div>
@endsection
@elseif($stat==2)
@section('content')
<div class="col-12-xxxl col-xl-12">
        <div class="card account-settings-box height-auto">
            <div class="card-body">
                <div class="heading-layout1 mg-b-20">
                    <div class="item-title">
                        <h3>Pick Date</h3>
                    </div>
                </div>
                @if($room!='')
                <form action="{{url('/atd/add')}}" method="post">
                    @csrf
                    <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="class">Class *</label>
                        <select name="class" id="class" class="select2 form-control">
                            <?php  $item=DB::table('room')->where('id',$room)->first();  ?>
                                <option value="{{$item->id}}">{{DB::table('class')->where('id',$item->class)->first()->class.' '.$item->division}}</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Date *</label>
                        <input type="date" name="date"  required class="form-control air-datepicker" data-position='bottom right'>
                    </div>
                </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                    </div>
                </form>
                @else
                <p>Sorry, No class room is yet assigned for you </p>
                @endif
            </div>
        </div>
    </div>
@endsection
@else
@section('content')
<div class="col-12-xxxl col-xl-12">
<div class="card account-settings-box height-auto">
    <div class="card-body">
        <div class="heading-layout1 mg-b-20">
            <div class="item-title">
                <?php 
                    $r=DB::table('room')->where('id',$room)->first();
                    ?>
                <h3>absent students {{DB::table('class')->where('id',$r->class)->first()->class.' - '.$r->division}} : {{date('d m y',strtotime($date))}}</h3>
            </div>
        </div>
        
        <div class="all-user-box">
            @foreach($data as $item)
            <a href="{{url('/student/'.$item->stud_id)}}">
            <div class="media media-none--xs ">
                <div class="media-body space-md">
                    <?php $stud=DB::table('students')->where('id',$item->stud_id)->first(); ?>
                    <h5 class="item-title">{{$stud->f_name.' '.$stud->l_name}}</h5>
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