<?php
	echo "<link rel='stylesheet' type='text/css' href='indexRent.css'>";
/*
echo "User : ".$_POST['userID']."<br>";
echo "Phone : ".$_POST['Phone']."<br>";
echo "Book : ".$_POST['bookID']."<br>";
*/
	//Connect to MySQL
	$dsn = 'mysql:dbname=myLib;host=localhost;charset=utf8;';
	try{
		$pdo = new PDO($dsn, 'root', '1234');
//		echo "Successed to connect to MySql!!"."<br>";
	}catch(PDOExpection $e){
		echo "Failed to connect to MySql, Because : ".$e->getMessage()."<br>";
	}
/*
function takeOutName($column, $table, $select, $name){
	$msg = "SELECT ".$column." FROM ".$table." WHERE ".$select." LIKE '%".$name."%'";
	try{
		$dsn = 'mysql:dbname=myLib;host=localhost;charset=utf8;';
		$pdo = new PDO($dsn, 'root', '1234');
		$res = $pdo->query($msg);
		$result = $res->fetch(PDO::FETCH_ASSOC);
	}catch(Expcetion $e){
		die("Error!! : ".$e->getMessage());
	}
	return $result[$column];
}
*/
//Make a sentence to insert the data
$userID = $_POST['userID'];
$bookID = $_POST['bookID'];
echo "B : ".$bookID."<br>"."U : ".$userID."<br>";

//$msgT = "INSERT INTO rent_info(book_id, user_id, rent_date, return_deadline) VALUES(".$_POST['BookName'].",".$_POST['UserName'].",".$_POST['RentDate'].",".$_POST['ReturnDeadLine'].")";

$msgI = "INSERT INTO rent_info(book_id, user_id";
$msgV = " VALUES(".$bookID.",".$userID;
if($_POST['RentDate']){
	$msgI = $msgI.", rent_date";
	$msgV = $msgV.",'".$_POST['RentDate']."'";
}
if($_POST['ReturnDeadLine']){
	$msgI = $msgI.", return_deadline";
	$msgV = $msgV.",'".$_POST['ReturnDeadLine']."'";
}
$msgI = $msgI.")";
$msgV = $msgV.")";
$msg = $msgI.$msgV;


echo $msg."<br>";


	try{
		$pdo->exec($msg);
		$lastID = $pdo->lastInsertId();
		$msg = "SELECT * FROM rent_v WHERE rent_id=".$lastID;
		$sql = $pdo->query($msg);
		echo "<body style='background: black;'>";
			echo "<p class='word'>入力成功です！！</p>";
			echo "<p class='word'>入力結果は：</p>";
			echo "<table align='center' border='2' style='position: relative; left: 0;'>";
				echo "<th>ID</th><th>BookName</th><th>UserName</th><th>RentDate</th><th style='font-size:28;'>Deadline</th>";
				foreach ($sql as $rentdata) {
					echo "<tr>";
						echo "<td class='Id'>".$rentdata[0]."</td>";
						echo "<td class='BookName'>".$rentdata[1]."</td>";
						echo "<td class='UserName'>".$rentdata[2]."</td>";
						echo "<td class='RentDate'>".$rentdata[3]."</td>";
						echo "<td class='ReturnDeadline'>".$rentdata[4]."</td>";
					echo "</tr>";
				}
		echo "</body>";
		echo "<form action='showRent.php'>";
			echo "<input type='submit' class='bigBotton' value='戻る'></input>";
		echo "</form>";
	}catch(PDOExpection $e){
		echo "Failed to throw data into MySql, Because : ".$e->getMessage();
	}

?>