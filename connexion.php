<!-- dropdown menu pour les utilisateurs non connectés -->
<ul class="nav navbar-nav">
	<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Connexion </a>
		<ul class="dropdown-menu" id="connexion">
			<div class="panel-heading">
				<form onsubmit="return false" id="login">
					<label for="email" id="coord"> Email</label>
					<input type="email" class="form-control" name="email" id="email" required/>
					<p><br/></p>
					<label for="email" id="coord"> Mot de passe</label>
					<input type="password" class="form-control" name="password" id="password" required/>
					<p><br/></p>
					<input type="submit" class="btn btn-dark" value="Connexion">
					<div><a href="customer_registration.php?register=1" id="coord" >Pas encore inscrit ?</a></div>
					<p><br/></p>
				</form>
			</div>
			<div class="panel-footer" id="e_msg"></div>
		</ul>
	</li>
</ul>