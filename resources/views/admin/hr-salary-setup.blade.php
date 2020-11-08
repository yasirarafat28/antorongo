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
                    <li class="breadcrumb-item active">কর্মচারীর বেতন</li>
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
                <div class="card action_bar">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-6">
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
                <div class="card">
                    <div class="header">
                        <h2><strong>কর্মচারীর বেতন  </strong> </h2>

                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>কর্মচারী </th>
                                <th>মূল বেতন </th>
                                <th>মহার্ঘ ভাতা </th>
                                <th>বাড়িভাড়া ভাতা </th>
                                <th>মেডিকেল ভাতা </th>
                                <th>বোনাস </th>
                                <th>অন্যান্য ভাতা </th>
                                <th>ভবিষ্যতনিধি </th>
                                <th>পেশাগত কর </th>
                                <th>অন্যান্য নিলাম </th>

                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>কর্মচারী </th>
                                <th>মূল বেতন </th>
                                <th>মহার্ঘ ভাতা </th>
                                <th>বাড়িভাড়া ভাতা </th>
                                <th>মেডিকেল ভাতা </th>
                                <th>বোনাস </th>
                                <th>অন্যান্য ভাতা </th>
                                <th>ভবিষ্যতনিধি </th>
                                <th>পেশাগত কর </th>
                                <th>অন্যান্য নিলাম </th>

                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                @foreach($records as $item)
                                <tr>
                                    <td>{{\App\NumberConverter::en2bn($loop->iteration)}}</td>
                                    <td> {{$item->user->name}}</td>
                                    <td>+ {{\App\NumberConverter::en2bn($item->basic_allowance)}} টাকা</td>
                                    <td>+ {{\App\NumberConverter::en2bn($item->dearness_allowance)}} টাকা</td>
                                    <td>+ {{\App\NumberConverter::en2bn($item->house_rent_allowance)}} টাকা</td>
                                    <td>+ {{\App\NumberConverter::en2bn($item->medical_allowance)}} টাকা</td>
                                    <td>+ {{\App\NumberConverter::en2bn($item->bonus_allowance)}} টাকা</td>
                                    <td>+ {{\App\NumberConverter::en2bn($item->other_addition_allowance)}} টাকা</td>
                                    <td>- {{\App\NumberConverter::en2bn($item->p_fund_deduction)}} টাকা</td>
                                    <td>- {{\App\NumberConverter::en2bn($item->pro_tax_deduction)}} টাকা</td>
                                    <td>- {{\App\NumberConverter::en2bn($item->other_deduction)}} টাকা</td>


                                    <td>
                                        <a data-toggle="modal" data-target="#largeEditModal{{$item->id}}" class="btn btn-icon btn-icon-mini" title="সম্পাদনা করুন"><i class="zmdi zmdi-edit"> </i></a>
                                        <a class="btn btn-danger btn-icon btn-icon-mini" title="মুছে ফেলুন ">
                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['admin/hr/salary-setup', $item->id],
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
                <div class="card">
                    <div class="header">
                        <h2><strong> বেতন </strong> যোগ করুন</h2>
                    </div>
                    <div class="body">
                        <form action="{{url('admin/hr/salary-setup')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> কর্মচারী </small></label>
                                        <select class="form-control ms" name="user_id">
                                            <option>-- বাছাই করুন --</option>
                                            @foreach($members as $member)
                                                <option value="{{$member->id}}">{{$member->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> মূল বেতন</small></label>
                                        <input type="number" class="form-control" placeholder="মূল বেতন" name="basic_allowance">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> মহার্ঘ ভাতা</small></label>
                                        <input type="number" class="form-control" placeholder="মহার্ঘ ভাতা" name="dearness_allowance">
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> বাড়িভাড়া ভাতা</small></label>
                                        <input type="number" class="form-control" placeholder="বাড়িভাড়া ভাতা" name="house_rent_allowance">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> মেডিকেল ভাতা</small></label>
                                        <input type="number" class="form-control" placeholder="মেডিকেল ভাতা" name="medical_allowance">
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> বোনাস</small></label>
                                        <input type="number" class="form-control" placeholder="বোনাস" name="bonus_allowance">
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> অন্যান্য ভাতা </small></label>
                                        <input type="number" class="form-control" placeholder="অন্যান্য ভাতা" name="other_addition_allowance">
                                    </div>
                                </div>
                                <hr>



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> ভবিষ্যতনিধি </small></label>
                                        <input type="number" class="form-control" placeholder="ভবিষ্যতনিধি" name="p_fund_deduction">
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> পেশাগত কর </small></label>
                                        <input type="number" class="form-control" placeholder="পেশাগত কর" name="pro_tax_deduction">
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> অন্যান্য </small></label>
                                        <input type="number" class="form-control" placeholder="অন্যান্য" name="other_deduction">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>
<!--Add Modal End-->

@foreach($records as $item)
<!-- Edit Modal Start -->
<div class="modal fade" id="largeEditModal{{$item->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="header">
                        <h2><strong> বেতন </strong> যোগ করুন</h2>
                    </div>
                    <div class="body">
                        <form action="{{url('admin/hr/salary-setup/'.$item->id)}}" method="POST">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> কর্মচারী </small></label>
                                        <select class="form-control ms" name="user_id">
                                            <option>-- বাছাই করুন --</option>
                                            @foreach($members as $member)
                                                <option value="{{$member->id}}" {{$member->id==$item->user_id?'selected' :''}} >{{$member->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> মূল বেতন</small></label>
                                        <input type="number" class="form-control" placeholder="মূল বেতন" name="basic_allowance" value="{{$item->basic_allowance}}">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> মহার্ঘ ভাতা</small></label>
                                        <input type="number" class="form-control" placeholder="মহার্ঘ ভাতা" name="dearness_allowance" value="{{$item->dearness_allowance}}">
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> বাড়িভাড়া ভাতা</small></label>
                                        <input type="number" class="form-control" placeholder="বাড়িভাড়া ভাতা" name="house_rent_allowance" value="{{$item->basic_allowance}}">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> মেডিকেল ভাতা</small></label>
                                        <input type="number" class="form-control" placeholder="মেডিকেল ভাতা" name="medical_allowance" value="{{$item->medical_allowance}}">
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> বোনাস</small></label>
                                        <input type="number" class="form-control" placeholder="বোনাস" name="bonus_allowance" value="{{$item->bonus_allowance}}">
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> অন্যান্য ভাতা </small></label>
                                        <input type="number" class="form-control" placeholder="অন্যান্য ভাতা" name="other_addition_allowance" value="{{$item->other_addition_allowance}}">
                                    </div>
                                </div>
                                <hr>



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> ভবিষ্যতনিধি </small></label>
                                        <input type="number" class="form-control" placeholder="ভবিষ্যতনিধি" name="p_fund_deduction" value="{{$item->p_fund_deduction}}">
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> পেশাগত কর </small></label>
                                        <input type="number" class="form-control" placeholder="পেশাগত কর" name="pro_tax_deduction" value="{{$item->pro_tax_deduction}}">
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> অন্যান্য </small></label>
                                        <input type="number" class="form-control" placeholder="অন্যান্য" name="other_deduction" value="{{$item->other_deduction}}">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>
<!--Add Modal End-->
@endforeach

@endsection


@section('script')

@endsection

