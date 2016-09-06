<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>编辑用户资料</title>	
	</head>
	<body>	
		<?php include "bbs_conn.php";  //<link rel="stylesheet" type="text/css" href="css/person_info.css">
			session_start();
			$username=$_SESSION['current_user'];
			$sql = "select * from users where username='$username'";
			$res = mysql_query($sql,$com);
			$row = mysql_num_rows($res);  
			if($row){
				//echo "123";
				$data = mysql_fetch_array($res);         //个人基本信息
				//$userid = $data['userid'];
				$nickname = $data['nickname'];
				$sex = $data['sex'];
				$image = $data['image'];
				$signature = $data['signature'];
			}
			
			
				//保存编辑的信息
			if($_POST)
			{
				if ((($_FILES["file"]["type"] == "image/gif")||($_FILES["file"]["type"] == "image/jpeg")
				||($_FILES["file"]["type"] == "image/png"))&&($_FILES["file"]["size"] < 2000000))
				{
					if ($_FILES["file"]["error"] > 0)
					{
						echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
					}
					else
					{
					/*
						echo "Upload: " . $_FILES["file"]["name"] . "<br />";
						echo "Type: " . $_FILES["file"]["type"] . "<br />";
						echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
						echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
					*/
					$photoname = time().substr($_FILES['file']["name"], strrpos($_FILES["file"]["name"],'.'));
					/*	if (file_exists(iconv("UTF-8","GB2312","upload/" . $_FILES["file"]["name"])))
							{					//iconv(),解决file_exists()判断中文文件名无效问题
								echo $_FILES["file"]["name"] . " already exists. ";
							}
						else
						{
					*/
							move_uploaded_file($_FILES["file"]["tmp_name"],iconv('UTF-8',     //iconv(),解决中文乱码问题
							'gb2312',"upload/head/" . $photoname));
						//	echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
							
						// }123
						//$filename=="";
						//	$filename = $_FILES["file"]["name"];
							$path = "upload/head/".$photoname;
						
					}
				  }
					// else
					// {
						// echo "Invalid file";
					// }
				
				if($photoname=="")
				{
					$path = $image;
				}
				//$image2 = $_POST['image'];
				$nickname2 = $_POST['nickname'];
				$sex2 = $_POST['sex'];
				$signature2 = $_POST['signature'];
				$sql2 = "update users set image='$path',nickname='$nickname2',sex='$sex2',signature='$signature2' where username='$username' ";
				$res2 = mysql_query($sql2,$com);
				if($res2){
					echo "<script>alert('资料已修改！'); location.href='person_info.php?username=$username'</script>;";
				}
			}
		?>
		<div id="edit">
			<!--
			<div id="head" name="head">			
				<?php //include "bbs_head.php"; ?>  						
			</div>
			
			<div id="gofirst">
				<a href="bbs_forum.php" id="">论坛首页</a>
				<a href="person_info.php?username=<?php //echo $username; ?>">我的主页</a>
			</div>
			-->
			
			<div class="login" id="login"><span align="right" id="close">关闭</span></div>
			<div id="edit_region">
				<div id="edit_tip">编辑资料</div>
				<form action="edit_info.php" method="post" enctype="multipart/form-data">
					<ul>
						<li>头像：<input type="file" name="file" id="file" />
						<li>昵称：<span><input name="nickname" type="text" value="<?php echo $nickname;?>" /></span></li>
						<li>性别：
						<span>
							<select name="sex" id="select">
								<option>男</option>
								<option>女</option>
							</select>
						</span></li>
						<li>个性签名：<span><input name="signature" type="text" value="<?php echo $signature;?>" /></span></li>
						<input type="submit" id="save" value="保存" />
				</form>
			</div>
		</div>
		<script src="js/person.js"></script>
	</body>
</html>
