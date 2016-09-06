<?php
	require "bbs_conn.php";
	$postid=$_GET['postid'];
	$res=mysql_query("delete from posts where postid='$postid'",$com);
	if($res){
		header("location:manage.php?value=帖子管理");	//直接赋值！
	}
	else{
		echo "error!";
	}