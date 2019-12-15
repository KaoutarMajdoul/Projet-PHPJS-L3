<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "inc/db.php";
//if(!isset($_SESSION["admin_id"]) || !isset($_SESSION["cont_id"])){
//	header("location:../index.php");
//}

$sql = "SELECT * FROM theme";
$run_query = mysqli_query($con,$sql);
mysqli_num_rows($run_query);
//$pro_id    = $row['idEven'];
// $pro_title = $row['nom'];
// $pro_adr = $row['adresse'];
// $pro_desc = $row['description'];
// $pro_image = $row['event_img'];

?>

<!DOCTYPE html>
<html>
<body>

	<?php include("inc/header.php") ?>

	<div class="container">
		<?php if (isset($_GET['status']) && $_GET['status'] == "deleted") : ?>
			<div class="alert alert-success" role="alert">
				<strong>Deleted</strong>
			</div>
		<?php endif ?>
		<?php if (isset($_GET['status']) && $_GET['status'] == "fail_delete") : ?>
			<div class="alert alert-danger" role="alert">
				<strong>Fail Delete</strong>
			</div>
		<?php endif ?>

		<div class="card border-danger">
			<div class="card-header bg-danger text-white">
				<strong>Thèmes</strong>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<a href="create_ad.php" class="btn btn-success float-right mb-3">Add New</a>
					</div>
				</div>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							
							<th>Nom</th>

							<th style="width: 20%;">Actions</th>
						</tr>
					</thead>
					<tbody>

						<?php while($theme = mysqli_fetch_array($run_query)){ ?>
							<tr>

								<td><?= $theme['nom'] ?></td>
								<td>
									<a href="delete_ad.php?id=<?=$theme['idTheme']?>" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

	<?php
	$sql = "SELECT * FROM contributeur";
	$run_query = mysqli_query($con,$sql);
	mysqli_num_rows($run_query);

	?>

	<div class="container">
		<div class="card border-danger">
			<div class="card-header bg-danger text-white">
				<strong>Contributeurs</strong>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<a href="create_ad_cont.php" class="btn btn-success float-right mb-3">Add New</a>
					</div>
				</div>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							
							<th>Email</th>

							<th style="width: 20%;">Actions</th>
						</tr>
					</thead>
					<tbody>

						<?php while($cont = mysqli_fetch_array($run_query)){ ?>
							<tr>

								<td><?= $cont['emailC'] ?></td>
								<td>
									<a href="delete_ad_cont.php?id=<?=$cont['emailC']?>" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>


</body>
</html>

