@extends('layouts.main')    

@section('content')
            @if ($errors->any())
                <div class="alert alert-warning">
                    <strong></strong>{{ $errors->first()}}
                </div>                
            @endif       
            <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Add Admin</h3>
                            </div>
                        </div>
                        <form action="{{url('/users/add')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>Name  *</label>
                                    <input type="text" name="name" placeholder="" required class="form-control">
                                </div>
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>E-Mail</label>
                                    <input type="email" name="email" required placeholder="" class="form-control">
                                </div>
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" required placeholder="" class="form-control">
                                    <input type="text" name="by" value="{{Auth::user()->id}}" style="display:none;">
                                </div>
                                    <div class="col-12 form-group mg-t-8">
                                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                    </div>
                                </div>
                        </form>
                        </div>
                    </div>
    <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>All Admin's Data  </h3>
                    </div>
                </div>
                <div class="table-responsive">
                        <script>
                                $(document).ready(function() {
                                    $('#example').DataTable();
                                } );
                            </script>
                    <table id="example" class="table display  text-nowrap">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>By</th>
                                <th>Created at</th>
                                <th>Password</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $item)
                            @if((Auth::user()->id==1) || (Auth::user()->id==2 && $item->id!=1) || (Auth::user()->id==3 && $item->id!=1 && $item->id!=2))
                            <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->by}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <form action="{{url('/user/password')}}" method="post">
                                        @csrf
                                    
                                    <td><input type="password" name="password" ><input type="text" name="id" value="{{$item->id}}" style="display:none"></td>
                                    <td><input type="submit" value="Update Password" class="btn btn-primary"></td>
                                    </form>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>All Parent's Data</h3>
                    </div>
                </div>
                <div class="table-responsive">
                        <script>
                                $(document).ready(function() {
                                    $('#example1').DataTable();
                                } );
                            </script>
                    <table id="example1" class="table display  text-nowrap">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>By</th>
                                <th>Created at</th>
                                <th>Password</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parent as $item)
                            <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->by}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <form action="{{url('/user/password')}}" method="post">
                                        @csrf
                                    
                                    <td><input type="password" name="password" ><input type="text" name="id" value="{{$item->id}}" style="display:none"></td>
                                    <td><input type="submit" value="Update Password" class="btn btn-primary"></td>
                                    </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>All Teacher's Data</h3>
                    </div>
                </div>
                <div class="table-responsive">
                        <script>
                                $(document).ready(function() {
                                    $('#example2').DataTable();
                                } );
                            </script>
                    <table id="example2" class="table display  text-nowrap">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>By</th>
                                <th>Created at</th>
                                <th>Password</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teacher as $item)
                            <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->by}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <form action="{{url('/user/password')}}" method="post">
                                        @csrf
                                        
                                    <td><input type="password" name="password" ><input type="text" name="id" value="{{$item->id}}" style="display:none"></td>
                                    <td><input type="submit" value="Update Password" class="btn btn-primary"></td>
                                    </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection