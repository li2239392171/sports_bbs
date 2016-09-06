<div class="style">帖子管理</div>
<table width="100%" border="1" align="center" cellpadding="1" bordercolor="#FFFFFF">
	<tr class="style1"  align="center" bgcolor="#FFEFBA">
		<td width="200" align="center" class="style2">标题</td>
		<td width="150" align="center" class="style2">作者</td>
		<td width="240" align="center" class="style2">内容</td>
		<td width="220" align="center" class="style2">发帖时间</td>	
		<td width="100" align="center" class="style2">是否删除</td>
	</tr>

<?php include "bbs_conn.php";
	if(isset($_GET['page'])){
		$page=$_GET['page'];
	}
	else{
		$page=1;
	}

	$sql0="select count(*) from posts";
	$res0=mysql_query($sql0,$com);
	$data0=mysql_fetch_array($res0);
	$posts_sum=$data0['count(*)'];
	$count=5;
	$totalpage=ceil($posts_sum/$count);
	$startnum=($page-1)*$count;


	$sql="select * from posts order by wtime desc limit $startnum,$count";
	$res=mysql_query($sql,$com);
	$row=mysql_num_rows($res);
	
	if($row){

		while($data=mysql_fetch_array($res)){
			$username=$image=$jointime=$sex="";
			$title=$data['title'];
			$author=$data['author'];
			$wtime=$data['wtime'];
			$content=$data['content'];
			$postid=$data['postid'];
		?>
		<tr class="style1" align="center" height="130" bgcolor="#FFFBF0">
			<td><?php echo $title;?></td>
			<td ><?php echo $author;?></td>
			<td><?php echo $content;?></td>
			<td><?php echo $wtime;?></td>			
			<td><a href="javascript:if(confirm('确定删除该帖子吗？'))window.location.href='delete_post.php?postid=<?php echo $postid;?>'">删除</a></td>
		</tr>
	<?php 
		}
	}
?>
		<tr>
			<td height="50" colspan="5">
				<table width="80%" align="center">
					<tr>
						<td width="50%">
							  页次：<?php echo $page;?>/<?php echo $totalpage;?>   &nbsp;总记录：<?php echo $posts_sum;?>条
						</td>
						<td width="40%">
							<a href="manage.php?value=<?php echo $_GET['value']?>&&page=1">首页</a>
							<a href="manage.php?value=<?php echo $_GET['value']?>&&page=<?php if($page>1){echo $page-1;} else{echo $page;} ?>">上一页</a>
							<a href="manage.php?value=<?php echo $_GET['value']?>&&page=<?php if($page<$totalpage){echo $page+1;} else{echo $page;} ?>">下一页</a>
							<a href="manage.php?value=<?php echo $_GET['value']?>&&page=<?php echo $totalpage; ?>">尾页</a>
						</td>
					</tr>
				</table>	
			</td>
		</tr>
</table>