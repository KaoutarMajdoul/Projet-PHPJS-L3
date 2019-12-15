<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";

//affichage des thèmes dans le menu
if(isset($_POST["theme"])){
	$theme_query = "SELECT * FROM theme";
	$run_query = mysqli_query($con,$theme_query) or die(mysqli_error($con));
	echo "
	<div class='nav nav-pills nav-stacked'>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$tid = $row["idTheme"];
			$theme_name = $row["nom"];
			echo "
			<li><a href='#' class='theme' tid='$tid'>$theme_name</a></li>
			";
		}
		echo "</div>";
	}
}
//end

//affichage des évènements passés dans le menu
if(isset($_POST["passe"])){
	$passe_query = "SELECT * FROM evenement WHERE `dateFin` < DATE(NOW())";
	$run_query = mysqli_query($con,$passe_query) or die(mysqli_error($con));
	echo "

	<div class='nav nav-pills nav-stacked' href='#' class='theme'>
	</div>";
	
}
//end

//affichage des évènements
if(isset($_POST["getEvent"]) || isset($_POST["get_selected_theme"]) || isset($_POST["selectPasse"]) || isset($_POST["search"]) || isset($_POST["get_event_id"]) || isset($_POST["saved"])){

	/* Affichage de tous les évènements à venir dans le corps */
	if(isset($_POST["getEvent"])){
		$sql = "SELECT * FROM evenement WHERE `dateFin` > DATE(NOW()) ORDER BY `dateDeb`";
		$run_query = mysqli_query($con,$sql);
		if(mysqli_num_rows($run_query) > 0){
			while($row = mysqli_fetch_array($run_query)){
				$pro_id    = $row['idEven'];
				$pro_title = $row['nom'];
				$pro_adr = $row['adresse'];
				$pro_desc = $row['description'];
				$pro_image = $row['event_img'];
				echo "
				<div class='col-md-4'>
				<div class='panel panel-info'>
				<div class='panel-heading' id='title_event' eid='$pro_id'><a href='index.php?id_event=".$pro_id."'>$pro_title </a></div>
				<div class='panel-body'>
				<img src='images/$pro_image' style='width:330px; height:250px;'/>
				</div>
				<div class='panel-heading' >$pro_desc
				<br>
				<br>
				<a href='inscription.php?id=".$pro_id."' class='btn btn-sm btn-success' id='inscription'>S'inscrire</a>
				<a href='desinscription.php?id=".$pro_id."' class='btn btn-sm btn-danger' id='inscription'>Se désinscrire</a>
				</div>
				</div>
				</div>	
				";
			}
		}
	}
	/* Affichage de tous les évènements dont le thème est celui sélectionné dans le menu */
	else if(isset($_POST["get_selected_theme"])){
		$id = $_POST["tid"];
		$sql = "SELECT * FROM theme, evenement WHERE idTheme = '$id' AND idTheme=theme AND `dateFin` > DATE(NOW()) ORDER BY `dateDeb`";
		$run_query = mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['idEven'];
			$pro_title = $row['nom'];
			$pro_adr = $row['adresse'];
			$pro_desc = $row['description'];
			$pro_image = $row['event_img'];
			echo "
			<div class='col-md-4'>
			<div class='panel panel-info'>
			<div class='panel-heading' id='title_event' eid='$pro_id'><a href='index.php?id_event=".$pro_id."'>$pro_title </a></div>
			<div class='panel-body'>
			<img src='images/$pro_image' style='width:330px; height:250px;'/>
			</div>
			<div class='panel-heading' >$pro_desc
			<br>
			<br>
			<a href='inscription.php?id=".$pro_id."' class='btn btn-sm btn-success' id='inscription'>S'inscrire</a>
			<a href='desinscription.php?id=".$pro_id."' class='btn btn-sm btn-danger' id='inscription'>Se désinscrire</a>
			</div>

			</div>
			</div>	
			";
		}
	}
	/* Affichage des évènements passés */
	else if(isset($_POST["selectPasse"])){
		$sql = "SELECT * FROM evenement WHERE `dateFin` < DATE(NOW()) ORDER BY `dateFin`";
		$run_query = mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['idEven'];
			$pro_title = $row['nom'];
			$pro_adr = $row['adresse'];
			$pro_desc = $row['description'];
			$pro_image = $row['event_img'];
			echo "
			<div class='col-md-4'>
			<div class='panel panel-info'>
			<div class='panel-heading' id='title_event' eid='$pro_id'><a href='index.php?id_event=".$pro_id."'>$pro_title </a></div>
			<div class='panel-body'>
			<img src='images/$pro_image' style='width:330px; height:250px;'/>
			</div>
			<div class='panel-heading'>$pro_desc
			</div>
			</div>
			</div>	
			";
		}
	}
	/* Affichage des évènements correspondant au mot clé */
	else if(isset($_POST["search"])){
		$keyword = $_POST["keyword"];
		$sql = "SELECT DISTINCT e.idEven, e.nom, e.description, e.adresse, e.nbPlaces, e.dateDeb, e.dateFin, e.event_img FROM evenement e WHERE e.nom LIKE '%$keyword%' OR e.description LIKE '%$keyword%' OR e.adresse LIKE '%$keyword%' AND `dateFin` > DATE(NOW()) ";
		$run_query = mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['idEven'];
			$pro_title = $row['nom'];
			$pro_adr = $row['adresse'];
			$pro_desc = $row['description'];
			$pro_image = $row['event_img'];
			echo "
			<div class='col-md-4'>
			<div class='panel panel-info'>
			<div class='panel-heading' id='title_event' eid='$pro_id'><a href='index.php?id_event=".$pro_id."'>$pro_title </a></div>
			<div class='panel-body'>
			<img src='images/$pro_image' style='width:330px; height:250px;'/>
			</div>
			<div class='panel-heading' >$pro_desc
			<br>
			<br>
			<a href='inscription.php?id=".$pro_id."' class='btn btn-sm btn-success' id='inscription'>S'inscrire</a>
			<a href='desinscription.php?id=".$pro_id."' class='btn btn-sm btn-danger' id='inscription'>Se désinscrire</a>
			</div>

			</div>
			</div>	
			";
		}
		if(mysqli_num_rows($run_query) == 0){
			echo "
			<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>Votre recherche ne correspond à aucun évènement</b>
			</div>
			";
		}
	}
	/* Affichage d'un évènement avec toutes ses informations */
	else if(isset($_POST["get_event_id"])){
		$id=$_POST["eid"];
		$sql = "SELECT * FROM evenement WHERE idEven = '$id'";
		$run_query = mysqli_query($con,$sql);
		if(!$run_query){
			echo " 
			<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>Votre recherche ne correspond à aucun évènement</b>
			</div>";
		}
		else{
			$row=mysqli_fetch_array($run_query);
			$pro_id    = $row['idEven'];
			$pro_title = $row['nom'];
			$pro_adr = $row['adresse'];
			$pro_desc = $row['description'];
			$pro_image = $row['event_img'];
			$nbPlaces = $row['nbPlaces'];
			$dateDeb = $row['dateDeb'];
			$dateFin = $row['dateFin'];
			$lat = $row['latitude'];
			$long = $row['longitude'];

			echo "
			<div class='col-md-4'>
			<div class='panel panel-info'>
			<div class='panel-heading' id='title_event' eid='$pro_id'><a href='index.php?id_event=".$pro_id."'>$pro_title </a></div>
			<div class='panel-body'>
			<img src='images/$pro_image' style='width:330px; height:250px;'/>
			</div>
			<div class='panel-heading' >$pro_desc
			<br>
			<br>
			<a href='inscription.php?id=".$pro_id."' class='btn btn-sm btn-success' id='inscription'>S'inscrire</a>
			<a href='desinscription.php?id=".$pro_id."' class='btn btn-sm btn-danger' id='inscription'>Se désinscrire</a>
			</div>
			</div>
			</div>	

			<div class='col-md-4' style='font-size:20px; font-weight:bold;'> 
			<form action='noter.php?id=".$pro_id."' method='post' enctype='multipart/form-data'>
			<label for='note'>Note (/5) </label> : 
			<input type='number' id='note' name='note' max='5' min='0'>
			<button type='submit' name ='noter' class='btn btn-success'> Envoyer </button>
			</form>
			<br>
			Nombre de places : $nbPlaces
			<br>
			Commence le : $dateDeb
			<br>
			Termine le : $dateFin </div>
			<br>
			</div>
			<div class='col-md-4' style='font-size:20px; font-weight:bold;'> <a href='map.php?lat=$lat&long=$long'>Voir la carte</a></div>
			";
		}
	}
	/* Affichage des évènements enregistrés pour les individus connectés (barre de navigation, connecter) */
	else if(isset($_POST["saved"])){
		$user_id = $_SESSION["uid"];
		$email = $_SESSION["email"];
		$sql = "SELECT p.idEven, nom, description, adresse, nbPlaces, dateDeb, dateFin, event_img FROM participe p, evenement e WHERE p.idEven=e.idEven AND p.emailPers='$email'";
		$query = mysqli_query($con,$sql);
		if (mysqli_num_rows($query) > 0) {
			while ($row=mysqli_fetch_array($query)) {
				$pro_id    = $row['idEven'];
				$pro_title = $row['nom'];
				$pro_adr = $row['adresse'];
				$pro_desc = $row['description'];
				$pro_image = $row['event_img'];
				echo "
				<div class='col-md-4'>
				<div class='panel panel-info'>
				<div class='panel-heading' id='title_event' eid='$pro_id'><a href='index.php?id_event=".$pro_id."'>$pro_title </a></div>
				<div class='panel-body'>
				<img src='images/$pro_image' style='width:330px; height:250px;'/>
				</div>
				<div class='panel-heading' >$pro_desc
				<br>
				<br>
				<a href='desinscription.php?id=".$pro_id."' class='btn btn-sm btn-danger' id='inscription'>Se désinscrire</a>
				</div>

				</div>
				</div>	
				";
			}
		}else{
			echo " 
			<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>Vous n'avez encore aucun évènement enregistré</b>
			</div>";
		}
	}
}
//end

?>






