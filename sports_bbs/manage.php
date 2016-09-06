<?php include "bbs_conn.php";
	session_start();
	if(isset($_SESSION['current_admin']))
	{
		
		if(isset($_GET['value']))
		{
			$value=$_GET['value'];
		}
		else{
			$value="";
		}

		$admin=$_SESSION['current_admin'];
		$res=mysql_query("select * from administrator where name='$admin'",$com);
		$data=mysql_fetch_array($res);
		$image=$data['image'];
?>
<!DOCHTML>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<title>后台管理</title>
		<link rel="stylesheet" type="text/css" href="css/manage.css">
	</head>
	<body>
		<div class="all">
			<div class="head">
				<div class="logo">
					<img src="images/b.png" />
				</div>
				<a id="quit" href="admin_logout.php">退出</a>
				<div id="welcome">
					<img src="<?php echo $image; ?>" >
					<span id="show_name">

					<a href=""><?php echo $admin;?></a>
					</span>欢迎管理员来到本站
				</div>

			</div>
			<div class="tip">
				<span>当前位置：后台管理板块</span>
				<a href="bbs_forum.php">返回首页>></a>
			</div>
			<div class="main">
				<div class="left">
					<div class="list">管理列表</div>						
					<a class="user" href="manage.php?value=<?php echo "用户管理";?>">用户管理</a>
					<a class="post" href="manage.php?value=<?php echo urlencode("帖子管理");?>">帖子管理</a>						
					<a class="reply" href="manage.php?value=<?php echo "回帖管理";?>">回帖管理</a>									
				</div>
				
				<div class="right">
					<?php
						switch($value){
							case "用户管理":
								include "manage_user.php";
							break;
							case "帖子管理":
								include "manage_post.php";
							break;
							case "回帖管理":
								include "manage_reply.php";
							break;
							default:
								include "manage_post.php";
							break;
						}
					?>
				</div>

				<div id="foot">
				<span id="about">关于本站</span>|<span id="problem">问题反馈</span>|<span id="contact">联系我们</span>
				<div id="explain">©2016.6 All Rights Reserved.Powered by Internet by lgq.</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
	}
	else{

		echo "<script>alert('你不具备管理员条件！');window.location.href='admin_login.php';
		</script>;";
	}
?>
