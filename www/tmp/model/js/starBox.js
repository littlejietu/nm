// JavaScript Document
$(document).ready(function(){
    var stepW = 24;
    var description = new Array("非常差","很差","一般","很好","非常好!");
	var szhi = new Array("1","2","3","4","5");
    var stars = $("#star > li");
    var descriptionTemp;
	var szhiTemp;
    $("#showb").css("width",0);
    stars.each(function(i){
        $(stars[i]).click(function(e){
            var n = i+1;
            $("#showb").css({"width":stepW*n});
            descriptionTemp = description[i];
			szhiTemp = szhi[i];
            $(this).find('a').blur();
			$(".szhi").val(szhi[i]);
            return stopDefault(e);
            return descriptionTemp;
        });
    });
    stars.each(function(i){
        $(stars[i]).hover(
            function(){
                $(".description").text(description[i]);
            },
            function(){
                if(descriptionTemp != null)
                    $(".description").text("评价："+descriptionTemp);
                else 
                    $(".description").text(" ");
            }
        );
    });
});
function stopDefault(e){
    if(e && e.preventDefault)
           e.preventDefault();
    else
           window.event.returnValue = false;
    return false;
};
