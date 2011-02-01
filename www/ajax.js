function createAJAXobject() {
	if (window.XMLHttpRequest)
	{
		xmlhttp= new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
} // end createAJAXobject()


function submitlogin()
{
	createAJAXobject();

	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var query = "?username=" + username + "&password=" + password
	//alert("login.php" + query);
	xmlhttp.open("GET","login.php" + query ,true);
	xmlhttp.setRequestHeader("Pragma", "no-cache");
	xmlhttp.setRequestHeader("Cache-Control", "must-revalidate");
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send();

	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("status").innerHTML=xmlhttp.responseText;
			if (xmlhttp.responseText == 'logged in successfully!')
			{
				document.getElementById("submitbutton").innerHTML='<input type="button" onclick="submitlogout()" value="logout" />';
			}
		}
	}

} //end submitlogin()

function submitlogout()
{
	createAJAXobject();

	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var query = "?username=" + username + "&password=" + password
	//alert("login.php" + query);
	xmlhttp.open("GET","logout.php" + query ,true);
	xmlhttp.setRequestHeader("Pragma", "no-cache");
	xmlhttp.setRequestHeader("Cache-Control", "must-revalidate");
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send();

	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("status").innerHTML=xmlhttp.responseText;
			document.getElementById("main").innerHTML= "";
			document.getElementById("submitbutton").innerHTML='<input type="button" onclick="submitlogin()" value="login" />';
		}
	}

} //end submitlogout()


function navigationSearch()
{
	createAJAXobject();

	xmlhttp.open("GET","search.php",true);
	xmlhttp.setRequestHeader("Pragma", "no-cache");
	xmlhttp.setRequestHeader("Cache-Control", "must-revalidate");
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send();

	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("main").innerHTML=xmlhttp.responseText;
		}
	}
} //end submitlogin()

function letstype(SearchStr, phpfile)
{
	createAJAXobject();

	if (SearchStr.length==0)
	{
		xmlhttp.onreadystatechange=function()
		{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("qResult").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET",phpfile,true);
		xmlhttp.send();
	}

	if (SearchStr.length>0)
	{
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("qResult").innerHTML=xmlhttp.responseText;
			}
		  }
		xmlhttp.open("GET",phpfile+"?q="+SearchStr,true);
		xmlhttp.send();
	}
} //end letstype()