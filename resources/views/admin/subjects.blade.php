@extends('layouts.main')    

@section('content')
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div>                
@endif 
                <!-- All Subjects Area Start Here -->
                <div class="row">
                        <div class="col-4-xxxl col-12">
                            <div class="card height-auto">
                                <div class="card-body">
                                    <div class="heading-layout1">
                                        <div class="item-title">
                                            <h3>Add New Subject</h3>
                                        </div>
                                    </div>
                                    <form class="new-added-form" method="POST" action="{{url('/add/subject')}} ">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                <label>Subject Name *</label>
                                                <input type="text" placeholder="" name="name" class="form-control">
                                            </div>
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                <label>Select Class *</label>
                                                <select name="class" class="select2 form-control">
                                                    @foreach ($class as $item)
                                                    <option value="{{$item->id}}">{{$item->class}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                <label>Select Code</label>
                                                <input type="text" name="code" class="form-control" name="code" >
                                            </div>
                                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                                    <label>Maximum Marks</label>
                                                    <input type="number" name="max" class="form-control" name="code" >
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
                                            <h3>All Subjects</h3>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table display data-table text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Subject Code</th>
                                                    <th>Subject Name</th>
                                                    <th>Class</th>
                                                    <th>Maximum Mark</th>
                                                    <th></th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                <tr>
                                                    <td> {{$item->id}} </td>
                                                    <td> {{$item->code}} </td>
                                                    <td>{{$item->subject}}</td>
                                                    <td>{{$item->class()}}</td>
                                                    <td>{{$item->max}}</td>
                                                    <td> <a href=" {{url('/edit/subject/'.$item->id)}} " class="btn btn-danger form-control">Edit</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- All Subjects Area End Here -->
@endsection