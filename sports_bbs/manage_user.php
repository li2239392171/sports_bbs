<div class="style">用户管理</div>
<table width="100%" border="1" align="center" cellpadding="1" bordercolor="#FFFFFF">
	<tr class="style1"  align="center" bgcolor="#FFEFBA">
		<td width="180" align="center" class="style2">头像</td>
		<td width="150" align="center" class="style2">用户名</td>
		<td width="220" align="center" class="style2">注册时间</td>
		<td width="140" align="center" class="style2">积分</td>
		<td width="120" align="center" class="style2">发帖数</td>
		<td width="100" align="center" class="style2">是否删除</td>
	</tr>

<?php include "bbs_conn.php";
	if(isset($_GET['page'])){
		$page=$_GET['page'];
	}
	else{
		$page=1;
	}

	$sql0="select count(*) from users where status=1";
	$res0=mysql_query($sql0,$com);
	$data0=mysql_fetch_array($res0);
	$posts_sum=$data0['count(*)'];
	$count=3;
	$totalpage=ceil($posts_sum/$count);
	$startnum=($page-1)*$count;


	$sql="select * from users where status=1 limit $startnum,$count";
	$res=mysql_query($sql,$com);
	$row=mysql_num_rows($res);
	
	if($row){

		while($data=mysql_fetch_array($res)){
			$username=$image=$jointime=$sex="";
			$username=$data['username'];
			$image=$data['image'];
			$jointime=$data['jointime'];
			$sex=$data['sex'];

			$sql2="select * from experience where username='$username'";
			$res2=mysql_query($sql2,$com);
			$data2=mysql_fetch_array($res2);
			$total=$data2['total'];

			$sql3="select count(*) from posts where author='$username'";
			$res3=mysql_query($sql3,$com);
			$data3=mysql_fetch_array($res3);
			$posts_num=$data3['count(*)'];

		?>
		<tr class="style1" align="center" height="130" bgcolor="#FFFBF0">
			<td><img src="<?php echo $image;?>" width="100" height="100" /></td>
			<td><?php echo $username;?></td>
			<td ><?php echo $jointime;?></td>
			<td><?php echo $total;?></td>
			<td><?php echo $posts_num;?></td>
			<td><a href="javascript:if(confirm('确定删除该用户？'))window.location='delete_user.php?username=<?php echo $username;?>'">删除</a></td>
		</tr>
	<?php 
		}
	}
?>
		<tr>
			<td height="50" colspan="6">
				<table width="80%" align="center">
					<tr>
						<td width="50%">
							  页次：<?php echo $page;?>/<?php echo $totalpage;?>   总记录：<?php echo $posts_sum;?>条
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