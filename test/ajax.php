<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title> FormData Demo </title>
		<link rel="stylesheet" type="text/css" href="test/css/homepage.css">
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="test/js/main.js"></script>
  <script type="text/javascript" src="test/save_img.js">
  <!--
 
  -->
  </script>

 </head>

 <body>
   
							<form name="form" id="form" method="post" enctype="multipart/form-data">	
								
								<input type="text" name="input_title" id="input_title" placeholder="请填写标题" />
								<input type="text" id="post_content" class="shadow" name="post_content" placeholder="内容" />
																		
								<input type="file" class="photo" name="photo" id="photo" />
								
								<input type="button" id="submit"  name="submit" class="button white"  value="submit" onclick="submitfile()"/>
		
							</form>			
    <div id="result"></div>
 </body>
</html>