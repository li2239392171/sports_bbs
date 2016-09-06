<!DOCTYPE HTML>
<?php include "bbs_conn.php";?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>注册界面</title>
		<link rel="stylesheet" type="text/css" href="css/register.css" />
	</head>
	<body>	
	
	<?php		
		$username = check_input($_POST["username"]);  
		$password = check_input($_POST['password']);  
		$repeat_pw = check_input($_POST['repeat_pw']);
		if ($_SERVER["REQUEST_METHOD"] == "POST") {    //判断提交的数据是否是POST方式传来的 (不点击提交按钮，无法传送，值为false)
			$key = 1;    //判断是否所有输入都满足条件
			if(!preg_match("/^[0-9a-zA-Z_\x{4e00}-\x{9fa5}]{2,6}+$/u",$username))   //【正则表达式】php验证用户名是否是数字、字母下划线、汉字组成的，限制字符长度
			{
				$nameerr = "输入字符不合法！";
				$key = 0;
			}
			if(!preg_match('/^[_0-9a-z]{2,4}+$/i',$password))  //php正则验证密码规则只允许 数字、字母、下划线；最短6位、最长16位
			{	
				$pwerr1 = "密码不符合格式！";	
				$key = 0;
			}
			else
			{
				//if(strlen($password)<3)
				//{	
				//	$pwerr2 = "密码不能少于三位！";	
				//}
				if($repeat_pw!=$password){			
					$pwerr3 = "两次输入的密码不一致！";		
					$key = 0;					
				}
			}
		}
		
		function check_input($data){
			$data = trim($data);      //（通过 PHP trim() 函数）去除用户输入数据中不必要的字符（多余的空格、制表符、换行）
			$data = stripslashes($data);    //（通过 PHP stripslashes() 函数）删除用户输入数据中的反斜杠（\）
			$data = htmlspecialchars($data);  // 把一些预定义的字符转换为 HTML 实体。例如："<" （小于）和 ">" （大于）
			return $data;
		}
		
		/*
		if(function_exists("date_default_timezone_set"))
		{
			date_default_timezone_set("PRC");     // 设置中国时区
		}
		*/
		
		if($key == 1)
		{		
			 //查询不区分大小写，因此注册不允许类似 ’风轻云淡AAA‘和’风轻云淡Aaa‘同时出现！
			$exist = "select * from users where username='$username'";    
			$result_exist = mysql_query($exist,$com) or die(mysql_error());
			//mysql_query() 在执行成功时返回一个资源标识符/TRUE，出错时返回 FALSE
			$rows = mysql_num_rows($result_exist);    //用mysql_num_rows()获得查询结果
			// echo $rows;
			// echo $result_exist;    //$result_exist结果得到标识符，无法判断真假
			if($rows > 0)
			{
				// alert提示框中如何同时显示汉字和php变量！！
				echo '<script>window.alert("用户',$username,'已存在!"); location.href="bbs_register.php";</script>';
			}

			else
			{
				$jointime = date("Y-m-d H:i:s");
				// 密码加密后字符长度为20~30位，因此数据库表中的password属性长度设置要足够大，否则保存的加密数据不完整！！！
				$save_register = "Insert into users(username,password,jointime,image) Values ('$username',MD5($password),'$jointime','images/member.png')";   //password($password)
				//先给用户添加默认头像
				$result = mysql_query($save_register,$com) or die(mysql_error());				
				
				if($result){
					echo "<script>alert('注册成功！'); location.href='bbs_login.php';</script>";
				}				
			}	
		}
	?>
		
		<div class="all">
			<div class="back">
				<a class="return" href="javascript:;" onclick="javascript:history.back(-1);"> <b> < </b>返回上一页 </a>
			</div>
			<div class="main">
				<div class="logo">
					<img src="images/lo2.png">
				</div>
				<form action="<?php echo  htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<div class="form">
						<div class="input">
							<input id="uname" type="text" name="username" required="required" placeholder="用户名/昵称" autocomplete="off" />
							<span><?PHP echo $nameerr;?></span>
							<input id="pw" type="password" name="password" required="required" placeholder="密码" autocomplete="off" />
							<span><?PHP echo $pwerr1;?></span>
							<span><?PHP echo $pwerr2;?></span>
							<input id="repeat-pw" type="password" name="repeat_pw" required="required" placeholder="确认密码" autocomplete="off" />
							<span><?PHP echo $pwerr3;?></span>
						</div>
						 <!--验证码-->
						<!--<div class="verification-code">    
							<input id="veri-code" type="text" name="verification_code" required="required" placeholder="输入右侧验证码" />
							<img src="" id="code-img" />
						</div>
						
						<div class="read-agree">
							<input type="checkbox" name="agreement" />阅读并接受
							<a href=" " class="agree-text">《xxx协议》</a>
						</div>	
						-->
						<div class="register-button">
							<input id="button" type="submit" value="注册" onclick="check()" />
						</div>
						<div class="have-acc">
							<a href="bbs_login.php" class="re-login">已有帐号，前往登录 <b> > </b> </a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
				