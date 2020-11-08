@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>
    .dataTables_wrapper .dt-buttons{
        display: none;
    }
</style>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{url('')}}"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item active">কর্মচারী তালিকা</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card action_bar shadow">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-6">
                                <div class="input-group search">
                                    <input type="text" class="form-control" placeholder="ইমেইল, ফোন ,আইডি">
                                    <span class="input-group-addon">
                                        <i class="zmdi zmdi-search"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-3 text-right">
                                <a  data-toggle="modal" data-target="#largeModal" class="btn btn-neutral hidden-sm-down">
                                    <i class="zmdi zmdi-plus-circle"></i>
                                </a>


                                <button type="button" class="btn btn-neutral hidden-sm-down" onclick="$('.buttons-csv')[0].click();">
                                    <i class="zmdi zmdi-archive"></i>
                                </button>
                                <button type="button" class="btn btn-neutral hidden-sm-down" onclick="$('.buttons-print')[0].click();">
                                    <i class="zmdi zmdi-print"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="header">
                        <h2><strong>Users </strong> </h2>

                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>নাম </th>
                                <th>ফোন </th>
                                <th>ইমেইল</th>
                                <th>পদবী </th>
                                <th>অবস্থা</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>নাম </th>
                                <th>ফোন </th>
                                <th>ইমেইল</th>
                                <th>পদবী </th>
                                <th>অবস্থা</th>
                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($users as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->role}}</td>
                                    <td>{{ucfirst($item->status)}}</td>
                                    <td>
                                        <a href="{{url('chairman/member-profile/'.$item->id)}}" class="btn btn-icon btn-icon-mini"  title="দেখুন"><i class="zmdi zmdi-eye"> </i></a>
                                        <a data-toggle="modal" data-target="#largeEditModal{{$item->id}}" class="btn btn-icon btn-icon-mini" title="সম্পাদনা করুন"><i class="zmdi zmdi-edit"> </i></a>
                                        <a class="btn btn-danger btn-icon btn-icon-mini" title="মুছে ফেলুন ">
                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['/chairman/users', $item->id],
                                               'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-times"></i> ', array(
                                                 'type' => 'submit',
                                                 'class' => 'btn btn-danger btn-xs btnper',
                                                'title' => 'Delete user',
                                                'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                                 )) !!}
                                            {!! Form::close() !!}
                                        </a>
                                    </td>
                                </tr>



                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>

<!-- Add Modal Start -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card shadow">
                    <div class="header">
                        <h2><strong>Add</strong> User</h2>
                    </div>
                    <div class="body">
                        <form action="{{url('chairman/users')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>Name</small></label>
                                        <input type="text" class="form-control" placeholder="User Name" name="name">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>Email</small></label>
                                        <input type="email" class="form-control" placeholder="Email" name="email">
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>Username</small></label>
                                        <input type="text" class="form-control" placeholder="Username" name="username">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>Password</small></label>
                                        <input type="password" class="form-control" placeholder="Password" name="Password">
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>Phone</small></label>
                                        <input type="text" class="form-control" placeholder="Phone" name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>Address</small></label>
                                        <input type="text" class="form-control" placeholder="Address" name="address">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>Division</small></label>
                                        <select class="form-control ms" name="division" id="division-form" onchange="get_district_list(this.value)">
                                            <option value="">-- Please select --</option>
                                            @foreach($divisions as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>District</small></label>
                                        <select class="form-control ms district-form" name="district" id="district-form"  onchange="get_thana_list(this.value)">
                                            <option value="">-- Please select a District --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>Upozila/Thana</small></label>
                                        <select class="form-control ms thana-form" name="thana" id="thana-form">
                                            <option value="">-- Please select a Upozilla --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>Role</small></label>
                                        <select name="role" class="form-control ms">
                                            <option value="">-- Select a Role --</option>
                                            <?php foreach ($roles as $key => $item): ?>
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">

                                        <label for=""><small>Status</small></label>
                                        <select name="status" class="form-control ms">
                                            <option value="active">Active</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small>Photo</small></label>
                                        <input type="file" class="form-control" placeholder="Photo" name="photo">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-round">SAVE CHANGES</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!--Add Modal End-->

@foreach($users as $item)
    <!-- Edit Large Modal -->
    <div class="modal fade" id="largeEditModal{{$item->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card shadow">
                        <div class="header">
                            <h2><strong>Update</strong> Users</h2>
                        </div>
                        <div class="body">
                            <form action="{{url('chairman/users/'.$item->id)}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}

                                <?php
                                if ($item->division){
                                    $districts=  App\District::where('division_id',$item->division)->orderBy('name','ASC')->get();
                                }
                                else{
                                    $districts = array();
                                }
                                if ($item->district){
                                    $thanas=  App\Thana::where('district_id',$item->district)->orderBy('name','ASC')->get();
                                }else{
                                    $thanas = array();
                                }
                                ?>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>Name</small></label>
                                            <input type="text" class="form-control" placeholder="User Name" name="name" value="{{$item->name}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>Email</small></label>
                                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{$item->email}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>Password</small></label>
                                            <input type="password" class="form-control" placeholder="Password" name="password">
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>Username</small></label>
                                            <input type="text" class="form-control" placeholder="Username" name="username"  value="{{$item->username}}">
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>Phone</small></label>
                                            <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{$item->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>Address</small></label>
                                            <input type="text" class="form-control" placeholder="Address" name="address" value="{{$item->address}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>Division</small></label>
                                            <select class="form-control ms" name="division" id="division-form" onchange="get_district_list(this.value)">
                                                <option value="">-- Please select --</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{$division->id}}" {{$division->id==$item->division ? 'selected' : ''}} >{{$division->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>District</small></label>
                                            <select class="form-control ms district-form" name="district" id="district-form"  onchange="get_thana_list(this.value)">

                                                <option value="">-- Please select --</option>

                                                @foreach($districts as $district)
                                                    <option value="{{$district->id}}" {{$district->id==$item->district ? 'selected' : ''}}>{{$district->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>Upozila/Thana</small></label>
                                            <select class="form-control ms thana-form" name="thana" id="thana-form">
                                                <option value="">-- Please select --</option>
                                                @foreach($thanas as $thana)
                                                    <option value="{{$thana->id}}" {{$thana->id==$item->thana ? 'selected' : ''}} >{{$thana->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>Role</small></label>
                                            <select name="role" class="form-control ms">
                                                <option value="">-- Select a Role --</option>
                                                <?php foreach ($roles as $key => $role): ?>
                                                <option value="{{$role->name}}"  {{$role->name==$item->role ? 'selected' : ''}} >{{$role->name}}</option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">

                                            <label for=""><small>Status</small></label>
                                            <select name="status" class="form-control ms">
                                                <option value="active"  {{$item->status=='active' ? 'selected' : ''}} >Active</option>
                                                <option value="pending" {{$item->status=='pending' ? 'selected' : ''}}>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>Photo</small></label>
                                            <input type="file" class="form-control" placeholder="Photo" name="photo">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-round">SAVE CHANGES</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
    <!--Edit  Modal End-->
@endforeach



<script type="text/javascript">

    function get_district_list(division_id)
    {
        var list = $(".district-form");
        list.children('option:not(:first)').remove();
        $.ajax({
            type: "POST",
            url: "{{ route('getDistrict') }}",
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
                "division_id": division_id,
            },
            success:function(data) {
                console.log(data);
                jQuery.each(data, function(index, item) {
                    list.append(new Option(item.name, item.id));
                });
            },

            error: function (error) {
                console.log(error);
                $('#package-lists').html(error);
            },

        });
    }

    function get_thana_list(district_id)
    {
        var list = $(".thana-form");
        list.children('option:not(:first)').remove();
        $.ajax({
            type: "POST",
            url: "{{ route('getThana') }}",
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
                "district_id": district_id,
            },
            success:function(data) {
                console.log(data);
                jQuery.each(data, function(index, item) {
                    list.append(new Option(item.name, item.id));
                });
            },

            error: function (error) {
                console.log(error);
                $('#package-lists').html(error);
            },

        });
    }
</script>

@endsection


@section('script')

@endsection

