$(function(){
    $('.reg-left input').customInput();
});

$().ready(function() {
    $('#xt_reg1').bind('click',function(){
        $('.xt_reg1_rgn').css('display','block');
        $('.xt_reg2_rgn').css('display','none');
        $(this).addClass('curr');
        $('#xt_reg2').removeClass('curr');

    });
    $('#xt_reg2').bind('click',function(){
        $('.xt_reg1_rgn').css('display','none');
        $('.xt_reg2_rgn').css('display','block');
        $('#xt_reg1').removeClass('curr');
        $(this).addClass('curr');
    });
});