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
	$msg = "SELECT * FROM book_info_m WHERE book_id=".$_POST['BookId'];
//	echo $msg."<br>";
	$tmp = $pdo->query($msg);
	foreach ($tmp as $row);

//	echo $msg;
	echo "<form action='UpdateProcessAndResult.php' method='post' class='main'>";
	echo "<input type='hidden' name='ID' value='".$row[0]."'/>";
	echo "名前 : <input type='text' name='Name' placeholder='".$row[1]."';/><br>";
	echo "NDC. : <input type='text' name='NDC' placeholder='".$row[2]."';/><br>";
	echo "作者 : <input type='text' name='Author' placeholder='".$row[3]."';/><br>";
	echo "価格 : <input type='text' name='Price' placeholder='".$row[4]."';/><br>";
	echo "<input type='submit' class='confirm' value='変更します'/>";
	echo "</form>";

?>