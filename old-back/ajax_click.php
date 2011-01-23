<html>
	<head>

		<script type="text/javascript">
			function letsclick()
			{

				if (window.XMLHttpRequest)
				{
					xmlhttp= new XMLHttpRequest();
				}
				else
				{
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}

				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					document.getElementById("changing").innerHTML=xmlhttp.responseText;
					}
				}
					xmlhttp.open("GET","get_ip_per_host.php",true);
					xmlhttp.send();

			}
		
		</script>
	</head>
	<body>
	
		<button type="button" onclick="letsclick()">Change me!</button>
		
		<div id="changing">I'll get changed...</div>

		<!--
			<p><b>Start typing a name in the input field below:</b></p>
			<form>
			First name: <input type="text" onkeyup="showHint(this.value)" size="20" />
			</form>
			<p>Suggestions: <span id="txtHint"></span></p>
		-->
	</body>
</html>