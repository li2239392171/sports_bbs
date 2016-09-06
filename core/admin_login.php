<!DOCTYPE html>
<html>
<head>
	<title>管理员登录</title>
</head>
<body>
	<?php include "bbs_conn.php"; ?>
		<?php
			$adminname = $_POST["adminname"];  
			$password = $_POST['password'];
			if($_SERVER["REQUEST_METHOD"]== "POST")
			{
				$key = 1;
				if(!preg_match("/^[0-9a-z_A-Z\x{4e00}-\x{9fa5}]{2,6}+$/u",$adminname))
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
			
			
			$check_uname = "select name from administrator where name='$adminname'";
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
					$check = "select name from administrator where name = '$adminname' and password = '$pwd'";   //password($password)
					$result = mysql_query($check,$com);
					$rows2 = mysql_num_rows($result);
					if($rows2>0)
					{
						session_start();       //记录状态!!!!!!
						$_SESSION['current_admin'] = $adminname;				
						echo "<script>alert('登录成功!!');location.href = 'manage.php';</script>";
					}
					else
					{
						echo "<script>alert('用户名和密码不匹配!!');location.href = 'admin_login.php';</script>";
					}
				}
			}														
		?>
		
		
		<div class="login-all">
			
			<div class="login-form">			
				<div style="margin-left:25px;margin-bottom:20px;">管理员登录</div>
				<form action="" method="post">
					<div class="login-in">
						<input type="text" name="adminname" id="adminname" required="required" placeholder="管理员名称" autocomplete="off" />
						<span><?php echo $nameerr; ?></span>
						<span><?php echo $nameerr_no; ?></span>
						<br/><br>
						<input type="password" name="password" id="password" required="required" placeholder="密码" autocomplete="off" />
					</div>
					<div class="login-button" style="margin-left:30px;margin-top:10px;margin-bottom:20px;">
						<input type="submit" class="button" value="登录" />
					</div>
				
				</form>
			</div>

			<div class="back">
				<a href="javascript:;" onclick="javascript:history.back(-1);"> <b></b> << 返回上一页 </a>
			</div>
		</div>
</body>
</html>