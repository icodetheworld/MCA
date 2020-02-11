@extends('layouts.main')

@section('content')
     <!-- Dashboard summery Start Here -->
     <div class="row gutters-20">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="dashboard-summery-one mg-b-20">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="item-icon bg-light-green ">
                                <i class="flaticon-classmates text-green"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="item-content">
                                <div class="item-title">Students</div>
                                <div class="item-number"><span class="counter" data-num="{{$s=count(DB::table('students')->get())}}">{{$s}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="dashboard-summery-one mg-b-20">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="item-icon bg-light-blue">
                                <i class="flaticon-multiple-users-silhouette text-blue"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="item-content">
                                <div class="item-title">Teachers</div>
                                <div class="item-number"><span class="counter" data-num="{{$t=count(DB::table('teachers')->get())}}">{{$t}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="dashboard-summery-one mg-b-20">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="item-icon bg-light-yellow">
                                <i class="flaticon-couple text-orange"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="item-content">
                                <div class="item-title">Parents</div>
                                <div class="item-number"><span class="counter" data-num="{{$p=count(DB::table('parents')->get())}}">{{$p}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="dashboard-summery-one mg-b-20">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="item-icon bg-light-red">
                                <i class="flaticon-mail text-red"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="item-content">
                                <div class="item-title">SMS Balance</div><?php $m=DB::table('settings')->where('field','sms_bal')->first()->value; $n=(int)($m/0.2); ?>
                                <div class="item-number"><span></span><span class="counter" data-num="{{$n}}">{{$n}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 col-12-xxxl">
                <div class="card dashboard-card-six pd-b-20">
                    <div class="card-body">
                        <div class="heading-layout1 mg-b-17">
                            <div class="item-title">
                                <h3>Notice Board</h3>
                            </div>
                        </div>
                        <?php 
                            $data=DB::table('notice')->get();
                        ?>
                        <div class="notice-box-wrap">
                            @foreach($data as $item)
                            <div class="notice-list">
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
        </div>
        <!-- Dashboard Content End Here -->
@endsection
