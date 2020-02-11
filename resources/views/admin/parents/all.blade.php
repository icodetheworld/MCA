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
                    <h3>Admission Form</h3>
                </div>
            </div>
            <form action="{{url('/parent/add')}}" method="POST">
                @csrf
                <div class="row">
                    
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Name  *</label>
                        <input type="text" name="name" placeholder="" required class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Occupation *</label>
                        <input type="text" name="job" placeholder="" required class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Gender *</label>
                        <select name="gender" class="select2 form-control">
                            <option value="">Please Select Gender *</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>E-Mail</label>
                        <input type="email" name="email" required placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone</label>
                        <input name="phone" type="tel" required placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone 2</label>
                        <input name="phone2" type="tel" required placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Address</label>
                        <input type="text" name="address" required placeholder="" class="form-control">
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
                        <h3>All Parents Data</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table display  text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Occupation</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Phone 2</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count=0;?>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td>{{++$count}}</td>
                                            <td>{{$item->id }}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->gender}}</td>     
                                            <td>{{$item->job}}</td>     
                                            <td>{{$item->email}}</td>                                       
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->phone}}</td>
                                            <td>{{$item->phone2}}</td>
                                            <td> <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <span class="flaticon-more-button-of-three-dots"></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{url('/parent/view/'.$item->id)}}"><i
                                                                class="fas fa-eye text-dark-pastel-green"></i>View</a>
                                                        <a class="dropdown-item" href="{{url('/parent/edit/'.$item->id)}}"><i
                                                                class="fas fa-cogs text-orange-peel"></i>Edit</a>
                                                        <a class="dropdown-item" onclick="return confirm('Are you sure wanted to delete {{$item->name}}')" href="{{url('/parent/delete/'.$item->id)}}"><i
                                                                class="fas fa-redo-alt text-orange-red"></i>Delete</a>
                                                    </div>
                                                </div></td>
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
@endsection

                               <!-- <th>Id</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Occupation</th>
                                <th>Phone</th>
                                <th>Phone 2</th>
                                <th>E-mail</th>
                                <th>-</th>-->