<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include("include/title.php")?>
<link href="css/base.css" type="text/css" rel="stylesheet" />
<link href="css/common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include("include/header.php")?>
<div class="mainbody" id="mainbody">
    <div class="container mrgB30">
        <div class="member clearfix">
            <?php include("include/uc_menu.php")?>
            <div class="fr uc_content">
            	<?php include("include/notice.php")?>
                <div class="clearfix uitopg">
                    <div class="transa">
                        <div class="aut_bti"><h3>作品上传</h3></div>
                        <div class="uploadworks">
                            <div class="upload_top clearfix">
                            	<p class="fl">上传照片</p>
                            	<div class="fl st_select">
                                    <input type="hidden" name="" class="st_select_input"/>
                                    <div class="st_select_txt">请选择要上传的相册</div>
                                    <div class="st_select_btn"></div>
                                    <ul class="st_select_list">
                                        <li>马来西亚外景拍摄</li>
                                        <li>毛里求斯</li>
                                    </ul>
                                </div>
                                <p class="fr"><a href="##">反馈问题</a><a href="##">使用帮助</a></p>
                            </div>
                            <div class="upload_list">
                            	<ul class="clearfix">
                                	<li>
                                    	<img src="images/mt_11.jpg"/>
                                        <div class="udl_bti"><p>DSC_3133</p><a class="delete"></a></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="upload_bottom aut_tab clearfix">
                            	<input name="" type="button" class="but" value="开始上传"/>
                                <input name="" type="button" class="but but_reset" value="继续添加"/>
                                <p class="fl">共 1 张照片，0.4M</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="help_bottom"></div>
    </div> 
</div>
<!--mainbody-->
<?php include("include/footer.php")?>

</body>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript">
function st_select(){this.init.apply(this,arguments)};
st_select.prototype={
	 init:function(opt)
	 {
		this.setOpts(opt);
		this.o=this.getByClass(this.opt.TTContainer,document,'div');//容器
		this.b=this.getByClass(this.opt.TTDiy_select_btn);//按钮
		this.t=this.getByClass(this.opt.TTDiy_select_txt);//显示
		this.l=this.getByClass(this.opt.TTDiv_select_list);//列表容器
		this.ipt=this.getByClass(this.opt.TTDiy_select_input);//列表容器
		this.lengths=this.o.length;
		this.showSelect();
	 },
	 addClass:function(o,s)//添加class
	 {
		o.className = o.className ? o.className+' '+s:s;
	 },
	 removeClass:function(o,st)//删除class
	 {
		var reg=new RegExp('\\b'+st+'\\b');
		o.className=o.className ? o.className.replace(reg,''):'';
	 },
	 addEvent:function(o,t,fn)//注册事件
	 {
		//return o.addEventListener ? o.addEventListener(t,fn,false):o.attachEvent('on'+t,fn);
	 },
	 showSelect:function()//显示下拉框列表
	 {
		var This=this;
		var iNow=0;
		this.addEvent(document,'click',function(){
			 for(var i=0;i<This.lengths;i++)
			 {
				This.l[i].style.display='none';
			 }
		})
		for(var i=0;i<this.lengths;i++)
		{
			this.l[i].index=this.b[i].index=this.t[i].index=i;
			this.t[i].onclick=this.b[i].onclick=function(ev)  
			{
				var e=window.event || ev;
				var index=this.index;
				This.item=This.l[index].getElementsByTagName('li');

				This.l[index].style.display= This.l[index].style.display=='block' ? 'none' :'block';
				for(var j=0;j<This.lengths;j++)
				{
					if(j!=index)
					{
						This.l[j].style.display='none';
					}
				}
				This.addClick(This.item);
				e.stopPropagation ? e.stopPropagation() : (e.cancelBubble=true); //阻止冒泡
			}
		}
	 },
	 addClick:function(o)//点击回调函数
	 {

		if(o.length>0)
		{
			var This=this;
			for(var i=0;i<o.length;i++)
			{
				o[i].onmouseover=function()
				{
					This.addClass(this,This.opt.TTFcous);
				}
				o[i].onmouseout=function()
				{
					This.removeClass(this,This.opt.TTFcous);
				}
				o[i].onclick=function()
				{
					var index=this.parentNode.index;//获得列表
					This.t[index].innerHTML=This.ipt[index].value=this.innerHTML.replace(/^\s+/,'').replace(/\s+&/,'');
					This.l[index].style.display='none';
				}
			}
		}
	 },
	 getByClass:function(s,p,t)//使用class获取元素
	 {
		var reg=new RegExp('\\b'+s+'\\b');
		var aResult=[];
		var aElement=(p||document).getElementsByTagName(t || '*');

		for(var i=0;i<aElement.length;i++)
		{
			if(reg.test(aElement[i].className))
			{
				aResult.push(aElement[i])
			}
		}
		return aResult;
	 },

	 setOpts:function(opt) //以下参数可以不设置  //设置参数
	 { 
		this.opt={
			 TTContainer:'st_select',//控件的class
			 TTDiy_select_input:'st_select_input',//用于提交表单的class
			 TTDiy_select_txt:'st_select_txt',//st_select用于显示当前选中内容的容器class
			 TTDiy_select_btn:'st_select_btn',//st_select的打开按钮
			 TTDiv_select_list:'st_select_list',//要显示的下拉框内容列表class
			 TTFcous:'focus'//得到焦点时的class
		}
		for(var a in opt)  //赋值 ,请保持正确,没有准确判断的
		{
			this.opt[a]=opt[a] ? opt[a]:this.opt[a];
		}
	 }
}
var TTDiy_select=new st_select({  //参数可选
	TTContainer:'st_select',//控件的class
	TTDiy_select_input:'st_select_input',//用于提交表单的class
	TTDiy_select_txt:'st_select_txt',//st_select用于显示当前选中内容的容器class
	TTDiy_select_btn:'st_select_btn',//st_select的打开按钮
	TTDiv_select_list:'st_select_list',//要显示的下拉框内容列表class
	TTFcous:'focus'//得到焦点时的class
});//如同时使用多个时请保持各class一致.
</script>
</html>