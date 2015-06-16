

$('.XT-modify').bind('click',function(){
	window.location.href='/m/model/set?modelid='+$(this).attr('_val');
});

$('.XT-album-create').bind('click',function(){
	window.location.href='/m/works?agid='+$(this).attr('_val');
});


$('.XT-del').bind('click',function(){
	var obj = $(this).parent().parent().parent().parent();

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