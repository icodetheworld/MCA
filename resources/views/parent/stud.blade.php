@extends('layouts.main')    

@section('content')
 <!-- Student Info Area End Here -->
 <div class="col-8-xxxl col-12">
        <div class="row">
            <!-- Summery Area Start Here -->
            <div class="col-lg-4">
                <div class="dashboard-summery-one">
                    <div class="row">
                        <div class="col-6">
                            <div class="item-icon bg-light-magenta">
                                <i class="flaticon-shopping-list text-magenta"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="item-content">
                                <div class="item-title">Class</div>
                                <div class="item-number"><span class="counter" data-num="{{\App\clss::where('id',$data->room()->class)->first()->class}}">{{\App\clss::where('id',$data->room()->class)->first()->class}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="dashboard-summery-one">
                    <div class="row">
                        <div class="col-6">
                            <div class="item-icon bg-light-blue">
                                <i class="flaticon-calendar text-blue"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="item-content">
                                <div class="item-title">Division</div>
                                <div class="item-number"><span class="" >{{$data->room()->division}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="dashboard-summery-one">
                    <div class="row">
                        <div class="col-6">
                            <div class="item-icon bg-light-yellow">
                                <i class="flaticon-percentage-discount text-orange"></i>
                            </div>
                        </div>
                        <?php
                            $tot = count($data->attendance());
                            $abs = count($data->abs());
                            if($tot!=0 ){
                                $perf = (($tot-$abs)/$tot)*100;
                                $per= (int)$perf;
                            }
                            else {
                                $per=0;
                            }
                            
                        ?>
                        <div class="col-6">
                            <div class="item-content">
                                <div class="item-title">Attendance</div>
                                <div class="item-number"><span class="counter" data-num="{{$per}}">{{$per}}</span><span>%</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Summery Area End Here -->
        </div>
    </div>
     <!-- Student Info Area Start Here -->
     <div class="col-4-xxxl col-12">
            <div class="card dashboard-card-ten">
                <div class="card-body">
                    <div class="student-info">
                        <div class="media media-none--xs">
                        </div>
                        <div class="table-responsive info-table">
                            <table class="table text-nowrap">
                                <tbody>
                                    <tr>
                                        <td>Id:</td>
                                        <td class="font-medium text-dark-medium">{{$data->id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Name:</td>
                                        <td class="font-medium text-dark-medium">{{$data->f_name.' '.$data->l_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Gender:</td>
                                        <td class="font-medium text-dark-medium">{{$data->gender}}</td>
                                    </tr>
                                    <tr>
                                        <td>Father Name:</td>
                                        <td class="font-medium text-dark-medium">{{$data->name_of_father}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mother Name:</td>
                                        <td class="font-medium text-dark-medium">{{$data->name_of_mother}}</td>
                                    </tr>
                                    <tr>
                                        <td>Date Of Birth:</td>
                                        <td class="font-medium text-dark-medium">{{$data->dob}}</td>
                                    </tr>
                                    <tr>
                                        <td>Cast:</td>
                                        <td class="font-medium text-dark-medium">{{$data->cast}}</td>
                                    </tr>
                                    <tr>
                                        <td>Religion:</td>
                                        <td class="font-medium text-dark-medium">{{$data->religion}}</td>
                                    </tr>
                                    <tr>
                                        <td>E-Mail:</td>
                                        <td class="font-medium text-dark-medium">{{$data->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Admission Date:</td>
                                        <td class="font-medium text-dark-medium">{{$data->date_of_admission}}</td>
                                    </tr>
                                    <tr>
                                        <td>Class:</td>
                                        <td class="font-medium text-dark-medium">{{\App\clss::where('id',$data->room()->class)->first()->class}}</td>
                                    </tr>
                                    <tr>
                                        <td>Division:</td>
                                        <td class="font-medium text-dark-medium">{{$data->room()->division}}</td>
                                    </tr>
                                    <tr>
                                        <td>House:</td>
                                        <td class="font-medium text-dark-medium">{{$data->house}}</td>
                                    </tr>
                                    <tr>
                                        <td>Adress:</td>
                                        <td class="font-medium text-dark-medium">{{$data->address}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone:</td>
                                        <td class="font-medium text-dark-medium">{{$data->phone}}</td>
                                    </tr>
                                    <tr>
                                        @if(Auth::user()->role=='admin')
                                        <td>Parent Details:</td>
                                        <?php $atd=DB::table('parent_relation')->where('student_id',$data->id)->first(); ?>
                                        @if($atd!=null)
                                        <td class="font-medium text-dark-medium"><a href="{{url('/parent/view/'.$atd->parent_id)}}">View</a></td>
                                        @else
                                        <td class="font-medium text-dark-medium">No Details Available</td>
                                        @endif
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Abscent Days</td>
                                        <?php $atd=DB::table('attendance')->where('stud_id',$data->id)->where('state','on')->get(); ?>
                                        <td class="font-medium text-dark-medium">
                                            <ol>
                                                @foreach ($atd as $item)
                                                    <li>{{$item->day}}</li>
                                                @endforeach    
                                            </ol>    
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
        
<div class="table-responsive">
        <p>Following are the result for <strong>{{$data->f_name.' '.$data->l_name}}</strong>, Register number : <strong>{{$data->id}}</strong>, class : <strong>{{DB::table('class')->where('id',$data->class)->first()->class}}</strong>, Division : <strong>{{DB::table('room')->where('id',$data->room)->first()->division}}</strong> </p>
        <table class="table bs-table table-striped table-bordered text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th class="text-left">Subject</th>
                    <th>Mark</th>
                    <th>Total</th>
                </tr>
            </thead>
             <form action="{{url('/add/marks/stud')}}" method="post">
             @csrf
            <tbody>
                <?php $count=0; ?>
            
                @foreach ($subjects as $item)
                    <tr>
                        <td>{{++$count}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->subject}}</td>
                        @if($d=DB::table('marks')->where('student_id',$data->id)->where('class',$data->class)->where('subject_id',$item->id)->first())
                        <td>{{$d->mark}}</td>
                        @else 
                        <td>-</td>
                        @endif
                        <td>{{'/'.$item->max}}</td>
                    </tr>
                @endforeach
            </tbody>
            </form>
        </table>
    </div>
@endsection