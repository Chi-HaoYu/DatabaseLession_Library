<?php
	
	echo "<link rel='stylesheet' type='text/css' href='input.css'>";

	//Connect to MySQL
	$dsn = 'mysql:dbname=myLib; host=localhost;charset=utf8;';
	try{
		$pdo = new PDO($dsn, 'root', '1234');
//		echo "Successed to connect to MySQL!!"."<br>";
	}catch(PDOException $e){
		echo "Failed to connect top MySQL, Because : ".$e->getMessage()."<br>";
	}

	#Make $msg a sentence to rob data
	//Rob without condition
	$msg = "SELECT * FROM user_info WHERE user_id=".$_POST['ID'];
//	echo $msg."<br>";
	$tmp = $pdo->query($msg);
	foreach ($tmp as $row);

//	echo $msg;
	echo "<form action='UpdateProcessAndResult.php' method='post' class='main'>";
	echo "<input type='hidden' name='ID' value='".$row[0]."'/>";
	echo "名前 : <input type='text' name='Name' placeholder='".$row[1]."';/><br>";
	echo "電話 : <input type='text' name='Phone' placeholder='".$row[2]."';/><br>";
	echo "Email: <input type='text' name='Email' placeholder='".$row[3]."';/><br>";
	echo "住所 : <input type='text' name='Address' placeholder='".$row[4]."';/><br>";
	echo "<input type='submit' class='confirm' value='変更します'/>";
	echo "</form>";

?>