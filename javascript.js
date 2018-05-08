$(document).ready(function()
{
     console.log("Le document est prêt");
    /* $('#btn_connexion').click(function()
	{
		console.log("connexion");
		console.log("uid:",$(this).attr('data-uid'));
    	$.post('http://localhost:8888/Desktop/JavaScript/REVISION/TP6/utilisateurs.php',
    		{uid: $(this).attr('data-uid')},
    		function(reponse)
    		{
    			console.log(reponse);
    			var user = reponse;
    			if(user.ok != false){
	    			$('#nom').text(user.nom);
	    			$('#age').text(user.age);
	    			$('#score').text(user.score);
	    		}
	    		else{
	    			alert(user.message);
	    		} 
    		});
    	$('#affichage').show();
    	$('#affichage').css('top', event.pageY);
    	$('#affichage').css('left', event.pageX);
	});*/
	
	/*$('form').submit(function(){
		console.log("123");
		var message = "erarear"
		$.post("http://localhost:8888/Desktop/GitHub/Web_game_world_research/accueil.php",{
			message: message
		},
		function(reponse){
			console.log("456");
			console.log('message dans le JS:'+reponse.message);
		});
				console.log("789");
				alert(" Name n Form Submitted Successfully......");

	});*/

	$('form').submit(function(){
		var message2 = "aze";
		$.ajax({
			type:'POST',
			url:'accueil.php',
			data : 'pseudo1=' + pseudo1,
			success:function(retour){
				alert("SUCCESS:"+pseudo1);
				
			},
			error: function(retour){
              	alert("ERREUR");
            }
		});
		$('#nom_utilisateur').append("<a id=\"nom_utilisateur\"><span class=\"glyphicon glyphicon-user\"></span>OKAYYYY</a>");
		alert("DANS LA FONCTION");
	});

	

	/* Permet de fermer une modale avec le bouton Annuler
	*/
	$('.btn_annuler').click(function()
	{
		if($('#modalConnexion').is(":visible")){
			$('#modalConnexion').modal('hide');
		}
		if($('#modalInscrire').is(":visible")){
			$('#modalInscrire').modal('hide');
		}
	});

});
