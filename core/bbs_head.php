<!-- 前后的<html><body>和</body></html>标签可以省略，方便查看源代码的逻辑性！-->
		<div id="logo">
			<a id="logo" href="bbs_forum.php"><img src="images/b.png" /></a>
		</div>
		<?php 	include "bbs_conn.php";
			session_start();
			if(!isset($_SESSION['current_user'])&&!isset($_SESSION['current_admin']))
			{
			// echo '  <img class="" src="images/logo.jpg">';
			// echo '	<div class="welcome">';
			// echo '	<h4>欢迎来到本站，请先</h4><a href="bbs_login.php" class="login">登录</a>或者<a href="bbs_register.php" class="register">注册</a>';
			// echo '  </div>';	
		?>		
		<!-------------用户为游客状态------------>
			<div id="welcome">
				<div id="show_name"></div><label>欢迎来到本站，请先</label><a href="bbs_login.php" id="login">登录</a>或者<a href="bbs_register.php" class="register">注册</a>
			</div>	
		<?php 
			}
			else if(isset($_SESSION['current_user']))
			{
			$current_user=$_SESSION['current_user'];
			$sql = "select image from users where username='$current_user'";
			$res = mysql_query($sql,$com);
			$data = mysql_fetch_array($res);
			$image = $data['image'];
		?>	
		<!-------------会员状态------------>
			<a id="quit" href="logout.php">退出</a>
			<div id="">
				<div id="welcome">
					<img src="<?php echo $image; ?>" >
					<span id="show_name">
						<a href="person_info.php?username=<?php echo $current_user;?>" target="_blank"><?php echo $current_user;?></a>
					</span>欢迎来到本站
				</div>
			</div>	
		<?php 
			}
			else if(isset($_SESSION['current_admin']))
			{
			$current_admin=$_SESSION['current_admin'];
			$sql = "select image from administrator where name='$current_admin'";
			$res = mysql_query($sql,$com);
			$data = mysql_fetch_array($res);
			$image = $data['image'];
		?>	
		<!-------------管理员状态------------>
			<a id="quit" href="admin_logout.php">退出</a>
			<div id="">
				<div id="welcome">
					<img src="<?php echo $image; ?>" >
					<span id="show_name">
						<a href="person_info.php?username=<?php echo $current_admin;?>" target="_blank"><?php echo $current_admin;?></a>
					</span>欢迎管理员来到本站
				</div>
			</div>	
		<?php 
			}
		?>

