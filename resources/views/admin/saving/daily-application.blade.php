@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Main Content -->

<!-- Dropzone Css -->
<link rel="stylesheet" href="{{asset('assets/plugins/dropzone/dropzone.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/timeline.css')}}">

<section class="content profile-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12"></div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item active">সঞ্চয় অধিভুক্তির ফর্ম </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
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
        <div class="col-md-12">
            <div class="card shadow">

                <div class="header">

                    <h2><strong> বাক্তিগত</strong>  তথ্য</h2>

                </div>

                <div class="body">
                    <form method="POST" action="{{route('SavingDailyApplication')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="type" value="{{$type}}">
                        <div class="row clearfix">

                            <div class="col-lg-8 col-md-8 col-sm-12">

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

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> পরিচয় প্রদান কারী(পরিচালক সভ্য)</small></label>

                                    <select name="identifier_id" id="identifier_id" class="form-control z-index show-tick selectpicker"  data-live-search="true">
                                        <option value="">বাছাই করুন</option>
                                        @foreach($members??array() as $member)
                                            <option value="{{$member->id}}">{{$member->name}} - {{$member->unique_id}} </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> দৈনিক সঞ্চয়ের পরিমান </small></label>

                                    <input type="number" step="any" class="form-control" placeholder="দৈনিক সঞ্চয়ের পরিমান " name="installment_amount" value="{{old('installment_amount')}}" id="date">
                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> সময়কাল (মাস) </small></label>

                                    <input type="number" step="any" class="form-control" placeholder="সময়কাল (মাস) " name="duration" value="{{old('duration')}}" id="date">
                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>তারিখ </small></label>

                                    <input type="date" class="form-control" placeholder="তারিখ " name="date" value="{{old('date')}}" id="date">

                                </div>

                            </div>

                            <!--<div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>পলিসির পরিমান </small></label>

                                    <input type="text" class="form-control" placeholder="পলিসির পরিমান " name="amount" value="{{old('amount')}}" id="amount">

                                </div>

                            </div>-->


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> হিসাব নাম্বার/সভ্য নাম্বার (ফাকা রাখলে স্বয়ংক্রিয় ভাবে তৈরি হবে)</small></label>

                                    <input type="text" class="form-control" placeholder="হিসাব নাম্বার/সভ্য নাম্বার" name="unique_id" value="{{old('unique_id')}}" id="unique_id">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> নাম</small></label>

                                    <input type="text" class="form-control" placeholder="নাম" name="name_bn" value="{{old('name_bn')}}" id="name_bn">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> নাম (ইংরেজীতে)</small></label>

                                    <input type="text" class="form-control" placeholder="নাম (ইংরেজীতে)" name="name" value="{{old('name')}}" id="name">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> পিতার/স্বামীর নাম</small></label>

                                    <input type="text" class="form-control" placeholder="পিতার/স্বামীর নাম" name="father_name" value="{{old('father_name')}}" id="father_name">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  মাতার নাম</small></label>

                                    <input type="text" class="form-control" placeholder="মাতার নাম" name="mother_name" value="{{old('mother_name')}}" id="mother_name">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> নমিনি</small></label>

                                    <input type="text" class="form-control" placeholder="নমিনি" name="nominee_name" value="{{old('nominee_name')}}" id="nominee_name">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> সম্পর্ক</small></label>

                                    <input type="text" class="form-control" placeholder="সম্পর্ক" name="nominee_relation" value="{{old('nominee_relation')}}" id="nominee_relation">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>নমিনির ছবি</small></label>

                                    <input type="file" class="form-control" placeholder="ছবি" name="nominee_photo">

                                </div>

                            </div>



                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> নমিনির স্বাক্ষর</small></label>

                                    <input type="file" class="form-control" placeholder="স্বাক্ষর" name="nominee_signature">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  জাতীয়তা</small></label>

                                    <select name="nationality" id="" class="form-control ms">
                                        <option value="Bangladeshi">Bangladeshi</option>
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>   বর্তমান ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="বর্তমান ঠিকানা" name="present_address" value="{{old('present_address')}}" id="present_address">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>   স্থায়ী ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="স্থায়ী ঠিকানা" name="permanent_address" value="{{old('permanent_address')}}" id="permanent_address">

                                </div>

                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> মোবাইল নং </small></label>

                                    <input type="text" class="form-control" placeholder="মোবাইল নং" name="phone" value="{{old('phone')}}" id="phone">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  টেলিফোন </small></label>

                                    <input type="text" class="form-control" placeholder="টেলিফোন" name="phone_2" value="{{old('phone_2')}}" id="phone_2">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small>  বিশেষ নির্দেশনা যদি থাকে </small></label>

                                    <input type="text" class="form-control" placeholder="বিশেষ নির্দেশনা যদি থাকে" name="comment" value="{{old('comment')}}" id="comment">

                                </div>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> যোগাযোগের ঠিকানা </small></label>

                                    <input type="text" class="form-control" placeholder="যোগাযোগের ঠিকানা" name="contact_address" value="{{old('contact_address')}}" id="contact_address">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> ডকুমেন্ট</small></label>

                                    <input type="file" class="form-control" placeholder="ডকুমেন্ট" name="document" >


                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> ছবি</small></label>

                                    <input type="file" class="form-control" placeholder="ছবি" name="photo" id="photo" onchange="photoURL(this)">
                                    <div class="col-md-12" style="display: block;">
                                        <img src="" id="photo-img" onerror="this.onerror=null; this.src='{{asset('/front/images/no_img_avaliable.jpg')}}';" style="width: 50%;height: 80px;display: none">
                                    </div>

                                </div>

                            </div>



                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">

                                    <label for=""><small> স্বাক্ষর</small></label>

                                    <input type="file" class="form-control" placeholder="স্বাক্ষর" name="signature" id="signature" onchange="signatureURL(this);">
                                    <div class="col-md-12" style="display: block;">
                                        <img src="" id="signature-img" onerror="this.onerror=null; this.src='{{asset('/front/images/no_img_avaliable.jpg')}}';" style="width: 50%;height: 80px;display: none">
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">

                                    <button type="submit" class="btn btn-info btn-round"> সেভ করুন</button>
                                </div>


                            </div>


                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
