<?php	include "bbs_conn.php";   //<title>主页显示帖子的主要信息</title>
	
	$total = mysql_fetch_array(mysql_query("select count(postid) from posts"));    //查询数据库中一共有多少条数据   
	$sum=$total[0];   //帖子总数
	$perpagenum = 10;    //定义每页显示几条 
	$totalpage = ceil($sum/$perpagenum);   //上舍，取整    
	   
		//if(!isset($_GET['page'])||!intval($_GET['page'])||$_GET['page']>$Totalpage) //page可能的四种状态    
	if(!isset($_GET['page'])||!intval($_GET['page'])||$_GET['page']>$totalpage)
	{
		$page = 1;
	}
	else   
	{
		$page = $_GET['page'];
	}
		
	$startnum = ($page-1)*$perpagenum;//开始条数    
	$sql = "select * from posts order by wtime desc limit $startnum,$perpagenum";   //查询出所需要的条数    
	//echo $sql."    ";  
	$res = mysql_query($sql);
	$data = mysql_fetch_array($res);
	//$rows=mysql_num_rows($res);
	

	if($total) //如果$total不为空则执行以下语句    
	{    
    do    
    {  	
			$re_author=$re_time=$time2=$time1="";       //将对应值还原为空，重新赋值！！
		        //获取页数上对应的主题帖信息
			//$data=mysql_fetch_array($res);
			$title=$data['title'];
			$author=$data['author'];
			$wtime=$data['wtime'];  $time1 = date('m-d H:i',strtotime($wtime));  //获取时间的输出格式，先用strtotime()转成时间戳！！！
			$postid=$data['postid'];
			
			    //获取主题帖对应的最后回帖信息
			$sql2="select * from reply_post where postid='$postid' order by re_time desc limit 1";
			$res2=mysql_query($sql2,$com);
			$rows2 = mysql_num_rows($res2);
			if($rows2 > 0)
			{
				$data2 = mysql_fetch_array($res2);
				$re_author = $data2['re_author'];
				$re_time = $data2['re_time'];	 $time2 = date('m-d H:i',strtotime($re_time));  //获取时间的输出格式	 	
			}
			
			
				//统计帖子浏览量
			$sql4= "select * from amount where postid='$postid'";	
			$res4=mysql_query($sql4,$com);
			$data4=mysql_fetch_array($res4);
			$pageviews=$data4['pageviews'];
			if(empty($pageviews)){
				$pageviews = 0;
			}
			
				//统计帖子回复
			$sql5= "select count(replyid) from reply_post where postid='$postid'";	
			$res5=mysql_query($sql5,$com);
			$data5=mysql_fetch_array($res5);
			$replyno=$data5['count(replyid)'];
			
		?>
			<div class="contentout" onmouseout="this.className='contentout'" onmouseover="this.className='contentover'">
				<div class="list_title">
						<a href="post_info.php?postid=<?php echo $postid; ?>" title="" target="_blank"><?=$title?></a>
				</div>
				<div class="list_right">
					<div class="list_write">
						<a id="writer" target="_blank" href="person_info.php?username=<?php echo $author;?>"><?php echo $author; ?></a>
						<span class="date"><?php echo $time1; ?></span>
					</div>				   
					<div class="list_count">
						<div class="list_ount_inner">
							<span class="red"><?php echo $pageviews; ?></span>/
							<span class="red"><?php echo $replyno; ?></span>       <!--访问量 / 回复数-->
						</div>
					</div>
					<div class="list_reply">
		<?php 
			if(empty($re_author)){
				$re_author = "— —";
		?>
						<div><?php echo $re_author; ?></div>
		<?php
			}
			else{
		?>
						<a target="_blank" href="person_info.php?username=<?php echo $re_author;?>"><?php echo $re_author; ?></a>
		<?php
			}
		?>
						<span class="date"><?php echo $time2; ?></span>
					</div>
				</div>
			</div>
			<hr />
		<?php
	}    	
	while($data = mysql_fetch_array($res));//do....while  

	}	
	else  //如果$total为空则输出No message 
	{
		echo "<center>no message!</center>";
	}		
?>

			
			
			
	
	