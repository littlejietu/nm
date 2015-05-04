$(function() {
    var arrProductCode = Array();

	$('#XT-Add').bind('click',function(){
        var arrChk = Array();
        var arrTxt = Array();

        $('input[name="item"]:checked').each(function(){ 
            if($.inArray($(this).val(), arrChk)<0)
            {
                arrChk.push($(this).val());
                arrTxt.push($(this).attr('_text'));
            }
        }); 

        var msg = '';
        if(arrChk.length==0)
            msg = '请选择工作内容！';
        else if( $('input:radio[name="scene"]:checked').length == 0)
            msg = '请选择工作场景！';
        else if( $('input:radio[name="time"]:checked').length == 0)
            msg = '请选择计价方式！';

            
        $('#alertmsg').html(msg);
        if(msg!='')
            return false;
        
        var htmlItem = $('#priceitem').html();//$('#priceList').find("li:first-child").clone().html();
        var scene_text  = $('input:radio[name="scene"]:checked').attr('_text');
        var time_text  = $('input:radio[name="time"]:checked').attr('_text');
        var scene  = $('input:radio[name="scene"]:checked').val();
        var time  = $('input:radio[name="time"]:checked').val();
        var htmlTmp = '';
        $.each(arrChk, function(idx,item){
            var code = item+'_'+scene+'_'+time;
            if($.inArray(code, arrProductCode)<0)
            {
                arrProductCode.push(code);
                htmlTmp += htmlItem.replace(/{{item_code}}/g, code).replace(/{{item_work}}/g, arrTxt[idx]+' + '+scene_text+' + '+time_text);
            }
        });
        
        if(htmlTmp!='')
            $('#priceList').append(htmlTmp);
        if($('#priceList').html()=='')
            $('#XT-Submit').css('display','none');
        else
            $('#XT-Submit').addClass('but');

    });

    
    $('#XT-Reset').bind('click',function(){
        $('input[name="item"]:checked').each(function(){ 
            $(this).attr('checked',false);
        });

        if($('input:radio[name="scene"]:checked').length>0)
            $('input:radio[name="scene"]:checked').attr('checked',false);
        if($('input:radio[name="time"]:checked').length>0)
            $('input:radio[name="time"]:checked').attr('checked',false);
    });

});