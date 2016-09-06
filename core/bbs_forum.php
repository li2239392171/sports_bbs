<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset = UTF-8" />
		<title>校园体育论坛</title>
		<link rel="shortcut icon" href="images/use.ico">
		<link rel="stylesheet" type="text/css" href="css/homepage.css">
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="js/save_img.js"></script>		
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
					<h3>话题区</h3> 
					<div id="search">	
							<input type="text" id="search_input" placeholder="输入关键字搜索帖子"/>
							<button type="button" id="submit_find" onclick="search();"></button>
					</div>
					<hr/>
					<div class="topdirection"></div>
					<div id="details">
						论坛介绍：供所有热爱运动的朋友们在这里交流想法，NBA、欧洲杯、美洲杯、奥运会...有话题就在这里发吧，期待你的加入。最后希望大家理性聊天(*^__^*)~~
					</div>
				</div>
				
				<!-- -------------------------帖子区---------------------------- -->
				<div id="posts">  
					<div id="search_result"> 
						<div id="category">
							<a id="topics" name="" href="javascript:;" onclick="allpost();">全部</a>
						<!--	<a id="hot" href="javascript:;" onclick="hotpost();">热点</a>
							<a id="recommend" href="javascript:;" onclick="recommendpost();">推荐</a>
							<a id="images" href="#">图片</a>
						-->
						</div>
						<div id="top">
							<label id="theme">主题</label>
							<label id="author">作者</label>
							<label id="reply_visit">浏览/回复</label>
							<label id="last_reply">最后回复</label>
						</div>
								
						<!-- ---------------帖子主题等信息！--------------------- -->
						<div id="posts_list"></div>					
					
						<div id="page">
							<?php include "paging.php";?>
							<br><hr>
						</div>					
					</div>

					<div id="">
						<iframe name="formsubmit" style="display:none;"></iframe>
					</div>

					<div id="publish">
						<div id="">
							<label id="">发表新帖</label>
						</div>	
						<div id="input_box">
															
							<form name="form" id="form" method="post" enctype="multipart/form-data">	
								
								<input type="text" name="input_title" id="input_title" placeholder="请填写标题" />
								<textarea id="input_content" class="shadow" name="post_content" placeholder="内容"></textarea>
								
								<input type="button" id="submit"  name="submit" class="button white"  value="发布" onclick="submitfile()"/>

								<input type="text" name="filetext" id="filetext"  placeholder="图片路径/名称"/>
								<input type="button" id="select" value="图片" onclick="photo.click()"/>
								<input type="file" class="photo" name="photo" id="photo" onchange="filetext.value=this.value"/>
																						
							</form>

							<div id="result"></div>
						</div>
					</div>
				</div>												
			</div>
			<!-------------------右侧信息栏-------------------------->
			<div id="board_right"><?php  include "board_right.php";?></div>	
			<div id="foot">
				<span id="about">关于本站</span>|<span id="problem">问题反馈</span>|<span id="contact">联系我们</span>
				<div id="explain">©2016.6 All Rights Reserved.Powered by Internet by lgq.</div>
			</div>
		</div>		
		<script src="js/main.js"></script>
	</body>
</html>
					
										