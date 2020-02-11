@extends('layouts.main')

@section('content')
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div>                
@endif  
<div class="row">
        <!-- Add Notice Area Start Here -->
        <div class="col-4-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Create Message</h3>
                        </div>
                    </div>
                    <form class="new-added-form" action="{{url('sms/add')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12-xxxl col-lg-12 col-12 form-group" >
                                <label>Message Content</label>
                                <textarea maxlength="160" name="content" class="form-control" style="height:150px;"></textarea>
                            </div>
                            <div class="col-12-xxxl col-lg-12 col-12 form-group" >
                                <label>Groups</label>
                                <select name="group" class="select2 form-control">
                                    <option value="">Select a Group *</option>
                                    <option value="all_teachers">All Teachers</option>
                                    <option value="all_parents">All Parents</option>
                                    <option value="trans">All Transport opted students</option>
                                    @foreach ($room as $item)
                                        <option value="{{$item->id}}">{{DB::table('class')->where('id',$item->class)->first()->class.' - '.$item->division}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Send</button>
                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card height-auto" style="width:100%">
                <div class="card-body" >
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>All Failed Messages</h3>
                        </div>
                        <div class="float-right">
                                <a href="{{url('/sms/retry')}}" class="btn btn-warning">Retry</a>
                                <a href="{{url('/sms/clear')}}" class="btn btn-danger">Clear</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-responsive text-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=0; ?>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->message}}</td>
                                    <td>{{date('d m y',strtotime($item->created_at))}}</td>
                                    <td>{{date('H:i',strtotime($item->created_at))}}</td>
                                    <td></td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script>
                    $(document).ready(function() {
                        $('#example').DataTable();
                    } );
                </script>
</div>
@endsection