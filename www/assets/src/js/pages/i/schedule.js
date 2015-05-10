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

