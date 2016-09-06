<?php include "bbs_conn.php";
	session_start();
	$re_author=$_SESSION['current_user'];
	$postid=$_GET['postid'];
	$re_content = $_GET['reply_content'];
	$re_time=date("Y-m-d H:i:s");
	
	if($re_content)     
	{
	$sql = "insert into reply_post(re_author,re_content,re_time,postid) values('$re_author','$re_content','$re_time','$postid')";
	$res = mysql_query($sql,$com);
	}

		//列出对应帖子的所有回复...
	$sql2 = "select * from reply_post where postid=$postid";
	$res2 = mysql_query($sql2,$com);
	$row2 = mysql_num_rows($res2);
	if($row2)
	{	
		for($i=0;$i<$row2;$i++)
		{
			$username=$picture=$re_content2=$re_time2=$replyid="";   //清空值
			$data2 = mysql_fetch_array($res2);
			$re_author2=$data2['re_author'];
			$re_content2 = $data2['re_content'];
			$re_time2 = $data2['re_time'];
			$replyid = $data2['replyid'];
				
			$sql3 = "select * from users where username='$re_author2'";    //获取回复者的用户名和头像
			$res3 = mysql_query($sql3,$com);
			$row3 = mysql_num_rows($res3);
			if($row3)
			{	
				$data3 = mysql_fetch_array($res3);
				$username=$data3['username'];
				$image = $data3['image'];
			}
			
				//获取回复的点赞数
			$sql4 = "select count(zanid) from zan_reply where replyid=$replyid";
			$res4 = mysql_query($sql4,$com);
			$row4 = mysql_num_rows($res4);
			$data4 = mysql_fetch_array($res4);
			$zan_no = $data4['count(zanid)'];
			
?>
				<!---->
			<html>
			<head>		
				<title>帖子讨论区</title>
			</head>
			<body>
			<div id="repostinfo">	
				<div id="reuser-info">
					<div id="rehead-img">
						<a target="_blank" href="person_info.php?username=<?php echo $re_author2;?>">
						<img src="<?php echo $image; ?>"></a></div>
					<div id="reusername"><?php echo $re_author2; ?></div>
				</div>
				
				<div id="recontent">
					<div class="retext"><?php echo $re_content2; ?></div>
				</div>
				<div id="zan_re">
					<a href="javascript:;" name="<?php echo $replyid;?>" onclick="zan_reply(this)"><img src="images/zan1.png"></a>		
					(<span id=<?php echo $replyid;?>><?php echo $zan_no;?></span>)	
				</div>
				<?php
					session_start();
					$user=$_SESSION['current_user'];
					if($user==$re_author2)
					{			
				?>
							
				<div id="re_del"><a href="del_post.php?replyid=<?php echo $replyid;?>">删除</a></div>
					
				<?php	
					}
				?>
				<div id="retime"><?php echo $re_time2; ?></div>
						<!--多级回复-->
				<!--
				<button id="show_input" onclick="show_reply()">回复</button>
				<div id="re_reply">
					<input type="text" name="in_reply" id="in_reply" placeholder="输入回复" />
					<input type="button" id="send" value="发送" onclick="show_comment()" />
					<div id="show_reply"></div>
				</div>
				-->
			</div>	

			
			</body>
			</html>
			<?php
		}
	}
	// if($res)
	// {	
		// echo "<script>alert('已发表回复！');</script>";      //双引号中不能嵌套双引号，相邻的符号不能相同，用单引号代替
	// }
	// else
	// {
		// echo "<script>alert('回复失败！');</script>";
	//}
?>					
													