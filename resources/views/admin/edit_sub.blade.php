@extends('layouts.main')    

@section('content')
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div>                
@endif 
                <!-- All Subjects Area Start Here -->
                <div class="row">
                        <div class="col-4-xxxl col-12">
                            <div class="card height-auto">
                                <div class="card-body">
                                    <div class="heading-layout1">
                                        <div class="item-title">
                                            <h3>Edit Subject</h3>
                                        </div>
                                    </div>
                                    <form class="new-added-form" method="POST" action="{{url('/edit/subject')}} ">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                <label>Subject Id *</label>
                                                <input type="text" placeholder="" name="id" value="{{$data->id}}" disabled class="form-control">
                                                <input type="text" placeholder="" name="id" value="{{$data->id}}" style="display:none" class="form-control">
                                            </div>
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                    <label>Subject Name *</label>
                                                    <input type="text" placeholder="" name="subject" value="{{$data->subject}}" class="form-control">
                                                </div>
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                <label>Select Class *</label>
                                                <select name="class" class="select2 form-control">
                                                    @foreach ($class as $item)
                                                    <option value="{{$item->id}}">{{$item->class}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                <label>Select Code</label>
                                                <input type="text" name="code" class="form-control" value="{{$data->code}}" name="code" >
                                            </div>
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                    <label>Maximum Marks</label>
                                                    <input type="number" name="max" class="form-control" value="{{$data->max}}" name="code" >
                                                </div>
                                            <div class="col-12 form-group mg-t-8">
                                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
@endsection