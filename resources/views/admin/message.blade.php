

@extends('layouts.admin')

@section('style')
<style>

.message_container {
  background-color: rgb(255, 255, 255);
  border-radius: 5px;
  -webkit-box-shadow:0px 1px 4px 0px rgba(0, 0, 0, 0.09);
  -moz-box-shadow:0px 1px 4px 0px rgba(0, 0, 0, 0.09);
  box-shadow:0px 1px 4px 0px rgba(0, 0, 0, 0.09);
  margin: 0;
}
.inbox_user_list {
  background-color: #ffffff;
  border-right: 1px solid #eeeeee;
  display: inline-block;
  padding: 30px 30px 40px;
  width: 100%;
}
.inbox_user_list .wrap{
  position: relative;
}
.inbox_user_list .wrap img{
  border-radius: 50%;
  float: left;
  margin-right: 15px;
}
.inbox_user_list .wrap .meta h5.name{
  font-size: 16px;
  margin-bottom: 0;
}
.inbox_user_list .wrap .meta p.preview{
  color: #7f7f7f;
  font-size: 14px;
}
.inbox_user_list ul li {
	padding: 15px 0;
	list-style: none;
}
.inbox_user_list .iu_heading {
  padding-bottom: 45px;
}
.inbox_user_list ul li.contact .wrap .meta{
  display: inline-block;
  margin-top: 10px;
}
.iu_heading .candidate_revew_search_box input.form-control {
	width: 89%;
	margin-bottom: 0;
}
.iu_heading .candidate_revew_search_box .candidate_revew_search_box button{
  background-color: transparent;
}
.inbox_user_list ul li.contact .wrap span {
  background-color: #95a5a6;
  border: 1px solid #ffffff;
  border-radius: 50%;
  height: 13px;
  left: 50px;
  margin: 0px 0 0 1px;
  position: absolute;
  width: 13px;
}
.inbox_user_list ul li.contact .wrap span.online {
  background-color: #2ecc71;
}
.inbox_user_list ul li.contact .wrap span.away {
  background-color: #f1c40f;
}
.inbox_user_list ul li.contact .wrap span.busy {
  background-color: #e74c3c;
}
.inbox_user_list ul li.contact .wrap img {
  border-radius: 50%;
  float: left;
  margin-right: 10px;
  width: 60px;
}
.message_container .inbox_chatting_box {
  background-color: #ffffff;
  position: relative;
  max-height: 575px !important;
  height: auto;
  margin-right: 10px;
  max-height: calc(100% - 93px);
  overflow-y: scroll;
  overflow-x: hidden;
}
.message_container .inbox_chatting_box::-webkit-scrollbar {
  background: transparent;
  border-radius: 3px;
  padding-right: 10px;
  width: 8px;
}
.message_container .inbox_chatting_box::-webkit-scrollbar-thumb {
  background-color: #ededed;
  border-radius: 3px;
}
.message_container .user_heading {
	background-color: #ffffff;
	padding: 20px 0;
	position: relative;
}
.message_container .user_heading:before{
  background-color: #eeeeee;
  content: "";
  height: 1px;
  left: -50%;
  position: absolute;
  top: 107px;
  width: 463px;
}
.inbox_chatting_box .chatting_content {
	display: inline-block;
	padding: 30px 30px 0 30px;
	position: relative;
	width: 100%;
	list-style: none;
}
.message_container .user_heading .wrap img {
  float: left;
  margin-right: 10px;
  border-radius: 50%;
}
.message_container .user_heading .wrap h5.name {
  font-size: 16px;
  color: rgb(10, 10, 10);
  line-height: 1.2;
  margin-bottom: 0;
}
.message_container .user_heading .wrap p.preview {
  font-size: 15px;
  color: rgb(127, 127, 127);
  line-height: 1.867;
  margin-bottom: 0;
}
.message_container .last_seen_time {
  background-color: #ffffff;
  padding: 35px 0 0;
}
.message_container .last_seen_time a{
  font-size: 17px;
  font-family: "Open Sans";
  color: rgb(127, 127, 127);
  line-height: 1.647;
  margin-bottom: 0;
}
.inbox_chatting_box .chatting_content li {
  padding: 20px 0;
  margin-bottom: 0;
}
.inbox_chatting_box .chatting_content li.media.sent {
  float: left;
  clear: both;
}
.inbox_chatting_box .chatting_content li.media img{
  border-radius: 50px;
  margin-bottom: 10px;
}
.inbox_chatting_box .chatting_content li.media .media-body {
  display: block;
}
.inbox_chatting_box .chatting_content li.media span {
  background-color: #95a5a6;
  border: 1px solid #ffffff;
  border-radius: 50%;
  height: 13px;
  left: 80px;
  margin: 2px 0 0 -2px;
  position: absolute;
  width: 13px;
}
.inbox_chatting_box .chatting_content li.media span.busy {
  background-color: #e74c3c;
}
.inbox_chatting_box .chatting_content li.media .media-body .date_time{
  font-size: 14px;
}
.inbox_chatting_box .chatting_content li.media .media-body p{
  background-color: #2441e7;
  border: 1px solid #ffffff;
  border-radius: 5px;
  color: #ffffff;
  font-size: 14px;
  font-family: "Open Sans";
  color: rgb(255, 255, 255);
  margin-bottom: 0;
  padding: 10px 15px;
  max-width: 265px;
}
.inbox_chatting_box .chatting_content li.media.reply {
  float: right;
  clear: both;
}
.inbox_chatting_box .chatting_content li.media.reply.first {
  margin: -100px 0 0;
}
.inbox_chatting_box .chatting_content li.media.reply .media-body p {
  border-radius: 5px;
  background-color: #f3f3f3;
  color: #7f7f7f;
  max-width: 320px;
  padding: 10px 15px;
}
.message_container .message_input {
	background-color: #f9fafc;
	left: 30px;
	right: 30px;
	text-align: center;
	bottom: -70px;
	width: 99%;
    margin: 10px 5px;
}
.message_container .message_input form input.form-control {
  background-color: #f1f1f1;
  border-color: transparent;
  border-radius: 5px;
  height: 40px;
  width: 100%;
  padding-left: 30px;
}
.message_container .message_input form input.form-control:focus {
  box-shadow: none;
  outline: none;
}
.message_container .message_input form button.btn {
  border: 1px solid #ffffff;
  border-radius: 5px;
  color: #ffffff;
  font-size: 16px;
  flex: 1;
  position: absolute;
  right: 20px;
}
.message_container .message_input form button.btn:focus {
  box-shadow: none;
  outline: none;
}
.message_container .message_input form button.btn span {
  font-size: 20px;
  padding-left: 10px;
}
.candidate_revew_search_box form {
	display: flex;
	flex-flow: row;
	align-items: center;
	position: relative;
}
.candidate_revew_search_box form button {
	padding: 7px 11px;
	position: absolute;
	right: 0;
	top: 50%;
	transform: translateY(-50%);
	border-radius: 10px;
}

