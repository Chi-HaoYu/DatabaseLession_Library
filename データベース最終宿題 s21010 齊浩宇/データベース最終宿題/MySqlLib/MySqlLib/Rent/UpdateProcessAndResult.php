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

	#Make $msg a sentence to change data
	$msg = "UPDATE rent_info SET ";
	//Change with condition from Name
	if($_POST['BookName']){
		$msg = $msg."book_name='".$_POST['BookName']."'";
	}
	//Change with condition from NDC
	if($_POST['UserName']){
		//Check AND needed
		if($_POST['BookName']){
			$msg = $msg." , ";
		}
		$msg = $msg."user_name='".$_POST['UserName']."'";
	}
	//Chande with condition from Author
	if($_POST['RentDate']){
		//Check AND needed
		if($_POST['UserName'] || $_POST['BookName']){
			$msg = $msg." , ";
		}
		$msg = $msg."rent_date='".$_POST['RentDate']."'";
	}
	//Rob with condition from Price
	if($_POST['ReturnDealine']){
		if($_POST['RentDate'] || $_POST['UserName'] || $_POST['BookName']){
			$msg = $msg." , ";
		}
		$msg = $msg."return_deadline='".$_POST['ReturnDeadline']."'";
	}
	

	$msg = $msg." WHERE rent_id=".$_POST['ID'];
//	echo $msg;
	$sql = $pdo->exec($msg);
	
	echo "<p class='word' style='left: 450px;'>改変成功：</p>";
	
	$msg = "SELECT * FROM rent_info WHERE rent_id=".$_POST['ID'];
	$tmp = $pdo->query($msg);
	
	//Create the table
	echo "<table border='2'>";
		echo "<th>Book</th><th>User</th><th>RentDate</th><th>Deadline</th><th></th>";
		foreach ($tmp as $row) {
			echo "<tr>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "</tr>";
		}
	echo "</table>";
?>