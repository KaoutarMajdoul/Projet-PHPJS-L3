<?php
session_start();
include "db.php";
if (isset($_POST["f_name"])) {

	$f_name = $_POST["f_name"];
	$l_name = $_POST["l_name"];
	$pseudo = $_POST["pseudo"];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$name = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";

	if(empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($repassword) ||
		empty($pseudo)){
		
		echo "
	<div class='alert alert-warning'>
	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all fields..!</b>
	</div>
	";
	exit();
} else {
	if($password != $repassword){
		echo "
		<div class='alert alert-warning'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>password is not same</b>
		</div>
		";
	}
	//existing email address in our database
	$sql = "SELECT email FROM personne WHERE email = '$email' LIMIT 1" ;
	$check_query = mysqli_query($con,$sql);
	$count_email = mysqli_num_rows($check_query);
	if($count_email > 0){
		echo "
		<div class='alert alert-danger'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Email Address is already used. Try Another email address</b>
		</div>
		";
		exit();
	} else {
		$password = md5($password);
		$sql = "INSERT INTO `personne` (`email`, `nom`, `prenom`, `pseudo`, `mdp`) VALUES ('$email', '$l_name', '$f_name', '$pseudo', '$password')";
		$_SESSION["uid"] = mysqli_insert_id($con);
		$_SESSION["nom"] = $l_name;
		$_SESSION["email"] = $email;
		$ip_add = getenv("REMOTE_ADDR");
		if(mysqli_query($con,$sql)){
			echo "<div class='alert alert-success'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>Inscription réussie. <a href='index.php'>Accueil</a></b>
			</div>";
			exit();
		}
		else{
			echo "<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>Error</b>
			</div>";
			exit();
		}
	}
}

}



?>
