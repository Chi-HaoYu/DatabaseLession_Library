<?php
	
	echo "<link rel='stylesheet' type='text/css' href='indexUser.css'>";

	//Connect to MySQL
	$dsn = 'mysql:dbname=myLib; host=localhost;charset=utf8;';
	try{
		$pdo = new PDO($dsn, 'root', '1234');
//		echo "Successed to connect to MySQL!!"."<br>";
	}catch(PDOException $e){
		echo "Failed to connect top MySQL, Because : ".$e->getMessage()."<br>";
	}

	#Make $msg a sentence to change data
	$msg = "UPDATE user_info SET ";
	//Change with condition from Name
	if($_POST['Name']){
		$msg = $msg."user_name='".$_POST['Name']."'";
	}
	//Change with condition from NDC
	if($_POST['Phone']){
		//Check AND needed
		if($_POST['Name']){
			$msg = $msg." , ";
		}
		$msg = $msg."user_phone='".$_POST['Phone']."'";
	}
	//Chande with condition from Author
	if($_POST['Email']){
		//Check AND needed
		if($_POST['Phone'] || $_POST['Name']){
			$msg = $msg." , ";
		}
		$msg = $msg."user_email='".$_POST['Email']."'";
	}
	//Rob with condition from Price
	if($_POST['Address']){
		if($_POST['Email'] || $_POST['Phone'] || $_POST['Name']){
			$msg = $msg." , ";
		}
		$msg = $msg."user_address='".$_POST['Address']."'";
	}
	

	$msg = $msg." WHERE user_id=".$_POST['ID'];
//	echo $msg;
	$sql = $pdo->exec($msg);
	
	echo "<p class='word' style='left: 450px;'>改変成功：</p>";
	
	$msg = "SELECT * FROM user_info WHERE user_id=".$_POST['ID'];
	$tmp = $pdo->query($msg);
	
	//Create the table
	echo "<table border='2'>";
		echo "<th>Name</th><th>Phone</th><th>Email</th><th>Address</th>";
		echo "<form action='deleteAction.php' method='post'>";
		foreach ($tmp as $row) {
			echo "<tr>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "</tr>";
		}
		echo "</form>";
	echo "</table>";
?>