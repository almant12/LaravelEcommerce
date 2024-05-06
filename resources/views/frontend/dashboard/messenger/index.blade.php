@extends('frontend.dashboard.layouts.master')

@section('title')
    {{$settings->site_name}} || Chat
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-10 col-xxl-10 col-lg-10 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <div class="wsus__dashboard_review">
                            <div class="row">
                                <div class="col-xl-4 col-md-5">
                                    <div class="wsus__chatlist d-flex align-items-start">
                                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                             aria-orientation="vertical">
                                            <h2>Seller List</h2>
                                            <div class="wsus__chatlist_body">
                                                @foreach($chatUsers as $user)
                                                    <button class="nav-link chat-user-profile"
                                                            data-id="{{$user->receiverProfile->id}}"
                                                            id="v-pills-home-tab"
                                                            data-bs-toggle="pill"
                                                            data-bs-target="#v-pills-home"
                                                            type="button" role="tab" aria-controls="v-pills-home"
                                                            aria-selected="true">
                                                        @php
                                                        $unseenMessages = \App\Models\Chat::where(['receiver_id'=>auth()->user()->id,
                                                        'sender_id'=>$user->receiverProfile->id,'seen'=>0])->exists();
                                                        @endphp

                                                        <div class="wsus_chat_list_img {{$unseenMessages ? 'msg-notification' : ''}} ">
                                                            <img src="{{asset($user->receiverProfile->image)}}" alt="user" class="img-fluid">
                                                            <span>5</span>
                                                        </div>
                                                        <div class="wsus_chat_list_text">
                                                            <h4>{{$user->receiverProfile->name}} {{$user->receiverProfile->lastname}}</h4>
                                                            <span class="status active">online</span>
                                                        </div>
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-md-7">
                                    <div class="wsus__chat_main_area">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <div class="wsus__chat_area" style="position: relative;height: 113vh;">
                                                    <div class="wsus__chat_area_header">
                                                        <h2 id="chat-inbox-title"></h2>
                                                    </div>
                                                    <div class="wsus__chat_area_body">
                                                    </div>
                                                    <div class="wsus__chat_area_footer" style="margin-top: 50px;position: absolute;width: 100%; bottom: 0;">
                                                        <form id="message-form">
                                                            <input type="text" placeholder="Type Message"
                                                                   class="message-box" autocomplete="off" name="message">
                                                            <input type="hidden" id="receiver_id" name="receiver_id" value="">
                                                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const mainChatInbox = $('.wsus__chat_area_body');

        function formatDateTime(dateTimeString) {
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            }
            const formatedDateTime = new Intl.DateTimeFormat('en-Us', options).format(new Date(dateTimeString));
            return formatedDateTime;
        }

        function scrollTobottom() {
            mainChatInbox.scrollTop(mainChatInbox.prop("scrollHeight"));
        }

        $(document).ready(function (){
            $('.chat-user-profile').on('click',function (){
                let receiverId = $(this).data('id');
                let receiverImage = $(this).find('img').attr('src');
                let chatUserName = $(this).find('h4').text()
                mainChatInbox.attr('data-inbox',receiverId);
                $(this).find('.wsus_chat_list_img').removeClass('msg-notification');
                $('#receiver_id').val(receiverId);

                $.ajax({
                    method: 'GET',
                    url: '{{route('user.get-messages')}}',
                    data: {
                        receiverId:receiverId
                    },
                    beforeSend: function (){
                        mainChatInbox.html('')
                        $('#chat-inbox-title').text(`Chat with ${chatUserName}`)
                    },success: function (response){
                        $.each(response,function (index,value){
                            if(value.sender_id == USER.id) {
                                var message = `<div class="wsus__chat_single single_chat_2">
                                        <div class="wsus__chat_single_img">
                                            <img src="${USER.image}"
                                                alt="user" class="img-fluid">
                                        </div>
                                        <div class="wsus__chat_single_text">
                                            <p>${value.message}</p>
                                            <span>${formatDateTime(value.created_at)}</span>
                                        </div>
                                    </div>`
                            }else {
                                var message = `<div class="wsus__chat_single">
                                        <div class="wsus__chat_single_img">
                                            <img src="${receiverImage}"
                                                alt="user" class="img-fluid">
                                        </div>
                                        <div class="wsus__chat_single_text">
                                            <p>${value.message}</p>
                                            <span>${formatDateTime(value.created_at)}</span>
                                        </div>
                                    </div>`
                            }
                            mainChatInbox.append(message);
                        })

                        scrollTobottom();
                    }
                })
            })

            $('#message-form').on('submit',function (e){
                e.preventDefault()
                let formData = $(this).serialize();
                let messageData = $('.message-box').val();

                var formSubmitting = false;

                if(formSubmitting || messageData === "" ) {
                    return;
                }
                // set message in inbox
                let message = `
                <div class="wsus__chat_single single_chat_2">
                    <div class="wsus__chat_single_img">
                        <img src="${USER.image}"
                            alt="user" class="img-fluid">
                    </div>
                    <div class="wsus__chat_single_text">
                        <p>${messageData}</p>
                        <span>${formatDateTime(new Date())}</span>
                    </div>
                </div>
                `
                mainChatInbox.append(message);
                $('.message-box').val('');
                scrollTobottom();

                $.ajax({
                    method: 'POST',
                    url: '{{route('user.send-message')}}',
                    data:formData,
                    beforeSend: function (){
                        $('.send-button').prop('disable',true);
                        formSubmitting = true
                    },
                    success: function (){

                    },error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                        $('.send-button').prop('disabled', false);
                        formSubmitting = false;
                    },
                    complete: function() {
                        $('.send-button').prop('disabled', false);
                        formSubmitting = false;
                    }
                })
            })
        })
    </script>
@endpush
