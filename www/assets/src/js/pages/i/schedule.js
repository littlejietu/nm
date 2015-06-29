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

	$("#item").bind("change",function(){

		if(arrIST.length>0)
		{
			var selectedId = $('#item').val();
			$('.XT-Scene a').remove();
			$('.XT-Time a').remove();

			if($.inArray( selectedId,arrIST) )
			{
				var obj = arrIST[selectedId];
				var arrS = Array();
				for(var i=0;i<obj.length;i++)
				{
					if($.inArray(obj[i].k, arrS))
					{
						arrS.push(obj[i].k);
						$('.XT-Scene').append('<a href="javascript:;" onclick="filt(this)" name="'+obj[i].k+'" class="XT-Scene-itm">'+obj[i].name+'</a>');
					}
				}

				$('#scene').val(obj[0].k);
				$('.XT-Scene a:first').click();
				//$('.XT-Scene a:first').addClass('licur');
			}
		}

	});

	$('.XT-Scene').delegate('.XT-Scene-itm','click',function(){
		var selectedId = $('#item').val();
		var sceneId = $('#scene').val();
		$('.XT-Time a').remove();
		if($.inArray( selectedId,arrIST) )
		{
			var obj = arrIST[selectedId];
			
			for(var i=0;i<obj.length;i++)
			{

				if(obj[i].k == sceneId)
				{
					for(var ii=0;ii<obj[i].tim.length;ii++)
					{
						var oo = obj[i].tim[ii];

						$('.XT-Time').append('<a href="javascript:;" onclick="filt(this)" name="'+oo.k+'">'+oo.name+'</a>');
					}
					
					
				}
			}

			$('#time').val(obj[0].tim[0].k);
			$('.XT-Time a:first').click();
			
		}
	});

	$('#item').trigger('change');
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

				$('#price').val(arrProduct[i][1]);
				
				break;
			}
		}
	}

	var totalPrice = $('#price').val() * $('#num').val();
	if(totalPrice>0)
		$('.price').html( totalPrice );
	if($('.price').html()!='面议')
		$('.moneysign').html('¥');
	else
		$('.moneysign').html('');
}


$('#XT-Book').bind('click',function() {
	$('#err-message').html('');
	if($('.price').html()=='' || $('.price').html()=='0')
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
	$('#begtime').val($('#photo_date').html());


	var options = { dataType:'json',
		success: function(res) {
            if(res.code ==200){
                alert('下单成功！等待模特确认后，请到订单中心去支付。');
                //window.location.href='/m/order';
                $('.close').click();
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


	
		
});

