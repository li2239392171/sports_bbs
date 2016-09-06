<?php require "bbs_conn.php";
	session_start();
	unset($_SESSION['current_admin']);
	echo "<center><h3>注销成功！</h3> <br /> <h4>正在跳转到主页,请稍候...</h4></center>";
	header("refresh:1;url=bbs_forum.php");
?>