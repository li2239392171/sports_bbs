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
<?php	//include "bbs_conn.php";
	$replyid = $postid = "";
	$replyid=$_GET['replyid'];
	$postid=$_GET['postid'];
	session_start();

/*	
	if(isset($_SESSION['like'.$replyid]))
	{
		$status=-1;
		echo $status;
		return;
	}
	else{
		$_SESSION['like'.$replyid] = 'like'.$replyid;
*/
	if($replyid)
	{
		$name = $_SESSION['current_user'];
		$newtime = date('Y-m-d H:i:s');
		$sql = "select * from zan_reply where replyid='$replyid' and name='$name' order by time desc limit 1";
		$res = mysql_query($sql,$com);
		$data = mysql_fetch_array($res);
		$oldtime = $data['time'];
		$time=time()-strtotime($oldtime);
		if($time<2*60)	//判断距离上次点赞时长
		{
			$a = -1;
			echo $a;
			return;
		}
		else
		{
			$sql1 = "insert into zan_reply(name,replyid,time) values('$name',$replyid,'$newtime')";
			$res1 = mysql_query($sql1,$com);
			if($res)
			{
				$sql2 = "select count(zanid) from zan_reply where replyid='$replyid'";
				$res2 = mysql_query($sql2,$com);
				$row2 = mysql_num_rows($res2);
				$data = mysql_fetch_array($res2);
				$zan_no = $data['count(zanid)'];
				echo $zan_no;
			}
		}	
	}
	else if($postid)
	{
		$name = $_SESSION['current_user'];
		$newtime = date('Y-m-d H:i:s');
		$sql = "select * from zan_post where postid='$postid' and name='$name' order by time desc limit 1";
		$res = mysql_query($sql,$com);
		$data = mysql_fetch_array($res);
		$oldtime = $data['time'];
		$time=time()-strtotime($oldtime);
		if($time<2*60)
		{
			$a = -1;
			echo $a;
			return;
		}
		else
		{
			$sql1 = "insert into zan_post(name,postid,time) values('$name',$postid,'$newtime')";
			$res1 = mysql_query($sql1,$com);
			if($res)
			{
				$sql2 = "select count(zanid) from zan_post where postid='$postid'";
				$res2 = mysql_query($sql2,$com);
				$row2 = mysql_num_rows($res2);
				$data = mysql_fetch_array($res2);
				$zan_no = $data['count(zanid)'];
				echo $zan_no;
			}
		}	
	}
?>