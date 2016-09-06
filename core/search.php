<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset = UTF-8" />
		<title>search</title>
		<link rel="shortcut icon" href="images/use.ico">
		<link rel="stylesheet" type="text/css" href="css/search.css">
		
	</head>

	<body>
		<div id="all">
			<!-----------------------网页头部---------------------->
			<div id="head" name="head">			
				<?php include "bbs_head.php"; ?>  						
			</div>
			
			<!-----------------------网页主体，框架---------------------->
			<div id="main">     
			
			    <!-- ---------------版块介绍----------------- -->
				<div id="intro">    
					<h3>搜索区</h3> 
					<div id="search">
						<script type="text/javascript">
								function search(){
							var search_input = document.getElementById("search_input");
							if (search_input.value == "") {
								search_input.focus();
								return false;
							}
							else{
								location.href="search.php?keyword="+search_input.value;
							}
						}

						</script>
							<input type="text" name="keyword" id="search_input" placeholder="输入关键字搜索帖子"/>
							
							<button type="button" id="submit_find" onclick="search();"></button>
					</div>
					<hr/>
				</div>
					<!-- ----------------------帖子区------------------------ -->
				<div id="posts">  

			<?php include "bbs_conn.php";

				header("Content-Type:text/html; charset=UTF-8");

				$keyword = $_GET['keyword'];
				$sql = "select * from posts where title like '%$keyword%' or content like '%$keyword%' order by wtime desc";		
				$res = mysql_query($sql,$com);
				$row = mysql_num_rows($res);
	
				if($row){
					?>
					<div id="remind">
						<h4>帖子标题搜索：<span><?php echo $keyword;?></span></h4>
						<label>搜索结果：<span><?php echo $row;?></span> 条记录</label>
						<a href="bbs_forum.php"><< 返回首页</a>
					</div>
					<div id="top">
						<label id="theme">帖子</label>
						<label id="author">作者</label>
						<label id="wtime">发布时间</label>
						<label id="visit_num">浏览量</label>
						<label id="reply_num">回复</label>				
					</div>
					<?php
					for($i=0; $i<$row; $i++)
					{

						$data = mysql_fetch_array($res);
						$title = $data['title'];
						$author = $data['author'];
						$wtime = $data['wtime'];
						$postid = $data['postid'];
						$content = $data['content'];

							//高亮显示关键字!!
						//$title = preg_replace("/($keyword)/i", "<b style=\"color:red\">\\1</b>", $title);			//该方法会出现$title内容乱码情况
						$title = str_replace("$keyword", "<b><font color='red'>$keyword</font></b>", $title);
						$content = str_replace("$keyword", "<b><font color='red'>$keyword</font></b>", $content);

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
						<div class="list_post">
								<a href="post_info.php?postid=<?php echo $postid; ?>" target="_blank"><?=$title?></a>
								<span id="content">&nbsp&nbsp<?php echo $content;?></span>
						</div>
						<div class="list_right">
							<div class="list_write">
								<a target="_blank" href="person_info.php?username=<?php echo $author;?>"><?php echo $author; ?></a>
							</div>				   
							<div class="list_time">
								<span class="red"><?php echo $wtime; ?></span>							
							</div>
							<div class="list_visit">
								<span class="date"><?php echo $pageviews; ?></span>
							</div>
							<div class="list_reply">
								<span class="date"><?php echo $replyno; ?></span>
							</div>
						</div>
					</div>
					<hr />
					<?php	
					}
				}
				else{
					?>
					<div id="remind">
						<label>帖子标题搜索:<span><?php echo $keyword;?></span></label>
					</div>
					<div id="no_result">
						<label>很抱歉，没有找到与“<span><?php echo $keyword;?></span>”相关的帖子</label>
					</div>
					<?php
				}

			?>
				</div>												
			</div>
			<div id="foot">
				<span id="about">关于本站</span>|<span id="problem">问题反馈</span>|<span id="contact">联系我们</span>
				<div id="explain">©2016.6 All Rights Reserved.Powered by Internet by lgq.</div>
			</div>
		</div>
	</body>
</html>