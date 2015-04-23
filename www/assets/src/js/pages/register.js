
$().ready(function() {

    $('.reg-left input').customInput();

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

    var wait=60;
    function time(o) {
        if (wait == 0) {
            o.removeAttribute("disabled");            
            o.value=" 获取验证码 ";
            wait = 60;
        } else { // www.jbxue.com
            o.setAttribute("disabled", true);
            o.value=" 重新发送(" + wait + ") ";
            wait--;
            setTimeout(function() {
                time(o)
            },
            1000)
        }
    }
    document.getElementById("getCode").onclick=function(){time(this);}






    //  $("#signupForm").validate({
    //     rules: {
    //         usertype : "required"
    //     },
    //     submitHandler:function(form){
    //         alert("submitted");   
    //         form.submit();
    //     }    
    // });

    //验证--begin
    $("#afrm").validate({
        rules: {
            usertype : "required",
            phone : {required:true,
                remote:{//验证用户名是否存在
                    type:"POST",
                    dataType: "json",
                    url:"/reg/formcheck",
                    data:{
                        'mobile':function(){return $("#phone").val();},
                        'type':'mobile',
                        'remote':0
                    }
                } 
            },
            code_phone : 'required',
            password_phone : { required: true, minlength: 6},
            repassword_phone: { required: true, equalTo: "#password_phone" }
          
        },
        messages: {
           usertype: '',
           phone: {required:'<span class="no" style="display: inline;">手机/邮箱不能为空</span>',remote:'<span class="no" style="display: inline;">该手机号码已被注册，请更换其他号码并重新提交</span>'},
           code_phone : '<span class="no" style="display: inline;">请填写验证码</span>',
           password_phone : { required: '<span class="no" style="display: inline;">请输入密码</span>', minlength: '<span class="no" style="display: inline;">密码不能小于6个字符</span>' },
           repassword_phone :{required: '<span class="no" style="display: inline;">请输入确认密码</span>',  equalTo: '<span class="no" style="display: inline;">两次输入密码不一致</span>'}
        },

        //errorClass:"no",
        errorElement:"em",
        errorPlacement: function(error, element) { //指定错误信息位置 
            var arrELE = ['manage_funds','years_profit[]'];

            if (element.is(':radio') || element.is(':checkbox') || $.inArray(element.attr('name'), arrELE)>-1 ) { //如果是radio或checkbox 
                var eid = element.attr('name'); //获取元素的name属性 
                error.appendTo(element.parent().parent()); //将错误信息添加当前元素的父结点后面 
            }
            else
            {
                error.insertAfter(element);
            }
        },
        submitHandler:function(form){

            var options = { dataType:'json',
                success: function(res) {
                    if(res.code ==200){
                        var win = dialog({
                            title: '系统提示',
                            width: '200px',
                            fixed: true,
                            cancel: true,
                            content: '修改成功',
                            cancelValue: '确定'
                            //onclose : function(){window.location.href='/manage/account.html';}
                        });
                        win.showModal();
                    }
                    else
                    {
                        var msg = '';
                        $.each(res.data.error_messages,function(n,value) {  
         
                            msg +=value+'<br />';
                       
                        });  

                        var win = dialog({
                            title: '系统提示',
                            width: '200px',
                            fixed: true,
                            cancel: true,
                            content: '请正确填写:<br>'+msg,
                            cancelValue: '确定'
                        });
                        win.showModal();
                    }
                }

            };
            $('#afrm').ajaxSubmit(options);
        }
    });
    //验证--end


});