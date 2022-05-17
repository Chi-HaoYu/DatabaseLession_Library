<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<link rel="stylesheet" type="text/css" href="input.css">
		<title>Search User</title>
	</head>

	<body>
		
		<form action="selectUserLook.php" method="post" class="main">
			名前 : <input type="text" name="userName" placeholder="キーワードを入力してください";/><br>
			電話 : <input type="text" name="Phone" placeholder="キーワードを入力してください";/><br>
			貸し日 : <input type="date" name="RentDate" placeholder="キーワードを入力してください";/><br>
			帰還期限:<input type="date" name="ReturnDeadLine" placeholder="キーワードを入力してください";/><br>
			<?php
				echo "<input type='hidden' name='bookID' value='".$_POST['send']."' />";
			?>
			<br>
			<input type="submit" name="confirm" value="確認" class="confirm"/>
		</form>
	</body>

</html>
