@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>

</style>

<!-- Main Content -->
<section class="content">

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">সদস্য খুঁজুন</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">সদস্য খুঁজুন</a></li>
            </ul>
        </div>
        <div class="row clearfix">


            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card shadow">

                    <div class="header">

                        <h2><strong>সদস্য খুঁজুন</strong><small></small> </h2>

                        <ul class="header-dropdown">

                            <li class="remove">

                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>

                            </li>

                        </ul>

                    </div>

                    <div class="body members_profiles">



                        <form method="GET">

                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">

                                    <div class="form-group">

                                        <input type="text" class="form-control" placeholder="ফোন/হ িসাব নাম্বার/ বারকোড " name="q" value="{{$query}}">

                                    </div>

                                </div>





                                <div class="col-lg-3 col-md-12">

                                    <button class="btn btn-primary btn-round">খুঁজুন</button>

                                </div>


                            </div>



                        </form>



                    </div>

                </div>

            </div>

        </div>

        @if($member)

            <div id="printable">

                <div class="row clearfix">

                    <div class="col-md-12">

                        <div class="card profile-header">

                            <div class="body">

                                <div class="row">

                                    <div class="col-lg-4 col-md-4 col-12">

                                        <div class="profile-image float-md-right"> <img src="{{url($member->photo??'')}}" style="height:  150px;" onerror="this.onerror=null;this.src='/front/images/no_img_avaliable.jpg';"> </div>

                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">

                                        <h4 class="m-t-0 m-b-0"><strong>{{$member->name_bn}}</strong></h4>
                                        <br>
                                        <p>বর্তমান ঠিকানা: {{$member->present_address}}</p>
                                        <p> ফোন: {{$member->phone}}</p>
                                        <p>সদস্য নং: {{$member->unique_id}}</p>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row clearfix">
                    <div class="col-md-4">
                        <div class="card shadow">

                            <div class="header">

                                <h2><strong>বাক্তিগত </strong> তথ্য</h2>

                            </div>

                            <div class="body">

                                <small class="text-muted">নাম: </small>

                                <p>{{$member->name_bn}}</p>

                                <hr>


                                <small class="text-muted">নাম (ইংরেজীতে): </small>

                                <p>{{$member->name}}</p>

                                <hr>

                                <small class="text-muted">পিতার নাম: </small>

                                <p>{{$member->father_name}}</p>

                                <hr>

                                <small class="text-muted">মাতার নাম: </small>

                                <p>{{$member->mother_name}}</p>

                                <hr>


                                <small class="text-muted"> ফোন : </small>

                                <p>{{$member->phone_2}}</p>

                                <hr>

                                <small class="text-muted"> মোবাইল : </small>

                                <p>{{$member->phone}}</p>

                                <hr>

                                <small class="text-muted">জন্মদিন: </small>

                                <p class="m-b-0">{{$member->dob}}</p>

                                <hr>

                                <small class="text-muted"> হিসাবের ধরন : </small>

                                <p>
                                    @if($member->account_type=='individual')
                                        একক
                                    @elseif($member->account_type=='joint')
                                        একক
                                    @elseif($member->account_type=='individual_ownership')
                                        একক মালিকানা
                                    @endif
                                </p>

                                <hr>

                                <small class="text-muted"> প্রকল্প : </small>

                                <p>

                                    @if($member->project=='saving_project')
                                        সঞ্চয়ী প্রকল্প
                                    @elseif($member->project=='current')
                                        চলতি  প্রকল্প
                                    @elseif($member->project=='saving')
                                        সঞ্চয়ী
                                    @elseif($member->project=='short_term')
                                        সল্প মেয়াদী
                                    @elseif($member->project=='long_term')
                                        দীর্ঘ মেয়াদী
                                    @endif
                                </p>

                                <hr>


                            </div>



                        </div>

                    </div>

                    <div class="col-md-4">



                        <div class="card shadow">

                            <div class="header">

                                <h2><strong> অন্যান্য  </strong> তথ্য</h2>

                            </div>

                            <div class="body">

                                <small class="text-muted">সদস্য আইডি: </small>

                                <p>{{$member->unique_id}}</p>

                                <hr>

                                <small class="text-muted"> বর্তমান ঠিকানা : </small>

                                <p>{{$member->present_address}}</p>


                                <hr>

                                <small class="text-muted"> স্থায়ী ঠিকানা : </small>

                                <p>{{$member->permanent_address}}</p>


                                <hr>

                                <small class="text-muted"> যোগাযোগের ঠিকানা : </small>

                                <p>{{$member->contact_address}}</p>


                                <hr>

                                <small class="text-muted"> পেশা ও এর ধরন : </small>

                                <p>{{$member->occupation}}</p>


                                <hr>

                                <small class="text-muted"> পেশাগত প্রতিষ্ঠানের পূর্ণ ঠিকানা : </small>

                                <p>{{$member->company_name}}</p>


                                <hr>

                                <small class="text-muted">ভোটার পরিচয় নং: </small>

                                <p>{{$member->nid}}</p>

                                <hr>

                                <small class="text-muted">জাতীয়তা: </small>

                                <p>{{$member->nationality}}</p>

                                <hr>

                                <small class="text-muted"> একাউন্ট তৈরির তারিখ: </small>

                                <p class="m-b-0">{{$member->created_at}}</p>



                            </div>

                        </div>



                    </div>

                    <div class="col-md-4">



                        <div class="card shadow">

                            <div class="header">

                                <h2><strong>নমিনেশন বাক্তির</strong> তথ্য</h2>

                            </div>

                            <div class="body">



                                <small class="text-muted">নাম: </small>

                                <p>{{$member->nominee_name}}</p>

                                <hr>
                                <small class="text-muted">পিতার নাম: </small>

                                <p>{{$member->nominee_father_name}}</p>

                                <hr>
                                <small class="text-muted">বর্তমান ঠিকানা: </small>

                                <p>{{$member->nominee_present_address}}</p>

                                <hr>
                                <small class="text-muted">স্থায়ী ঠিকানা: </small>

                                <p>{{$member->nominee_permanent_address}}</p>

                                <hr>
                                <small class="text-muted">অংশ: </small>

                                <p>{{$member->nominee_share}}</p>

                                <hr>

                                <small class="text-muted"> ফোন: </small>

                                <p>{{$member->nominee_phone??''}}</p>

                                <hr>

                                <small class="text-muted"> সম্পর্ক : </small>

                                <p>{{$member->nominee_relation}}</p>

                                <hr>

                                <small class="text-muted"> বয়স : </small>

                                <p>{{$member->nominee_age}}</p>

                                <hr>

                            </div>

                        </div>



                    </div>

                </div>
            </div>

            @if(sizeof($loan_records))

                <!-- Exportable Table -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="header">
                                <h2><strong>ঋণের   </strong> তালিকা </h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                                    <thead>
                                    <tr>
                                        <th>ক্রিয়াকলাপ</th>
                                        <th>ঋণ আইডি </th>
                                        <th>পুরাতন ঋণ আইডি </th>
                                        <th> সদস্য আইডি  </th>
                                        <th> সদস্য নাম  </th>
                                        <th> ঋণের পরিমান  </th>
                                        <th> মোট পরিশোধ</th>
                                        <th> মোট বকেয়া</th>
                                        <th> তারিখ </th>
                                        <th>  অবস্থা</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $loan_records?? array() as $item)
                                    <tr>
                                        <td>

                                            <a href="{{url('admin/loan/find?q='.$item->unique_id)}}" class="btn btn-primary"><i class="fa fa-eye"> </i> </a>

                                        </td>                                    <td>{{$item->unique_id}}</td>
                                        <td>{{$item->old_txn}}</td>
                                        <td>{{$item->user->unique_id??''}}</td>
                                        <td>{{$item->user->name_bn??''}}</td>
                                        <td>
                                            @if($item->status=='active')
                                                {{\App\NumberConverter::en2bn($item->approved_amount)}}
                                            @else
                                                {{\App\NumberConverter::en2bn($item->request_amount)}}
                                            @endif
                                        </td>
                                        <td>{{\App\NumberConverter::en2bn($item->interests->sum('amount')   +   $item->paid_reveanues->sum('amount'))}}</td>
                                        <td>{{\App\NumberConverter::en2bn($item->current_payable())}}</td>
                                        <td>{{date('Y/m/d',strtotime($item->start_at))}}</td>
                                        <td>{{$item->status}}</td>

                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Exportable Table -->
            @endif
            @if(sizeof($saving_records))
            <!-- Exportable Table -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="header">
                                <h2><strong> সঞ্চয় </strong> তালিকা </h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                                    <thead>
                                    <tr>
                                        <th>সিরিয়াল </th>
                                        <th>সঞ্চয় আইডি </th>
                                        <th> সদস্য নাম  </th>
                                        @if($type='daily')
                                            <th> দৈনিক সঞ্চয়ের পরিমান  </th>
                                            <th> সময়কাল (মাস)  </th>
                                        @else
                                            <th> পলিসির পরিমান  </th>
                                            <th> মোট লাভ</th>
                                            <th> মোট ফেরত</th>
                                        @endif
                                        <th>  অবস্থা</th>
                                        <th>  তারিখ</th>
                                        <th> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($saving_records ?? array() as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->txn_id}}</td>
                                            <td>{{$item->user->name_bn??""}}</td>
                                            @if($type='daily')
                                                <td>{{\App\NumberConverter::en2bn($item->installment_amount)}} টাকা </td>
                                                <td>{{\App\NumberConverter::en2bn($item->duration)}} মাস </td>
                                            @else
                                                <td>{{\App\NumberConverter::en2bn($item->target_amount)}}</td>
                                                <td>{{\App\NumberConverter::en2bn($item->return_amount-$item->target_amount)}}</td>
                                                <td>{{\App\NumberConverter::en2bn($item->return_amount)}}</td>
                                            @endif
                                            <td>{{ucfirst($item->status)}}</td>
                                            <td>{{$item->started_at}}</td>
                                            <td>
                                                <a href="{{url('admin/saving/find?id='.$item->id)}}" class="btn  btn-primary"><i class="zmdi zmdi-eye"> </i> বিস্তারিত </a>
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
            @endif
            @if(sizeof($FDR_records))


            <!-- Exportable Table -->
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="header">
                                <h2><strong>এফ ডি আর  </strong> তালিকা </h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover dataTable js-plaintable">
                                    <thead>
                                    <tr>
                                        <th>ক্রিয়াকলাপ</th>
                                        <th>সভ্য আইডি </th>
                                        <th>এফ ডি আর আইডি </th>
                                        <th>পুরাতন  এফ ডি আর আইডি </th>
                                        <th> সদস্য নাম  </th>
                                        <th> পরিমান  </th>
                                        <th> সময়কাল (মাস)  </th>
                                        <th> লাভের হার</th>

                                        <th> প্রাপ্ত লাভ  </th>
                                        <th>  অবস্থা</th>
                                        <th>  তারিখ</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($FDR_records ?? array() as $item)
                                        <tr>
                                            <td style="width: 12%">
                                                <a href="/admin/fdr/find?q={{$item->txn_id}}"><i class="fa fa-eye"></i></a>

                                            </td>
                                            <td>{{$item->user->unique_id??''}}</td>
                                            <td>{{$item->txn_id}}</td>
                                            <td>{{$item->old_txn}}</td>
                                            <td>{{$item->user->name_bn??''}}</td>
                                            <td>{{\App\NumberConverter::en2bn($item->deposits->sum('amount'))}} টাকা  </td>
                                            <td>{{\App\NumberConverter::en2bn($item->duration)}} মাস </td>
                                            <td>{{\App\NumberConverter::en2bn($item->interest_rate)}} % </td>
                                            <td>{{\App\NumberConverter::en2bn($item->profits->sum('amount'))}} টাকা  </td>
                                            <td>{{ucfirst($item->status)}}</td>
                                            <td>{{$item->started_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Exportable Table -->
            @endif
        @endif
    </div>
</section>

@endsection


@section('script')

@endsection

