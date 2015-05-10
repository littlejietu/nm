/* 首页效果 */
$(document).ready(function(){
	$(".nav li a").hover(function(){
		$(".navimg",this).stop().animate({top:"-25px"},150);
		$(".navzi",this).stop().animate({top:"0"},150);
	},function(){
		$(".navimg",this).stop().animate({top:"0px"},150);
		$(".navzi",this).stop().animate({top:"-25px"},150);
	});

	$('.recom li').width($(window).width()/6);
	$(window).resize(function() {
		$('.recom li').width($(window).width()/6);
	});
	
	$(".women li a").hover(function(){
		$(".womzi",this).stop().animate({bottom:"0"},150);
	},function(){
		$(".womzi",this).stop().animate({bottom:"-40px"},150);
	});
})

/* 置顶 */
$(function(){
	  //首先将#back-to-top隐藏
	  $("#totop").hide();
	  //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
	  $(function(){
		  $(window).scroll(function(){
			  if ($(window).scrollTop()>300){
				  $("#totop").fadeIn();
			  }else{
				  $("#totop").fadeOut();
			  }
		  });
		  //当点击跳转链接后，回到页面顶部位置
		  $("#totop").click(function(){
			  $('body,html').animate({scrollTop:0},300);
			  return false;
		  });
	  });
});

//档期选择 
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
//		$(".time_select_button").click();
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
})

// 档期选择弹出 
function alertWin(a){
	$('.popover-mask').show();
	$('.popover-mask').height($(document).height());
	$('.popover').slideDown(200);
}
function closeWin(a){
	$('.popover-mask').hide();
	$('.popover').slideUp(200);
}

function filt(a){
	$(a).addClass('licur').siblings().removeClass('licur');
	$(a).siblings('input').val($(a).attr('name'));
}	

	
/* login */	
jQuery.fn.customInput = function(){
	return $(this).each(function(){	
		if($(this).is('[type=checkbox],[type=radio]')){
			var input = $(this);
			
			// 使用输入的ID得到相关的标签
			var label = $('label[for='+input.attr('id')+']');
			
			// 包裹在一个div输入+标签
			input.add(label).wrapAll('<div class="custom-'+ input.attr('type') +'"></div>');
			
			// 必要的浏览器不支持：hover伪类的标签
			label.hover(
				function(){ $(this).addClass('hover'); },
				function(){ $(this).removeClass('hover'); }
			);
			
			//绑定自定义事件，触发它，绑定点击，焦点，模糊事件				
			input.bind('updateState', function(){	
				input.is(':checked') ? label.addClass('checked') : label.removeClass('checked checkedHover checkedFocus'); 
			})
			.trigger('updateState')
			.click(function(){ 
				$('input[name='+ $(this).attr('name') +']').trigger('updateState'); 
			})
			.focus(function(){ 
				label.addClass('focus'); 
				if(input.is(':checked')){  $(this).addClass('checkedFocus'); } 
			})
			.blur(function(){ label.removeClass('focus checkedFocus'); });
		}
	});
};

//单选框
//$(function(){
//	$('input').customInput();
//});

//初始化页面垂直居中
function center(){
	var winHeight = $(window).height();
	var bodyHeight = $(document.body).height();
	var heightGap = (winHeight - bodyHeight)/2;
	$('body.resize').css('padding-top', heightGap);
	$(window).resize(function() {
		winHeight = $(window).height();
		bodyHeight = $('body').height();
		var heightGap = winHeight - bodyHeight;
		if(heightGap > 5){
			$('body.resize').css('padding-top', heightGap/2);
		}else{
			$('body.resize').css('padding-top', 0);
		}
	})
}window.onload=center;

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
}

/* 会员中心 */
function helpClose(a){
	$(".help_notice").slideUp(200);
}

/* 模特筛选 start */
$('.control_bar .button_less').bind("click",
function(e){ 
	var display = $('.filterBox').css('display')=="none"?"block":"none";
	$('.filterBox').css('display',display)
	e.stopPropagation();
	$(this).toggleClass("spred");
});

$(".letter").find("li:lt(3)").addClass("intro");


/* 评论管理-回复 */
$(function(){
	$(".t_review>.operat").click(function(){
		if($(this).siblings(".reply").is(":visible"))
		{
			$(this).siblings(".reply").slideToggle(200).slideUp("slow");
		}
		else
		{
			$(".t_review>.operat").siblings(".reply").filter(":visible").slideToggle(200).slideUp("slow");
			$(this).siblings(".reply").slideToggle(200).slideDown("slow");
		}
	})
})


/* 上传头像 */
function previewImage(file) 
{ 
	var MAXWIDTH = 100; 
	var MAXHEIGHT = 100; 
	var div = document.getElementById('previews'); 
	if (file.files && file.files[0]) 
	{ 
		//div.innerHTML = '<img id=imghead>'; 
		var img = document.getElementById('imghead'); 
		img.onload = function(){ 
		var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight); 
		img.width = rect.width; 
		img.height = rect.height; 
		img.style.marginLeft = rect.left+'px'; 
		img.style.marginTop = rect.top+'px'; 
	} 
		var reader = new FileReader(); 
		reader.onload = function(evt){img.src = evt.target.result;} 
		reader.readAsDataURL(file.files[0]); 
	} 
	else 
	{ 
		var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="'; 
		file.select(); 
		file.blur(); 
		var src = document.selection.createRange().text; 
		div.innerHTML = '<img id=imghead>';
		var img = document.getElementById('imghead');
		img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src; 
		var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight); 
		status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height); 
		div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;margin-left:"+rect.left+"px;"+sFilter+src+"\"'></div>";
	} 
}