<?php include "bbs_conn.php";
session_start();    
unset($_SESSION['current_user']);      //只有在session_start();后面才能有效！！

/*
$sql = "select replyid from reply_post order by replyid desc limit 1";
$res = mysql_query($sql,$com);
$data = mysql_fetch_array($res);
$replyid = $data['replyid'];
for($i=0;$i<=$replyid;$i++)
{
	unset($_SESSION['like'.$replyid]);
}
*/
echo "<center><h3>注销成功！</h3> <br /> <h4>正在跳转到主页,请稍候...</h4></center>";
header("refresh:1;url=bbs_forum.php");
?>