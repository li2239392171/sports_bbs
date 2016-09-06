<?php include "bbs_conn.php";
	session_start();
	$concern = $_GET['concern'];
	$fans = $_SESSION['current_user'];
	
	if(!($fans == $concern) && !empty($concern) && !empty($fans)){   
		$sql = "select * from relation where fans = '$fans' and concern = '$concern'";
		$res = mysql_query($sql,$com);
		$row = mysql_num_rows($res);
		
		if(!$row){
				$sql2 = "insert into relation(concern,fans) values('$concern','$fans')";
				$res2 = mysql_query($sql2,$com);
			?>		
				<b>取消关注</b>    <!--标签后不能带';'-->
			<?php
		}
		else{
			$sql3 = "delete from relation where fans = '$fans' and concern = '$concern'";
			$res3 = mysql_query($sql3,$com);
			?>		
				<b>+关注</b>
			<?php
		}

	}
?>

