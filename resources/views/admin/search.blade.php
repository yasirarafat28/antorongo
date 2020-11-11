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
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">খুঁজুন</h1>

            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">খুঁজুন</a></li>
            </ul>
        </div>
        <div class="row clearfix">


            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card shadow">

                    <div class="header">

                        <h2><strong>খুঁজুন</strong><small></small> </h2>

                        <ul class="header-dropdown">

                            <li class="remove">

                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>

                            </li>

                        </ul>

                    </div>

                    <div class="body members_profiles">



                        <form method="GET" action="/search">

                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">

                                    <div class="form-group">

                                        <input type="text" class="form-control" placeholder="ফোন/হ িসাব নাম্বার/ বারকোড " name="q" value="{{$query}}">

                                    </div>

                                </div>





                                <div class="col-lg-6 col-md-12">

                                    <button class="btn btn-primary btn-round">খুঁজুন</button>

                                </div>

                            </div>



                        </form>



                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

@endsection


@section('script')

@endsection

