@extends('layouts.main')    

@section('content')
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div>                
@endif 
                <!-- Student Table Area Start Here -->
                <div class="card height-auto">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>All Students Data</h3>
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
                                            <th>Admission No</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th>Parents</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td>{{$item->id }}</td>
                                            <td>{{$item->ad_no}}</td>
                                            <td>{{$item->f_name.' '.$item->l_name}}</td>
                                            <td>{{$item->gender}}</td>     
                                            <td>{{$item->email}}</td>                                       
                                            <td>{{\App\clss::where('id',$item->room()->class)->first()->class}}</td>
                                            <td>{{$item->room()->division}}</td>
                                            <?php 
                                                $id=DB::table('parent_relation')->where('student_id',$item->id)->first();
                                                if($id!=null){
                                                    $parent=DB::table('parents')->where('id',$id->parent_id)->first();
                                                    $url="/parent/view/".$parent->id;
                                                    $name=$parent->name;
                                                }else{
                                                    $name="Not Yet Assigned";
                                                    $url="/all_parents";
                                                }
                                            ?>
                                            <td><a href="{{url($url)}}" >{{$name}}</a></td>
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->phone}}</td>
                                            <td> <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <span class="flaticon-more-button-of-three-dots"></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{url('/student/'.$item->id)}}"><i
                                                                class="fas fa-eye text-dark-pastel-green"></i>View</a>
                                                        <a class="dropdown-item" href="{{url('/student/view/'.$item->id)}}"><i
                                                                class="fas fa-cogs text-orange-peel"></i>Edit</a>
                                                        <a class="dropdown-item" onclick="return confirm('Are you sure wanted to delete {{$item->f_name.' '.$item->l_name}}')" href="{{url('/student/delete/'.$item->id)}}"><i
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
                    <!-- Student Table Area End Here -->
@endsection