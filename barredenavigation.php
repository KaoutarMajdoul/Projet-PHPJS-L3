<div class="navbar navbar-inverse navbar-fixed-top"> 
	<div class="container-fluid">	
		<div class="navbar-header">
			<a href="index.php" class="navbar-brand">CM Events</a>
		</div>
		<div class="collapse navbar-collapse navbar-right" id="collapse">
			<ul class="nav navbar-nav">
				<li id="recherche"><input type="text" class="form-control" placeholder="Rechercher" id="search"></li>
				<li id="loupe"><button type="submit" class="btn btn-primary" id="search_btn"><span class="glyphicon glyphicon-search"></span></button></li>
			</ul>
			<!-- different dropdown menu selon les utilisateurs -->
			<?php
			if (isset($_SESSION["admin_id"])) {
				require('admin_co.php');
			}
			else if(isset($_SESSION["cont_id"])){
				require('cont_co.php');
			}
			else if(isset($_SESSION["uid"])){
				require('connecter.php'); 
			}
			else
				require('connexion.php');
			?>

		</div>
	</div>
</div>