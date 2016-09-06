/*

$(function(){
$('#file').change(function(){
$('#filetxt').val($('#file').val());
});
});
	
	
function submitfile(){
	var filetxt = document.getElementById("filetxt");
	var file = document.getElementById("file");
	//obj.select();
	//document.selection.clear(); 
	//obj.outerHTML=obj.outerHTML;   //清空上传文件
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

		}
	}
}
*/