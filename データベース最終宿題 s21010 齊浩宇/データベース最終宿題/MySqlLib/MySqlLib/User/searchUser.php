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

	//Create the table
	echo "<table border='2'>";
	echo "<th>Name</th><th>Phone</th><th>Email</th><th>Address</th>";

	#Make $msg a sentence to rob data
	//Rob without condition
	$msg = "SELECT * FROM user_info";
	//Rob with some condition
	if($_POST['Name'] || $_POST['Phone'] || $_POST['Email'] || $_POST['Address']){
		$msg = $msg." WHERE ";
	}
	//Rob with condition from Name
	if($_POST['Name']){
		$msg = $msg."user_name LIKE '%".$_POST['Name']."%'";
	}
	//Rob with condition from Phone
	if($_POST['Phone']){
		//Check AND needed
		if($_POST['Name']){
			$msg = $msg." AND ";
		}
		$msg = $msg."user_phone LIKE '%".$_POST['Phone']."%'";
	}
	//Rob with condition from Email
	if($_POST['Email']){
		//Check AND needed
		if($_POST['Phone'] || $_POST['Name']){
			$msg = $msg." AND ";
		}
		$msg = $msg."user_email LIKE '%".$_POST['Email']."%'";
	}
	//Rob with condition from Address
	if($_POST['Address']){
		if($_POST['Email'] || $_POST['Phone'] || $_POST['Name']){
			$msg = $msg." AND ";
		}
		$msg = $msg."user_address LIKE '%".$_POST['Address']."%'";
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
			echo "</tr>";
		}

	echo "</table>";
?>