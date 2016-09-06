<html>
<head>
<link rel="shortcut icon" href="images/use.ico">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
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

</body>
</html>