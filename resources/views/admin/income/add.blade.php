@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<style>

</style>

<!-- Main Content -->
<section class="content">

    <div class="container-fluid">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h3><small><strong> আয় যোগ </strong>  করুন</small></h3>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">আয় যোগ করুন</a></li>
                    </ul>
                </div>
            </div>
        </div>
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
            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="card shadow">


                    <hr>
                    <div class="col-md-12 row mb-3">


                        <div class="col-lg-10 col-md-10 col-sm-12 offset-1">

                            <div class="header">

                                <h2><strong> আয় যোগ </strong>  করুন</h2>

                            </div>
                            <form action="{{url('admin/income')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                {{csrf_field()}}

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">

                                        <label for=""><small> সদস্য বাছাই করুন</small></label>

                                        <select name="user_id" id="user_id" onchange="getUser(this.value)" class="form-control z-index show-tick selectpicker"  data-live-search="true">
                                            <option value="no">সদস্য বাছাই করুন</option>
                                            @foreach($members??array() as $member)
                                                <option value="{{$member->id}}">{{$member->name}} - {{$member->unique_id}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> আয়ের খাত বাছাই করুন </small></label>
                                        <select name="head_id" class="form-control ms">
                                            <option value="0">বাছাই করুন </option>

                                            @foreach($parents??array() as $parent)
                                                @if(sizeof($parent->transactable_childs))
                                                    <optgroup label="{{$parent->name}}">
                                                        @foreach($parent->transactable_childs??array() as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach

                                                    </optgroup>
                                                @else
                                                    <option value="{{$parent->id}}">{{$parent->name}}</option>
                                                @endif

                                            @endforeach
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

                                        <input type="date" class="form-control" name="date" placeholder="উত্তলনের তারিখ">

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
                                                টাকা জমার রশিদ
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">

                                    <button class="btn btn-primary btn-round"> সেভ করুন</button>

                                </div>
                            </form>

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

