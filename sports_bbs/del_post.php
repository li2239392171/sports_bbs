<?php include "bbs_conn.php";
		//删除帖子，以及对应的回复
	$postid=$_GET['postid'];
	$replyid=$_GET['replyid'];
	
	if($postid){
		$sql = "delete from posts where postid = $postid ";
		$res = mysql_query($sql,$com);
		$sql2 = "delete from reply_post where postid=$postid";
		$res2 = mysql_query($sql2,$com);
		if($res&&$res2)
		 {	
			 echo "<script>alert('帖子已删除！');</script>";      //双引号中不能嵌套双引号，相邻的符号不能相同，用单引号代替
			 header("location: post_info.php");
			//echo "<SCRIPT language='JavaScript'>javascript:window.history.go(1);</SCRIPT>";
		}
		else{
			echo "<script>alert('帖子删除失败！');</script>"; 
			echo "<SCRIPT language='JavaScript'>history.go(-1);</SCRIPT>"; 
		}
	}
	else if($replyid){		
		
			//删除单条回复
		$sql3 = "delete from reply_post where replyid=$replyid";
		$res3 = mysql_query($sql3,$com);
		if($res3)
		 {	
			 echo "<script>alert('回复已删除！');</script>";      //双引号中不能嵌套双引号，相邻的符号不能相同，用单引号代替
			 echo "<SCRIPT language='JavaScript'>history.back(1);</SCRIPT>";
		}
		else{
			echo "<script>alert('回复删除失败！');</script>"; 
			echo "<SCRIPT language='JavaScript'>history.back(1);</SCRIPT>";      //history.go(-1);
		}
	}
		
	
?>

