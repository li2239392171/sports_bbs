<?php	error_reporting(0);
include "conn/bbs_conn.php";   //<title>主页显示帖子的主要信息</title>	

	$input_title = isset($_POST['input_title'])? $_POST['input_title'] : '';
	
	$post_content = isset($_POST['post_content'])? $_POST['post_content'] : '';

	$filename = time().substr($_FILES['photo']['name'], strrpos($_FILES['photo']['name'],'.'));

	$response = array();

	if(move_uploaded_file($_FILES['photo']['tmp_name'], $filename)){
		$response['isSuccess'] = true;
		$response['input_title'] = $input_title;
		$response['post_content'] = $post_content;
		$response['photo'] = $filename;
	}else{
		$response['isSuccess'] = false;
	}
	echo json_encode($response);

	$sql="insert into picture(path) values('$filename')";
	$res=mysql_query($sql,$com);
	
	
	

	

/*
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="css/input.css">
</head>
<body>
	$postid=$_POST['postid'];
	if(isset($_POST) && $_SERVER['REQUEST_METHOD']=='POST'){
		if ((($_FILES["file"]["type"] == "image/gif")||($_FILES["file"]["type"] == "image/jpeg")
			||($_FILES["file"]["type"] == "image/png"))&&($_FILES["file"]["size"] < 2000000))
		{
				if ($_FILES["file"]["error"] > 0)
				{
					echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
				}
				else
				{
					echo "Upload: " . $_FILES["file"]["name"] . "<br />";
					echo "Type: " . $_FILES["file"]["type"] . "<br />";
					echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
					echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

					if (file_exists(iconv("UTF-8","GB2312","upload/" . $_FILES["file"]["name"])))
						{
							echo $_FILES["file"]["name"] . " already exists. ";
						}
					else
					{
						move_uploaded_file($_FILES["file"]["tmp_name"],iconv('UTF-8','gb2312',"upload/" . $_FILES["file"]["name"]));	//iconv()解决文件名中文乱码
						echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
			  
						$time=date("Y-m-d H:i:s");
						$filename = $_FILES["file"]["name"];
						$str = "upload/".$filename;
						$sql = "insert into picture(path,postid,savetime) values('$str',,)";
						$res = mysql_query($sql,$com);
						if($res)
						{
							echo "";
						}
					}
				}	
		}
		else
		{
			echo "Invalid file";
		}
	}
	</body>
</html>
*/


?>

