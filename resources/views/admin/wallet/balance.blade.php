@extends('layouts.admin')
@section('style')

@endsection
@section('content')

<section class="content">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ব্যালেন্স

            </h1>
        </div>

        <!-- Content Row -->
        <div class="row col-md-12">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <h3>অফিস ব্যালেন্স</h3>
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn($office)}}</div>

                                <a href="/admin/balance/transfer/office" class="text-link">ট্রান্সফার করুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    <h3>ক্যাশিয়ারের ব্যালেন্স</h3>
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn($cashier)}}</div>
                                <a href="/admin/balance/transfer/cashier" class="text-link">ট্রান্সফার করুন</a>
                                <a href="/admin/balance/transactions/cashier" class="text-link">ট্রান্সফার করুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    <h3>ব্যাংক ব্যালেন্স</h3>

                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">৳ {{App\NumberConverter::en2bn($bank)}}</div>
                                <a href="/admin/balance/transfer/bank" class="text-link">ট্রান্সফার করুন</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>

@endsection


@section('script')


@endsection
