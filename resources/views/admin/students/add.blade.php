@extends('layouts.main')    

@section('content')
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div>                
@endif    
<form action=" {{url('/student/admission/add')}} " method="POST">
    @csrf
                <!-- Admit Form Area Start Here -->
                <div class="card height-auto">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Admission Form</h3>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Date Of Admission *</label>
                                        <input type="date" name="doa" id="myDate" required class="form-control air-datepicker"
                                            data-position='bottom right'>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Admission No *</label>
                                        <input type="text" name="ad_no" placeholder="" required class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>First Name *</label>
                                        <input type="text" name="f_name" placeholder="" required class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Last Name *</label>
                                        <input type="text" name="l_name" placeholder="" required class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Gender *</label>
                                        <select name="gender" class="select2 form-control">
                                            <option value="">Please Select Gender *</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Date Of Birth *</label>
                                        <input type="date" name="dob" required class="form-control air-datepicker"
                                            data-position='bottom right'>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Father's Name</label>
                                        <input type="text" name="father"  required placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Mother's Name</label>
                                            <input type="text" name="mother" required placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Cast</label>
                                            <input type="text" name="cast" required placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Religion</label>
                                            <input type="text" name="religion" required placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>E-Mail</label>
                                        <input type="email" name="email" required placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Class *</label>
                                        <select name="room" class="select2 form-control">
                                        <option value="">Please Select Class *</option>
                                            @foreach ($room as $item)
                                            <option value="{{$item->id}}">{{$item->class().' - '.$item->division}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>House *</label>
                                        <select name="house" class="select2 form-control">
                                            <option value="">Please Select Section *</option>
                                            @foreach ($house as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Transport *</label>
                                        <select name="bus" class="select2 form-control">
                                            <option value="No">NO</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Phone</label>
                                        <input name="phone" type="tel" required placeholder="" class="form-control">
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" required placeholder="" class="form-control">
                                    </div>
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                </form>
                    <!-- Admit Form Area End Here -->
@endsection