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

	#Make $msg a sentence to rob data
	//Rob without condition
	$msg = "SELECT * FROM rent_v";
	//Rob with some condition
	if($_POST['BookName'] || $_POST['UserName'] || $_POST['RentDate'] || $_POST['ReturnDeadLine']){
		$msg = $msg." WHERE ";
	}
	//Rob with condition from Name
	if($_POST['BookName']){
		$msg = $msg."book_name LIKE '%".$_POST['BookName']."%'";
	}
	//Rob with condition from NDC
	if($_POST['UserName']){
		//Check AND needed
		if($_POST['BookName']){
			$msg = $msg." AND ";
		}
		$msg = $msg."user_name LIKE '%".$_POST['UserName']."%'";
	}
	//Rob with condition from Author
	if($_POST['RentDate']){
		//Check AND needed
		if($_POST['UserName'] || $_POST['BookName']){
			$msg = $msg." AND ";
		}
		$msg = $msg."rent_date LIKE '%".$_POST['RentDate']."%'";
	}
	//Rob with condition from Price
	if($_POST['ReturnDeadLine']){
		if($_POST['RentDate'] || $_POST['UserName'] || $_POST['BookName']){
			$msg = $msg." AND ";
		}
		$msg = $msg."return_deadline LIKE '%".$_POST['ReturnDeadLine']."%'";
	}
	

	$msg = $msg.";";
//	echo $msg;
	
	echo "<p class='word' style='left: 450px;'>検索結果：</p>";
	
	$tmp = $pdo->query($msg);
	
	//Create the table
	echo "<table border='2'>";
		echo "<th>Book</th><th>User</th><th>RentDate</th><th>Deadline</th><th></th>";
		echo "<form action='UpdateInput.php' method='post'>";
		foreach ($tmp as $row) {
			$id = $row[0];
			echo "<tr>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "<td style='width:60px; padding:0;'><button name='ID' class='delBotton' value='".$id."'/>改変</button></td>";
			echo "</tr>";
		}
		echo "</form>";
	echo "</table>";
?>