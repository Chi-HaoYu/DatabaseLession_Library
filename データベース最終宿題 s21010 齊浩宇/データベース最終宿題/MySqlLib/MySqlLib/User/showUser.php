<?php

	echo "<link rel='stylesheet' type='text/css' href='indexUser.css'>";

	//Connect MySQL
	$dsn = "mysql:dbname=myLib;host=localhost;charset=utf8;";
	try{
		$pdo = new PDO( $dsn, "root", "1234");
//		echo "Successed to connect to MySQL!!"."<br>";
	}catch(PDOException $e){
		echo "Failed to connect to MySQL, Because : ".$e->getMessage();
	}

	//Pick up data form user_info
	$sql = "SELECT * FROM user_info";
	try{
		$pdoMsg = $pdo->query($sql);
//		echo "Successed to Pick up data!!"."<br>";

		//Put in table
		echo "<table align='center' border='2' >";
		echo "<th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Address</th>";
		foreach ($pdoMsg as $userdata) {
			echo "<tr>";
				echo "<td class='Id'>".$userdata[0]."</td>";
				echo "<td class='Name'>".$userdata[1]."</td>";
				echo "<td class='Phone'>".$userdata[2]."</td>";
				echo "<td class='Email'>".$userdata[3]."</td>";
				echo "<td class='Address'>".$userdata[4]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}catch(PDOException $e){
		echo "Failed to pick up data, Because : ".$e->getMessage();
	}
?>