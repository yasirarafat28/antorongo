@extends('layouts.admin')
@section('style')

@endsection
@section('content')

<section class="content">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ড্যাশবোর্ড</h1>

        </div>

        <!-- Content Row -->
        <div class="row col-md-12">
            <h6 class="m-0 mb-3 font-weight-bold text-primary col-md-12">স্বল্প মেয়াদী সঞ্চয়</h6>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    স্বল্প মেয়াদী সঞ্চয়
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($short_saving_transactions)}} টাকা</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{\App\NumberConverter::en2bn($short_savings->count())}} জন</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    স্বল্প মেয়াদী বর্তমান সঞ্চয়</div>

                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($short_active_saving_transactions)}} টাকা</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($short_active_count)}}</div>


                                <a href="/admin/saving/short/list?filterBy=approved" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    অনিষ্পাদিত স্বল্প মেয়াদী সঞ্চয়</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($short_pending_count)}}</div>
                                <a href="/admin/saving/short/list?filterBy=pending" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    স্বল্প মেয়াদী সঞ্চয় প্রত্যাহার</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($short_closed_count)}}</div>
                                <a href="/admin/saving/short/list?filterBy=closed" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <!-- Earnings (Monthly) Card Example -->
            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    মোট সদস্য সংখ্যা</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{\App\User::where('role','member')->count()}} টি </div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    ৫ বছর মেয়াদী সঞ্চয়
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($short_saving_transactions)}} টাকা</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{\App\NumberConverter::en2bn($short_savings->count())}} জন</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Pending Requests Card Example -->
            {{-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    ১০ বছর মেয়াদী সঞ্চয়
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($long_saving_transactions)}} টাকা</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{\App\NumberConverter::en2bn($long_savings->count())}} জন</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row col-md-12">
            <h6 class="m-0 mb-3 font-weight-bold text-primary col-md-12">দীর্ঘ মেয়াদী সঞ্চয়</h6>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    দীর্ঘ মেয়াদী সঞ্চয়
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($long_saving_transactions)}} টাকা</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{\App\NumberConverter::en2bn($long_savings->count())}} জন</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    দীর্ঘ মেয়াদী বর্তমান সঞ্চয়</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($long_active_count)}}</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($long_active_saving_transactions)}} টাকা</div>

                                <a href="/admin/saving/long/list?filterBy=approved" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    অনিষ্পাদিত দীর্ঘ মেয়াদী সঞ্চয়</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($long_pending_count)}}</div>
                                <a href="/admin/saving/long/list?filterBy=pending" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    দীর্ঘ মেয়াদী সঞ্চয় প্রত্যাহার</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($long_closed_count)}}</div>
                                <a href="/admin/saving/long/list?filterBy=closed" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->

        </div>
        <div class="row col-md-12">
            <h6 class="m-0 mb-3 font-weight-bold text-primary col-md-12">দৈনিক সঞ্চয়</h6>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    দৈনিক সঞ্চয়
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($daily_saving_transactions)}} টাকা</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{\App\NumberConverter::en2bn($daily_savings->count())}} জন</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    দৈনিক বর্তমান সঞ্চয়</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($daily_active_count)}}</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($daily_active_saving_transactions)}} টাকা</div>


                                <a href="/admin/saving/daily/list?filterBy=approved" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    অনিষ্পাদিত দৈনিক সঞ্চয়</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($daily_pending_count)}}</div>
                                <a href="/admin/saving/daily/list?filterBy=pending" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    দৈনিক সঞ্চয় প্রত্যাহার</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($daily_closed_count)}}</div>
                                <a href="/admin/saving/daily/list?filterBy=closed" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->

        </div>
        <div class="row col-md-12">
            <h6 class="m-0 mb-3 font-weight-bold text-primary col-md-12">সাধারণ সঞ্চয়(সেভিংস )</h6>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    সাধারণ সঞ্চয়
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($current_saving_transactions)}} টাকা</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{\App\NumberConverter::en2bn($current_savings->count())}} জন</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    বর্তমান সাধারণ সঞ্চয়</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($current_active_count)}}</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($current_active_saving_transactions)}} টাকা</div>

                                <a href="/admin/saving/current/list?filterBy=approved" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    অনিষ্পাদিত সাধারণ সঞ্চয়</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($current_pending_count)}}</div>
                                <a href="/admin/saving/current/list?filterBy=pending" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    সাধারণ সঞ্চয় প্রত্যাহার</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($current_closed_count)}}</div>
                                <a href="/admin/saving/current/list?filterBy=closed" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->

        </div>
        <div class="row col-md-12">
            <h6 class="m-0 mb-3 font-weight-bold text-primary col-md-12">এফ ডি আর ম্যানেজমেন্ট</h6>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    এফ ডি আর
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($fdr_transactions)}} টাকা</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{\App\NumberConverter::en2bn($fdr_list->count())}} জন</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    বর্তমান  এফ ডি আর</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($fdr_active_count)}}</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($fdr_active_transactions)}} টাকা</div>


                                <a href="/admin/fdr/list?filterBy=approved" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    অনিষ্পাদিত এফ ডি আর</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($fdr_pending_count)}}</div>
                                <a href="/admin/loan/fdr?filterBy=pending" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    এফ ডি আর প্রত্যাহার</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($fdr_closed_count)}}</div>
                                <a href="/admin/fdr/list?filterBy=closed" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-md-12">
            <h6 class="m-0 mb-3 font-weight-bold text-primary col-md-12">ঋণ ম্যানেজমেন্ট</h6>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    মোট ঋণ</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($loan->sum('approved_amount'))}} টাকা</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{\App\NumberConverter::en2bn($loan->count())}} জন</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    বর্তমান  ঋণ</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($active_count)}}</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{\App\NumberConverter::en2bn($loan_active_transactions)}} টাকা</div>
                                <a href="/admin/loan/list?filterBy=active" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    অনিষ্পাদিত ঋণ</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($pending_count)}}</div>
                                <a href="/admin/loan/list?filterBy=pending" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    ঋণ প্রত্যাহার</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{App\NumberConverter::en2bn($closed_count)}}</div>
                                <a href="/admin/loan/list?filterBy=closed" class="text-link">তালিকা দেখুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    লাভ</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800"> ৳ {{App\NumberConverter::en2bn($loan_active_interest_total,2)}} টাকা </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    লাভ বকেয়া</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn($loan_interest_added_total - $loan_active_interest_total - $loan_profit_waiver_total,2)}} টাকা</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    আসল আদায়</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn($loan_reveanue_paid_total,2)}} টাকা</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    আসল বকেয়া</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800"> ৳ {{App\NumberConverter::en2bn($loan_active_transactions + $loan_reveanue_add_total - $loan_reveanue_paid_total , 2)}} টাকা</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    সম্পদ জামানত (স্বর্ণালংকার)</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800"> ৳ {{App\NumberConverter::en2bn($total_person_depository, 2)}} টাকা</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <br>
        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">আয় ব্যয় গ্রাফ</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="dashboardAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">আয় ব্যয়</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> আয়
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> ব্যয়
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card shadow">
                    <div class="header">
                        <h2><strong>সর্বশেষ লেনদেন</strong></h2>
                        <ul class="header-dropdown">
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive members_profiles">
                        <table class="table table-bordered table-striped table-hover ">
                            <thead>
                            <tr>
                                <th>সিরিয়াল </th>
                                <th>কোড   </th>
                                <th>খাত  </th>
                                <th>লেনদেনের ধরন   </th>
                                <th> টাকার পরিমান  </th>
                                <th>  তারিখ</th>
                                <th>  অবস্থা</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Transaction::with('head')->limit(20)->get() ?? array() as $item)
                                <tr>
                                    <td>{{\App\NumberConverter::en2bn($loop->iteration)}}</td>

                                    <td>{{$item->txn_id}}</td>
                                    <td>{{$item->head->name??''}}</td>
                                    <td>
                                        @if($item->type=='income')
                                            আয়
                                        @else
                                            ব্যয়
                                        @endif
                                    </td>
                                    <td>{{\App\NumberConverter::en2bn($item->amount)}}</td>
                                    <td>{{\App\NumberConverter::en2bn(date("d-m-Y",strtotime($item->date)))}}</td>
                                    <td>{{ucfirst($item->status)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('script')

<script>


    // Area Chart Example
    var ctx = document.getElementById("dashboardAreaChart");
    var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            @foreach($monthly_data??array() as $row)
            "{{App\BanglaMonth::monthName($row->month)}}, {{App\NumberConverter::en2bn($row->year)}}",
            @endforeach
        ],
        datasets: [
            {
                label: "আয়",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [
                    @foreach($monthly_data??array() as $row)
                    {{$row->income}},
                    @endforeach
                ],
            },
            {
                label: "ব্যয়",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "#1cc88a",
                pointRadius: 3,
                pointBackgroundColor: "#1cc88a",
                pointBorderColor: "#1cc88a",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [
                    @foreach($monthly_data??array() as $row)
                        {{$row->expense}},
                    @endforeach
                ],
            }
        ],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
        padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
        }
        },
        scales: {
        xAxes: [{
            time: {
            unit: 'date'
            },
            gridLines: {
            display: false,
            drawBorder: false
            },
            ticks: {
            maxTicksLimit: 7
            }
        }],
        yAxes: [{
            ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
                return '৳' + number_format(value);
            }
            },
            gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
            }
        }],
        },
        legend: {
        display: false
        },
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
            label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ৳ ' + number_format(tooltipItem.yLabel) + ' টাকা ';
            }
        }
        }
    }
    });


    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["আয়", "ব্যয়"],
        datasets: [{
        data: [{{$pie_chart_data->income??0}}, {{$pie_chart_data->expense??0}}],
        backgroundColor: ['#4e73df', '#1cc88a'],
        hoverBackgroundColor: ['#2e59d9', '#17a673'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        },
        legend: {
        display: false
        },
        cutoutPercentage: 80,
    },
    });
</script>

@endsection
