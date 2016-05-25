<!--
Title:mailer.php

Description: Comp 484 lab 4

Author:Joseph Hoxsey

-->
<?php
	$from = "<josephhoxseycomp484@gmail>";
	$to = "";
	$subject = "Lab4";
	$body = "";
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$currtime = date("Y-m-d H:i:s");
	$datetime = "";
	$msgid = "";

	$query = "SELECT * FROM message WHERE sent = 0";

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

	while($row = mysql_fetch_array($results,MYSQL_ASSOC))	{
		$datetime = $row['timestamp'];
		if($datetime <= $currtime)	{
			$to = $row['email'];
			$body = $row['message'];
			$msgid = $row['msgid'];
			
			$headers = array(
				'From' => $from,
				'To' => $to,
				'Subject' => $subject
			);

			$smtp = Mail::factory('smtp', array(
				'host' => 'ssl://smtp.gmail.com',
				'port' => '465',
				'auth' => true,
				'username' => 'josephhoxseycomp484@gmail.com',
				'password' => 'comp484lab4'
			));

			$mail = $smtp->send($to, $headers, $body);

			if (PEAR::isError($mail)) {
				echo('<p>' . $mail->getMessage() . '</p>');
			} else {
				echo('<p>Message successfully sent!</p>');
				$query = "UPDATE messages SET sent = 1 WHERE messageID = '$messID'";
				mysql_query($query, $database);
			}
		}
	}

	mysql_close($database);

	
		
?>