<!--
Title:addmessage.php

Description: Comp 484 lab 4

Author:Joseph Hoxsey

-->
<?php
		session_start();
		$servername = "localhost";
		$dbusername = "root";
		$dbpassword = "";
		$email = $_POST["email"];
		$datetime = $_POST["datetime"];
		$message = $_POST["message"];
		$uid = $_SESSION["uid"];
		
		$formatedtime = explode("T",$datetime);
		$dt = $formatedtime[0]." ".$formatedtime[1];
		//echo $dt;
		$query = "INSERT INTO message (userid, email, message, timestamp,issent) VALUES ('$uid','$email','$message','$dt','FALSE')";
		
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
			echo "Inserting message into the database was successful!<br>";
			header("Location: lab4.php");
		}
		
		mysql_close($database);
?>