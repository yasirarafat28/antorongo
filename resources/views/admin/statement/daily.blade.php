@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>

</style>

<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">ঋণের তথ্য খুঁজুন</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card action_bar shadow">
                    <div class="body">

                        <form action="">

                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4">

                                    <label for=""><small>থেকে</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datepicker" value="{{$_GET['from'] ?? ''}}" name="from" placeholder="থেকে তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">

                                    <label for=""><small> পর্যন্ত</small></label>

                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="zmdi zmdi-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control datepicker" value="{{$_GET['to'] ?? ''}}" name="to" placeholder=" পর্যন্ত তারিখ বাছাই করুন...">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-2">

                                    <br>

                                    <div class="input-group">
                                        <button class="btn btn-primary btn-round">খুঁজুন</button>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 text-right">
                                    <button type="button" class="btn btn-neutral hidden-sm-down" onclick="$('.buttons-csv')[0].click();">
                                        <i class="zmdi zmdi-archive"></i>
                                    </button>
                                    <button type="button" class="btn btn-neutral hidden-sm-down" onclick="$('.buttons-print')[0].click();">
                                        <i class="zmdi zmdi-print"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="row clearfix">

            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card shadow">

                    <div class="header">

                        <h2><strong> পরিশোধ এর </strong>  রেকর্ড</h2>

                        <ul class="header-dropdown">

                            <li class="remove">

                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>

                            </li>

                        </ul>

                    </div>

                    <div class="body table-responsive members_profiles">

                        <table class="table table-hover">

                            <thead>

                            <tr>

                                <th>সিরিয়াল</th>

                                <th> লোণ আইডি </th>
                                <th> মেম্বার আইডি </th>
                                <th> মেম্বার নাম </th>
                                <th> কোড </th>
                                <th> প্রতিনিধি </th>

                                <th>পরিমান</th>

                                <th> অবস্থা</th>

                                <th> পরিশোধের সময়</th>

                            </tr>

                            </thead>

                            <tfoot>

                            <tr>

                                <th>সিরিয়াল</th>

                                <th> লোণ আইডি </th>
                                <th> মেম্বার আইডি </th>
                                <th> মেম্বার নাম </th>
                                <th> কোড </th>
                                <th> প্রতিনিধি </th>

                                <th>পরিমান</th>

                                <th> অবস্থা</th>

                                <th> পরিশোধের সময়</th>

                            </tr>

                            </tfoot>

                            <tbody>


                            <tr>

                                <td>১</td>

                                <td>১২৫৬৮৫২</td>
                                <td>১২৫৬৮৫২</td>
                                <td>  সেলিম খান</td>
                                <td>১২৫৬৮৫২</td>
                                <td> ইয়াসির আরাফাত</td>

                                <td style="color: green;font-weight: 700;">




                                    +




                                    ৫০০০০ টাকা

                                </td>


                                <td>নিশ্চিত </td>

                                <td>2019-04-27 20:25:02</td>

                            </tr>








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

@endsection

