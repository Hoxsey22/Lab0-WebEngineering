<!--
Title:addnewuser.php

Description: Comp 484 lab 4

Author:Joseph Hoxsey

-->
<?php
		$servername = "localhost";
		$dbusername = "root";
		$dbpassword = "";
		$username = $_POST["username"];
		$password = $_POST["password"];
		$salt = substr(md5(uniqid(rand(), true)), 0, 6);
		$password = hash("sha512", $password . $salt);
		
		$query = "INSERT INTO users (username, password, salt) VALUES ('$username','$password','$salt')";
		
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
		else	{
			echo "Inserting '$username' into the database was successful!<br>";
			header("Location: lab4.php");
		}
		
		mysql_close($database);
?>