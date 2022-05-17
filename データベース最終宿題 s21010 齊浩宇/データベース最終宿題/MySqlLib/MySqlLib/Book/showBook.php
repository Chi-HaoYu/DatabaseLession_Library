<?php

	echo "<link rel='stylesheet' type='text/css' href='indexBook.css'>";

	//Connect MySQL
	$dsn = "mysql:dbname=myLib;host=localhost;charset=utf8;";
	try{
		$pdo = new PDO( $dsn, "root", "1234");
//		echo "Successed to connect to MySQL!!"."<br>";
	}catch(PDOException $e){
		echo "Failed to connect to MySQL, Because : ".$e->getMessage();
	}

	//Pick up data form book_info
	$sql = "SELECT * FROM book_info_m";
	try{
		$pdoMsg = $pdo->query($sql);
//		echo "Successed to Pick up data!!"."<br>";

		//Put in table
		echo "<table align='center' border='2' >";
		echo "<th>ID</th><th>Name</th><th>NDC</th><th>Author</th><th>Price</th>";
		foreach ($pdoMsg as $bookdata) {
			echo "<tr>";
				echo "<td class='Id'>".$bookdata[0]."</td>";
				echo "<td class='Name'>".$bookdata[1]."</td>";
				echo "<td class='NDC'>".$bookdata[2]."</td>";
				echo "<td class='Author'>".$bookdata[3]."</td>";
				echo "<td class='Price'>".$bookdata[4]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}catch(PDOException $e){
		echo "Failed to pick up data, Because : ".$e->getMessage();
	}
?>