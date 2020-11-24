@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Main Content -->

<!-- Dropzone Css -->
<link rel="stylesheet" href="{{asset('assets/plugins/dropzone/dropzone.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/timeline.css')}}">
<section class="content profile-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                {{-- <h2>Profile
                    <small>Welcome to {{\App\Setting::setting()->app_name}}</small>
                </h2> --}}
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item active">ঋণের আবেদন</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-md-12">

            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
        <form method="POST" action="{{route('LoanApplication')}}" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="row clearfix">
                <div class="card shadow">

                    <div class="header">

                        <h2><strong> ঋণের আবেদন</strong>  ফরম</h2>

                    </div>

                    <div class="body">

                        <div class="row clearfix">

                            <div class="col-lg-8 col-md-8 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> সদস্য বাছাই করুন</small></label>

                                    <select name="user_id" id="user_id" onchange="getUser(this.value)" class="form-control z-index show-tick selectpicker"  data-live-search="true">
                                        <option value="no">সদস্য বাছাই করুন</option>
                                        @foreach($members??array() as $member)
                                            <option value="{{$member->id}}" {{$loan->user_id==$member->id?'selected':''}} >{{$member->name}} - {{$member->unique_id}} </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>তারিখ </small></label>

                                    <input type="date" class="form-control" placeholder="তারিখ " name="date" value="{{$loan->date}}" id="date">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>ঋণের  পরিমান </small></label>

                                    <input type="text" class="form-control" placeholder="ঋণের  পরিমান " name="request_amount" value="{{$loan->request_amount}}" id="amount">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>ঋণ গ্রহনের কারন  </small></label>

                                    <input type="text" class="form-control" placeholder="ঋণ গ্রহনের কারন " name="reason" value="{{$loan->reason}}" id="amount">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>কিস্তির ধরন  </small></label>
                                    <select name="installment_type"  class="form-control ms">
                                        <option value="daily" {{$loan->installment_type=='daily'?'selected':''}}> দৈনিক </option>
                                        <option value="weekly" {{$loan->installment_type=='weekly'?'selected':''}}> সাপ্তাহিক</option>
                                        <option value="monthly" {{$loan->installment_type=='monthly'?'selected':''}}>মাসিক</option>
                                    </select>


                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>কিস্তির পরিমান</small></label>

                                    <input type="number" step="any" class="form-control" placeholder="কিস্তির পরিমান " name="installment_amount" value="{{$loan->installment_amount}}" id="amount">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> ঋণ নাম্বার (ফাকা রাখলে স্বয়ংক্রিয় ভাবে তৈরি হবে)</small></label>

                                    <input type="text" class="form-control" placeholder="ঋণ নাম্বার" name="loan_code" value="{{$loan->loan_code}}" id="loan_code">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> হিসাব নাম্বার/সভ্য নাম্বার (ফাকা রাখলে স্বয়ংক্রিয় ভাবে তৈরি হবে)</small></label>

                                    <input type="text" class="form-control" placeholder="হিসাব নাম্বার/সভ্য নাম্বার" name="unique_id" value="{{old('unique_id')}}" id="unique_id">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> নাম</small></label>

                                    <input type="text" class="form-control" placeholder="নাম" name="name_bn" value="{{old('name_bn')}}" id="name_bn">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> নাম (ইংরেজীতে)</small></label>

                                    <input type="text" class="form-control" placeholder="নাম (ইংরেজীতে)" name="name" value="{{old('name')}}" id="name">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> পিতার/স্বামীর নাম</small></label>

                                    <input type="text" class="form-control" placeholder="পিতার/স্বামীর নাম" name="father_name" value="{{old('father_name')}}" id="father_name">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  মাতার নাম</small></label>

                                    <input type="text" class="form-control" placeholder="মাতার নাম" name="mother_name" value="{{old('mother_name')}}" id="mother_name">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> নমিনি</small></label>

                                    <input type="text" class="form-control" placeholder="নমিনি" name="nominee_name" value="{{old('nominee_name')}}" id="nominee_name">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> সম্পর্ক</small></label>

                                    <input type="text" class="form-control" placeholder="সম্পর্ক" name="nominee_relation" value="{{old('nominee_relation')}}" id="nominee_relation">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  জাতীয়তা</small></label>

                                    <select name="nationality" id="" class="form-control ms">
                                        <option value="Bangladeshi">Bangladeshi</option>
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>   বর্তমান ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="বর্তমান ঠিকানা" name="present_address" value="{{old('present_address')}}" id="present_address">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>   স্থায়ী ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="স্থায়ী ঠিকানা" name="permanent_address" value="{{old('permanent_address')}}" id="permanent_address">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> মোবাইল নং </small></label>

                                    <input type="text" class="form-control" placeholder="মোবাইল নং" name="phone" value="{{old('phone')}}" id="phone">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  টেলিফোন </small></label>

                                    <input type="text" class="form-control" placeholder="টেলিফোন" name="phone_2" value="{{old('phone_2')}}" id="phone_2">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  বিশেষ নির্দেশনা যদি থাকে </small></label>

                                    <input type="text" class="form-control" placeholder="বিশেষ নির্দেশনা যদি থাকে" name="comment" value="{{old('comment')}}" id="comment">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> যোগাযোগের ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="যোগাযোগের ঠিকানা" name="contact_address" value="{{old('contact_address')}}" id="contact_address">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> ছবি</small></label>

                                    <input type="file" class="form-control" placeholder="ছবি" name="photo" id="photo" onchange="photoURL(this)">
                                    <div class="col-md-12" style="display: block;">
                                        <img src="" id="photo-img" onerror="this.onerror=null; this.src='{{asset('/front/images/no_img_avaliable.jpg')}}';" style="width: 50%;height: 80px;display: none">
                                    </div>

                                </div>

                            </div>



                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> স্বাক্ষর</small></label>

                                    <input type="file" class="form-control" placeholder="স্বাক্ষর" name="signature" id="signature" onchange="signatureURL(this);">
                                    <div class="col-md-12" style="display: block;">
                                        <img src="" id="signature-img" onerror="this.onerror=null; this.src='{{asset('/front/images/no_img_avaliable.jpg')}}';" style="width: 50%;height: 80px;display: none">
                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>

                </div>
            </div>




            <div class="row clearfix">
                <div class="card shadow">

                    <div class="header">

                        <h2><strong> অফিস কর্তৃক পূরণীয়</strong></h2>

                    </div>

                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> অনুমদিত ঋণের  পরিমান </small></label>

                                    <input type="text" class="form-control" placeholder="অনুমদিত ঋণের  পরিমান " name="approved_amount" value="{{$loan->approved_amount}}" id="amount">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> মেয়াদ </small></label>

                                    <input type="text" class="form-control" placeholder="মেয়াদ " name="duration" value="{{$loan->duration}}" id="amount">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> লাভের হার (%) </small></label>

                                    <input type="text" class="form-control" placeholder="লাভের হার (%) " name="interest_rate" value="{{$loan->interest_rate}}" id="amount">

                                </div>

                            </div>




                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> বিস্তারিত </small></label>

                                    <textarea class="form-control" placeholder="বিস্তারিত " name="note"  id="note">{{$fdr->note}}</textarea>

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> অবস্থা  </small></label>

                                    <select name="stat" id="stat" class="form-control ms">
                                        <option value="">বাছাই করুন</option>
                                        <option value="active" {{$fdr->status=='active'?'selected':''}} >Active</option>
                                        <option value="pending" {{$fdr->status=='pending'?'selected':''}} > Pending</option>
                                        <option value="declined" {{$fdr->status=='declined'?'selected':''}} > Declined </option>
                                        <option value="closed" {{$fdr->status=='closed'?'selected':''}} > Closed </option>

                                    </select>

                                </div>

                            </div>


                        </div>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="header">
                            <h2><strong>জামানতের   </strong> বর্ণনা </h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>সিরিয়াল </th>
                                    <th>সভ্য নং </th>
                                    <th> নাম/বিবরন   </th>
                                    <th> পলিসির টাকা   </th>
                                    <th> স্বাক্ষর</th>
                                    <th>যাচাইকারীর স্বাক্ষর</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($i=1;$i<=sizeof($loan->PersonDepositors);$i++)

                                    <input type="hidden" name="depository_id[]" value="{{$loan->PersonDepositors[$i]->id??0}}">

                                    <tr>
                                        <td>{{\App\NumberConverter::en2bn($i)}}</td>
                                        <td>
                                            <input type="text" class="form-control" name="depository_unique_id[]" value="{{$loan->PersonDepositors[$i]->unique_id??''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="depository_description[]" value="{{$loan->PersonDepositors[$i]->description??''}}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="depository_total_amount[]" value="{{$loan->PersonDepositors[$i]->policy_amount??''}}">
                                        </td>
                                        <td>
                                            <input type="file" class="form-control" name="depository_signature[]">
                                        </td>
                                        <td>
                                            <input type="file" class="form-control" name="depository_identifier_signature[]">
                                        </td>

                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <hr>

                        <div class="body">
                            <h4>সম্পদ জামানত (স্বর্ণালংকার)</h4>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>সিরিয়াল </th>
                                    <th>সভ্য নং </th>
                                    <th> নাম/বিবরন   </th>
                                    <th> পরিমান   </th>
                                    <th> প্রতি ভরীর মূল্য</th>
                                    <th> মোট  মূল্য</th>
                                    <th> স্বাক্ষর</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @for($i=1;$i<=sizeof($loan->OrnamentDepositors);$i++)

                                    <input type="hidden" name="o_id[]" value="{{$loan->OrnamentDepositors[$i]->id??0}}">

                                    <tr>
                                        <td>{{\App\NumberConverter::en2bn($i)}}</td>
                                        <td>
                                            <input type="text" class="form-control" name="o_depository_unique_id[]" value="{{$loan->OrnamentDepositors[$i]->unique_id??''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="o_depository_description[]" value="{{$loan->OrnamentDepositors[$i]->description??''}}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="o_depository_qty[]" value="{{$loan->OrnamentDepositors[$i]->qty??''}}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="o_depository_unit_price[]" value="{{$loan->OrnamentDepositors[$i]->unit_price??''}}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="o_depository_total_price[]" value="{{$loan->OrnamentDepositors[$i]->total_amount??''}}">
                                        </td>
                                        <td>
                                            <input type="file" class="form-control" name="depository_signature[]">
                                        </td>

                                    </tr>
                                    @endfor

                                </tbody>
                            </table>
                        </div>
                        <br>
                        <hr>

                        <div class="body">
                            <h4>সম্পদ জামানত (জমি/বাড়ী)</h4>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>সিরিয়াল </th>
                                    <th>অবস্থান  </th>
                                    <th> মৌজা</th>
                                    <th>দাগ নং </th>
                                    <th> খতিঃ নং</th>
                                    <th> হোল্ডিং নং</th>
                                    <th> বর্ণনা </th>
                                    <th> পরিমান </th>
                                    <th>মূল্য  </th>
                                    <th> স্বাক্ষর</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @for($i=1;$i<=sizeof($loan->PropertyDepositors);$i++)
                                    <input type="hidden" name="p_id[]" value="{{$loan->PropertyDepositors[$i]->id??0}}">

                                    <tr>
                                        <td>{{\App\NumberConverter::en2bn($i)}}</td>
                                        <td>
                                            <input type="text" class="form-control" name="p_position[]" value="{{$loan->PropertyDepositors[$i]->position??''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="p_mouja[]" value="{{$loan->PropertyDepositors[$i]->mouja??''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="p_dag[]" value="{{$loan->PropertyDepositors[$i]->dag??''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="p_khotiyan[]" value="{{$loan->PropertyDepositors[$i]->khotiyan??''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="p_holding[]" value="{{$loan->PropertyDepositors[$i]->holding??''}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="p_description[]" value="{{$loan->PropertyDepositors[$i]->description??''}}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="p_qty[]" value="{{$loan->PropertyDepositors[$i]->qty??''}}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="p_total_amount[]" value="{{$loan->PropertyDepositors[$i]->total_amount??''}}">
                                        </td>
                                        <td>
                                            <input type="file" class="form-control" name="p_signature[]">
                                        </td>

                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="body col-md-12 text-center">

                            <button type="submit" class="btn btn-info btn-round"> সেভ করুন</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <!--<div class="row clearfix">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="header">
                        <h2><strong>পূর্বের ঋণ সংক্রান্ত তথ্য </strong>  </h2>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>ঋণ গ্রহনের তারিখ </th>
                                <th> ঋণের পরিমান   </th>
                                <th> পরিশোধের তারিখ</th>
                                <th> সম্পূর্ণ পরিশোধ </th>
                                <th> পরিশোধের বাকী  </th>
                                <th> গ্রেড  </th>
                                <th> স্বাক্ষর</th>
                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>১</td>
                                    <td>
                                        <input type="date" class="form-control" name="ploan_date[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ploan_amount[]">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="ploan_paid_date[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ploan_full_paid[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ploan_due[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ploan_grade[]">
                                    </td>
                                    <td>
                                        <input type="file" class="form-control" name="ploan_signature[]">
                                    </td>

                                </tr>

                                <tr>
                                    <td>২</td>
                                    <td>
                                        <input type="date" class="form-control" name="ploan_date[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ploan_amount[]">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="ploan_paid_date[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ploan_full_paid[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ploan_due[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ploan_grade[]">
                                    </td>
                                    <td>
                                        <input type="file" class="form-control" name="ploan_signature[]">
                                    </td>

                                </tr>

                                <tr>
                                    <td>৩</td>
                                    <td>
                                        <input type="date" class="form-control" name="ploan_date[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ploan_amount[]">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="ploan_paid_date[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ploan_full_paid[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ploan_due[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ploan_grade[]">
                                    </td>
                                    <td>
                                        <input type="file" class="form-control" name="ploan_signature[]">
                                    </td>

                                </tr>

                                <tr>
                                    <td>৪</td>
                                    <td>
                                        <input type="date" class="form-control" name="ploan_date[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ploan_amount[]">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="ploan_paid_date[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ploan_full_paid[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ploan_due[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ploan_grade[]">
                                    </td>
                                    <td>
                                        <input type="file" class="form-control" name="ploan_signature[]">
                                    </td>

                                </tr>

                                <tr>
                                    <td>৫</td>
                                    <td>
                                        <input type="date" class="form-control" name="ploan_date[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ploan_amount[]">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="ploan_paid_date[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ploan_full_paid[]">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="ploan_due[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="ploan_grade[]">
                                    </td>
                                    <td>
                                        <input type="file" class="form-control" name="ploan_signature[]">
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </div>
        </div>-->


    </div>
</section>

<script src="{{asset('assets/plugins/dropzone/dropzone.js')}}"></script> <!-- Dropzone Plugin Js -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


<script>

    $(window).on('load', function() {

        getUser('{{$loan->user_id}}');

    });


    function getUser(user_id)
    {
        if (user_id==='no')
        {
            $('#unique_id').val('').removeAttr('readonly');
            $('#name').val('').removeAttr('readonly');
            $('#name_bn').val('').removeAttr('readonly');
            $('#father_name').val('').removeAttr('readonly');
            $('#mother_name').val('').removeAttr('readonly');
            $('#nominee_name').val('').removeAttr('readonly');
            $('#nominee_relation').val('').removeAttr('readonly');
            $('#present_address').val('').removeAttr('readonly');
            $('#permanent_address').val('').removeAttr('readonly');
            $('#phone').val('').removeAttr('readonly');
            $('#phone_2').val('').removeAttr('readonly');
            $('#comment').val('').removeAttr('readonly');
            $('#contact_address').val('').removeAttr('readonly');
        }else {

            $.ajax({
                type: "POST",
                url: "{{ route('getUser') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": user_id,
                },
                success: function (data) {
                    console.log(data);
                    $('#unique_id').val(data.unique_id).attr('readonly', 'true');
                    $('#name').val(data.name).attr('readonly', 'true');
                    $('#name_bn').val(data.name_bn).attr('readonly', 'true');
                    $('#father_name').val(data.father_name).attr('readonly', 'true');
                    $('#mother_name').val(data.mother_name).attr('readonly', 'true');
                    $('#nominee_name').val(data.nominee_name).attr('readonly', 'true');
                    $('#nominee_relation').val(data.nominee_relation).attr('readonly', 'true');
                    $('#present_address').val(data.present_address).attr('readonly', 'true');
                    $('#permanent_address').val(data.permanent_address).attr('readonly', 'true');
                    $('#phone').val(data.phone).attr('readonly', 'true');
                    $('#phone_2').val(data.phone_2).attr('readonly', 'true');
                    $('#comment').val(data.comment).attr('readonly', 'true');
                    $('#contact_address').val(data.contact_address).attr('readonly', 'true');


                    //Image section

                    $('#photo-img').attr('src', data.photo);
                    $('#photo-img').show();


                    $('#signature-img').attr('src', data.signature);
                    $('#signature-img').show();
                },

                error: function (error) {
                    console.log(error);
                },

            });
        }
    }
</script>

@endsection


@section('script')

@endsection
