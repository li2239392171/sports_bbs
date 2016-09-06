<?php include "bbs_conn.php";
			$postid=$_GET['postid'];
			$sql = "select * from posts where postid='$postid'";
			$res = mysql_query($sql);
			$row = mysql_num_rows($res);
			if(!$row)
			{	
				header("location: error.php");
			}
			else
			{
?>
<html>
	<head>
		<link rel="shortcut icon" href="images/use.ico">
		<link rel="stylesheet" type="text/css" href="css/homepage.css">
		<link rel="stylesheet" type="text/css" href="css/post_info.css">	
		<!--<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>-->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="js/jquery.qqFace.js"></script>
		<script type="text/javascript">
			$(function(){
				$('.emotion').qqFace({
					id : 'facebox', //表情盒子的ID
					assign:'reply_content', //给那个控件赋值
					path:'images/face/'	//表情存放的路径
				});
				
			});
			//查看结果
			function replace_em(str){
				str = str.replace(/\</g,'&lt;');
				str = str.replace(/\>/g,'&gt;');
				str = str.replace(/\n/g,'<br/>');
				str = str.replace(/\[em_([0-9]*)\]/g,'<img src="images/face/$1.gif" border="0" />');
				return str;
			}
		</script>
		<title>帖子讨论区</title>
	</head>
	<body>
		<?php include "bbs_conn.php";
		
				//帖子信息
			$info = mysql_fetch_array($res);
			$author = $info['author'];
			$title = $info['title'];
			$content = $info['content'];
			$wtime = $info['wtime'];
			$picture = $info['picture'];
			
				//找出帖子作者信息
			$sql1 = "select * from users where username='$author'";
			$res1 = mysql_query($sql1);
			
			$info1 = mysql_fetch_array($res1);
			$image1 = $info1['image'];
			// $title = $info['title'];
			// $content = $info['content'];
			// $wtime = $info['wtime'];
			// $picture = $info['picture'];
			
			/*    //对应的全部回帖信息    （已在发表回帖的页面实现，并返回内容）
			$sql2 = "select * from reply_post where postid=$postid";
			$res2 = mysql_query($sql2);
			$row = mysql_num_rows($res2);
			if($row)
			{	echo "123456";
				$info2 = mysql_fetch_array($res2);
				$re_author = $info2['re_author'];
				$re_content = $info2['re_content'];
				$re_time = $info2['re_time'];			
			}
			*/
					
				//统计帖子浏览量
			session_start();
			//$pageviews=$_SESSION['post'];
			$postid=$_GET['postid'];
			if(!isset($_SESSION['post']))
			{	
				$sql3= "select * from amount where postid='$postid'";
				$res3=mysql_query($sql3,$com);
				$row3=mysql_num_rows($res3);
				if(!$row3)
				{	
					mysql_query("insert into amount(postid,pageviews) values('$postid',1)");
					session_start();
					$_SESSION['postid']=$postid;
				}
				else
				{
					mysql_query("update amount set pageviews=pageviews+1 where postid=$postid");
					session_start();
					$_SESSION['postid'] = $postid;
				}
			}
				
			$sql4= "select pageviews from amount where postid='$postid'";	
			$res4=mysql_query($sql4,$com);
			$data4=mysql_fetch_array($res4);
			$pageviews=$data4['pageviews'];
			
				//统计帖子回复
			$sql5= "select count(replyid) from reply_post where postid='$postid'";	
			$res5=mysql_query($sql5,$com);
			$data5=mysql_fetch_array($res5);
			$replyno=$data5['count(replyid)'];
			
				//获取帖子的点赞数
			$sql6 = "select count(zanid) from zan_post where postid=$postid";
			$res6 = mysql_query($sql6,$com);
			$row6 = mysql_num_rows($res6);
			$data6 = mysql_fetch_array($res6);
			$zan_pno6 = $data6['count(zanid)'];
			
		?>
			
		<div id="all">
			<!-----------------------网页头部---------------------->
			<div id="head">
				<?php include "bbs_head.php"; ?>  						
			</div>
			
			<div id="main2">
				<div id="head_below">
					<span id="tip">论坛·交流区</span>									
					<a id="return" href="bbs_forum.php"><<返回论坛首页</a>
				</div>
				
				<div id="info">
					<div id="postinfo">
						<div id="title-head">
							<span id="title"><?php echo $title; ?></span>
							<div id="total">
								<span id="read">共<label><?php echo $pageviews ;?></label>浏览</span>|
								<span id="reply"><label><?php echo $replyno;?></label>回帖</span>
							</div>
						</div>
						
						<div id="user-info">
							<div id="head-img"><img src="<?php echo $image1;?>" /> <!--<label>标签不能控制图片大小--></div>
							<a id="author" target="_blank" href="person_info.php?username=<?php echo $author;?>"><?php echo $author; ?></a>
						</div>				
						<div id="content">
							<div id="text"><?php echo $content; ?></div>
							<?php
								if($picture)
								{
							?>
								<div id="picture"><img src="<?php echo $picture; ?>" /></div>
							<?php
								}
							?>
						</div>
						
						<div id="share"> <a>分享+</a> </div>
						
						<div id="zan_post">
							<a href="javascript:;" name="<?php echo $postid;?>" onclick="zan_post(this)"><img src="images/zan1.png"></a>		
							(<span id=<?php echo $postid;?>><?php echo $zan_pno6;?></span>)	
						</div>
						
						<?php
							session_start();
							$user=$_SESSION['current_user'];
							if($user==$author)
							{
						?>			
								<div id="del"><a href="javascript:if(confirm('真的要删除帖子吗？'))window.location='del_post.php?postid=<?php echo $postid;?>'">删除</a></div>								
						<?php	
							}						
						?>							
						<div id="time"><?php echo $wtime; ?></div>		
						<a id="show_reply" href="#publish_reply">回复</a>
						
					</div>
					
					<div id="repost"><!--回帖内容--></div>
				</div>	
					
				<div id="end">
					<span><label><?php echo $replyno;?></label>回帖</span>								
					<a id="end_return" href="bbs_forum.php"><<返回论坛首页</a>
				</div>
				
				<div id="publish_reply">
					<div id="tips">发表回复</div>
					<div><img src="images/comment.png"/></div>


					<textarea id="reply_content" name="reply_content" placeholder="来说两句吧..." ></textarea>
					<p><span class="emotion">表情</span>
					<button class="sub_btn" type="button" onclick="reply()">回复</button></p>

					<input  type="hidden" id="postid" value="<?php echo $postid;?>"/>
				
					
				</div> 
			</div>
			
			<div id="foot">
				<span id="about">关于本站</span>|<span id="problem">问题反馈</span>|<span id="contact">联系我们</span>
				<div id="explain">©2016.6 All Rights Reserved.Powered by Internet by lgq.</div>
			</div>
		</div>
		<script src="js/main.js"></script>     <!--放在最后，防止标签元素未加载问题-->
		
		<script src="js/reply.js"></script>

	</body>
</html>
<?php							
			}
?>					
						
						
						
		