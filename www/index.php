<!DOCTYPE HTML>
<html>

	<head>
		<title>template snitch</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="Marco Koch">
		<meta name="date" content="2010-03-03T19:52:00+01:00">
		<script type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="template.css"/>
		<style type="text/css">

		</style>
		
		<script src="ajax.js"></script>
		

	</head>

	<body>
	
 	<div id="sidebar">
		
		<ul>
			<li>
				<a href="javascript:;" onMouseUp="navigation('search.php')">host - ip</a>
			</li>
			
			<li>
     			<a href="javascript:;" onMouseUp="navigation('ip_search.php')">ip</a>
			</li>
		</ul>

 	
	</div> <!-- end div #sidebar -->
	
	
	<div id="main">


 	
	</div> <!-- end div #main -->
	
	
	<div id="loginbox">


	<form>
	<table id="login">
	
		<tr>
			<td id="status" colspan="2"></td>
		</tr>

		<tr>
			<td><label for="username">username: </label></td>
			<td><input type="text" name="username" id="username" value="" /></td>
		</tr>

		<tr>
			<td><label for="password">password: </label></td>
			<td><input type="password" name="password" id="password" /></td>
		</tr>

		<tr>
			<td>=D</td>
			<td id="submitbutton"><input type="button" onclick="submitlogin()" value="login" /></td>
		</tr>
		
	
	</table>
	</form>



	</div> <!-- end div #loginbox -->	



</body>

</html>