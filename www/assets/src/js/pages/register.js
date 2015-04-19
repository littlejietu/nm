
$().ready(function() {

    //$('.reg-left input').customInput();

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


     $("#signupForm").validate({
        rules: {
            usertype : "required"
        },
        submitHandler:function(form){
            alert("submitted");   
            form.submit();
        }    
    });

    //验证--begin
    $("#afrm").validate({
        rules: {
            usertype : "required",
            contact_name : "required",
            service_type : 'required',
            service_introduce : 'required',
            phone_cr:{
                digits:true
            },
            phone_qh:{
                digits:true
            },
            phone:{
                digits:true
            },
            fax_cr:{
                digits:true
            },
            fax_qh:{
                digits:true
            },
            fax:{
                digits:true
            }
          
        },
        messages: {
           usertype: '<span class="no"></span>',
           contact_name: '<i class="icoErr16"></i>请输入您的真实姓名',
           service_type : '<i class="icoErr16"></i>请选择服务类型',
           service_introduce : '<i class="icoErr16"></i>请输入服务范围',
           phone_cr : '<i class="icoErr16"></i>',
           phone_qh : '<i class="icoErr16"></i>',
           fax : '<i class="icoErr16"></i>',
           fax_cr : '<i class="icoErr16"></i>',
           fax_qh : '<i class="icoErr16"></i>',
           fax : '<i class="icoErr16"></i>',
        },

        errorClass:"no",
        errorElement:"em",
        submitHandler:function(form){
            alert("submitted");   
            //form.submit();
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