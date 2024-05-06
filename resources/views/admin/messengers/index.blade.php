@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Chat Box</h1>
{{--            <div class="section-header-breadcrumb">--}}
{{--                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>--}}
{{--                <div class="breadcrumb-item"><a href="#">Components</a></div>--}}
{{--                <div class="breadcrumb-item">Chat Box</div>--}}
{{--            </div>--}}
        </div>

        <div class="section-body">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-3">
                    <div class="card"  style="height: 70vh;">
                        <div class="card-header">
                            <h4>Users List</h4>
                        </div>
                        <div class="card-body">
                            @foreach($chatUsers as $user)
                                <ul class="list-unstyled list-unstyled-border">
                                    <li class="media chat-user-profile" data-id="{{$user->senderProfile->id}}">
                                        @php
                                        $unseenMessages = \App\Models\Chat::where(['receiver_id'=>auth()->user()->id,
                                        'sender_id'=>$user->senderProfile->id,'seen'=>0])->exists()
                                        @endphp
                                        <img alt="image" class="mr-3 rounded-circle {{$unseenMessages ? 'msg-notification' : ''}}" width="50" src="{{asset($user->senderProfile->image)}}">
                                        <div class="media-body">
                                            <div class="mt-0 mb-1 font-weight-bold chat-user-name">{{$user->senderProfile->name}} {{$user->senderProfile->lastname}}</div>
                                            <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Online</div>
                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card chat-box" id="mychatbox"  style="height: 70vh;">
                        <div class="card-header">
                            <h4 class="chat-with"></h4>
                        </div>
                        <div class="card-body chat-content">
                        </div>
                        <div class="card-footer chat-form">
                            <form id="message-form">
                                <input type="text" class="form-control message-box" placeholder="Type a message" name="message">
                                <input type="hidden" name="receiver_id"
                                       value="" id="receiver_id">
                                <button class="btn btn-primary send-button" type="submit">
                                    <i class="far fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>

        const mainChatInbox = $('.chat-content');

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
            $('.chat-user-profile').on('click',function (e){
                e.preventDefault();
                let receiverId = $(this).data('id')
                let receiverImage = $(this).find('img').attr('src')
                let chatUsername = $(this).find('.chat-user-name').text()
                mainChatInbox.attr('data-inbox',receiverId);
                $(this).find('.rounded-circle').removeClass('msg-notification');
                $('#receiver_id').val(receiverId);

                $.ajax({
                    method: 'GET',
                    url: '{{route('admin.get-messages')}}',
                    data: {
                        receiverId
                    },beforeSend: function (){
                        mainChatInbox.html('')
                        $('.chat-with').text(`Chat With ${chatUsername}`)
                    },success: function (response){
                        $.each(response,function (index,value){

                            if (value.sender_id == USER.id){
                                var message = `
                            <div class="chat-item chat-right">
                                <img style="height: 50px;
                                 object-fit: cover;" src="${USER.image}">
                                <div class="chat-details">
                                    <div class="chat-text">${value.message}</div>
                                    <div class="chat-time">${formatDateTime(value.created_at)}</div>
                                </div>
                            </div>
                                `
                            }else {
                                var message = `
                            <div class="chat-item chat-left">
                                <img style="height: 50px;
                                 object-fit: cover;" src="${receiverImage}">
                                <div class="chat-details">
                                    <div class="chat-text">${value.message}</div>
                                    <div class="chat-time">${formatDateTime(value.created_at)}</div>
                                </div>
                            </div>
                                `
                            }
                            mainChatInbox.append(message);
                        })

                        scrollTobottom();
                    }
                })
            })
            $('#message-form').on('submit',function (e){
                e.preventDefault();
                let formData = $(this).serialize();
                let messageData = $('.message-box').val();

                var formSubmitting = false;
                if (formSubmitting || messageData === ''){
                    return;
                }
                var message = `
                            <div class="chat-item chat-right">
                                <img style="height: 50px;
                                 object-fit: cover;" src="${USER.image}">
                                <div class="chat-details">
                                    <div class="chat-text">${messageData}</div>
                                    <div class="chat-time">${formatDateTime(new Date())}</div>
                                </div>
                            </div>
                                `
                mainChatInbox.append(message);
                $('.message-box').val('');
                scrollTobottom();

                $.ajax({
                    method: 'POST',
                    url: '{{route('admin.send-message')}}',
                    data:formData,
                    beforeSend: function (){
                        $('.send-button').prop('disabled',true);
                        formSubmitting = true
                    },success: function (){

                    },error:function (xhr, status, error){
                        toastr.error(xhr.responseJSON.message)
                        $('.send-button').prop('disabled',false)
                        formSubmitting = false
                    },complete:function (){
                        $('.send-button').prop('disabled',false)
                        formSubmitting = false
                    }
                })

            })
        })

    </script>
@endpush




