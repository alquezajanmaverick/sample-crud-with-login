<?php
if(isset($_SESSION['username'])){
	echo $_SESSION['username'];
	session_destroy();
	session_start();
}
else{
	session_start();
}
if(!empty($_POST)){
	if(isset($_POST['username']) && isset($_POST['password'])){
		require_once("PHPpdo.php");
		$db = new DatabaseConnect();
		$db->query("SELECT `username`,`password` from tbluser WHERE `username` = ? AND `password` = ?");
		$db->bind(1,$_POST['username']);
		$db->bind(2,$_POST['password']);
		$x = $db->single();
		$r = $db->rowCount();
		if($r != 0){
			//echo $x['username'].'  '.$x['password'];
			$_SESSION['username'] = $x['username'];
			echo "<script>window.location.href='main.php'</script>";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Simple Crud with Login Method</title>
	<link rel="stylesheet" href="css/bulma.css">
</head>
<body>
	<section class="section">
		<div class="columns">
			<div class="column"></div>	
			<div class="column">
				
				<div class="box">
					<h1 class="title">Log-in</h1>
						
					<form action="" method="post">
						<div class="field">
							<div class="control">
								<input class="input is-rounded" type="text" placeholder="usename here" name="username" id="username">
							</div>
						</div>	
						<div class="field">
							<div class="control">
								<input class="input is-rounded" type="password" placeholder="password here" name="password" id="password">
							</div>
						</div>
							
							<button class="button is-primary is-rounded" type="submit">LOG-IN</button>
					</form>

				</div>
			</div>
			<div class="column"></div>	
		

		
	</section>
</body>
</html>