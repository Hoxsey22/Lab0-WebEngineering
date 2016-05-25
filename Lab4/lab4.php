<!--
Title:Lab4.php

Description: Comp 484 lab 4

Author:Joseph Hoxsey

-->
<!DOCTYPE html>
<html>
	<head>
		<style>
		</style>
	</head>

	<body>
	<div id="login_div">
		
		<center>
		
		<?php 
			session_start(); 
			if(isset($_SESSION["isloggedin"]))	{
				echo "<h1>Welcome ".$_SESSION["username"]."</h1>
					<h2>Comp 484 - Lab 4</h2>
					<form action=\"lab4_success.php\" >
					<input type=\"submit\" value=\"Message\">
					</form><br>";

					die("</body></html>");
			}
			else
				echo "<h1>Welcome!!</h1>";
		
		?>
		<form action="login.php" method="post">
			Username: 
			<input type="text" name="username" maxlength="15"><br><br>
			Password: 
			<input type="password" name="password" maxlength="15"><br><br>
			<input type="submit" value="Login"> <br><br>
		
		</form>
		
		<form action="lab4_register.php" method="get">
			<input type="submit" value="Register"> <br><br>
		</form>
		
		</center>
		
	</div>
	</body>
</html>