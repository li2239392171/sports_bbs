function submitfile(){
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

	submitfile2();
}

function submitfile2(){
	var formData = new FormData($('#form')[0]);
	$.ajax({
		url: 'publish_post.php',
		type: 'POST',
		data: formData,
		dataType: 'JSON',
		async: false,  
		cache: false,
		processData: false,
		contentType: false
	}).done(function(ret){
		if(ret['isSuccess']){	
			alert("成功发表");
			allpost(); 
			location.href="bbs_forum.php";
		}else{
			var result = '';
			if(ret['file_error']){
				result = ret['file_error'];
			}
			else if(ret['error_size']){
				result = ret['error_size'];
			}
			else if(ret['error_upload']){
				result = ret['error_upload'];
			}
			else if(ret['error_type']){
				result = ret['error_type'];
			}
			
			alert('提交失敗');
			$('#result').html(result);
		}
	});
	return false;
}

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
