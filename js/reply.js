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


if(document.getElementById("repost"))
{
window.onload = function(){
	show_reply();
}
}




function zan_reply(obj){
	var zan = document.getElementById(obj.name);
	var zanstatus = document.getElementById("zanstatus");
	//var replyid = document.getElementById("replyid");
	var xml;
	
	var username = document.getElementById("show_name").innerText;
	if(!username)
	{
		alert("先登录才能点赞！");
		return;
	}
	// if(zanstatus.value == 1){
		// alert('你已经赞过了！');
		// return;
	// }
	// else
	// {
		if(window.ActiveXObject)
		{
			xml = new ActiveXObject("Microsoft.XMLHTTP");
		}
		else if(window.XMLHttpRequest)
		{
			xml = new XMLHttpRequest();
		}
		
		var url = "zan.php?replyid="+obj.name;
		xml.open("GET",url,true);
		xml.onreadystatechange = function(){
			if(xml.readyState == 4 && xml.status == 200)
			{
				//zan.innerHTML = xml.responseText;
				if(xml.responseText==-1){
					alert('你2分钟前已经赞过了！待会再来吧~~');
				}
				else{
					zan.innerHTML = xml.responseText;
				}
			}
		}
		xml.send();
	//}
}


function zan_post(obj){
	var zan = document.getElementById(obj.name);		
	var username = document.getElementById("show_name").innerText;
	var xml;
	
	if(!username)
	{
		alert("先登录才能点赞！");
		return;
	}
	if(window.ActiveXObject)
	{
		xml = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else if(window.XMLHttpRequest)
	{
		xml = new XMLHttpRequest();
	}
	
	var url = "zan.php?postid="+obj.name;
	xml.open("GET",url,true);
	xml.onreadystatechange = function(){
		if(xml.readyState == 4 && xml.status == 200)
		{
			//zan.innerHTML = xml.responseText;
			if(xml.responseText==-1){
				alert('你2分钟前才赞过！等下再来吧~~');
			}
			else{
				zan.innerHTML = xml.responseText;
			}
		}
	}
	xml.send();
}


/*
var url = "zan.php?replyid="+replyid.value;
	xml.open("GET",url,true);
	xml.onreadystatechange = function(){
		if(xml.readyState == 4 && xml.status == 200)
		{
			zan_no.innerHTML = xml.responseText;
		}
	}
	xml.send();
}

	var str = "replyid="+replyid.value;
	xml.open("POST","zan.php",true);
	xml.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
	xml.onreadystatechange = function(){
		if(xml.readyState == 4 && xml.status == 200)
		{
			zan_no.innerHTML = xml.responseText;
		}
	}
	xml.send(str);
*/

	
	
	
	
	
	
	
	
	
