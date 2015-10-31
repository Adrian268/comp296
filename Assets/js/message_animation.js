$(function(){

    $('.flash-message').addClass('active');

    setInterval(function(){

        $('.flash-message.confirm').removeClass('active');

    }, 3000);


});