</section>

<script src="{{asset('assets/plugins/dropzone/dropzone.js')}}"></script> <!-- Dropzone Plugin Js -->
<script>

    function getUser(user_id)
    {
        if (user_id==='no')
        {
            $('#unique_id').val('').removeAttr('readonly');
            $('#name').val('').removeAttr('readonly');
            $('#name_bn').val('').removeAttr('readonly');
            $('#father_name').val('').removeAttr('readonly');
            $('#mother_name').val('').removeAttr('readonly');
            $('#nominee_name').val('').removeAttr('readonly');
            $('#nominee_relation').val('').removeAttr('readonly');
            $('#present_address').val('').removeAttr('readonly');
            $('#permanent_address').val('').removeAttr('readonly');
            $('#phone').val('').removeAttr('readonly');
            $('#phone_2').val('').removeAttr('readonly');
            $('#comment').val('').removeAttr('readonly');
            $('#contact_address').val('').removeAttr('readonly');
        }else {

            $.ajax({
                type: "POST",
                url: "{{ route('getUser') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": user_id,
                },
                success: function (data) {
                    console.log(data);
                    $('#unique_id').val(data.unique_id).attr('readonly', 'true');
                    $('#name').val(data.name).attr('readonly', 'true');
                    $('#name_bn').val(data.name_bn).attr('readonly', 'true');
                    $('#father_name').val(data.father_name).attr('readonly', 'true');
                    $('#mother_name').val(data.mother_name).attr('readonly', 'true');
                    $('#nominee_name').val(data.nominee_name).attr('readonly', 'true');
                    $('#nominee_relation').val(data.nominee_relation).attr('readonly', 'true');
                    $('#present_address').val(data.present_address).attr('readonly', 'true');
                    $('#permanent_address').val(data.permanent_address).attr('readonly', 'true');
                    $('#phone').val(data.phone).attr('readonly', 'true');
                    $('#phone_2').val(data.phone_2).attr('readonly', 'true');
                    $('#comment').val(data.comment).attr('readonly', 'true');
                    $('#contact_address').val(data.contact_address).attr('readonly', 'true');


                    //Image section

                    $('#photo-img').attr('src', data.photo);
                    $('#photo-img').show();


                    $('#signature-img').attr('src', data.signature);
                    $('#signature-img').show();
                },

                error: function (error) {
                    console.log(error);
                },

            });
        }
    }



    //Image Preview
    function photoURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#photo-img').attr('src', e.target.result);
                $('#photo-img').show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    function signatureURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#signature-img').attr('src', e.target.result);
                $('#signature-img').show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

@endsection


@section('script')

@endsection
