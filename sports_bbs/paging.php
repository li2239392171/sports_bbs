<?php include "bbs_conn.php";

	$total = mysql_fetch_array(mysql_query("select count(postid) from posts"));    //查询数据库中一共有多少条数据   
	$sum=$total[0];   //帖子总数
	$perpagenum = 10;    //定义每页显示几条 
	$totalpage = ceil($sum/$perpagenum);   //上舍，取整    
	
 
		//if(!isset($_GET['page'])||!intval($_GET['page'])||$_GET['page']>$Totalpage) //page可能的四种状态    
	if(!isset($_GET['page'])||!intval($_GET['page'])||$_GET['page']>$totalpage)
	{
		$page = 1;
	}
	else   
	{
		$page = $_GET['page'];
	}
/*	  		
	$startnum = ($page-1)*$perpagenum;//开始条数    
	$sql = "select * from posts order by wtime limit $startnum,$perpagenum";   //查询出所需要的条数    
	echo $sql."    ";  
	$res = mysql_query($sql);
	$data = mysql_fetch_array($res);
	
	if($total)
	{
		do
		{
			$title = $data['title'];
			$wtime = $data['wtime'];
			
			echo "<div>".$title."</div>";
			echo "<div>".$wtime."</div>";
		}
		while($data = mysql_fetch_array($res));
	}	
	else{
		echo "<center>no message!</center>";
	}	
*/

	$nothing = 0;
	$per = $page - 1;   //上一页 
	$next = $page + 1;   //下一页   	
	?>
	<div id="count">共<span><?php echo $sum;?></span>帖子，每页10记录，共<span><?php echo $totalpage;?></span>页 <br/></div> 
	<center><div id="showpage">
	<?php
	if($page != 1)
	{
	?>	
	
		<a id="first" href="javascript:;" onclick="allpost2(1);">首页</a>
		<a id='previous' href="javascript:;" onclick="allpost2(<?php echo $per;?>);"><<上一页</a>
	<?php
	}
	for($i=1;$i<=$totalpage;$i++)
	{		
	?>
		<label><a id="no<?php echo $i;?>" href="javascript:;" onclick="allpost2(<?php echo $i;?>);"><?php echo $i;?></a></label>
	<?php
	}
	if($page != $totalpage)
	{
    
	?>
		<a id='next' href="javascript:;" onclick="allpost2(<?php echo $next;?>);">下一页>></a>
		<a id='last' href="javascript:;" onclick="allpost2(<?php echo $totalpage;?>);">尾页</a>
	</div></center>
	<?php
	}		

?>

