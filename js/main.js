	function search(){
							var search_input = document.getElementById("search_input");
							if (search_input.value == "") {
								search_input.focus();
								return false;
							}
							else{
								location.href="search.php?keyword="+search_input.value;
							}
						}

/*异步提交
function search(){
		var search_input = document.getElementById("search_input");
		var search_result = document.getElementById("search_result");
		var xmlhttp;

		if (search_input.value == "") 
			search_input.focus();
			return;
		}
		if (window.ActiveXObject) {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		else if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}

		url="search.php?keyword="+search_input.value
		xmlhttp.open("POST",url,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				search_result.innerHTML = xmlhttp.responseText;
			}
		}
}
*/

function allpost(){
		var posts_list = document.getElementById("posts_list");
		
		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		url="all_post.php";
		xmlhttp.open("POST",url,false);
		
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{	
				posts_list.innerHTML = xmlhttp.responseText;
				
				//document.getElementById("topics").style.background = "rgb(150,150,100)";
			}
		}
		xmlhttp.send();		
}

function allpost2(num){
		var posts_list = document.getElementById("posts_list");
		
		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		url="all_post.php?page="+num;
		xmlhttp.open("POST",url,true);
		
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{	
				posts_list.innerHTML = xmlhttp.responseText;				
				//document.getElementById("topics").style.background = "rgb(150,150,100)";
				paging(num);
			}
		}
		xmlhttp.send();			
		
}


function paging(num){	
		var page = document.getElementById("page");
		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		url="paging.php?page="+num;
		xmlhttp.open("GET",url,true);		
		xmlhttp.send();	
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{	
				page.innerHTML = xmlhttp.responseText;
				document.getElementById('no'+1).style.background="white";
				document.getElementById('no'+num).style.background="rgb(149,7,27)";
				document.getElementById('no'+num).style.color="white";
			}
		}
		
}



/*
function submit(){
	var title = document.getElementById("input_title");
	var username = document.getElementById("show_name").innerText;
	if(!username){
		alert('先登录才能发帖！');
		return;
	}
	
	if(title.value==""){
		 title.focus();
		 return;
	}

	publish();
}
	
function publish(){
	var title=document.getElementById("input_title");
	var content=document.getElementById("input_content");
	var head=document.getElementById("head");
	var xmlhttp;
	if(window.ActiveXOBject){
		xmlhttp = new ActiveXOBject("Microsoft.XMLHTTP");
	}
	else if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}
	//var str="title="+title.value+"&content="+content.value;		
	var url="publish_post.php?title="+title.value+"&content="+content.value;			
	xmlhttp.open("GET",url,true);	  //xmlhttp.open("POST",url,true);	
	xmlhttp.send(null);        //xmlhttp.send(str);   
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			alert('发表成功！'); 
			
			allpost();        
			//title.value="";
			//content.value="";
			//top.focus();
			//location.hash="head";
			location.href="bbs_forum.php";
		}
	}
}
*/
	
	
function reply(){	
	var reply_content = document.getElementById("reply_content");
	var username = document.getElementById("show_name").innerText;
	if(!username)
	{
		alert("先登录才能发表回复！");
		return;
	}

	if(reply_content.value==""){	
		reply_content.focus();
		 return;
	}
	reply2();
}
	
function reply2(){
	var repost = document.getElementById("repost");
	var postid = document.getElementById("postid");
	var reply_content = document.getElementById("reply_content");
	var xmlhttp;
	
	//document.write();
	if(window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	
	url = "publish_reply.php?postid="+postid.value+"&reply_content="+reply_content.value;
	xmlhttp.open("GET",url,false);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			reply_content.value="";
			alert('回复发表成功！'); 
			repost.innerHTML = xmlhttp.responseText;						
		}
	}
	xmlhttp.send();
}
	
function show_reply(){
	var repost = document.getElementById("repost");
	var postid = document.getElementById("postid");
	var xmlhttp;
	
	//document.write();
	if(window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}

	url = "publish_reply.php?postid="+postid.value;
	xmlhttp.open("GET",url,false);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			repost.innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send();
}


	
	

function addconcern(){
	var addconcern = document.getElementById("addconcern");
	var concern = document.getElementById("username");
	var xml;
	
	if(window.XMLHttpRequest)
	{
		xml = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		xml = new ActiveXObject("Microsoft.XMLHTTP");
	}
	//document.write(concern.value);
	url = "addconcern.php?concern="+concern.value;
	xml.open("GET",url,true);
	xml.send(null);
	
	xml.onreadystatechange = function(){      //onready'S'tatechange 注意'S'大写是错误的！！！！！！
		if(xml.readyState == 4 && xml.status == 200)
		{		
			addconcern.innerHTML = xml.responseText;
			location.reload();    //刷新页面
		}
	}
}
	

	//显示缩略图
function formatImg(imgObject){ 		//onload="formatImg(this)"
	if(imgObject.height > 130 || imgObject.width > 200){
		var hw = imgObject.height/imgObject.width;
		var hh = imgObject.height/130;
		var ww = imgObject.width/200;
		if (hh>ww) {
			imgObject.height = 130;
			imgObject.width = 130/hw;
		} else {
			imgObject.height = 200*hw;
			imgObject.width = 200;
		}
	}
	
	//imgObject.height = 130;
	//imgObject.width = 200;
}	




function addexp(){
	var username = document.getElementById("show_name").innerText;
	var sign = document.getElementById("sign");
	var xmlhttp;
	
	if(!username)
	{
		alert("先登录才能签到！");
		return;
	}	
	
	//document.write();
	if(window.ActiveXObject)
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}

	url = "sign.php?username="+username;
	xmlhttp.open("GET",url,false);
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			if(xmlhttp.responseText == -1)
			{
				alert("你在1小时内已签过了，过会再来吧！");
			}
			else{
				sign.innerHTML = xmlhttp.responseText;
			}
		}
	}
	xmlhttp.send();
}




	
	
	//自动调用函数
if(document.getElementById("posts_list"))     //在执行前判断元素是否存在!!
{
window.onload = function(){       
	allpost();
}
}

if(document.getElementById("repost"))
{
window.onload = function(){
	show_reply();
}
}







	//个人信息主页，两个js文件之间会冲突！！，未解？
/*
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
 } 	  
 
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

*/









