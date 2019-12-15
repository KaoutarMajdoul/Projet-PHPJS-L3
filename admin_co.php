<!-- dropdown menu pour admin -->
<ul class="nav navbar-nav navbar-right">
	<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo " ".$_SESSION["nom"]." "; ?></a>
		<ul class="dropdown-menu">
			<li class="saved"><a href="#" id="connecter">Évènements enregistrés</a></li>
			<li><a href="gerer/gerer_ad.php" id="connecter">Gérer</a></li>
			<li class="divider"></li>
			<li><a href="logout.php" id="connecter">Déconnexion</a></li>
		</ul>
	</li>
</ul>