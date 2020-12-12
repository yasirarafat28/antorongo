@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>

</style>

<!-- Main Content -->
<section class="content">

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
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">কর্মচারী তালিকা</h1>

                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">কর্মচারী তালিকা</a></li>
                </ul>
            </div>

            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        মোট কর্মচারী</div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">১৩ জন</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
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
                        <div class="clearfix">
                            <div class="float-left">
                                <h2>কর্মচারী তালিকা </h2>
                            </div>
                            <div class="float-right">
                                <a data-toggle="modal" data-target="#largeModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i> সদস্য যোগ করুন </a>
                            </div>
                        </div>

                    </div>
                    <div class="body">

                        {{-- <div class="col-lg-5 col-md-12 col-12">
                            <div class="input-group search">
                                <input type="text" class="form-control" placeholder="ইমেইল, ফোন ,আইডি">
                                <span class="input-group-addon">
                                    <i class="zmdi zmdi-search"></i>
                                </span>
                                <div class="col-lg-6 col-md-12">
                                    <button class="btn btn-primary btn-round">খুজুন</button>
                                </div>
                            </div>

                        </div> --}}
                        <div class="body members_profiles">
                            <form method="GET">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="ইমেইল, ফোন ,আইডি" name="q" >
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <button class="btn btn-primary btn-round">খুজুন</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <br>
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>নাম </th>
                                <th>ফোন </th>
                                <th>ইমেইল</th>
                                <th>পদবী </th>
                                <th>অবস্থা</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>নাম </th>
                                <th>ফোন </th>
                                <th>ইমেইল</th>
                                <th>পদবী </th>
                                <th>অবস্থা</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($users as $item)
                                <tr>
                                    <td>
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">

                                        <a href="{{url('chairman/member-profile/'.$item->id)}}" class="dropdown-item"  title="বিস্তারিত"><i class="fa fa-eye"> </i> বিস্তারিত </i></a>
                                        <a data-toggle="modal" data-target="#largeEditModal{{$item->id}}" class="dropdown-item" title="সম্পাদনা করুন"><i class="fa fa-edit"> </i> এডিট</a>
                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['/chairman/users', $item->id],
                                               'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-times"></i>  মুছে ফেলুন', array(
                                                 'type' => 'submit',
                                                 'class' => 'dropdown-item',
                                                'title' => 'Delete user',
                                                'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
                                                 )) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>                                    <td>{{$item->name}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->role}}</td>
                                    <td>{{ucfirst($item->status)}}</td>

                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">
                            {!! $users->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
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
            <div class="modal-header">
                <h5 class="modal-title"><strong>সদস্য </strong>তৈরি করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <form action="{{url('admin/users')}}" class="container" method="POST">
                    {{csrf_field()}}
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for=""><small>নাম</small></label>
                                <input type="text" class="form-control" placeholder="ব্যবহারকারীর নাম" name="name">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for=""><small>ই-মেইল</small></label>
                                <input type="email" class="form-control" placeholder="ব্যবহারকারীর ই-মেইল" name="email">
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for=""><small>ইউজারনেম</small></label>
                                <input type="text" class="form-control" placeholder="ইউজারনেম" name="username">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for=""><small>পাসওয়ার্ড</small></label>
                                <input type="password" class="form-control" placeholder="পাসওয়ার্ড" name="password">
                            </div>
                        </div>



                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for=""><small>ফোন</small></label>
                                <input type="text" class="form-control" placeholder="ফোন" name="phone">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for=""><small>ঠিকানা</small></label>
                                <input type="text" class="form-control" placeholder="ঠিকানা" name="address">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for=""><small>বিভাগ</small></label>
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
                                <label for=""><small>জেলা</small></label>
                                <select class="form-control ms district-form" name="district" id="district-form"  onchange="get_thana_list(this.value)">
                                    <option value="">-- Please select a District --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for=""><small>উপজেলা / থানা</small></label>
                                <select class="form-control ms thana-form" name="thana" id="thana-form">
                                    <option value="">-- Please select a Upozilla --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for=""><small>চরিত্র</small></label>
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

                                <label for=""><small>অবস্থা</small></label>
                                <select name="status" class="form-control ms">
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for=""><small>ছবি</small></label>
                                <input type="file" class="form-control" placeholder="ছবি" name="photo">
                            </div>
                        </div>
                        <div class="col-md-12 text-center">

                            <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                        </div>
                    </div>
                </form>
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

                        <div class="modal-header">
                            <h2 class="modal-title"><strong>ব্যবহারকারীকে </strong> আধুনিক করুন</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        <div class="modal-body">
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
                                            <label for=""><small>নাম</small></label>
                                            <input type="text" class="form-control" placeholder="ব্যবহারকারীর নাম" name="name" value="{{$item->name}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>ই-মেইল</small></label>
                                            <input type="email" class="form-control" placeholder="ব্যবহারকারীর ই-মেইল" name="email" value="{{$item->email}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>পাসওয়ার্ড</small></label>
                                            <input type="password" class="form-control" placeholder="পাসওয়ার্ড" name="password">
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>ইউজারনেম</small></label>
                                            <input type="text" class="form-control" placeholder="ইউজারনেম" name="username"  value="{{$item->username}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>ফোন</small></label>
                                            <input type="text" class="form-control" placeholder="ফোন" name="phone" value="{{$item->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>ঠিকানা</small></label>
                                            <input type="text" class="form-control" placeholder="ঠিকানা" name="address" value="{{$item->address}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>বিভাগ</small></label>
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
                                            <label for=""><small>জেলা</small></label>
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
                                            <label for=""><small>উপজেলা / থানা</small></label>
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
                                            <label for=""><small>চরিত্র</small></label>
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

                                            <label for=""><small>অবস্থা</small></label>
                                            <select name="status" class="form-control ms">
                                                <option value="active"  {{$item->status=='active' ? 'selected' : ''}} >Active</option>
                                                <option value="pending" {{$item->status=='pending' ? 'selected' : ''}}>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for=""><small>ছবি</small></label>
                                            <input type="file" class="form-control" placeholder="Photo" name="photo">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                                    </div>
                                </div>
                            </form>
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

