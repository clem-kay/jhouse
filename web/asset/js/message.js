$(document).ready(function() {


    $('#send-msg').on('click', textAreaMessage);
    const $textArea = $('#senderID');
    const yourSrcImg = 'https://mdbootstrap.com/img/Photos/Avatars/avatar-1.jpg';
    const yourName = 'Pjoter';

    function textAreaMessage() {
        let $newLi = $('<li>');
        let $newDiv = $('<div>');
        let $textareaText = $textArea.text();
        $newLi.addClass('d-flex justify-content-end mb-4');
        $newLi.prepend('<div class="chat-body white p-3 ml-2 z-depth-1"><div class="header"><strong class="primary-font font-weight-bold text-success">' +
            yourName + '</strong><small class="ml-3 pull-right text-muted"><i class="fa fa-clock-o"></i> 12 mins ago</small><hr class="w-100"><p class="mb-0">' +
            $('#senderID').val() +
            '</p></div>'
        ).append(
            '<img src="' + yourSrcImg + '" alt="avatar" class="avatar rounded-circle mr-2 ml-lg-3 ml-0 z-depth-1">'

        );
        $newLi.insertBefore('#give-me-msg');

        $('#senderID').val('');
    }

    $('#some-ul').on('keypress', '#senderID', function(e) {
        if (e.which === 13) {
            textAreaMessage();
        }
    });

});