<?php
	
	echo "<link rel='stylesheet' type='text/css' href='indexRent.css'>";

	//Connect to MySQL
	$dsn = 'mysql:dbname=myLib; host=localhost;charset=utf8;';
	try{
		$pdo = new PDO($dsn, 'root', '1234');
//		echo "Successed to connect to MySQL!!"."<br>";
	}catch(PDOException $e){
		echo "Failed to connect top MySQL, Because : ".$e->getMessage()."<br>";
	}

	//Create the table
	echo "<table border='2'>";
	echo "<th>BookName</th><th>UserName</th><th>RentDate</th><th style='font-size:28;'>Deadline</th><th>Return</th>";

	#Make $msg a sentence to rob data
	//Rob without condition
	$msg = "SELECT * FROM rent_v";
	//Rob with some condition
	if($_POST['BookName'] || $_POST['UserName'] || $_POST['RentDate'] || $_POST['ReturnDeadLine'] || $_POST['ReturnDate']){
		$msg = $msg." WHERE ";
	}
	//Rob with condition from BookName
	if($_POST['BookName']){
		$msg = $msg."book_name LIKE '%".$_POST['BookName']."%'";
	}
	//Rob with condition from UserName
	if($_POST['UserName']){
		//Check AND needed
		if($_POST['BookName']){
			$msg = $msg." AND ";
		}
		$msg = $msg."user_name LIKE '%".$_POST['UserName']."%'";
	}
	//Rob with condition from RentDate
	if($_POST['RentDate']){
		//Check AND needed
		if($_POST['UserName'] || $_POST['BookName']){
			$msg = $msg." AND ";
		}
		$msg = $msg."rent_date LIKE '%".$_POST['RentDate']."%'";
	}
	//Rob with condition from ReturnDeadLine
	if($_POST['ReturnDeadLine']){
		if($_POST['RentDate'] || $_POST['UserName'] || $_POST['BookName']){
			$msg = $msg." AND ";
		}
		$msg = $msg."return_deadLine = '".$_POST['ReturnDeadLine']."'";
	}
	//Rob with condition from ReturnDate
	if($_POST['ReturnDate']){
		if($_POST['RentDate'] || $_POST['UserName'] || $_POST['BookName'] || $_POST['ReturnDeadLine']){
			$msg = $msg." AND ";
		}
		$msg = $msg."return_date LIKE '".$_POST['ReturnDate']."%'";
	}

	$msg = $msg.";";
//	echo $msg;
	echo "<p class='word' style='left: 450px;'>検索結果：</p>";
	$tmp = $pdo->query($msg);
		foreach ($tmp as $row) {
			echo "<tr>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "<td>".$row[5]."</td>";
			echo "</tr>";
		}

	echo "</table>";
?>