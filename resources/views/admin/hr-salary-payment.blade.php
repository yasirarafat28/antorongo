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
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">
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
                                <th>ভবিষ্যতনিধি </th>
                                <th>পেশাগত কর </th>
                                <th>মোট পরিশোধযোগ্য </th>
                                <th>মোট পরিশোধ </th>

                                <th>ক্রিয়াকলাপ</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>কর্মচারী </th>
                                <th>মূল বেতন </th>
                                <th>মহার্ঘ ভাতা </th>
                                <th>ভবিষ্যতনিধি </th>
                                <th>পেশাগত কর </th>
                                <th>মোট পরিশোধযোগ্য </th>
                                <th>মোট পরিশোধ </th>

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
                                    <td>- {{\App\NumberConverter::en2bn($item->p_fund_deduction)}} টাকা</td>
                                    <td>- {{\App\NumberConverter::en2bn($item->pro_tax_deduction)}} টাকা</td>
                                    <td> +{{\App\NumberConverter::en2bn($item->payable_amount)}} টাকা</td>
                                    <td> +{{\App\NumberConverter::en2bn($item->paid_amount)}} টাকা</td>


                                    <td>
                                        <a data-toggle="modal" data-target="#largeShowModal{{$item->id}}" class="btn btn-icon btn-icon-mini" title="সম্পাদনা করুন"><i class="zmdi zmdi-eye"> </i></a>

                                        <a class="btn btn-danger btn-icon btn-icon-mini" title="মুছে ফেলুন ">
                                            {!! Form::open([
                                               'method'=>'DELETE',
                                               'url' => ['admin/hr/salary-payment', $item->id],
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
                        <h2><strong> বেতন </strong> যোগ করুন</h2>
                    </div>
                    <div class="body">
                        <form action="{{url('admin/hr/salary-payment')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> কর্মচারী </small></label>
                                        <select class="form-control ms" name="user_id" onchange="getSalaryStructure(this.value)">
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
                                        <label for=""><small> মহার্ঘ ভাতা</small></label>
                                        <input type="number" class="form-control" placeholder="মহার্ঘ ভাতা" name="dearness_allowance" value="0" id="dearness_allowance" onkeyup="SalaryCalculate()">
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> বাড়িভাড়া ভাতা</small></label>
                                        <input type="number" class="form-control" placeholder="বাড়িভাড়া ভাতা" name="house_rent_allowance" value="0" id="house_rent_allowance" onkeyup="SalaryCalculate()">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> মেডিকেল ভাতা</small></label>
                                        <input type="number" class="form-control" placeholder="মেডিকেল ভাতা" name="medical_allowance" value="0" id="medical_allowance" onkeyup="SalaryCalculate()">
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
                                        <label for=""><small> ভবিষ্যতনিধি </small></label>
                                        <input type="number" class="form-control" placeholder="ভবিষ্যতনিধি" name="p_fund_deduction" value="0" id="p_fund_deduction" onkeyup="SalaryCalculate()">
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> পেশাগত কর </small></label>
                                        <input type="number" class="form-control" placeholder="পেশাগত কর" name="pro_tax_deduction" value="0" id="pro_tax_deduction" onkeyup="SalaryCalculate()">
                                    </div>
                                </div>


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



                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> অন্যান্য </small></label>
                                        <input type="number" class="form-control" placeholder="অন্যান্য" name="other_deduction" value="0" id="other_deduction" onkeyup="SalaryCalculate()">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for=""><small> মতামত </small></label>
                                        <textarea name="note" class="form-control"></textarea>
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> মোট পরিশোধযোগ্য </small></label>
                                        <input type="number" class="form-control" readonly placeholder="মোট পরিশোধযোগ্য" name="payable" value="0" id="payable">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> মোট পরিশোধ  </small></label>
                                        <input type="number" class="form-control" placeholder="মোট পরিশোধ" name="paid" value="0" id="paid"  onkeyup="SalaryCalculate()">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for=""><small> বকেয়া   </small></label>
                                        <input type="number" class="form-control" readonly placeholder="মোট বকেয়া" name="due" value="0" id="due">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <h4>মোট বেতন : <span id="total-salary">0</span></h4>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <button type="submit" class="btn btn-info btn-round">সেভ করুন</button>
                                </div>


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
    <!-- Show Modal Start -->
    <div class="modal fade" id="largeShowModal{{$item->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card shadow">
                        <div class="header">
                            <h2><strong> বেতন </strong> যোগ করুন</h2>
                        </div>
                        <div class="body">
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
                                    <tr>
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
                                    </tr>
                                    <tr>
                                        <td>বোনাস</td>
                                        <td>{{$item->bonus_allowance}}</td>
                                    </tr>
                                    <tr>
                                        <td>অন্যান্য ভাতা</td>
                                        <td>{{$item->other_addition_allowance}}</td>
                                    </tr>
                                    <tr>
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
                                    </tr>
                                    <tr>
                                        <td>বেতনের মাস </td>
                                        <td>{{$item->payment_month}}</td>
                                    </tr>
                                    <tr>
                                        <td> মোট পরিশোধযোগ্য </td>
                                        <td>{{$item->payable_amount}}</td>
                                    </tr>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">বন্ধ করুন</button>
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
        dear = parseFloat($('#dearness_allowance').val());

        //alert(basic+dear);
        house = parseFloat($('#house_rent_allowance').val());
        medical = parseFloat($('#medical_allowance').val());
        bonus = parseFloat($('#bonus_allowance').val());
        other_allowance = parseFloat($('#other_addition_allowance').val());

        p_fund = parseFloat($('#p_fund_deduction').val());
        pro_tax = parseFloat($('#pro_tax_deduction').val());
        other_deduction = parseFloat($('#other_deduction').val());
        //console.log(parseFloat(basic+dear));

        $('#due').val(parseFloat($('#payable').val())-parseFloat($('#paid').val()));

        $('#total-salary').html(basic+dear+house+medical+bonus+other_allowance-p_fund-pro_tax-other_deduction);
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
                dear = parseFloat($('#dearness_allowance').val(data.dearness_allowance));

                //alert(basic+dear);
                house = parseFloat($('#house_rent_allowance').val(data.house_rent_allowance));
                medical = parseFloat($('#medical_allowance').val(data.medical_allowance));
                bonus = parseFloat($('#bonus_allowance').val(data.bonus_allowance));
                other_allowance = parseFloat($('#other_addition_allowance').val(data.other_addition_allowance));

                p_fund = parseFloat($('#p_fund_deduction').val(data.p_fund_deduction));
                pro_tax = parseFloat($('#pro_tax_deduction').val(data.pro_tax_deduction));
                other_deduction = parseFloat($('#other_deduction').val(data.other_deduction));

                $('#payable').val(data.basic_allowance+data.dearness_allowance+data.house_rent_allowance+data.medical_allowance+data.bonus_allowance+data.other_addition_allowance-data.p_fund_deduction-data.pro_tax_deduction-data.other_deduction);

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

