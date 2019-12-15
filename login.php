<?php
include "db.php";

session_start();

if(isset($_POST["email"]) && isset($_POST["password"])){
	$email = mysqli_real_escape_string($con,$_POST["email"]);
	$password = md5($_POST["password"]);
	$sql = "SELECT * FROM personne WHERE email = '$email' AND mdp = '$password'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	//si l'utilisateur existe dans la base données, il peut se connecter, et on intialise toutes les variables de session (on vérifie si l'utilisateur est un admin ou un contributeur également)
	if($count == 1){
		$row = mysqli_fetch_array($run_query);
		$_SESSION["email"] = $row["email"];
		$_SESSION["nom"] = $row["nom"];
		$_SESSION["uid"] = mysqli_insert_id($con);
		$ip_add = getenv("REMOTE_ADDR");
		if(isset($_SESSION["email"])){
			$email=$_SESSION["email"];
			$sql = "SELECT * FROM admin WHERE emailA = '$email'";
			$run_query = mysqli_query($con,$sql);
			$count = mysqli_num_rows($run_query);
			if($count == 1){
				$_SESSION["admin_id"] = mysqli_insert_id($con);
				echo "log_success";
				exit();
			}
		}
		if(!isset($_SESSION["admin_id"])){
			$email=$_SESSION["email"];
			$sql = "SELECT * FROM contributeur WHERE emailC = '$email'";
			$run_query = mysqli_query($con,$sql);
			$count = mysqli_num_rows($run_query);
			if($count == 1){
				$_SESSION["cont_id"] = mysqli_insert_id($con);
				echo "log_success";
				exit();
			}
		}
		echo "log_success";
		exit();
	}else{
		echo "<span style='color:red;'>Please register before login..!</span>";
		exit();
	}

}

?>

