<!-- inscription à un évènement -->
<?php 
include "db.php";
session_start();

if (isset($_GET['id'])){
	$p_id = $_GET['id'];
	$sql="SELECT * FROM evenement WHERE idEven = '$p_id' AND dateFin > DATE(NOW())";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	if($count==1){
		if(isset($_SESSION["uid"])){
        // SQL Statement
			$user_email = $_SESSION["email"];
			$p_id = $_GET['id'];
			$sql = "SELECT * FROM participe WHERE idEven = '$p_id' AND emailPers = '$user_email'";
			$run_query = mysqli_query($con,$sql);
			$count = mysqli_num_rows($run_query);
			if($count > 0){
				header("Location: index.php?status=alr_registered");
				exit();
			}else {
				$sql = "INSERT INTO `participe`
				(`emailPers`, `idEven`) 
				VALUES ('$user_email', '$p_id')";
				if(mysqli_query($con,$sql)){
					header("Location: index.php?status=registered");
					exit();
				}
			}
		} else{
			header("Location: index.php?status=noaccount");
			exit();
		}
	}
	else{
		header("Location: index.php?status=passed");
		exit();
	}
}
else {
	header("Location: index.php?status=error");
	exit();
}



