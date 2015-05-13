/* 档期选择 */
$().ready(function(){
	$('.time_select_click').click(function(){
		$(this).next().toggle();
	});
	
	$("#nianfen ul li").click(function(){
		$("#nian").html($(this).html());
		$("#total_nian").html($.trim($(this).html().replace("年",".")));
		$("#y").val($.trim($(this).html().replace("年","")));
		$('.select').hide();
	});
	
	$("#yuefen ul li").click(function(){
		$("#yue").html($(this).html());
		$("#total_yue").html($(this).html());
		$("#m").val($.trim($(this).html().replace("月","")));
		$(".time_select_button").click();
		$('.select').hide();
	});
	
	$('.span_hover').click(function(){
		//alert('1');
		$(this).hide();
		$(this).parent().css('position','relative');
		$(this).parent().css('height','auto');
		$(this).parent().css('left','0');
		$(this).parent().css('height','auto');
		$(this).parent().css('background','#26272b');
		$(this).parent().css('z-index','1000');
	});
	
	$(".piao_con .day:odd").addClass('bg_day');
});


$('.d_reser').bind('click',function(){
	$('#photo_date').html($(this).attr('_date'));
	$('.popover-mask').show();
	$('.popover-mask').height($(document).height());
	$('.popover').slideDown(200);

});
$('.close').bind('click',function(){
	$('.popover-mask').hide();
	$('.popover').slideUp(200);
});

function filt(a){
	$(a).addClass('licur').siblings().removeClass('licur');
	$(a).siblings('input').val($(a).attr('name'));

	getPrice();
}

function getPrice(){
	if($('#item').val()!=0 && $('#scene').val()!=0 && $('#time').val()!=0)
	{
		var selectedId = $('#item').val()+'_'+$('#scene').val()+'_'+$('#time').val();

		for(var i=1;i<arrProduct.length;i++)
		{
			if(arrProduct[i][0]==selectedId)
			{

				$('.money').html(arrProduct[i][1]);
				break;
			}
		}
	}

}

$('#XT-Book').bind('click',function() {
	/*
	if($('.money').html()=='' || $('.money').html()=='0')
	{
		$('#err-message').html('请选择工作内容');
		return;
	}
	if($('#scene').val()=="0")
	{
		$('#err-message').html('请选择工作场景');
		return;
	}
	if($('#time').val()=="0")
	{
		$('#err-message').html('请选择计价方式');
		return;
	}
	if($('#num').val()=="0"||$('#num').val()=="")
	{
		$('#err-message').html('请填写数量');
		return;
	}
	if($('#linkman').val()=="")
	{
		$('#err-message').html('请填写联系人');
		return;
	}
	if($('#linkway').val()=="")
	{
		$('#err-message').html('请填写联系方式');
		return;
	}
	*/

	//验证--begin
    $("#xtform").validate({
        rules: {
            nickname : {required:true,
                remote:{//验证昵称是否存在
                    type:"POST",
                    dataType: "json",
                    url:"/user/check/regcheck",
                    data:{
                        'nickname':function(){return $("#nickname").val();},
                        'type':'nickname',
                        'is_remote':1
                    }
                } 
            },
            realname : 'required',
            sex : 'required',
            height : 'required',
            weight : 'required'
          
        },
        messages: {
           nickname: {required:'<span class="xt_no">请填写昵称</span>',remote:'<span class="xt_no">该昵称已被注册，请正确填写</span>'},
           sex : '<span class="xt_no"></span>',
           realname : '<span class="xt_no"></span>',
           height : '<span class="xt_no"></span>',
           weight : '<span class="xt_no"></span>'
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
        submitHandler:function(){
            return true;
        }
    });
    //验证--end


	var options = { dataType:'json',
		success: function(res) {
            if(res.code ==200){
                alert('下单成功！等待模特确认后再到订单中心去支付。')
            }
            else
            {
            	var msg = '';
            	$.each(res.data.error_messages,function(n,value) {  
	            	msg +=value+'\\n';
	            });  
	            if(msg!='')
	            	alert(msg);
            }
        }

	};
    $('#afrm').ajaxSubmit(options);


	
		
});

