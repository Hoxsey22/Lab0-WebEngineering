<!--
Title:lab4_success.php

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
	<div id="message_div">
		<h1><?php session_start(); echo "Welcome ".$_SESSION["username"]."!";?></h1>
		
		<form action="addmessage.php" method="post">
			Email:<br> 
			<input type="email" name="email"> <br><br>
			Date & Time:
			<br>			
			<input type="datetime-local" name="datetime" step="1800"> <br><br>
			<input type="text" name="message" rows="5" cols="50">
			<br><br>
			<input type="submit" value="Submit"> <br><br>
		</form>
		
	</div>
	</body>
</html>