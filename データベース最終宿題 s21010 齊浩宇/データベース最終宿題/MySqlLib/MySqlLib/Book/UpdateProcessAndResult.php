<?php
	
	echo "<link rel='stylesheet' type='text/css' href='indexBook.css'>";

	//Connect to MySQL
	$dsn = 'mysql:dbname=myLib; host=localhost;charset=utf8;';
	try{
		$pdo = new PDO($dsn, 'root', '1234');
//		echo "Successed to connect to MySQL!!"."<br>";
	}catch(PDOException $e){
		echo "Failed to connect top MySQL, Because : ".$e->getMessage()."<br>";
	}

	#Make $msg a sentence to change data
	$msg = "UPDATE book_info_m SET ";
	//Change with condition from Name
	if($_POST['Name']){
		$msg = $msg."book_name='".$_POST['Name']."'";
	}
	//Change with condition from NDC
	if($_POST['NDC']){
		//Check AND needed
		if($_POST['Name']){
			$msg = $msg." , ";
		}
		$msg = $msg."book_ndc='".$_POST['NDC']."'";
	}
	//Chande with condition from Author
	if($_POST['Author']){
		//Check AND needed
		if($_POST['NDC'] || $_POST['Name']){
			$msg = $msg." , ";
		}
		$msg = $msg."book_author='".$_POST['Author']."'";
	}
	//Rob with condition from Price
	if($_POST['Price']){
		if($_POST['Author'] || $_POST['NDC'] || $_POST['Name']){
			$msg = $msg." , ";
		}
		$msg = $msg."book_price=".$_POST['Price'];
	}
	

	$msg = $msg." WHERE book_id=".$_POST['ID'];
//	echo $msg;
	$sql = $pdo->exec($msg);
	
	echo "<p class='word' style='left: 450px;'>改変成功：</p>";
	
	$msg = "SELECT * FROM book_info_m WHERE book_id=".$_POST['ID'];
	$tmp = $pdo->query($msg);
	
	//Create the table
	echo "<table border='2'>";
		echo "<th>Name</th><th>NDC</th><th>Author</th><th>Price</th>";
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