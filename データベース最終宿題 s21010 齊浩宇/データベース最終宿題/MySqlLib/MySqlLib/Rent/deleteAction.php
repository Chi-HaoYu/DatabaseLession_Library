<?php

//	echo "Id : ".$_POST['delete']." is what you want to delete!!<br>";
//	echo "Snake is ".$_POST['snake'];
	if($_POST['snake']=='live'){
		header("Location: deleteRent.php");
	}
	if($_POST['snake']=='dead'){
		header("Location: deleteRent.html");
	}

	//Connect MySQL
	$dsn = "mysql:dbname=myLib;host=localhost;charset=utf8;";
		try{
		$pdo = new PDO( $dsn, "root", "1234");
		echo "Successed to connect to MySQL!!"."<br>";
	}catch(PDOException $e){
		echo "Failed to connect to MySQL, Because : ".$e->getMessage();
	}

	$msg = "INSERT INTO rent_his(rent_id,book_id,user_id,rent_date,return_deadline) SELECT rent_id,book_id,user_id,rent_date,return_deadline FROM rent_info WHERE rent_id=".$_POST['delete'];

	try{
		$pdo->exec($msg);
	}catch(PDOException $e){
		echo $e;
	}
	$msg = "DELETE FROM rent_info WHERE rent_id=".$_POST['delete'];

//	echo $msg;
	
	try{
		$pdo->exec($msg);
	}catch(PDOException $e){
		echo $e;
	}


?>