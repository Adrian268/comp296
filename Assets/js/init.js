$(function(){

    $('.focus').focus();

    // shows confirm and error animations
    $('.flash-message').addClass('show');


    // removes confirm and error messages after 3 seconds
    setInterval(function(){

        $('.flash-message.remove').removeClass('show');

    }, 3000);

});

