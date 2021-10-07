function scrollToID(id, speed) {
        var targetOffset = $('#'+id).offset().top;
        $('html,body').animate({ scrollTop: targetOffset }, speed);
}

    $('.scrollup').on('click', function (e) {
        if($(this).attr('data-elem') != undefined) {
            e.preventDefault();
            scrollToID($(this).attr('data-elem'), 500)
        }
    });