@extends('layouts.main')    
@if($stat==1)
@section('content')
<div class="col-12-xxxl col-xl-12">
        <div class="card account-settings-box height-auto">
            <div class="card-body">
                <div class="heading-layout1 mg-b-20">
                    <div class="item-title">
                        <h3>Pick Class</h3>
                    </div>
                </div>
                <form action="{{url('/attendance/view')}}" method="post">
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
                        <label>Date *</label>
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
    <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>All Abscent Students</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Transport</th>
                                <th>Phone</th>
                                <th>Message Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=0?>
                            @foreach ($abs as $item)
                                <?php 
                                    $stud=DB::table('students')->where('id',$item->stud_id)->first();

                                ?>
                            <tr>
                                    <td>{{++$count}} </td>
                                    <td>{{$stud->id}}</td>
                                    <td>{{$stud->f_name.' '.$stud->l_name}}</td>
                                    <td>{{$stud->address}} </td>
                                    <td>{{$stud->trans}} </td>
                                    <td>{{$stud->phone}} </td>
                                    @if ($item->sms==1)
                                    <td> <a class="btn btn-success" style="color:white">Sent</a></td>
                                    @else
                                    <td> <a class="btn btn-danger" style="color:white">Failed</a></td>                                        
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                        <a  href="{{url('/atd/sms/123/456')}}"  class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Send/Resend</a>
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