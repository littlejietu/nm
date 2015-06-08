$(function() {

	//验证--begin
    $("#xtform").validate({
        ignore:"",
        rules: {
            realname : 'required',
            idno : 'required',
            mobile : 'required',
            idnoimg : 'required',
            bail : 'required'
          
        },
        messages: {
           realname : '<span class="xt_no"></span>',
           idno : '<span class="xt_no"></span>',
           mobile : '<span class="xt_no"></span>',
           idnoimg : '<span class="xt_no"></span>',
           bail : '<span class="xt_no"></span>'
        },

        //errorClass:"no",
        errorElement:"em",
        errorPlacement: function(error, element) { //指定错误信息位置 
            var arrELE = ['manage_funds','years_profit[]'];

            if (element.is(':radio') || element.is(':checkbox') || $.inArray(element.attr('name'), arrELE)>-1 ) { //如果是radio或checkbox 
                var eid = element.attr('name'); //获取元素的name属性 
                error.appendTo(element.parent().parent()); //将错误信息添加当前元素的父结点后面 
            }
            else
            {
                error.insertAfter(element);
            }
        },
        submitHandler:function(){
            return true;
        }
    });
    //验证--end




});