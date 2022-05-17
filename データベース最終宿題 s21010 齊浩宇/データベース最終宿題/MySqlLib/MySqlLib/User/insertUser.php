<?php
	//Check Name and Email had be fulled
	if(!($_POST['name'] && $_POST['email'])){
		echo "<script>";
			echo "alert('Name and Email must be write!!');";
			echo "window.history.go(-1);";
		echo "</script>";
	}

	echo "<link rel='stylesheet' type='text/css' href='indexUser.css'>";

	//Connect to MySQL
	$dsn = 'mysql:dbname=myLib;host=localhost;charset=utf8;';
	try{
		$pdo = new PDO($dsn, 'root', '1234');
//		echo "Successed to connect to MySql!!"."<br>";
	}catch(PDOExpection $e){
		echo "Failed to connect to MySql, Because : ".$e->getMessage()."<br>";
	}

	//Check Name and Email duplicate
	$warning = 0;
	$msg = "SELECT * FROM user_info WHERE user_name='".$_POST['name']."'";
	$tmp = $pdo->query($msg);
	foreach ($tmp as $arr) {
		if($arr[0])
			$warning++;
	}
	$msg = "SELECT * FROM user_info WHERE user_email='".$_POST['email']."'";
	$tmp = $pdo->query($msg);
	foreach ($tmp as $arr) {
		if($arr[0])
			$warning = $warning+2;
	}
//	echo $warning."<br>";
	switch ($warning) {
		case 0:
			break;
		case 1:
			echo "<script>";
				echo "alert('This Phone number had be used!!');";
				echo "window.history.go(-1);";
			echo "</script>";
			break;
		case 2:
			echo "<script>";
				echo "alert('This E-Mail had be used!!');";
				echo "window.history.go(-1);";
			echo "</script>";
			break;
		case 3:
			echo "<script>";
				echo "alert('This Phone number and E-Mail had be used!!');";
				echo "window.history.go(-1);";
			echo "</script>";
			break;
	}

	//Make a sentence to insert the data
	$msgI = "INSERT INTO user_info(user_name";
	$msgV = " VALUES ('".$_POST['name']."'";
	if($_POST['phone']){
		$msgI = $msgI.",user_phone";
		$msgV = $msgV.",'".$_POST['phone']."'";
	}
	$msgI = $msgI.",user_email";
	$msgV = $msgV.",'".$_POST['email']."'";
	if($_POST['address']){
		$msgI = $msgI.",user_address";
		$msgV = $msgV.",'".$_POST['address']."'";
	}
	$msgI = $msgI.")";
	$msgV = $msgV.")";
	$msg = $msgI.$msgV;
	echo $msg;


	try{
		$count = $pdo->exec($msg);
		echo "<body style='background: black;'>";
			echo "<p class='word'>入力成功です！！</p>";
			echo "<p class='word'>入力結果は：</p>";
			echo "<table align='center' border='2' style='position: relative; left: 0;'>";
				echo "<th>Name</th><th>Phone</th><th>Email</th><th>Address</th>";
				echo "<tr>";
						echo "<td class='Name'>".$_POST['name']."</td>";
						echo "<td class='Phone'>".$_POST['phone']."</td>";
						echo "<td class='Email'>".$_POST['email']."</td>";
						echo "<td class='Address'>".$_POST['address']."</td>";
				echo "</tr>";
		echo "</body>";
		echo "<input type='submit' class='bigBotton' value='戻る' onclick='javascript:history.back(-1);'></input>";
	}catch(PDOExpection $e){
		echo "Failed to throw data into MySql, Because : ".$e->getMessage();
	}


?>