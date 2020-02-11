@extends('layouts.main')    

@section('content')
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div>                
@endif  
     <!-- Student Info Area Start Here -->
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
                                <h3 class="item-title">{{$data->id}}</h3>
                            </div>
                        </div>
                        <div class="table-responsive info-table">
                            <table class="table text-nowrap">
                                <form action="{{url('/student/edit')}}" method="post">@csrf
                                <tbody>
                                    <tr>
                                        <td>Admission No:</td>
                                        <td class="font-medium text-dark-medium"><input class="form-control" type="text" name="ad_no" value="{{$data->ad_no}}"><input class="form-control" style="display:none;" type="text" name="id" value="{{$data->ad_no}}"></td>
                                    </tr>
                                    <tr>
                                        <td>First Name:</td>
                                        <td class="font-medium text-dark-medium"><input class="form-control" type="text" name="f_name" value="{{$data->f_name}}"><input class="form-control" style="display:none;" type="text" name="id" value="{{$data->id}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Last Name:</td>
                                        <td class="font-medium text-dark-medium"><input class="form-control" type="text" name="l_name" value="{{$data->l_name}}"></td>
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
                                        <td>Father Name:</td>
                                        <td class="font-medium text-dark-medium"><input class="form-control" type="text" name="father" value="{{$data->name_of_father}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Mother Name:</td>
                                        <td class="font-medium text-dark-medium"><input class="form-control" type="text" name="mother" value="{{$data->name_of_mother}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Date Of Birth:</td>
                                        <td class="font-medium text-dark-medium"><input type="date" class="form-control" name="dob" value="{{$data->dob}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Cast:</td>
                                        <td class="font-medium text-dark-medium"><input class="form-control" type="text" name="cast" value="{{$data->cast}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Religion:</td>
                                        <td class="font-medium text-dark-medium"><input class="form-control" type="text" name="religion" value="{{$data->religion}}"></td>
                                    </tr>
                                    <tr>
                                        <td>E-Mail:</td>
                                        <td class="font-medium text-dark-medium"><input type="text" name="email" value="{{$data->email}}" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Admission Date:</td>
                                        <td class="font-medium text-dark-medium"><input type="date" name="doa" class="form-control" value="{{$data->date_of_admission}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Class:</td>
                                        <td class="font-medium text-dark-medium">
                                                <select name="room" class="select2 form-control">
                                                    <?php
                                                    $room_id=\DB::table('room')->where('id',$data->room)->first();
                                                    $division=$room_id->division;
                                                    $clss=\DB::table('class')->where('id',$room_id->class)->first()->class;    
                                                    ?>
                                                <option value="{{$data->room}}">{{$clss.' - '.$division}}</option>
                                                    @foreach ($room as $item2)@if($data->room != $item2->id)
                                                    <option value="{{$item2->id}}">{{$item2->class().' - '.$item2->division}}</option>@endif
                                                    @endforeach
                                                </select>
                                            </div></td>
                                    </tr>
                                    <tr>
                                        <td>House:</td>
                                        <td class="font-medium text-dark-medium">
                                            <select name="house" class="form-control">
                                            <option value="{{$data->house}}">{{DB::table('house')->where('id',$data->house)->first()->name}}</option>    
                                            @foreach ($house as $item3)@if($data->house!=$item3->id)
                                                <option value="{{$item3->id}}">{{$item3->name}}</option>@endif
                                            @endforeach
                                            </select>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Transport *</td>
                                        <td>
                                        <select name="bus" class="select2 form-control">
                                            <option value="{{$data->bus}}">{{$data->bus}}</option>
                                            @if ($data->bus!='No')
                                            <option value="No">NO</option>
                                            @else
                                            <option value="Yes">Yes</option>
                                            @endif
                                        </select></td>
                                    </tr>
                                    <tr>
                                        <td>Adress:</td>
                                        <td class="font-medium text-dark-medium"><input type="text" name="address" value="{{$data->address}}" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Phone:</td>
                                        <td class="font-medium text-dark-medium"><input type="text" name="phone" value="{{$data->phone}}" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" value="Update" class="btn btn-success form-control"></td>
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