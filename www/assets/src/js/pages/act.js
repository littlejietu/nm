$('.XT-enter').bind('click',function(){
	var id = $(this).attr('_val');
	var it = $(this);
	$.ajax( {
	    url:'/act/enter',
	    data:{
	    		id : id
	    },
	    type:'post',
	    cache:false,
	    dataType:'json',
	    success:function(res) {
	        if(res.code ==200 ){
	            it.html('已报名');
	        }
	        else{
	        	alert(res.data.msg);
	        }
	     }
	});
});