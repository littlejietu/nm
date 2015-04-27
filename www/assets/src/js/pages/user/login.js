$(document).ready(function(){
    $(".ibanner").slide({
        titCell: ".hd ul",
        mainCell: ".bd ul",
        effect: "fold",
        autoPlay: true,
        autoPage: true,
        trigger: "click",
        startFun: function(i) {
            var curLi = jQuery(".ibanner .bd li").eq(i);
            if ( !! curLi.attr("_src")) {
                curLi.css("background-image", curLi.attr("_src")).removeAttr("_src")
            }
        }
    });
});

$(function(){
    $('.iban_form input').customInput();
});



//login表单提交
function formC(){
    var num=0;
    var name=document.getElementById('name');
    var password=document.getElementById('password');
    if(name.value==''){
        //alert('账号不能为空')
        document.getElementById('prompt').innerHTML='账号不能为空';
        $('#prompt').css("display","block");
        return false;
    }
    if(password.value==''){
        //alert('密码不能为空');
        document.getElementById('prompt').innerHTML='密码不能为空';
        $('#prompt').css("display","block");
        return false;
    }
    if($('#code').val()=='')
    {
        document.getElementById('prompt').innerHTML='验证码不能为空';
        $('#prompt').css("display","block");
        return false;
    }
}


$('#xtform').submit(function()
{
    var options = { dataType:'json',
        success: function(res) {
            if(res.code ==200){
                window.location.reload();
            }
            else
            {
                var msg = '';
                $.each(res.data.error_messages,function(n,value) {  

                    msg +=value+'\n';
               
                });  
                
                if(msg!='')
                    alert(msg);
            }
        }

    };
    $('#xtform').ajaxSubmit(options);
    return false;
});

