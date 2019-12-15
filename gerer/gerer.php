<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "inc/db.php";
//if(!isset($_SESSION["admin_id"]) || !isset($_SESSION["cont_id"])){
//	header("location:../index.php");
//}

$sql = "SELECT * FROM evenement ORDER BY `dateDeb`";
$run_query = mysqli_query($con,$sql);
mysqli_num_rows($run_query);
$event = mysqli_fetch_array($run_query);
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
				<strong>Évènements</strong>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<a href="create.php" class="btn btn-success float-right mb-3">Add New</a>
					</div>
				</div>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th> Image </th>
							<th>Nom</th>
							<th>Description</th>
							<!-- <th>Price</th> -->
							<!-- <th>Qty</th> -->

							<th style="width: 20%;">Actions</th>
						</tr>
					</thead>
					<tbody>

						<?php while($event = mysqli_fetch_array($run_query)){ ?>
							<tr>

								<td><img src="../images/<?=$event['event_img']?>" style="width:20%;"/></td>
								<td><?= $event['nom'] ?></td>
								<td><?= $event['description'] ?></td>
								<td>
									<a href="delete.php?id=<?=$event['idEven']?>" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
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

