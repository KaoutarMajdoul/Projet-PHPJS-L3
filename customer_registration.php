<!-- Formulaire d'nscription -->
<?php
if (isset($_GET["register"])) {
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="UTF-8">
		<title>CM Évènements</title>
		<?php require("styles.php"); ?>
	</head>

	<body>
		<div class="wait overlay">
			<div class="loader"></div>
		</div>

		<?php require('barredenavigation.php'); ?>	
		<?php require('header.php'); ?>	

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8" id="signup_msg">
					<!--Alert from signup form-->
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="panel panel-primary">
						<div class="panel-heading" id="inscr">Formulaire d'inscription</div>
						<div class="panel-body">

							<form id="signup_form" onsubmit="return false">
								<div class="row">
									<div class="col-md-6">
										<label for="f_name">Prénom</label>
										<input type="text" id="f_name" name="f_name" class="form-control">
									</div>
									<div class="col-md-6">
										<label for="l_name">Nom</label>
										<input type="text" id="l_name" name="l_name"class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="pseudo">Pseudo</label>
										<input type="text" id="pseudo" name="pseudo"class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="email">Email</label>
										<input type="text" id="email" name="email"class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="password">Mot de passe</label>
										<input type="password" id="password" name="password"class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="repassword">Entrer à nouveau votre mot de passe</label>
										<input type="password" id="repassword" name="repassword"class="form-control">
									</div>
								</div>
								
								<p><br/></p>
								<div class="row">
									<div class="col-md-12">
										<input style="width:100%;" value="S'inscrire" type="submit" name="signup_button"class="btn btn-success btn-lg">
									</div>
								</div>

							</form>
						</div>
						

					</div>
				</div>
				<div class="col-md-2"></div>
			</div>

		</div>
		<?php require('footer.php'); ?>
	</body>
	</html>

	<?php
}
?>






















