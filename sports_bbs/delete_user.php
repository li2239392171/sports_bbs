<?php
	require("bbs_conn.php");
	$name=$_GET['username'];
	$res=mysql_query("update users set status=0 where username='$name'",$com);
	if($res){
		header('location:manage.php');
	}
	else{
		echo "error!";
	}

?>
