
$('.XT-modify').bind('click',function(){
	$('#orderid').val($(this).attr('_val'));
	$.ajax( {
	    url:'/m/order/getinfo',
	    data:{
	    		id : $('#orderid').val()
	    },
	    type:'get',
	    cache:false,
	    dataType:'json',
	    success:function(res) {
	        if(res.code ==200 ){
	            $('#orderid').val(res.data.id);
	            $('#spanTitle').html(res.data.title);
	            $('#spanOrderId').html(res.data.no);
	            $('#price').val(res.data.price);
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

	$('#X-title').html('编辑价格');
	$('.popover-mask').show();
	$('.popover-mask').height($(document).height());
	$('.popover').slideDown(200);

});


$('#TX-save').bind('click',function(){

	$.ajax( {
	    url:'/m/order/modifyprice',
	    data:{
	    		id : $('#orderid').val(), 
	            price : $('#price').val()
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

