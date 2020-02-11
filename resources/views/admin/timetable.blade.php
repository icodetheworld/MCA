@extends('layouts.main')    
@if($stat==1)
@section('content')
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
                                            <h3>Add Class Routine for {{DB::table('class')->where('id',$room->class)->first()->class.' - '.$room->division}} </h3>
                                        </div>
                                    </div>
                                    <form class="new-added-form" action="{{url('/add/timetable')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                <label>Subject Name *</label>
                                                <select name="subject" class="select2 form-control">
                                                    @foreach ($subjects as $item)
                                                        <option value="{{$item->id}}">{{$item->code.' - '.$item->subject}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                <input type="text" name="id" style="display:none;" value="{{$room->id}}">
                                                <label>Day*</label>
                                                <select name="day" class="select2 form-control">
                                                    <option value="monday">Monday</option>
                                                    <option value="tuesday">Tuesday</option>
                                                    <option value="wednessday">Wednesday</option>
                                                    <option value="thursday">Thursday</option>
                                                    <option value="friday">Friday</option>
                                                </select>
                                            </div>
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                <label>Select Period *</label>
                                                <select name="period" class="select2 form-control">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                </select>
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
                                            <h3>Class Routine</h3>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped  text-nowrap">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Day</th>
                                                    <th>I</th>
                                                    <th>II</th>
                                                    <th>III</th>
                                                    <th>IV</th>
                                                    <th>V</th>
                                                    <th>VI</th>
                                                    <th>VII</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Monday</td>
                                                    @foreach ($mon as $item)
                                                    <?php 
                                                    $sub=DB::table('subjects')->where('id',$item->subject)->first();
                                                    ?>
                                                        <td>{{$sub->code.' - '.$sub->subject}}</td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Tuesday</td>
                                                    @foreach ($tue as $item)
                                                    <?php 
                                                    $sub=DB::table('subjects')->where('id',$item->subject)->first();
                                                    ?>
                                                        <td>{{$sub->code.' - '.$sub->subject}}</td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Wednesday</td>
                                                    @foreach ($wed as $item)
                                                    <?php 
                                                    $sub=DB::table('subjects')->where('id',$item->subject)->first();
                                                    ?>
                                                        <td>{{$sub->code.' - '.$sub->subject}}</td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Thursday</td>
                                                    @foreach ($thu as $item)
                                                    <?php 
                                                    $sub=DB::table('subjects')->where('id',$item->subject)->first();
                                                    ?>
                                                        <td>{{$sub->code.' - '.$sub->subject}}</td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Friday</td>
                                                    @foreach ($fri as $item)
                                                    <?php 
                                                    $sub=DB::table('subjects')->where('id',$item->subject)->first();
                                                    ?>
                                                        <td>{{$sub->code.' - '.$sub->subject}}</td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Class Routine Area End Here -->
@endsection
@else
@section('content')

<div class="col-12-xxxl col-xl-12">
        <div class="card account-settings-box height-auto">
            <div class="card-body">
                <div class="heading-layout1 mg-b-20">
                    <div class="item-title">
                        <h3>Pick Class</h3>
                    </div>
                </div>
                
                <div class="all-user-box">
                    @foreach($data as $item)
                    <a href="{{url('/timetable/'.$item->id)}}">
                    <div class="media media-none--xs ">
                        <div class="media-body space-md">
                            <h5 class="item-title">{{DB::table('class')->where('id',$item->class)->first()->class.' '.$item->division}}</h5>
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