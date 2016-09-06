<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>分页界面</title>
		<link rel="stylesheet" type="text/css" href="1.css">
	</head>
	<body>
	
<?php
include "page.php";

//php调用     
 $pageNo = $_GET['pageNo'];
 if(empty($pageNo)){
    $pageNo = 1;
}
//分页数据
 $pageData = News::getNewsPage($pageNo,$pageSize);
 //取得总行数
$count = News::getNewsCount();
//创建分页器
$p = new PageView($count['0']['TOTAL'],$pageSize,$pageNo,$pageData);
 //生成页码
$pageViewString = $p->echoPageAsDiv();

?>

	</body>
</html>