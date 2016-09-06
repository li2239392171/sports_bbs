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

<?php
	$username = $_GET['username'];
	$newtime= date('Y-m-d H:i:s');
	$sql = "select * from experience where username='$username'";
	$res = mysql_query($sql,$com);
	$row = mysql_num_rows($res);
	$data = mysql_fetch_array($res);
	$oldtime = $data['signtime'];
	
	
	if($row >0)
	{
		$time = time()-strtotime($oldtime);
		if($time<60*60)
		{
			$a=-1;
			echo $a;
			return;
		}
		else
		{		
			$sql2 = "update experience set total=total+5,signtime='$newtime' where username='$username'";
			$res2 = mysql_query($sql2,$com);
			if($res2)
			{
				echo "<div id='sign1'>已签到！<span>+5经验</span></div>";
			}
		}
	}
	else
	{
		$value = 20;
		$sql3 = "insert into experience(total,username,signtime) values($value,'$username','$newtime')";
		$res3 = mysql_query($sql3,$com);
		$row3 = mysql_num_rows($res3);
		if($res3)
		{	
			echo "<div id='sign2'>首次签到！<span>+20经验</span></div>";
		}
	}
?>
