$('#TX-create').bind('click',function(){

	$.ajax( {
	    url:'/m/model/add',
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
	window.location.href='/m/model/set?modelid='+$(this).attr('_val');
});


$('.XT-del').bind('click',function(){
	var obj = $(this).parent().parent();

	if(!confirm("确定要删除艺人吗?")){return}
	$.ajax( {
	    url:'/m/model/del',
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