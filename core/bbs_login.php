<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>登录界面</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>
	<body>
		<?php include "bbs_conn.php"; ?>
		<?php
			$username = $_POST["username"];  
			$password = $_POST['password'];
			if($_SERVER["REQUEST_METHOD"]== "POST")
			{
				$key = 1;
				if(!preg_match("/^[0-9a-zA-Z_\x{4e00}-\x{9fa5}]{2,6}+$/u",$username))
				{
					$nameerr = "输入字符不合法！";
					$key = 0;
				}
				if(!preg_match("/^[0-9a-z]{2,6}+$/u",$password))
				{	
					$pwerr = "密码不符合要求!";
					$key = 0;
				}
			}
			
			
			$check_uname = "select username from users where username='$username'";
			$result_check = mysql_query($check_uname,$com);
			$rows = mysql_num_rows($result_check);
			if($key == 1)
			{
				if(!$rows)
				{
					$nameerr_no = "该用户不存在";
				}
				else
				{	
					$pwd = MD5($password);
					$check = "select username from users where username = '$username' and password = '$pwd'";   //password($password)
					$result = mysql_query($check,$com);
					$rows2 = mysql_num_rows($result);
					if($rows2>0)
					{
						session_start();       //记录状态!!!!!!
						$_SESSION['current_user'] = $username;						
						echo "<script>alert('登录成功!!');location.href = 'bbs_forum.php';</script>";
					}
					else
					{
						echo "<script>alert('用户名和密码不匹配!!');location.href = 'bbs_login.php';</script>";
					}
				}
			}
				
										
		
		?>
		
		
		<div class="login-all">
			<div class="back">
				<a class="return" href="javascript:;" onclick="javascript:history.back(-1);"> <b> < </b> 返回上一页 </a>
				<a class="return_main" href="bbs_forum.php"> 返回主页 >> </a>
			</div>
			<div class="login-form">			
				<div class="login-logo">
					<img src="images/lo2.png" />
				</div>
				<form action="" method="post">
					<div class="login-in">
						<input type="text" name="username" id="username" required="required" placeholder="用户名/昵称" autocomplete="off" />
						<span><?php echo $nameerr; ?></span>
						<span><?php echo $nameerr_no; ?></span>
						<input type="password" name="password" id="password" required="required" placeholder="密码" autocomplete="off" />
					</div>
					<!--
					<div class="keep-forget">
						<input class="rem" type="checkbox" name="remember" value="1" />记住用户名
						<a href=" " class="forget-pw">忘记密码？</a>					
					</div>
					-->
					<div class="login-button">
						<input type="submit" class="button" value="登录" />
					</div>
					<div class="no-account">
						<a href="bbs_register.php" class="no-acc">没有账号？马上注册 <b>></b></a>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>