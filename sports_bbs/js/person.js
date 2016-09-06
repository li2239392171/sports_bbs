
	//此文件的调用存在一定问题！！
$(function(){
	$("#modify").hide(); //先让div隐藏
		$("#open").click(function(){
			$("#modify").fadeIn("slow");//淡入淡出效果 显示div
		});
		$("#close").click(function(){
			$("#modify").fadeOut("slow");//淡入淡出效果 隐藏div
		})
	});


function showmask() 
{ 
 var mask=document.getElementById("mask"); 
 var login=document.getElementById("login"); 
 var open=document.getElementById("open"); 
 var close=document.getElementById("close"); 
  
 open.onclick=function() 
 { 
  mask.style.display="block"; 
  login.style.display="block"; 
  document.getElementById("mask").style.height=document.documentElement.scrollHeight+'px';
 } 	  //加上设置长度是滚动条距离，就可以随滚动条滚动！
 
 close.onclick=function() 
 { 
  mask.style.display="none"; 
  login.style.display="none";  
 } 
} 


function personal_post(){
	var list = document.getElementById('list');
	var username = document.getElementById("username");
	var xml;
	
	if(window.ActiveXObject){
		xml = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else if(window.XMLHttpRequest){
		xml = new XMLHttpRequest();
	}
	url = "personal_post.php?username="+username.value;
	xml.open("GET",url,true);
	xml.send();
	xml.onreadystatechange = function(){
		if(xml.readyState == 4 && xml.status == 200){        //ajax异步提交函数对大小写要求严格，尽量按照格式
			list.innerHTML = xml.responseText;
		}
	}
}

if(document.getElementById("list"))
{
window.onload = function(){
	personal_post();
	showmask();
}
}

