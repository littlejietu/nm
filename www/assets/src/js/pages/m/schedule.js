$('#TX-create').bind('click',function(){

	$.ajax( {
	    url:'/m/schedule/addschedule',
	    data:{
	    		id : $('#sid').val(), 
	            dodate : $('#dodate').val(),
	            thing : $('#thing').val()
	    },
	    type:'post',
	    cache:false,
	    dataType:'json',
	    success:function(res) {
	        if(res.code ==200 ){
	            //alert(res.data);
	            $('#TX-win-close').click();
	            window.location.reload();
	        }else{
	            var msg = '';
            	$.each(res.data.error_messages,function(n,value) {
	            	msg +=value+'\n';
	            });
	            if(msg!='')
	            	alert(msg);
	        }
	     }
	});
});


$('.XT-modify').bind('click',function(){
	$('#sid').val($(this).attr('_val'));
	$.ajax( {
	    url:'/m/schedule/getinfo',
	    data:{
	    		id : $('#sid').val()
	    },
	    type:'get',
	    cache:false,
	    dataType:'json',
	    success:function(res) {
	        if(res.code ==200 ){
	            $('#dodate').val(res.data.dodate);
	            $('#thing').val(res.data.thing);
	        }else{
	            var msg = '';
            	$.each(res.data.error_messages,function(n,value) {
	            	msg +=value+'\n';
	            });
	            if(msg!='')
	            	alert(msg);
	        }
	     }
	});

	$('#X-title').html('修改客户');
	$('.popover-mask').show();
	$('.popover-mask').height($(document).height());
	$('.popover').slideDown(200);

});


$('.XT-del').bind('click',function(){
	var obj = $(this).parent().parent();

	if(!confirm("确定要删除吗?")){return}
	$.ajax( {
	    url:'/m/schedule/del',
	    data:{
	    		id : $(this).attr('_val')
	    },
	    type:'post',
	    cache:false,
	    dataType:'json',
	    success:function(res) {
	        if(res.code ==200 ){
	            obj.remove();
	        }else{
	            var msg = '';
            	$.each(res.data.error_messages,function(n,value) {
	            	msg +=value+'\n';
	            });
	            if(msg!='')
	            	alert(msg);
	        }
	     }
	});
});