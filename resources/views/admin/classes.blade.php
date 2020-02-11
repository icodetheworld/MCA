@extends('layouts.main')    
@section('content')
@if ($errors->any())
<div class="alert alert-warning">
    <strong></strong>{{ $errors->first()}}
</div>                
@endif 
                <div class="row">
                        <div class="col-6-xxxl col-6">
                                <div class="card height-auto">
                                        <div class="card-body">
                                            <div class="heading-layout1">
                                                <div class="item-title">
                                                    <h3>Add New Class</h3>
                                                    <p><i>* Even if you add class, it won't be displayed untill you added divisions</i></p>
                                                </div>
                                            </div>
                                            <form class="new-added-form" method="POST" action="{{url('/add/class')}} ">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                                        <label>New Class *</label>
                                                        <input type="text" placeholder="" name="class" class="form-control">
                                                    </div>
                                                   <div class="form-group ">
                                                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            <div class="card height-auto">
                                <div class="card-body">
                                    <div class="heading-layout1">
                                        <div class="item-title">
                                            <h3>All Class rooms</h3>
                                        </div>
                                    </div>
                                    <div class="table-">
                                        <table class="table table-hover table-striped table-sm" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Class</th>
                                                        <th>Division</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $count=0; ?>
                                                    @foreach ($data as $item)
                                                        
                                                    <tr>
                                                            <td>{{++$count}}</td>
                                                            <td>{{DB::table('class')->where('id',$item->class)->first()->class}}</td>
                                                            <td>{{$item->division}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{$data->links()}}
                                    </div>
                                </div>
                            </div>
                            <div class="card height-auto">
                                <div class="card-body">
                                    <div class="heading-layout1">
                                        <div class="item-title">
                                            <h3>All Houses</h3>
                                        </div>
                                    </div>
                                    <div class="table-">
                                        <table class="table table-hover table-striped table-sm" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>House</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $count=0; ?>
                                                    @foreach ($house as $item)
                                                        
                                                    <tr>
                                                            <td>{{++$count}}</td>
                                                            <td>{{$item->name}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{$data->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6-xxxl col-6">
                                 <div class="card height-auto">
                                    <div class="card-body">
                                        <div class="heading-layout1">
                                            <div class="item-title">
                                                <h3>Add New Division</h3>
                                            </div>
                                        </div>
                                        <form class="new-added-form" method="POST" action="{{url('/add/room')}} ">
                                            @csrf
                                            <div class="row">
                                                <div class=" col-md-12  form-group">
                                                    <label>Class *</label>
                                                    <select name="class" class="form-control">
                                                        @foreach ($class as $item)
                                                            <option value="{{$item->id}}">{{$item->class}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class=" col-md-12  form-group">
                                                    <label>Division</label>
                                                    <select name="division" class="form-control">
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>
                                                        <option value="E">E</option>
                                                        <option value="F">F</option>
                                                        <option value="G">G</option>
                                                        <option value="H">H</option>
                                                        <option value="I">I</option>
                                                        <option value="J">J</option>
                                                        <option value="K">K</option>
                                                        <option value="L">L</option>
                                                        <option value="M">M</option>
                                                        <option value="N">N</option>
                                                        <option value="O">O</option>
                                                        <option value="P">P</option>
                                                        <option value="Q">Q</option>
                                                        <option value="R">R</option>
                                                        <option value="S">S</option>
                                                        <option value="T">T</option>
                                                        <option value="U">U</option>
                                                        <option value="V">V</option>
                                                        <option value="W">W</option>
                                                        <option value="X">X</option>
                                                        <option value="Y">Y</option>
                                                        <option value="Z">Z</option>
                                                    </select>
                                                </div>
                                               <div class="form-group ">
                                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card height-auto">
                                        <div class="card-body">
                                            <div class="heading-layout1">
                                                <div class="item-title">
                                                    <h3>Add New House</h3>
                                                </div>
                                            </div>
                                            <form class="new-added-form" method="POST" action="{{url('/add/house')}} ">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                                        <label>New House *</label>
                                                        <input type="text" placeholder="" name="name" class="form-control">
                                                    </div>
                                                   <div class="form-group ">
                                                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                    </div>
                    <!-- All Subjects Area End Here -->
@endsection