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

var audio = new Audio('http://codeskulptor-demos.commondatastorage.googleapis.com/GalaxyInvaders/alien_shoot.wav');

window.Echo.private('message.'+ USER.id).listen(
    'MessageEvent',
    (e)=>{
        console.log(e)
        let mainChatBox = $('.chat-content')
        if (mainChatBox.attr('data-inbox') == e.sender_id){
            var message = `
                            <div class="chat-item chat-left">
                                <img style="height: 50px;
                                 object-fit: cover;" src="${e.sender_image}">
                                <div class="chat-details">
                                    <div class="chat-text">${e.message.replace(/\n/g, '<br>')}
                                    <div class="chat-time">${formatDateTime(e.date_time)}</div>
                                </div>
                            </div>
                                `
        }
        mainChatBox.append(message);
        scrollTobottom();

        audio.play();


        $('.chat-user-profile').each(function() {
            let profileUserId = $(this).data('id');
            if(profileUserId == e.sender_id) {
                $(this).find('img').addClass('msg-notification');
            }
        });
    }
)
