$('#TX-create-album').bind('click',function(){

	$('.popover-mask').show();
	$('.popover-mask').height($(document).height());
	$('.popover').slideDown(200);

});

$('#TX-win-close').bind('click',function(){
	$('.popover-mask').hide();
	$('.popover').slideUp(200);
});


$('#TX-create').bind('click',function(){

	$.ajax( {
	    url:'/m/works/addalbum',
	    data:{
	    		agid : $('#agid').val(),
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

$('.XT-album').bind('click',function(){
	$('#albumid').val($(this).attr('_val'));
	$.ajax( {
	    url:'/m/works/album',
	    data:{
	    		id : $('#albumid').val()
	    },
	    type:'get',
	    cache:false,
	    dataType:'json',
	    success:function(res) {
	        if(res.code ==200 ){
	            $('#title').val(res.data.title);
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

	$('#X-title').html('修改相册');
	$('.popover-mask').show();
	$('.popover-mask').height($(document).height());
	$('.popover').slideDown(200);

});

$('.XT-del-album').bind('click',function(){
	var obj = $(this).parent().parent().parent().parent();

	if(!confirm("确定要删除相册吗?")){return}
	$.ajax( {
	    url:'/m/works/delalbum',
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

