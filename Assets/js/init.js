$(function(){

    document.getElementById('focus').focus();

    $('.flash-message').addClass('active');

    $('.flash-message.confirm').setInterval(function(){

        $('.flash-message').removeClass('active');

    }, 3000);



});
