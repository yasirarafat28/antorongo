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
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">সঞ্চয় খুঁজুন</a></li>
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
        <div class="row">
            <div class="col-md-6 offset-3 card shadow">

                <div class=""><div class="header">

                    <h2><strong>ব্যালেন্স ট্রান্সফার </strong>  করুন</h2>

                </div>

                <form action="{{route('transfer_submit')}}" class="body" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                    {{csrf_field()}}

                    <input type="hidden" name="from" value="{{$from}}">

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for=""><small> অন্য একটি ব্যালেন্স বাছাই করুন </small></label>
                            <select name="to" class="form-control ms">
                                <option value="">বাছাই করুন </option>
                                @if ($from=='office')
                                    <option value="cashier">ক্যাশিয়ারের ব্যালেন্স</option>
                                    <option value="bank">ব্যাংক ব্যালেন্স</option>
                                @elseif ($from=='cashier')
                                    <option value="office">অফিস ব্যালেন্স</option>
                                    <option value="bank">ব্যাংক ব্যালেন্স</option>
                                @elseif ($from=='bank')
                                    <option value="cashier">ক্যাশিয়ারের ব্যালেন্স</option>
                                    <option value="office">অফিস ব্যালেন্স</option>

                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">

                        <div class="form-group">

                            <label for=""><small> টাকার পরিমান </small></label>

                            <input type="number" step="any" class="form-control" name="amount" placeholder="টাকার পরিমান">

                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12">

                        <div class="form-group">

                            <label for=""><small> তারিখ </small></label>

                            <input type="date" class="form-control" name="date" placeholder="তারিখ">

                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12">

                        <div class="form-group">

                            <label for=""><small> নোট/বিস্তারিত </small></label>

                            <textarea name="note" class="form-control" placeholder="নোট/বিস্তারিত"></textarea>

                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <input id="remember_me_2" name="invoice" type="checkbox">
                                <label for="remember_me_2">
                                     রশিদ চান ?
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-3">
                        <button class="btn btn-primary btn-round"> সেভ করুন</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</section>

@endsection


@section('script')

@endsection

