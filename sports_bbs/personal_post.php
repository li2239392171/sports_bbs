<?php include "bbs_conn.php";
	$username = $_GET['username'];
	$sql = "select * from posts where author = '$username' order by wtime desc";    //变量为字符串，必须用' '包含！！
	$res = mysql_query($sql,$com);
	$row = mysql_num_rows($res);
	
	// echo $row;     //$row可以代表帖子数！
	
	if($row)
	{
		for($i=0;$i<$row;$i++)
		{
			$title = $wtime = $postid ="";
			$data = mysql_fetch_array($res);
			$postid = $data['postid'];
			$title = $data['title'];
			$wtime = $data['wtime'];
			
		?>	
			<div class="listout" onmouseout="this.className='listout'" onmouseover="this.className='listover'">
				<div id="title"><a id="" href="post_info.php?postid=<?php echo $postid; ?>"><?php echo $title; ?></a></div>
				<span id="wtime"><?php echo $wtime; ?></span>
			</div>
			<hr />
		
		<?php
		
		}
	}
			
?>