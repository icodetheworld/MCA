@extends('layouts.main')    

@section('content')
<div class="col-12-xxxl col-xl-12">
        <div class="card account-settings-box height-auto">
            <div class="card-body">
                <div class="heading-layout1 mg-b-20">
                    <div class="item-title">
                        <h3>Edit / Take Attendance</h3>
                    </div>
                </div>
                <form action="{{url('/attendance/edit')}}" method="post">
                    @csrf
                    <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="class">Class *</label>
                        <select name="class" id="class" class="select2 form-control">
                            @foreach ($data as $item)
                                <option value="{{$item->id}}">{{DB::table('class')->where('id',$item->class)->first()->class.' '.$item->division}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Date  *</label>
                        <input type="date" name="date"  required class="form-control air-datepicker" data-position='bottom right'>
                    </div>
                </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
