<?php

session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>CM Évènements</title>
	<?php require("styles.php"); ?>
</head>

<body>
	<div id="main">
		<?php require('barredenavigation.php'); ?>
		<?php require('header.php'); ?>	

		<div class="row">
			<?php require('menu.php'); ?>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"><h1>Évènements enregistrés</h1></div>
					<div class="panel-body">
						
						<?php
						include_once("db.php");
						$user_id = $_SESSION["uid"];
						$email = $_SESSION["email"];
						$orders_list = "SELECT nom, description, adresse, nbPlaces, dateDeb, dateFin FROM participe p, evenement e WHERE p.idEven=e.idEven AND p.emailPers='$email'";
						$query = mysqli_query($con,$orders_list);
						if (mysqli_num_rows($query) > 0) {
							while ($row=mysqli_fetch_array($query)) {
								?>
								<div class="row">
									<div class="col-md-6">
										
									</div>
									<div class="col-md-6">
										<table>
											<?php echo $_SESSION["email"]; ?>
											<tr><td>Product Name</td><td><b><?php echo $row["nom"]; ?></b> </td></tr>
											<tr><td>Product Price</td><td><b><?php echo $row["description"]; ?></b></td></tr>
											<tr><td>Quantity</td><td><b><?php echo $row["adresse"]; ?></b></td></tr>
											<tr><td>Transaction Id</td><td><b><?php echo $row["nbPlaces"]; ?></b></td></tr>
										</table>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>

				</div>
			</div>
		</div>

		<?php require('footer.php'); ?>
	</div>

</body>
</html>
















































