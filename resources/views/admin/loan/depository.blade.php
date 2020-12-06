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

    <div class="container-fluid">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h3><strong>ঋণ খুঁজুন</strong><small></small> </h3>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">ঋণ খুঁজুন</a></li>
                    </ul>
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
                            @foreach($loan->PersonDepositors as $item)

                                <tr>
                                    <td>{{\App\NumberConverter::en2bn($loop->iteration)}}</td>
                                    <td>{{$item->unique_id}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{\App\NumberConverter::en2bn($item->policy_amount)}} </td>
                                    <td><img src="{{url($item->signature??'')}}" style="height: 40px;width: auto;"  onerror="this.onerror=null;this.src='{{asset('/front/images/no_img_avaliable.jpg')}}';"></td>
                                    <td><img src="{{url($item->identifier_signature??'')}}"  style="height: 40px;width: auto;"  onerror="this.onerror=null;this.src='{{asset('/front/images/no_img_avaliable.jpg')}}';"></td>


                                </tr>
                            @endforeach
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
                            @foreach($loan->OrnamentDepositors as $item)

                                <tr>
                                    <td>{{\App\NumberConverter::en2bn($loop->iteration)}}</td>
                                    <td>{{$item->unique_id}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->unit_price}}</td>
                                    <td>{{$item->total_amount}}</td>
                                    <td><img src="{{url($item->signature??'')}}" style="height: 40px;width: auto;"  onerror="this.onerror=null;this.src='{{asset('/front/images/no_img_avaliable.jpg')}}';"></td>
                                </tr>
                            @endforeach

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
                            @foreach($loan->PropertyDepositors as $item)

                                <tr>
                                    <td>{{\App\NumberConverter::en2bn($loop->iteration)}}</td>
                                    <td>{{$item->position}}</td>
                                    <td>{{$item->mouja}}</td>
                                    <td>{{$item->dag}}</td>
                                    <td>{{$item->khotiyan}}</td>
                                    <td>{{$item->holding}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->total_amount}}</td>
                                    <td><img src="{{url($item->signature??'')}}" style="height: 40px;width: auto;"  onerror="this.onerror=null;this.src='{{asset('/front/images/no_img_avaliable.jpg')}}';"></td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection


@section('script')

@endsection