</style>

@endsection
@section('content')
	<!-- Left sidebar menu end -->

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			{{-- <div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Messages</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>Messages</li>
				</ul>
            </div> --}}
             <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">বার্তা</h1>

                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> {{\App\Setting::setting()->app_name}}</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">বার্তা</a></li>
                </ul>
            </div>
			<div class="row message_container">
                <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 pr0 pl0">
                    <div class="inbox_user_list">
                        <div class="iu_heading">
                            <div class="candidate_revew_search_box">
                                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" type="search" name="q" value="{{$_GET['q']??''}}" placeholder="অনুসন্ধান করুন" aria-label="Search">
                                    <button class="btn btn-primary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <ul>
                            @php
                                $recordUsers  = array();
                            @endphp
                            @if (isset($_GET['q']) && $_GET['q'])
                                @foreach ($users??array() as $user)
                                    <li class="contact" data-id="{{$user->id??0}}" >
                                        <a href="?receiver_id={{$user->id}}">
                                            <div class="wrap">
                                                <span class="contact-status online"></span>
                                                <img class="img-fluid" src="{{url($user->photo??'')}}" onerror="this.src='/front/images/no_img_avaliable.jpg';" alt="s1.jpg">
                                                <div class="meta">
                                                    <h5 class="name">{{$user->name??''}}</h5>
                                                    <p class="preview">{{$user->roles->first()->name??'-'}}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                @endforeach

                            @else
                                @foreach($messagedUsers??array() as $messegeInfo)
                                    @if($messegeInfo->sender_id==\Illuminate\Support\Facades\Auth::id() && $messegeInfo->receiver)
                                        @if(in_array($messegeInfo->receiver_id,$recordUsers))
                                            @continue
                                        @endif
                                        <li class="contact" data-id="{{$messegeInfo->receiver_id??0}}" >
                                        <a href="?receiver_id={{$messegeInfo->receiver_id}}">
                                                <div class="wrap">
                                                    <span class="contact-status online"></span>
                                                    <img class="img-fluid" src="{{url($messegeInfo->receiver->photo??'')}}" onerror="this.src='/front/images/no_img_avaliable.jpg';" alt="s1.jpg">
                                                    <div class="meta">
                                                        <h5 class="name">{{$messegeInfo->receiver->name??''}}</h5>
                                                        <p class="preview">{{$messegeInfo->receiver->roles->first()->name??'-'}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        @php
                                            array_push($recordUsers,$messegeInfo->receiver_id);
                                        @endphp
                                    @elseif($messegeInfo->receiver)
                                        @if(in_array($messegeInfo->sender_id,$recordUsers))
                                            @continue
                                        @endif
                                        <li class="contact" data-id="{{$messegeInfo->sender_id??0}}" >
                                            <a href="?receiver_id={{$messegeInfo->sender_id}}">
                                                <div class="wrap">
                                                    <span class="contact-status online"></span>
                                                    <img class="img-fluid"  src="{{url($messegeInfo->sender->photo??'')}}" onerror="this.src='/front/images/no_img_avaliable.jpg';" alt="s2.jpg">
                                                    <div class="meta">
                                                        <h5 class="name">{{$messegeInfo->sender->name??''}}</h5>
                                                        <p class="preview">{{$messegeInfo->sender->roles->first()->name??'-'}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        @php
                                            array_push($recordUsers,$messegeInfo->sender_id);
                                        @endphp
                                    @endif
                                @endforeach



                            @endif


                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-7 col-xl-8 pr0 pl0">
                    @if ($receiver)

                        <div class="user_heading">
                            <a href="#">
                                <div class="wrap">
                                    <span class="contact-status online"></span>
                                    <img class="img-fluid" src="{{url($receiver->photo??'')}}"  onerror="this.src='/front/images/no_img_avaliable.jpg';" style="height: 50px !important" alt="s5.jpg">
                                    <div class="meta">
                                        <h5 class="name">{{$receiver->name}}</h5>
                                        <!--<p class="preview">was online today at 11:43</p>-->
                                    </div>
                                </div>
                            </a>
                        </div>

                    @else

                        <div class="chat-header clearfix">

                        </div>
                        <div class="chat-history text-center align-center" style="height: 40vh;">

                            <div class=" align-middle " style="position: relative; top: 20%;">
                                <h1 class="text-primary"><strong class="font-accent"><i class="material-icons" style="font-size: 80px">message</i></strong></h1>
                                <h3 class="text-primary"><strong class="font-accent">একটি কথোপকথন নির্বাচন করুন</strong></h3>
                                <p class="text-info">কোন কথোপকথন নির্বাচন করার বা নির্দিষ্ট কারো সন্ধানের চেষ্টা করুন.</p>
                            </div>
                        </div>
                    @endif
                    <!--<div class="last_seen_time text-center">
                        <a href="#">November 5, 2018</a>
                    </div>-->
                    <div class="inbox_chatting_box chat-history">
                        <ul class="chatting_content">
                            @foreach($chat_history as $chat)
                                @if($chat->sender_id==\Illuminate\Support\Facades\Auth::id())


                                    <span class="chat-id" style="display:none">{{$chat->id??0}}</span>
                                    <li class="media reply">
                                        <div class="media-body text-right">
                                            <div class="date_time">{{$chat->created_at}}</div>
                                            <p>{{$chat->message}}</p>
                                        </div>
                                    </li>

                                @else

                                    <span class="chat-id" style="display:none">{{$chat->id??0}}</span>
                                    <li class="media sent">
                                        <span class="contact-status busy"></span>
                                        <img class="img-fluid align-self-start mr-3" style="height: 65px !important" src="{{url($chat->sender->photo??'')}}"  onerror="this.src='/front/images/no_img_avaliable.jpg';" alt="s6.jpg">
                                        <div class="media-body">
                                            <div class="date_time">{{$chat->created_at}}</div>
                                            <p>{{$chat->message}}</p>
                                        </div>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                    <div class="message_input">
                        <form class="form-inline" id="send-form">
                            <input type="hidden" name="receiver_id" value="{{$_GET['receiver_id']??0}}">
                            <input class="form-control" type="message" id="message" placeholder="এখানে টেক্সট লিখুন..." aria-label="Search" name="message">
                            <button class="btn btn-primary btn-round" type="submit">Send <span class="flaticon-paper-plane"></span></button>
                        </form>
                    </div>
                </div>
            </div>
		</div>
	</main>
@endsection

@section('script')




<script>
    function MessegeBoxScrollDown(){

        var wtf    = $('.chat-history');
        var height = wtf[0].scrollHeight;
        wtf.scrollTop(height);
    }
    $(document).ready(function (e) {
        MessegeBoxScrollDown();
    })
</script>



<script>
    let receiver_id='{{$request->receiver_id??0}}';
    let last_fetched_id=0;
    var FetchMessage = function() {
        last_fetched_id= $('.chat-id:last').text();
        if (receiver_id){
            $.ajax({
                type: "GET",
                url: "{{ route('FetchChatMessage') }}",
                dataType: "json",
                data: {
                    "last_fetched_id": last_fetched_id,
                    "receiver_id": receiver_id,
                },
                success:function(data) {
                    jQuery.each(data, function(index, conversation) {
                        let conv='';
                        if (conversation.sender_id=='{{\Illuminate\Support\Facades\Auth::id()}}'){
                            conv = '<li class="clearfix">\n' +
                                '                                        <span class="chat-id" style="display:none">'+conversation.id+'</span>\n' +
                                '<li class="media reply">\n' +
                                    ' <div class="media-body text-right">\n' +
                                            '<div class="date_time">'+conversation.created_at+'</div>\n' +
                                            '<p>'+conversation.message+'</p>\n' +
                                        '</div>\n' +
                                    '</li>';
                        }else{
                            conv = '<li>\n' +
                                '                                        <span class="chat-id" style="display:none">'+conversation.id+'</span>\n' +
                                '<li class="media sent">\n' +
                                '<span class="contact-status busy"></span>'+
                                    ' <img class="img-fluid align-self-start mr-3" style="height: 65px !important" src="/'+conversation.sender.photo+'"  onerror="this.src=\'/front/images/no_img_avaliable.jpg\';" alt="s6.jpg">'+
                                    ' <div class="media-body">\n' +
                                            '<div class="date_time">'+conversation.created_at+'</div>\n' +
                                            '<p>'+conversation.message+'</p>\n' +
                                        '</div>\n' +
                                    '</li>';
                        }
                        $('.chat-history ul').append(conv);


                    });
                    MessegeBoxScrollDown();
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    };
    setInterval(FetchMessage, 3000);
</script>


<script>
    $('#send-form').on('submit',function (event) {
        event.preventDefault();

        $.ajax({
            method: "GET",
            data: $(this).serialize(),
            contentType: false,
            cache: false,
            processData: false,
            url: "{{ route('SubmitChatMessage') }}",
            success:function(data) {
                $('#message').val('').text('');
            },

            error: function (error) {
                console.log(error);
            },

        });


    });
</script>

@endsection
