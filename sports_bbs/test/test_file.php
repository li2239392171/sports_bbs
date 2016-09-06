<?php
	$hostname = "127.0.0.1";       //用127.0.0.1会比localhost刷新页面数据快！！
	$database = "bbs";
	$db_username = "kebi";
	$db_password = "123";
	$com = mysql_connect($hostname,$db_username,$db_password) or trigger_error("A error exist when connect the database!",E_USER_ERROR);

	$db = mysql_select_db($database,$com) or die(mysql_error());

	mysql_query("set names utf8");     //格式设置，解决数据库中文乱码问题！！
	 
	// 设置中国时区
	if(function_exists("date_default_timezone_set"))
	{
		date_default_timezone_set("PRC");     
	}
	 
	 //error_reporting(0);    //屏蔽一些不必要的提示和警告！！
	 ini_set("error_reporting","E_ALL & ~E_NOTICE");
?>	


<?php	error_reporting(0);       //该页面不能用'include "conn/bbs_conn.php"; ' 方法来引入源文件，虽然我也搞不懂为什么？？？！！！

	 
	$input_title = isset($_POST['input_title'])? $_POST['input_title'] : '';
	
	$post_content = isset($_POST['post_content'])? $_POST['post_content'] : '';
	
		//获取新文件名+后缀名
	$filename = time().substr($_FILES['photo']['name'], strrpos($_FILES['photo']['name'],'.'));

	$response = array();

	if(move_uploaded_file($_FILES['photo']['tmp_name'], $filename)){
		$response['isSuccess'] = true;
		$response['input_title'] = $input_title;
		$response['post_content'] = $post_content;
		$response['photo'] = $filename;
	}else{
		$response['isSuccess'] = false;
	}
	echo json_encode($response);

	$sql="insert into posts(picture) values('$filename')";
	$res=mysql_query($sql,$com);
	
?>