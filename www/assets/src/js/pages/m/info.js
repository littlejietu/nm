$(function() {
    $('#XT-info-base,#XT-info-pic').bind('click',function(){
        var id = $(this).attr('id');
        if(id=='XT-info-base'){
            $('#tb-'+id).show();
            $('#tb-XT-info-pic').hide();
        }
        else
        {
            $('#tb-'+id).show();
            $('#tb-XT-info-base').hide();
        }
    });

	//验证--begin
    $("#xtform").validate({
        rules: {
            nickname : {required:true,
                remote:{//验证昵称是否存在
                    type:"POST",
                    dataType: "json",
                    url:"/user/check/regcheck",
                    data:{
                        'nickname':function(){return $("#nickname").val();},
                        'type':'nickname',
                        'is_remote':1
                    }
                } 
            },
            realname : 'required',
            sex : 'required',
            height : 'required',
            weight : 'required'
          
        },
        messages: {
           nickname: {required:'<span class="xt_no">请填写昵称</span>',remote:'<span class="xt_no">该昵称已被注册，请正确填写</span>'},
           sex : '<span class="xt_no"></span>',
           realname : '<span class="xt_no"></span>',
           height : '<span class="xt_no"></span>',
           weight : '<span class="xt_no"></span>'
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


    //地区--begin
    if(typeof($('#city').val())!="undefined")
    {
        var multiSelect         = new MultiSelect('divCity','city',dataMultiArea,dataAllArea);
        multiSelect.pLabels  = '省,市';
        //multiSelect.pClass   = 'w70 mr5';
        multiSelect.pNames  = 'province_id,city_id';
        multiSelect.pStart  = 1;
        multiSelect.init(chinese_id);
        var initId = $('#init_city_id').val();
        if(initId=='' || initId==0)
            initId = chinese_id;
        multiSelect.select(initId);
        // $("#divCity select").each(function(){
        //     $(this).addClass("select-style");
        //     //$(this).wrap('<span class="standard_select"><span class="select_shelter"></span></span></div>');
        // });
    }
    //地区--end



});