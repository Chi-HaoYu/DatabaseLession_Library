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
	echo "<th>Name</th><th>Phone</th><th>Email</th><th>Address</th><th></th>";

	#Make $msg a sentence to rob data
	//Rob without condition
	$msg = "SELECT * FROM user_info";
	//Rob with some condition
	if($_POST['userName'] || $_POST['Phone']){
		$msg = $msg." WHERE ";
	}
	//Rob with condition from Name
	if($_POST['userName']){
		$msg = $msg."user_name LIKE '%".$_POST['userName']."%'";
	}
	//Rob with condition from Phone
	if($_POST['Phone']){
		//Check AND needed
		if($_POST['userName']){
			$msg = $msg." AND ";
		}
		$msg = $msg."user_phone LIKE '%".$_POST['Phone']."%'";
	}
	

	$msg = $msg.";";
//	echo $msg;
	echo "<form action='insertRent.php' method='post'>";
	echo "<p class='word' style='left: 450px;'>検索結果：</p>";
	$tmp = $pdo->query($msg);
		foreach ($tmp as $row) {
			echo "<tr>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "<input type='hidden' name='bookID' value='".$_POST['bookID']."' />";
			echo "<input type='hidden' name='RentDate' value='".$_POST['RentDate']."' />";
			echo "<input type='hidden' name='ReturnDeadLine' value='".$_POST['ReturnDeadLine']."' />";
			echo "<td><button name='userID' value='".$row[0]."'>貸す</button></td>";
			echo "</tr>";
		}
	echo "</form>";
	echo "</table>";
?>