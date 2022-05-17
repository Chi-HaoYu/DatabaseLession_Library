<?php
	//Check Name had be fulled
/*	if(!$_POST['Name']){
		echo "<script>";
			echo "alert('Sorry, But the book name cannot be 0, Because I dont fuckin God Damn like this fuckin shit word!!       Dont fuckin fool me, theres no fuckin any book would named God damn 0!!!');";
			echo "window.history.go(-1);";
		echo "</script>";
	}
*/	
	echo "<link rel='stylesheet' type='text/css' href='indexBook.css'>";

	//Connect to MySQL
	$dsn = 'mysql:dbname=myLib;host=localhost;charset=utf8;';
	try{
		$pdo = new PDO($dsn, 'root', '1234');
//		echo "Successed to connect to MySql!!"."<br>";
	}catch(PDOExpection $e){
		echo "Failed to connect to MySql, Because : ".$e->getMessage()."<br>";
	}

	//Make a sentence to insert the data
	$msgI = "INSERT INTO book_info_m(";
	$msgV = " VALUES (";
	if($_POST['Name']){
		$msgI = $msgI."book_name";
		$msgV = $msgV."'".$_POST['Name']."'";
	}
	if($_POST['NDC']){
		$msgI = $msgI.",book_ndc";
		$msgV = $msgV.",'".$_POST['NDC']."'";
	}
	$msgI = $msgI.",book_author";
	$msgV = $msgV.",'".$_POST['Author']."'";
	if($_POST['Price']){
		$msgI = $msgI.",book_price";
		$msgV = $msgV.",'".$_POST['Price']."'";
		$Price = $_POST['Price'];
	}else{
		$Price = 1000;
	}
	$msgI = $msgI.")";
	$msgV = $msgV.")";
	$msg = $msgI.$msgV;
//	echo $msg;


	try{
		$count = $pdo->exec($msg);
		echo "<body style='background: black;'>";
			echo "<p class='word'>入力成功です！！</p>";
			echo "<p class='word'>入力結果は：</p>";
			echo "<table align='center' border='2' style='position: relative; left: 0;'>";
				echo "<th>Name</th><th>Phone</th><th>Email</th><th>Address</th>";
				echo "<tr>";
						echo "<td class='Name'>".$_POST['Name']."</td>";
						echo "<td class='NDC'>".$_POST['NDC']."</td>";
						echo "<td class='Author'>".$_POST['Author']."</td>";
						echo "<td class='Price'>".$Price."</td>";
				echo "</tr>";
		echo "</body>";
		echo "<input type='submit' class='bigBotton' value='戻る' onclick='javascript:history.back(-1);'></input>";
	}catch(PDOExpection $e){
		echo "Failed to throw data into MySql, Because : ".$e->getMessage();
	}


?>