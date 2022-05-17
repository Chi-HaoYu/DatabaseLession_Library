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
	$msg = "SELECT * FROM rent_info WHERE rent_id=".$_POST['ID'];
//	echo $msg."<br>";
	$tmp = $pdo->query($msg);
	foreach ($tmp as $row);

//	echo $msg;
	echo "<form action='UpdateProcessAndResult.php' method='post' class='main'>";
	echo "<input type='hidden' name='ID' value='".$row[0]."'/>";
	echo "書籍名 : <input type='text' name='BookName' placeholder='".$row[1]."';/><br>";
	echo "利用者名:<input type='text' name='UserName' placeholder='".$row[2]."';/><br>";
	echo "貸し日 : <input type='text' name='RentDate' placeholder='".$row[3]."';/><br>";
	echo "帰還期限:<input type='text' name='ReturnDeadline' placeholder='".$row[4]."';/><br>";
	echo "<input type='submit' class='confirm' value='変更します'/>";
	echo "</form>";

?>