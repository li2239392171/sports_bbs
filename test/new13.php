<html> 
<head> 
<title>CSS 鼠标响应事件</title> 
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"> 
<style type="text/css"> 
.contentout{ background-color: #00FF66; padding:100px;} 
.contentover{background-color: #FF0000; padding:100px} 
</style> 
</head> 
<body> 
<ul class="contentout" onMouseOut="this.className='contentout'" onMouseOver="this.className='contentover'"> 
<h4>鼠标响应事件 当鼠标经过移出时切换css</h4> 
<li>onMouseDown 按下鼠标时触发 
<li>onMouseOver 鼠标经过时触发 
<li>onMouseUp 按下鼠标松开鼠标时触发 
<li>onMouseOut 鼠标移出时触发 
<li>onMouseMove 鼠标移动时触发 </li> 
</ul> 
</body> 
</html> 