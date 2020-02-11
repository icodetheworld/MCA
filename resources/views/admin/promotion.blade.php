@extends('layouts.main')    

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
                        <h3>Edit / Take Attendance</h3>
                    </div>
                </div>
                <form action="{{url('/promote')}}" method="post">
                    @csrf
                    <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="class">From *</label>
                        <select name="from" id="from" class="select2 form-control">
                            @foreach ($room as $item)
                                <option value="{{$item->id}}">{{DB::table('class')->where('id',$item->class)->first()->class.' '.$item->division}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                            <label for="class">To *</label>
                            <select name="to" id="to" class="select2 form-control">
                                @foreach ($room as $item)
                                    <option value="{{$item->id}}">{{DB::table('class')->where('id',$item->class)->first()->class.' '.$item->division}}</option>
                                @endforeach
                                <option value="done">Completed</option>
                            </select>
                        </div>
                </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" onclick="return alert('Are you sure want to promote these students?')" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
