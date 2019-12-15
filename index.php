<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>CM Évènements</title>
	<?php require("styles.php"); ?>
</head>

<body>
	<?php require('barredenavigation.php'); ?>

	<?php require('header.php'); ?>	

	<div class="row">
		<!-- messages d'information pour l'inscription ou la notation -->
		<div class="container">
			<?php if (isset($_GET['status']) && $_GET['status'] == "alr_registered") : ?>
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Vous êtes déjà inscrit à cet évènement</b>
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "registered") : ?>
				<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Inscription réussie</b>
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "noaccount") : ?>
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Un compte est nécessaire pour pouvoir interagir avec un évènement. <a href='customer_registration.php?register=1'> S'inscrire </a> ou se connecter.</b>
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "error") : ?>
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Error</b>
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "not_registered") : ?>
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Vous n'êtes pas inscrit à cet évènement.</b>
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "delete_re") : ?>
				<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Désinscription réussie</b>
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "passed") : ?>
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Évènement passé</b>
				</div>
			<?php endif ?>


			<?php if (isset($_GET['status']) && $_GET['status'] == "non_participe") : ?>
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Vous ne pouvez pas noter un évènement auquel vous n avez pas participé.</b>
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "non_termine") : ?>
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Vous ne pouvez pas noter un évènement qui n'est pas terminé.</b>
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "alr_note") : ?>
				<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Vous avez déjà noté cet évènement.</b>
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "note_ajoute") : ?>
				<div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Votre note a été ajoutée !</b>
				</div>
			<?php endif ?>
		</div>

		<?php require('menu.php'); ?>

		<!-- Affichage de tous les évènements ou d'un seul -->
		<?php if(isset($_GET['id_event'])){
			require('event.php');
		}
		else{
			require('corps.php');
		} ?>
	</div>

	<?php require('footer.php'); ?>
	
</body>
</html>