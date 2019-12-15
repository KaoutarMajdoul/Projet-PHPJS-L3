<?php

session_start();

unset($_SESSION["uid"]);

unset($_SESSION["nom"]);

if(isset($_SESSION["admin_id"])){
	unset($_SESSION["admin_id"]);
}

if(isset($_SESSION["cont_id"])){
	unset($_SESSION["cont_id"]);
}

unset($_SESSION["email"]);

header("location:index.php");

?>