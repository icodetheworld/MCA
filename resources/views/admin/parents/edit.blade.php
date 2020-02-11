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
                        <div class="media-body"><br>
                            <h3 class="item-title">{{$data->name}}</h3>
                        </div>
                    </div>
                    <div class="table-responsive info-table">
                        <form action="{{url('/parent/edit/')}}" method="post">
                            @csrf
                            <table class="table text-nowrap">
                            <tbody>
                                <tr>
                                    <td class="font-medium text-dark-medium"><input  style="display:none;" type="text" name="id" value="{{$data->id}}"  class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Name:</td>
                                    <td class="font-medium text-dark-medium"><input type="text" name="name" value="{{$data->name}}" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Gender:</td>
                                    <td class="font-medium text-dark-medium">
                                            <select name="gender" class="select2 form-control">
                                                    <option value="{{$data->gender}}">{{$data->gender}}</option>
                                                    @if ($data->gender!='Male')<option value="Male">Male</option>@endif
                                                    @if ($data->gender!='Female')<option value="Female">Female</option>@endif
                                                    @if ($data->gender!='Others')<option value="Others">Others</option>@endif
                                                </select>    
                                    </td>
                                </tr>
                                <tr>
                                    <td>Occupation:</td>
                                    <td class="font-medium text-dark-medium"><input type="text" name="job" value="{{$data->job}}" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>E-Mail:</td>
                                    <td class="font-medium text-dark-medium"><input type="text" name="email" value="{{$data->email}}" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td class="font-medium text-dark-medium"><input type="text" name="phone" value="{{$data->phone}}" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Phone 2:</td>
                                    <td class="font-medium text-dark-medium"><input type="text" name="phone2" value="{{$data->phone2}}" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td class="font-medium text-dark-medium"><button type="Submit" class="btn btn-warning form-control">Update</button></td>
                                </tr>
                            </tbody>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection