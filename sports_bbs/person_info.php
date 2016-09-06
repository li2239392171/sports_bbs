<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>个人中心</title>	
		<link rel="shortcut icon" href="images/use.ico">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/person_info.css">
	</head>
	<body>
		<?php include "bbs_conn.php";  //<link rel="stylesheet" type="text/css" href="css/person_info.css">
			$username=$_GET['username'];
			$sql = "select * from users where username='$username'";
			$res = mysql_query($sql,$com);
			$row = mysql_num_rows($res);    
			if($row){
				//echo "456";
				$image = "";
				$data = mysql_fetch_array($res);         //个人基本信息
				//$userid = $data['userid'];
				$nickname = $data['nickname'];
				$sex = $data['sex'];
				$jointime = $data['jointime'];
				$image0 = $data['image'];
				$signature = $data['signature'];
				
				$sql2 = "select count(postid) from posts where author='$username' ";
				$res2 = mysql_query($sql2,$com);
				$row2 = mysql_num_rows($res2);
				if($row2){
					$data2 = mysql_fetch_array($res2);
					$postno = $data2['count(postid)'];       //帖子数
				}
				
				$sql3 = "select count(replyid) from reply_post where re_author='$username' ";
				$res3 = mysql_query($sql3,$com);
				$row3 = mysql_num_rows($res3);
				if($row3){
					$data3 = mysql_fetch_array($res3);
					$replyno = $data3['count(replyid)'];       //回复数
				}
				
				/*关注和粉丝*/	
				$concernno = $fansno ="";
				$sql5 = "select count(relationid) from relation where fans='$username' ";
				$res5 = mysql_query($sql5,$com);
				$row5 = mysql_num_rows($res5);	
				$data5 = mysql_fetch_array($res5);
				$concernno = $data5['count(relationid)']; 
				//$concernno = $row5;       //关注数

				
				$sql6 = "select count(*) from relation where concern='$username' ";
				$res6 = mysql_query($sql6,$com);
				$data6 = mysql_fetch_array($res6);
				$fansno = $data6['count(*)']; 
				//$fansno = $row6;       //粉丝数
				
				$sql7 = "select * from experience where username='$username' ";
				$res7 = mysql_query($sql7,$com);
				$data7 = mysql_fetch_array($res7);
				$total = $data7['total']; 
			}

			
		?>
		
		<div id="all">
			<div id="head">
				<?php include "bbs_head.php"; ?>
			</div>
			<div id="info">
				<div id="above">
					<div id="head_img">
							<img src=<?php echo $image0;?>>		<!--这里的$image会与head.php文件里的变量重名，应注意！-->
							<div id="contact">
								<div id="count_no"><?php echo $fansno;?><span><?php echo $concernno;?></span></div>
								<div id="fan">粉丝<span>关注</span></div>
							</div>
					</div>
					<div id="concern">
						<div id="user"><?php echo $username;?></div>
						<div id="addconcern"><a href="javascript:;" onclick="addconcern();"> 
						<?php    
							session_start();
							if(isset($_SESSION['current_user']))
							{		
								$fans = $_SESSION['current_user'];
								$concern = $username;
								$sql4 = "select * from relation where fans = '$fans' and concern = '$concern'";
								$res4 = mysql_query($sql4,$com);
								$row4 = mysql_num_rows($res4);
								
								if(!($fans == $concern)){         //只有查看其它用户时显示
									if(!$row4)
									{	
									?>	
									<b>+关注</b>
									<?php
									}
									else{
									?>
									<b>取消关注</b>
									<?php
									}	
								}	
							}
						?>
						</a></div>
					</div>
					
					<div id="footprint">
						<ul>
							<li id="postno">发帖数：<?php echo $postno;?></li>
							<li id="replyno">回复数：<?php echo $replyno;?></li>
						</ul>					
					</div>
				</div>
				
				<div id="my_post">
					<div id="lead">
						<input type="hidden" id="username" value="<?php echo $username; ?>" placeholder="隐藏属性，用于传值！" />				
						<a href="javascript:;" onclick="personal_post()">我的主页</a>					
					</div>
					<div id="list"><!--个人帖子--></div>
				</div>
				
				<div id="basicinfo">
					<ul>
						<div id="userinfo">用户资料</div>
						<?php
							if($username == $_SESSION['current_user'])
							{
						?>
								<label id="open" class="openout" onmouseout="this.className='openout'" onmouseover="this.className='openover'">修改资料</label>
						<?php
							}
						?>
						<li>昵称：<span><?php echo $nickname;?></span></li>
						<li>性别：<span><?php echo $sex;?></span></li>
						<li>经验值：<span id="jifen"><?php echo $total;?></span></li>
						<li>注册时间：<span><?php echo $jointime;?></span></li>
						<li>个性签名：<span><?php echo $signature;?></span></li>
					</ul>
				</div>
			</div>
			
			<div class="mask" id="mask"></div> 
			
			<div id="modify">
				<?php include "edit_info.php"; ?>
			</div>     	<!--修改资料弹窗-->
			
			<div id="foot">
				<span id="about">关于本站</span>|<span id="problem">问题反馈</span>|<span id="contact">联系我们</span>
				<div id="explain">©2016.6 All Rights Reserved.Powered by Internet by lgq.</div>
			</div>
		</div>
		<script src="js/main.js"></script>	
		<script src="js/person.js"></script>	
	</body>
</html>
				
					
				
	