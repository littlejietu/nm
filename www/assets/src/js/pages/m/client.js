$('#TX-create').bind('click',function(){

	$.ajax( {
	    url:'/m/client/addclient',
	    data:{
	    		id : $('#clientid').val(), 
	            linkman : $('#linkman').val(),
	            contact : $('#contact').val(),
	            memo : $('#memo').val()
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
	$('#clientid').val($(this).attr('_val'));
	$.ajax( {
	    url:'/m/client/getinfo',
	    data:{
	    		id : $('#clientid').val()
	    },
	    type:'get',
	    cache:false,
	    dataType:'json',
	    success:function(res) {
	        if(res.code ==200 ){
	            $('#linkman').val(res.data.linkman);
	            $('#contact').val(res.data.contact);
	            $('#memo').val(res.data.memo);
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

	if(!confirm("确定要删除联系人吗?")){return}
	$.ajax( {
	    url:'/m/client/del',
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