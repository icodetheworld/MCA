@extends('layouts.main')    

@section('content')

<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <?php
                        $rom=DB::table('room')->where('id',$room)->first();
                        $cls=DB::table('class')->where('id',$rom->class)->first();
                        ?>
                        <h3>Attendence Sheet Of Class {{$cls->class}}: Section {{$rom->division}}, {{date('d M, Y',strtotime($date))}} ({{$state}})</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table bs-table table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">Students</th>
                                <th>1</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <form action="{{url('/attd/add')}}" method="post">
                                @csrf
                                @if($state=='add')
                                @foreach ($data as $item)
                                    <tr>                       
                                        <td>1</td>             
                                        <td class="text-left">{{$item->f_name}}</td>
                                        <td><input type="checkbox" name="{{$item->id}}"></td>
                                    </tr>
                                @endforeach
                                @else 
                                @foreach ($data as $item)
                                <tr>                       
                                    <td>1</td>             
                                    <td class="text-left">{{DB::table('students')->where('id',$item->stud_id)->first()->f_name}}</td>
                                    @if($item->state!='on')
                                    <td><input type="checkbox" name="{{$item->stud_id}}"></td>
                                    @else
                                    <td><input type="checkbox" name="{{$item->stud_id}}" checked></td>
                                    @endif
                                </tr>
                            @endforeach
                                @endif
                                <tr>
                                    <input type="text" name="date" id="" value="{{$date}}" style="display:none;" >
                                    <input type="text" name="class" id="" value="{{$room}}" style="display:none;" >
                                    <input type="text" name="state" id="" value="{{$state}}" style="display:none;" >
                                    <td colspan="3"><input type="submit" value="Submit" class="btn btn-danger form-control"></td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection