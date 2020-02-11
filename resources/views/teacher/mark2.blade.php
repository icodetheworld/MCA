@extends('layouts.main')  

@section('content')
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div> 
@endif


<div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>{{$stud->id.' : '.$stud->f_name.' '.$stud->l_name}}</h3>
                        <h4>{{DB::table('class')->where('id',$stud->class)->first()->class.' - '.DB::table('room')->where('id',$stud->room)->first()->division}}</h4>
                    </div>
                </div>
                <div class="table-responsive">
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
                         <form action="{{url('/adds/marks/std')}}" method="post">
                         @csrf
                        <tbody>
                            <?php $count=0; ?>
                        
                            @foreach ($subs as $item)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->subject}}</td>
                                    <td><input type="text" name="{{$item->id}}" required class="form-control"></td>
                                    <td>{{'/'.$item->max}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <input type="text" name="id" value="{{$stud->id}}" style="display:none" id="">
                                <input type="text" name="class" value="{{$stud->class}}" style="display:none" id="">
                                <td colspan="5"><input type="submit" value="Submit" class="form-control"></td>
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