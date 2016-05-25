<!--
Title:lab4_register.php

Description: Comp 484 lab 4

Author:Joseph Hoxsey

-->

<!DOCTYPE html>
<html>
	
	<head>
		<style type="text/css">
			#espan	{
				color: red;
			}
		</style>
	<?php
		$servername = "localhost";
		$dbusername = "root";
		$dbpassword = "";
		
		$query = "SELECT username FROM users ";
		
		//check connection mysql
		if(!($database = mysql_connect($servername, $dbusername,$dbpassword)))	{
			die("Database connection failed! </body></html>");
		}
		else
			echo "Connection to the datebase was successful!<br>";
		
		//check connection lab4 database
		if(!(mysql_select_db("lab4", $database)))	{
			die("Connection to lab4 database failed! </body></html>");
		}
		else
			echo "Connection to lab4 datebase was successful!<br>";
		if(!($results = mysql_query($query, $database)))	{
			echo "This query could not be executed!";
			die(mysql_error()."</body></html>");
		}
		else
			echo "The query was successful!<br>";
		
		$array = Array();
		while($row = mysql_fetch_array($results,MYSQL_ASSOC))	{
			$array[] = $row['username'];
		}
		
		mysql_close($database);
?>
	<script type="text/javascript">
		var un;
		var pw;
		var rpw;
		var form;
		var submit;
		var pwspan
		var dbUsernames;
		
		function isPasswordStrong()	{
			var specialcharpattern = new RegExp("^[a-zA-Z0-9- ]*$");
			var charpattern = new RegExp("[a-zA-Z]");
			var numpattern = new RegExp("\d/");
			if (!(pw.value.match(/[^0-9a-zA-Z]/g))) {
				return false;
			}
			if(!(pw.value.match(/[0-9]/g)))	{
				return false;
			}
			if(!(pw.value.match(/[a-zA-Z]/g)))	{
				return false;
			}
			return true;
				
		}
		
		function check()	{
			var error = 0;
			pwspan.innerHTML = "";
			if(un.value == "")	{
				pwspan.innerHTML += "Username is blank!<br>";
				error++;
			}
			if(pw.value == "")	{
				pwspan.innerHTML += "Password is blank!<br>";
				error++;
			}
			for(var i = 0; i < dbUsernames.length; i++)	{
				if(dbUsernames[i] == un.value)	{
					pwspan.innerHTML += "Username already in use!<br>";
					error++;
				}
			}
			if(!isPasswordStrong())	{
				pwspan.innerHTML += "Password is not strong enough!<br>Make sure to use special characters, numbers and letters!<br>";
				error++;
			}
			if(pw.value != rpw.value )	{
				pwspan.innerHTML += "Passwords do not match!";
				error++;
			}
			if(error < 1)
				form.submit();
		}
		
		// init function that will be called at the start of the page
		function init()
		{
			dbUsernames = <?php echo '["' . implode('", "', $array) . '"]' ?>;
			un = document.getElementById("username");
			pwspan = document.getElementById("espan");
			pw = document.getElementById("password");
			rpw = document.getElementById("rpassword");
			submit = document.getElementById("submit");
			submit.addEventListener("click", check);
			form = document.forms["form"];
			
		}

		window.addEventListener("load", init, false); 
	</script>
	</head>

	<body>
	
	<div id="register_div">
		<h1>Register Form</h1>
		<span id="espan"></span><br>
		<form id="form" name="form" action="addnewuser.php" method="post">
			Username: <br>
			<input id="username" type="text" name="username" maxlength="15"><br><br>
			Password: <br>
			<input id="password" type="password" name="password" maxlength="15"><br><br>
			Re-enter Password: <br>
			<input id="rpassword" type="password" name="re-password" maxlength="15"><br><br>
			
		</form>
		<button id="submit">Submit</button> <br><br>
	</div>
	</body>
</html>