$(function(){
	//select 模拟框
	
	//keywords text
if($("#user").click())
{
	var keyword = "手机";
    $("#user").val(keyword).bind("focus",function(){
		if(this.value == keyword){
			this.value = "";
			this.className = "text21"
		}
		else{
			this.className = "text21"
		}
	}).bind("blur",function(){
		if(this.value == ""){
			this.value = keyword;
			this.className = "text2"
			this.style.color="#888";
			$('.reg-user .ok').hide();
			$('.reg-user .no').show();
		}
		else{
			this.className = "text2";
			this.style.color="#333";
			$('.reg-user .no').hide();
			$('.reg-user .ok').show();
		}
	});
}
	
var patrn=/^[0-9A-Za-z]{6,}$/;	
if($("#pwd").click())
{
	var keyword1 = "密码";
    $("#pwd").val(keyword1).bind("focus",function(){
		if(this.value == keyword1){
			this.value = "";
			this.className = "text21"
			this.type="password";
		}
		else{
			this.className = "text21"
		}
	}).bind("blur",function(){
		if(this.value == ""  ){
			this.value = keyword1;
			this.type="text";
			this.className = "text2"
			this.style.color="#888";
			$('.reg-pwd .ok').hide();
			$('.reg-pwd .no').show();
		}
		else{
			if(!patrn.exec(this.value))
			{
				this.type="password";
				this.className = "text2"
			    this.style.color="#333";
			    $('.reg-pwd .ok').hide();
			    $('.reg-pwd .no').show();
			}
			else{
			    this.className = "text2";
			    this.style.color="#333";
			    $('.reg-pwd .no').hide();
			    $('.reg-pwd .ok').show();
			}
		}
		
	});
}

if($("#pwd1").click())
{
	var keyword2 = "确定密码";
    $("#pwd1").val(keyword2).bind("focus",function(){
		if(this.value == keyword2){
			this.value = "";
			this.className = "text21"
			this.type="password";
		}
		else{
			this.className = "text21"
		}
	}).bind("blur",function(){
		if(this.value == "" ){
			this.value = keyword2;
			this.type="text";
			this.className = "text2"
			this.style.color="#888";
			$('.reg-pwd1 .ok').hide();
			$('.reg-pwd1 .no').show();
		}
		else{
			if(this.value!=$("#pwd").val())
			{
				this.type="password";
				this.className = "text2"
			    this.style.color="#333";
			    $('.reg-pwd1 .ok').hide();
			    $('.reg-pwd1 .no').show();
			}
			else{
			    this.className = "text2";
			    this.style.color="#333";
			    $('.reg-pwd1 .no').hide();
			    $('.reg-pwd1 .ok').show();
			}
		}
	});
}
	
var patrn1=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;	
if($("#email").click())
{
	var email = "邮箱";
	$("#email").val(email).bind("focus",function(){
	if(this.value == email){
		this.value = "";
		this.className = "text21"
	}
	else{
		this.className = "text21"
	}	
	}).bind("blur",function(){
			if(!patrn1.exec(this.value) || this.value=="")
			{
				this.style.borderColor="#dbdbdb";
			    $('.reg-email .ok').hide();
			    $('.reg-email .no').show();
			}
			else{
			    this.style.borderColor="#dbdbdb";
			    $('.reg-email .no').hide();
			    $('.reg-email .ok').show();
			}
		});
	}
		
});