@extends('layouts.main')

@section('content')
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div>                
@endif  
<div class="row">
    @if(Auth::user()->role=='admin')
        <!-- Add Notice Area Start Here -->
        <div class="col-4-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Create A Notice</h3>
                        </div>
                    </div>
                    <form class="new-added-form" action="{{url('notice/add')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Title</label>
                                <input type="text" name="title" placeholder="" class="form-control">
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Date</label>
                                <input type="date" name="date" placeholder="" class="form-control air-datepicker">
                            </div>
                            <div class="col-12-xxxl col-lg-12 col-12 form-group" >
                                <label>Details</label>
                                <textarea name="content" class="form-control" style="height:150px;"></textarea>
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Notice Area End Here -->
        @endif
        <!-- All Notice Area Start Here -->
        <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Notice Board</h3>
                        </div>
                    </div>
                    <div class="notice-board-wrap">
                        @foreach ($data as $item)
                            <div class="notice-list">
                                @if(Auth::user()->role=='admin')<a onclick="return confirm('Are you sure want to delete this notice?')" href="{{url('/notice/delete/'.$item->id)}}"><p style="text-align:right"><i class="fas fa-window-close"></i></p></a>@endif
                                <div class="post-date bg-yellow">{{$item->i_date}}</div>
                                <h6 class="notice-title">{{$item->title}}</h6>
                                <p>{{$item->content}} </p>
                                <div class="entry-meta">{{date("jS F, Y",strtotime($item->created_at))}}</span></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- All Notice Area End Here -->
    </div>
@endsection