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

	//Create the table
	echo "<table border='2'>";
	echo "<th>Name</th><th>NDC</th><th>Author</th><th>Price</th>";

	#Make $msg a sentence to rob data
	//Rob without condition
	$msg = "SELECT * FROM book_info_m";
	//Rob with some condition
	if($_POST['Name'] || $_POST['NDC'] || $_POST['Author'] || $_POST['Price']){
		$msg = $msg." WHERE ";
	}
	//Rob with condition from Name
	if($_POST['Name']){
		$msg = $msg."book_name LIKE '%".$_POST['Name']."%'";
	}
	//Rob with condition from NDC
	if($_POST['NDC']){
		//Check AND needed
		if($_POST['Name']){
			$msg = $msg." AND ";
		}
		$msg = $msg."book_ndc LIKE '%".$_POST['NDC']."%'";
	}
	//Rob with condition from Author
	if($_POST['Author']){
		//Check AND needed
		if($_POST['NDC'] || $_POST['Name']){
			$msg = $msg." AND ";
		}
		$msg = $msg."book_author LIKE '%".$_POST['Author']."%'";
	}
	//Rob with condition from Price
	if($_POST['Price']){
		if($_POST['Author'] || $_POST['NDC'] || $_POST['Name']){
			$msg = $msg." AND ";
		}
		$msg = $msg."book_price LIKE '%".$_POST['Price']."%'";
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