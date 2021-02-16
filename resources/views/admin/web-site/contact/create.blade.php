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
                    <h3><small><strong> যোগাযোগ যোগ</strong> করুন</small></h3>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">যোগাযোগ যোগ করুন</a></li>
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

                    <div class="col-md-12 row mb-3">

                        <div class="header">
                            <div class="clearfix">
                                <div class="float-left">
                                    <h2><strong>যোগাযোগ যোগ </strong>করুন</h2>
                                </div>
                                <div class="float-right">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 offset-1">

                            <form action="{{url('admin/contacts')}}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                                {{csrf_field()}}

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small>ইমেল</small></label>
                                        <input type="email" placeholder="ইমেল" name="gmail" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small>ফোনঃ</small></label>
                                        <input type="text" placeholder="ফোন" name="phone_no" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small> মোবাইলঃ</small></label>
                                        <input type="text" placeholder="মোবাইল" name="mobile_no" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small>ঠিকানা</small></label>
                                        <textarea name="address" id="" placeholder="ঠিকানা" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for=""><small>অবস্থা</small></label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="active">Active</option>
                                            <option value="inctive">Inctive</option>
                                        </select>
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
<script src="/admin/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
<script src="/admin/js/forms/editors.js"></script>


{{-- <script>
    $(document).ready(function(){
        $( 'textarea.ckeditor' ).ckeditor();
    });
</script> --}}

@endsection

