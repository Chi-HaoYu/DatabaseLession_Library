<?php

	echo "<link rel='stylesheet' type='text/css' href='indexRent.css'>";

	//Connect MySQL
	$dsn = "mysql:dbname=myLib;host=localhost;charset=utf8;";
	try{
		$pdo = new PDO( $dsn, "root", "1234");
//		echo "Successed to connect to MySQL!!"."<br>";
	}catch(PDOException $e){
		echo "Failed to connect to MySQL, Because : ".$e->getMessage();
	}

	//Pick up data form book_info
	$sql = "SELECT * FROM rent_his_v";
	try{
		$pdoMsg = $pdo->query($sql);
//		echo "Successed to Pick up data!!"."<br>";

		//Put in table
		echo "<table align='center' border='2' >";
		echo "<th>ID</th><th>BookName</th><th>UserName</th><th>RentDate</th><th style='font-size:28;'>Deadline</th><th>Return</th>";
		foreach ($pdoMsg as $rentdata) {
			echo "<tr>";
				echo "<td class='Id'>".$rentdata[0]."</td>";
				echo "<td class='BookName'>".$rentdata[1]."</td>";
				echo "<td class='UserName'>".$rentdata[2]."</td>";
				echo "<td class='RentDate'>".$rentdata[3]."</td>";
				echo "<td class='ReturnDeadline'>".$rentdata[4]."</td>";
				if($rentdata[5]){
					echo "<td class='ReturnDate'>".$rentdata[5]."</td>";
				}else{
					echo "<td class='ReturnDate'>未帰還です</td>";
				}
			echo "</tr>";
		}
		echo "</table>";
	}catch(PDOException $e){
		echo "Failed to pick up data, Because : ".$e->getMessage();
	}
?>