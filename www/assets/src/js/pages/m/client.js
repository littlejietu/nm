$('#TX-create').bind('click',function(){

	$.ajax( {
	    url:'/m/client/addclient',
	    data:{
	    		id : $('#albumid').val(), 
	            title : $('#title').val(),
	            memo : $('#memo').val()
	    },
	    type:'post',
	    cache:false,
	    dataType:'json',
	    success:function(res) {
	        if(res.code ==200 ){
	            // view("修改成功！");
	            alert(res.data);
	            $('#TX-win-close').click();
	            window.location.reload();
	            $('#X-tit-'+$('#albumid').val()).html($('#title').val());
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