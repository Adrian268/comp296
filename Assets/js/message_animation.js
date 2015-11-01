$(function(){

    $('.flash-message').addClass('show');

    setInterval(function(){

        $('.flash-message.remove').removeClass('show');

    }, 3000);


});