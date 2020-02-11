@extends('layouts.main')    
@if($stat==0)
@section('content')
<div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Enter register number</h3>
                </div>
            </div>
            <form action="{{url('/results/flush')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Reg No  *</label>
                        <input type="text" name="id" placeholder="" required class="form-control">
                    </div>
                        <div class="col-12 form-group mg-t-8">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Submit</button>
                        </div>
                    </div>
            </form>
            </div>
        </div>
@endsection
@elseif($stat==1)
@section('content')
<div class="table-responsive">
        <p>Following are the result for <strong>{{$stud->f_name.' '.$stud->l_name}}</strong>, Register number : <strong>{{$stud->id}}</strong>, class : <strong>{{DB::table('class')->where('id',$stud->class)->first()->class}}</strong>, Division : <strong>{{DB::table('room')->where('id',$stud->room)->first()->division}}</strong> </p>
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
            
                @foreach ($subs as $item)
                    <tr>
                        <td>{{++$count}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->subject}}</td>
                        @if($d=DB::table('marks')->where('student_id',$stud->id)->where('class',$stud->class)->where('subject_id',$item->id)->first())
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
@else
@section('content')

@endsection
@endif