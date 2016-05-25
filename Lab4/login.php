<!--
Title:login.php

Description: Comp 484 lab 4

Author:Joseph Hoxsey

-->
<?php
		$servername = "localhost";
		$dbusername = "root";
		$dbpassword = "";
		$username = $_POST["username"];
		$password = $_POST["password"];
		session_start();
		
		$query = "SELECT * FROM users WHERE username = '$username'";
		
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
		
		$row = mysql_fetch_assoc($results);
		$salt = $row["salt"];
		$password = hash("sha512", $password . $salt);
		
		if($password === $row["password"])	{
			echo "Login Successful!";
			$_SESSION["uid"] = $row["uid"];
			$_SESSION["username"] = $username;
			$_SESSION["isloggedin"] = TRUE;
			header("Location: lab4_success.php");
		}
		else	{
			echo "Login failed!";
			echo $row["password"];
			//header("Location: lab4.php");
		}
		
		mysql_close($database);
?>