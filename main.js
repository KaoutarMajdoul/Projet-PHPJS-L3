$(document).ready(function(){
	//récupération des thèmes
	theme();
	function theme(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{theme:1},
			success	:	function(data){
				$("#get_theme").html(data);
				
			}
		})
	}
	//end

	//récupération des évènements passés
	passe();
	function passe(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{passe:1},
			success	:	function(data){
				$("#get_passe").html(data);
				
			}
		})
	}
	//end

	//inscription
	$("#signup_form").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "register.php",
			method : "POST",
			data : $("#signup_form").serialize(),
			success : function(data){
				$(".overlay").hide();
				if (data == "register_success") {
					window.location.href = "index.php";
				}else if(data == "error"){
					$("#signup_msg").html(data);
				}
				window.location.href = "index.php";
				
			}
		})
	})
	//end

	//connexion
	$("#login").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url	:	"login.php",
			method:	"POST",
			data	:$("#login").serialize(),
			success	:function(data){
				if(data == "log_success"){
					window.location.href = "index.php";
				}else if(data == "<span style='color:red;'>Please register before login..!</span>"){
					$("#e_msg").html(data);
					$(".overlay").hide();
				}
				else{
					window.location.href = "index.php";
				}
			}
		})
	})
	//end

	//chargement des évènements
	event();
	function event(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{getEvent:1},
			success	:	function(data){
				$("#get_event").html(data);
			}
		})
	}
	//end


	//évènements selon le thème
	$("body").delegate(".theme","click",function(event){
		$("#get_event").html("<h3>Loading...</h3>");
		event.preventDefault();
		var tid = $(this).attr('tid');

		$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{get_selected_theme:1,tid:tid},
			success	:	function(data){
				$("#get_event").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})

	})
	//end

		//evenements enregistrés dans le dropdown menu
		$("body").delegate(".saved","click",function(event){
			$("#get_event").html("<h3>Loading...</h3>");
			event.preventDefault();

			$.ajax({
				url		:	"action.php",
				method	:	"POST",
				data	:	{saved:1},
				success	:	function(data){
					$("#get_event").html(data);
					if($("body").width() < 480){
						$("body").scrollTop(683);
					}
				}
			})

		})
		//end


		//evenement seul et toutes ses informations
		$("body").delegate("#title_event","click",function(event){
			$("#get_event_id").html("<h3>Loading...</h3>");
			event.preventDefault();
			var eid = $(this).attr('eid');

			$.ajax({
				url		:	"action.php",
				method	:	"POST",
				data	:	{get_event_id:1,eid:eid},
				success	:	function(data){
					$("#get_event").html(data);
					if($("body").width() < 480){
						$("body").scrollTop(683);
					}
				}
			})

		})
		//end


	//évènement passés
		$("body").delegate(".passe","click",function(event){
			event.preventDefault();
			$("#get_passe").html("<h3>Loading...</h3>");

			$.ajax({
				url		:	"action.php",
				method	:	"POST",
				data	:	{selectPasse:1},
				success	:	function(data){
					$("#get_event").html(data);
					if($("body").width() < 480){
						$("body").scrollTop(683);
					}
				}
			})

		})
		//end

	//évènements qui correspondent au mot clé
		$("#search_btn").click(function(){
			$("#search").html("<h3>Loading...</h3>");
			var keyword = $("#search").val();
			if(keyword != ""){
				$.ajax({
					url		:	"action.php",
					method	:	"POST",
					data	:	{search:1,keyword:keyword},
					success	:	function(data){ 
						$("#get_event").html(data);
						if($("body").width() < 480){
							$("body").scrollTop(683);
						}
					}
				})
			}
		})
	//end
})















