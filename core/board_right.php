	<!------------ 管理员 -------------->

					<div id="sign">
						<button class="sbutton blue" onclick="addexp();">签到</button>
					</div>
					<?php
						$res5=mysql_query("select * from administrator",$com);
						$data5=mysql_fetch_array($res5);
						$admin_image=$data5['image'];
						if(isset($_SESSION['current_admin'])){
							$current_admin=$_SESSION['current_admin'];
						}
						else{
							
							$current_admin=$data5['name'];
						}
						
					?>
					<div id="medorator">
						<label>版主</label>
						<span><img src=<?php echo $admin_image;?>></span>
						<span id="medname">
						<a href="person_info.php?username=<?php echo $current_admin;?>"><?php echo $current_admin;?></a>
						</span>
						<?php
							if(!isset($_SESSION['current_admin'])){

						?>
						<a class="admin_login" href="admin_login.php">管理员登录</a>
						<?php
							}
							else{
						?>
							<a class="admin_login" href="manage.php">进入管理界面...</a>
						<?php
							}
						?>

					</div>	

					<div id="posts-top">
						<span>帖子点击量top5</span>
					<!--<a href="person_info?username=<?php //echo $username;?>">(清风...)</a>-->
					<?php include "bbs_conn.php";
						$sql = "select * from amount order by pageviews desc limit 5";
						$res = mysql_query($sql,$com);
						$row = mysql_num_rows($res);
						

						for($i=1; $i<=$row; $i++)
						{
							$data = mysql_fetch_array($res);
							$postid = $data['postid'];

							$sql2 ="select * from posts where postid='$postid'";
							$res2 = mysql_query($sql2);
							$data2 = mysql_fetch_array($res2);
							$title = $data2['title'];
						?>
						<div id="posttop"><label><?php echo $i;?></label> <a href="post_info.php?postid=<?php echo $postid;?>"><?php echo $title;?></a></div>

						<?php
						}
					?>

					</div>

					<div id="user-top">
						<span>top3用户榜</span>
					<?php
						$sql3 = "select * from experience order by total desc limit 3";
						$res3 = mysql_query($sql3,$com);
						$row3 = mysql_num_rows($res3);
						

						for($i=1; $i<=$row3;$i++)
						{
							$data3 = mysql_fetch_array($res3);
							$username3 = $data3['username'];
							$total = $data3['total'];

							$sql4 ="select * from users where username='$username3'";
							$res4 = mysql_query($sql4);
							$data4 = mysql_fetch_array($res4);
							$image = $data4['image'];
						?>
						<div id="uesrtop"><label><?php echo $i;?></label> 
							<img src=<?php echo $image;?>>
							<a href="person_info.php?username=<?php echo $username3;?>"><?php echo $username3;?></a><span><?php echo $total;?></span>
						</div>

						<?php
						}
					?>

					</div>

					
					