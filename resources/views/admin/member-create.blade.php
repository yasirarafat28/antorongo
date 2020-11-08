@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Main Content -->


<section class="content profile-page">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ul class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                <li class="breadcrumb-item active">সদস্য যোগ করুন</li>
            </ul>
        </div>

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
        <form action="{{url('admin/members')}}" method="POST"  enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-md-12">
                <div class="card shadow">

                    <div class="header">

                        <h2><strong> বাক্তিগত</strong>  তথ্য</h2>

                    </div>

                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> হিসাবের ধরন</small></label>

                                    <select name="account_type" id="" class="form-control ms">
                                        <option value="individual">একক</option>
                                        <option value="joint">যৌথ </option>
                                        <option value="individual_ownership"> একক মালিকানা</option>
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> প্রকল্প</small></label>

                                    <select name="project" id="" class="form-control ms">
                                        <option value="saving_project"> সঞ্চয়ী প্রকল্প </option>
                                        <option value="current"> চলতি  প্রকল্প </option>
                                        <option value="saving"> সঞ্চয়ী </option>
                                        <option value="short_term"> সল্প মেয়াদী(৫ বছর মেয়াদী) </option>
                                        <option value="long_term"> দীর্ঘ মেয়াদী(১০ বছর মেয়াদী) </option>ে
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> হিসাব নাম্বার (ফাকা রাখলে স্বয়ংক্রিয় ভাবে তৈরি হবে)</small></label>

                                    <input type="text" class="form-control" placeholder="হিসাব নাম্বার" name="unique_id" value="{{old('unique_id')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> নাম</small></label>

                                    <input type="text" class="form-control" placeholder="নাম" name="name_bn" value="{{old('name_bn')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> নাম (ইংরেজীতে)</small></label>

                                    <input type="text" class="form-control" placeholder="নাম (ইংরেজীতে)" name="name" value="{{old('name')}}">

                                </div>

                            </div>



                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> মালিক/ অংশীদার/ যৌথ মালিকানার নাম</small></label>

                                    <input type="text" class="form-control" placeholder="মালিক/ অংশীদার/ যৌথ মালিকানার নাম" name="share_holder_name" value="{{old('share_holder_name')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> পিতার/ স্বামীর নাম</small></label>

                                    <input type="text" class="form-control" placeholder="পিতার/ স্বামীর নাম" name="father_name" value="{{old('father_name')}}">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  মাতার নাম</small></label>

                                    <input type="text" class="form-control" placeholder="মাতার নাম" name="mother_name" value="{{old('mother_name')}}">

                                </div>

                            </div>



                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="input-group">

                                        <span class="input-group-addon">

                                            <i class="zmdi zmdi-calendar"></i>

                                        </span>

                                    <!--<input type="text" class="form-control datetimepicker" name="dob" value="" placeholder=" জন্মতারিখ" data-dtp="dtp_EPzkD" value="{{old('dob')}}">-->
                                    <input type="date" class="form-control" name="dob" placeholder=" জন্মতারিখ"  value="{{old('dob')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  জাতীয়তা</small></label>

                                    <input type="text" class="form-control" placeholder="জাতীয়তা" name="nationality" value="{{old('nationality')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  ভোটার পরিচয় নং</small></label>

                                    <input type="text" class="form-control" placeholder="ভোটার পরিচয় নং" name="nid" value="{{old('nid')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  পেশা ও এর ধরন </small></label>

                                    <input type="text" class="form-control" placeholder="পেশা ও এর ধরন" name="occupation" value="{{old('occupation')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  পেশাগত প্রতিষ্ঠানের পূর্ণ ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="পেশাগত প্রতিষ্ঠানের পূর্ণ ঠিকানা" name="company_name" value="{{old('company_name')}}">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>   বর্তমান ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="বর্তমান ঠিকানা" name="present_address" value="{{old('present_address')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>   স্থায়ী ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="স্থায়ী ঠিকানা" name="permanent_address" value="{{old('permanent_address')}}">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> মোবাইল নং </small></label>

                                    <input type="text" class="form-control" placeholder="মোবাইল নং" name="phone" value="{{old('phone')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  টেলিফোন </small></label>

                                    <input type="text" class="form-control" placeholder="টেলিফোন" name="phone_2" value="{{old('phone_2')}}">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  বিশেষ নির্দেশনা যদি থাকে </small></label>

                                    <input type="text" class="form-control" placeholder="বিশেষ নির্দেশনা যদি থাকে" name="comment" value="{{old('comment')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> যোগাযোগের ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="যোগাযোগের ঠিকানা" name="contact_address" value="{{old('contact_address')}}">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> ছবি</small></label>

                                    <input type="file" class="form-control" placeholder="ছবি" name="photo">

                                </div>

                            </div>



                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> স্বাক্ষর</small></label>

                                    <input type="file" class="form-control" placeholder="স্বাক্ষর" name="signature">

                                </div>

                            </div>


                        </div>

                    </div>

                </div>


                <div class="card shadow">

                    <div class="header">

                        <h2><strong> নমিনেশন</strong> ফরম</h2>

                    </div>

                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> নাম</small></label>

                                    <input type="text" class="form-control" placeholder="নাম" name="nominee_name" value="{{old('nominee_name')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> পিতার নাম</small></label>

                                    <input type="text" class="form-control" placeholder="পিতার নাম" name="nominee_father_name" value="{{old('nominee_father_name')}}">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>   বর্তমান ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="বর্তমান ঠিকানা" name="nominee_present_address" value="{{old('nominee_present_address')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>   স্থায়ী ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="স্থায়ী ঠিকানা" name="nominee_permanent_address" value="{{old('nominee_permanent_address')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>   অংশ </small></label>

                                    <input type="text" class="form-control" placeholder="অংশ" name="nominee_share" value="{{old('nominee_share')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> সম্পর্ক</small></label>

                                    <input type="text" class="form-control" placeholder="সম্পর্ক" name="nominee_relation" value="{{old('nominee_relation')}}">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> বয়স</small></label>

                                    <input type="text" class="form-control" placeholder="বয়স" name="nominee_age" value="{{old('name')}}">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> ছবি</small></label>

                                    <input type="file" class="form-control" placeholder="ছবি" name="nominee_photo">

                                </div>

                            </div>



                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> স্বাক্ষর</small></label>

                                    <input type="file" class="form-control" placeholder="স্বাক্ষর" name="nominee_signature">

                                </div>

                            </div>



                            <div class="col-md-12">

                                <button class="btn btn-primary btn-round"> সেভ করুন</button>

                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </form>


    </div>
</section>

<script src="{{asset('assets/plugins/dropzone/dropzone.js')}}"></script> <!-- Dropzone Plugin Js -->

@endsection


@section('script')

@endsection
