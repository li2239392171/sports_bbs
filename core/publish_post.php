
<?php
	$hostname = "127.0.0.1";       //用127.0.0.1会比localhost刷新页面数据快！！
	$database = "bbs";
	$db_username = "kebi";
	$db_password = "123";
	$com = mysql_connect($hostname,$db_username,$db_password) or trigger_error("A error exist when connect the database!",E_USER_ERROR);

	$db = mysql_select_db($database,$com) or die(mysql_error());

	mysql_query("set names utf8");     //格式设置，解决数据库中文乱码问题！！
	 
	// 设置中国时区
	if(function_exists("date_default_timezone_set"))
	{
		date_default_timezone_set("PRC");     
	}
	 
	 //error_reporting(0);    //屏蔽一些不必要的提示和警告！！
	 ini_set("error_reporting","E_ALL & ~E_NOTICE");
?>	
			
<?php	error_reporting(0); 

				session_start();    //必须！！否则不能得到$_SESSION['current_user']的值！！
				$username=$_SESSION['current_user'];
				$title = $_POST['input_title'];
				$content = $_POST['post_content'];
				$wtime=date("Y-m-d H:i:s");
				
				$filetype = $_FILES["photo"]["type"];
				$filesize = $_FILES["photo"]["size"];
				
				$response = array();
				
				if(empty($_FILES["photo"]["name"]))
				{
					$sql = "insert into posts(author,title,content,wtime) values('$username','$title','$content','$wtime')";
					$res = mysql_query($sql,$com);
				
					$response['isSuccess'] = true;
				}
				else
				{
					if(($filetype == "image/gif")||($filetype == "image/jpeg")||($filetype == "image/png")
					||($filetype == "image/pjpeg")||($filetype == "image/x-png"))
					{
						$key = 0;
						if ($_FILES["file"]["error"] > 0)
						{
							$response['isSuccess'] = false;
							$response['file_error'] = "error code: ".$_FILES["file"]["error"];
							$key = 0;
						}
						else{
							if($filesize > 2000000){
								$response['isSuccess'] = false;
								$response['error_size'] = "图片太大!";
								$key = 0;
							}
							else{
								$photoname = time().substr($_FILES['photo']["name"], strrpos($_FILES["photo"]["name"],'.'));
								if(move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/posts/".$photoname))	//此处的move_upload_file和["tem_name"],书写错误，调了3个小时！！！！
								{
									$key = 1;
								}
								else{
									$response['isSuccess'] = false;
									$response['error_upload'] = "下载出错！";
									$key = 0;
								}
							}
						}	
						if($key == 1){
							if(!empty($photoname))
							{
								$path = "upload/posts/".$photoname;	//存路径
								$sql = "insert into posts(author,title,content,wtime,picture) values('$username','$title','$content','$wtime','$path')";
								$res = mysql_query($sql,$com);

									$response['isSuccess'] = true;

							}
							else{
								$sql = "insert into posts(author,title,content,wtime) values('$username','$title','$content','$wtime')";
								$res = mysql_query($sql,$com);

								$response['isSuccess'] = true;
				
							}
						}						
					}
					else{
						$response['isSuccess'] = false;
						$response['error_type'] = "文件格式不符合！";
					}		
				}

				echo json_encode($response);

?>
