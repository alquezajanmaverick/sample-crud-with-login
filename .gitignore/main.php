<?php
require_once("PHPpdo.php");
$db = new DatabaseConnect();

session_start();
if(isset($_SESSION['username'])){
	$user = $_SESSION['username'];
	//do whatever you want!
	$db->query("SELECT * FROM tblperson");
	$x = $db->resultset();
	$r = $db->rowCount();
}
else{
	//nah! alis ka dito!
	session_destroy();
	header("Location: index.php");
}

//ADD
if(isset($_POST['fname']) && isset($_POST['lname'])){
	if(!empty($_POST['fname']) && !empty($_POST['lname'])){
		$db->query("INSERT INTO tblperson(fname,lname)VALUES(?,?)");
		$db->bind(1,$_POST['fname']);
		$db->bind(2,$_POST['lname']);
		$db->execute();
		header("Location:main.php");
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
	<section class="hero is-bold is-info">
		<div class="hero-body">
			<div class="container">
				<h2 class="title">Hello, <?php echo $user; ?>!</h2>
			</div>
			
		</div>
	</section>
	<!-- ADD NEW -->
	<section class="section has-text-centered">
		<div class="columns">
			<div class="column"></div>
			<div class="column">
				
				<div class="field is-horizontal">
					<!-- <div class="field-label is-normal">
						<label class="label">First Name:</label>
					</div> -->
					<form method="post">
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input type="text" name="fname" id="fname" class="input is-small" placeholder="first name">
								</div>
							</div>
						</div>

						<!-- <div class="field-label is-normal">
							<label class="label">First Name:</label>
						</div> -->
						<div class="field-body">
							<div class="field">
								<div class="control">
									<input type="text" name="lname" id="lname" class="input is-small" placeholder="first name">
								</div>
							</div>
						</div>

						<div class="field-body">
							<div class="field">
								<div class="control">
									<button type="submit" class="button is-success is-bold is-small">ADD</button>
								</div>
							</div>
						</div>
					</form>
				</div>

			</div>
			<div class="column"></div>
		</div>
		
	</section>

	<!-- SHOW LIST -->
	<section>
		<?php if($r>0){ ?>
			<div class="container has-text-centered">

				<table class="table is-centered has-text-centered is-fullwidth is-hoverable">
					<thead>
						<th class="has-text-centered">FirstName</th>
						<th class="has-text-centered">LastName</th>
						<th colspan="2" class="has-text-centered">Action</th>
					</thead>
					<tbody>
						<?php foreach ($x as $person) { ?>
							<tr>
								<td class="has-text-centered"><?php echo $person['fname']; ?></td>
								<td class="has-text-centered"><?php echo $person['lname']; ?></td>
								<td class="has-text-centered"><button class="button is-small is-warning">UPDATE</button></td>
								<td class="has-text-centered"><button class="button is-small is-danger" onclick="window.location.assign('delete.php?uid=<?php echo $person['ID']; ?>')">REMOVE</button></td>
							</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<th class="has-text-centered" colspan="4"><?php echo $r; ?> person/s on this list.</th>
					</tfoot>
				</table>
			</div>
		<?php }else{ ?>
			<div class="container">
				<h2 class="title is-bold has-text-centered">List is empty.</h2>
			</div>
		<?php } ?>
	</section>

	<button type="button" onclick="window.location.assign('logout.php')">LOGOUT</button>
</body>
</html>