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
            <h1 class="h3 mb-0 text-gray-800">কর্মচারীর বেতন পরিশোধ</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">কর্মচারীর বেতন পরিশোধ</a></li>
            </ul>
        </div>

        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    উপার্জন (মাসিক)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">৳ 40,000 টাকা</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Earnings (Monthly) Card Example -->
            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    উপার্জন (বার্ষিক)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">৳ 40,000 টাকা</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        {{-- <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card action_bar shadow">
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
        </div> --}}

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">

                    <div class="header">
                        <div class="clearfix">
                            <div class="float-left">
                                <h2>কর্মচারীর বেতন পরিশোধ</h2>
                            </div>
                            <div class="float-right">
                                <a data-toggle="modal" data-target="#largeModal" class="btn btn-primary"> <i class="fas fa-fw fa-plus"></i>কর্মচারীর বেতন পরিশোধ</a>
                            </div>
                        </div>

                    </div>
                    <div class="body table-responsive">

                        <form action="">

                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4">

                                    <label for=""><small>মাস</small></label>
                                    <select name="month" id="" class="form-control ms">
                                        <option value="">Select a month</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='January'?'selected':''}} value="January">January</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='February'?'selected':''}} value="February">February</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='March'?'selected':''}} value="March">March</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='April'?'selected':''}} value="April">April</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='May'?'selected':''}} value="May">May</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='June'?'selected':''}} value="June">June</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='July'?'selected':''}} value="July">July</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='August'?'selected':''}} value="August">August</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='September'?'selected':''}} value="September">September</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='October'?'selected':''}} value="October">October</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='November'?'selected':''}} value="November">November</option>
                                        <option {{isset($_GET['month']) && $_GET['month']=='December'?'selected':''}} value="December">December</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4">

                                    <label for=""><small> কর্মচারীর</small></label>
                                    <select class="form-control ms" name="user_id" >
                                        <option>-- বাছাই করুন --</option>
                                        @foreach($members as $member)
                                            <option {{isset($_GET['user_id']) && $_GET['user_id']==$member->id?'selected':''}} value="{{$member->id}}">{{$member->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-2 col-md-2">

                                    <br>

                                    <div class="input-group">
                                        <button class="btn btn-primary btn-round">খুঁজুন</button>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <br>
                                    @if (count($_GET))

                                        <a href="?{{$_SERVER['QUERY_STRING']}}&limit=-1" class="btn btn-success">সবগুলো দেখুন </a>
                                    @else

                                        <a href="?limit=-1" class="btn btn-success">সবগুলো দেখুন </a>

                                    @endif
                                </div>

                            </div>
                        </form>
                        <br>
                        <br>
                        <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                            <thead>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>কর্মচারী </th>
                                <th>মূল বেতন </th>
                                <th>বোনাস </th>
                                <th>অন্যান্য ভাতা </th>
                                <th>জরিমানা </th>
                                {{-- <th>মোট পরিশোধযোগ্য </th> --}}
                                <th>মোট পরিশোধ </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ক্রিয়াকলাপ</th>
                                <th>কর্মচারী </th>
                                <th>মূল বেতন </th>
                                <th>বোনাস </th>
                                <th>অন্যান্য ভাতা </th>
                                <th>জরিমানা </th>
                                {{-- <th>মোট পরিশোধযোগ্য </th> --}}
                                <th>মোট পরিশোধ </th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($records as $item)
                                <tr>
                                    <td>
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">

                                        <a data-toggle="modal" data-target="#largeShowModal{{$item->id}}" class="dropdown-item" title="সম্পাদনা করুন"><i class="fa fa-eye"> </i> বিস্তারিত</a>

                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['admin/hr/salary-payment', $item->id],
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
                                    </td>
                                    <td> {{$item->user->name}}</td>
                                    <td>+ {{\App\NumberConverter::en2bn($item->basic_allowance)}} টাকা</td>
                                    <td>+ {{\App\NumberConverter::en2bn($item->bonus_allowance)}} টাকা</td>
                                    <td>{{\App\NumberConverter::en2bn($item->other_addition_allowance)}} টাকা</td>
                                     <td>- {{\App\NumberConverter::en2bn($item->fine??0)}} টাকা</td>
                                    {{-- <td> +{{\App\NumberConverter::en2bn($item->payable_amount)}} টাকা</td> --}}
                                    <td> +{{\App\NumberConverter::en2bn($item->paid_amount)}} টাকা</td>



                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        <div class="pull-right">
                            {!! $records->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
                        <h2><strong>কর্মচারীর</strong> বেতন পরিশোধ</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/hr/salary-payment')}}" method="POST">
                            {{csrf_field()}}

                            <input type="hidden"   name="paid" value="0" id="paid"   >
                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> কর্মচারী </small></label>
                                        <select class="form-control ms" name="user_id" >
                                            <option>-- বাছাই করুন --</option>
                                            @foreach($members as $member)
                                                <option value="{{$member->id}}">{{$member->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> মূল বেতন</small></label>
                                        <input type="number" class="form-control" placeholder="মূল বেতন" name="basic_allowance" value="0" id="basic_allowance" onkeyup="SalaryCalculate()">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> বোনাস</small></label>
                                        <input type="number" class="form-control" placeholder="বোনাস" name="bonus_allowance" value="0" id="bonus_allowance" onkeyup="SalaryCalculate()">
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> অন্যান্য ভাতা </small></label>
                                        <input type="number" class="form-control" placeholder="অন্যান্য ভাতা" name="other_addition_allowance" value="0" id="other_addition_allowance" onkeyup="SalaryCalculate()">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> জরিমানা  </small></label>
                                        <input type="number" class="form-control" placeholder="জরিমানা" name="fine" value="0" id="fine" onkeyup="SalaryCalculate()">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> বেতনের  মাস  </small></label>
                                        <select name="month" id="" class="form-control ms">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> মতামত </small></label>
                                        <textarea name="note" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <h4>মোট বেতন : <span id="total-salary">0</span></h4>
                                </div>

                                <div class="col-lg-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>

    </div>
</div>
<!--Add Modal End-->


@foreach($records as $item)
    <!-- Show Modal Start -->
    <div class="modal fade" id="largeShowModal{{$item->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                        <div class="modal-header">
                            <h2><strong>বেতন পরিশোধ</strong>বিস্তারিত দেখুন</h2>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td>কর্মচারী</td>
                                        <td>{{$item->user->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>মূল বেতন</td>
                                        <td>{{$item->basic_allowance}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>মহার্ঘ ভাতা</td>
                                        <td>{{$item->dearness_allowance}}</td>
                                    </tr>
                                    <tr>
                                        <td>বাড়িভাড়া ভাতা</td>
                                        <td>{{$item->house_rent_allowance}}</td>
                                    </tr>
                                    <tr>
                                        <td>মেডিকেল ভাতা</td>
                                        <td>{{$item->medical_allowance}}</td>
                                    </tr> --}}
                                    <tr>
                                        <td>বোনাস</td>
                                        <td>{{$item->bonus_allowance}}</td>
                                    </tr>
                                    <tr>
                                        <td>অন্যান্য ভাতা</td>
                                        <td>{{$item->other_addition_allowance}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>ভবিষ্যতনিধি</td>
                                        <td>{{$item->p_fund_deduction}}</td>
                                    </tr>
                                    <tr>
                                        <td>পেশাগত কর</td>
                                        <td>{{$item->pro_tax_deduction}}</td>
                                    </tr>
                                    <tr>
                                        <td>অন্যান্য বিয়োগ </td>
                                        <td>{{$item->other_deduction}}</td>
                                    </tr> --}}
                                    <tr>
                                        <td>বেতনের মাস </td>
                                        <td>{{$item->payment_month}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td> মোট পরিশোধযোগ্য </td>
                                        <td>{{$item->payable_amount}}</td>
                                    </tr> --}}
                                    <tr>
                                        <td> মোট পরিশোধ </td>
                                        <td>{{$item->paid_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td> পরিশোধের তারিখ </td>
                                        <td>{{$item->created_at}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

        </div>
    </div>
    <!--Show Modal End-->
@endforeach



<script>
    function SalaryCalculate()
    {
        basic = parseFloat($('#basic_allowance').val());
        // dear = parseFloat($('#dearness_allowance').val());

        //alert(basic+dear);
        // house = parseFloat($('#house_rent_allowance').val());
        // medical = parseFloat($('#medical_allowance').val());
        bonus = parseFloat($('#bonus_allowance').val());
        other_allowance = parseFloat($('#other_addition_allowance').val());

        // p_fund = parseFloat($('#p_fund_deduction').val());
        // pro_tax = parseFloat($('#pro_tax_deduction').val());
        // other_deduction = parseFloat($('#other_deduction').val());
        p_fine = parseFloat($('#fine').val());
        //console.log(parseFloat(basic+dear));

        //$('#due').val(parseFloat($('#payable').val())-parseFloat($('#paid').val()));

        let grand_total = basic+bonus+other_allowance-p_fine;
        $('#paid').val(grand_total);
        $('#total-salary').html(grand_total);
        //$('#total-salary').html(parseFloat(basic+dear+house+medical+bonus+other_allowance));

    }
</script>



<script type="text/javascript">
    function getSalaryStructure(user_id)
    {
        var list = $(".thana-form");
        $.ajax({
            type: "POST",
            url: "{{ route('getSalaryStructure') }}",
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
                "user_id": user_id,
            },
            success:function(data) {

                basic = parseFloat($('#basic_allowance').val(data.basic_allowance));
                // dear = parseFloat($('#dearness_allowance').val(data.dearness_allowance));

                //alert(basic+dear);
                // house = parseFloat($('#house_rent_allowance').val(data.house_rent_allowance));
                // medical = parseFloat($('#medical_allowance').val(data.medical_allowance));
                bonus = parseFloat($('#bonus_allowance').val(data.bonus_allowance));
                other_allowance = parseFloat($('#other_addition_allowance').val(data.other_addition_allowance));

                // p_fund = parseFloat($('#p_fund_deduction').val(data.p_fund_deduction));
                // pro_tax = parseFloat($('#pro_tax_deduction').val(data.pro_tax_deduction));
                // other_deduction = parseFloat($('#other_deduction').val(data.other_deduction));
                // p_fine = parseFloat($('#fine').val(data.fine));

                $('#payable').val(data.basic_allowance+data.bonus_allowance+data.other_addition_allowance);

                SalaryCalculate();

            },

            error: function (error) {
                console.log(error);
            },

        });
    }
</script>

@endsection


@section('script')

@endsection

