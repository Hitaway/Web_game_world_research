$(document).ready(function()
{
    console.log("Le document est prêt");

	window.setTimeout(function(){
		$(".notification").fadeTo(500, 0).slideUp(500, function(){
		$(this).remove(); 
		});
	}, 4000);

	/*$('form').submit(function(e){
		$.ajax({
			type:'POST',
			url:'header.php',
			data: 'erreur=' + erreur,
			success:function(reponse){
				console.log("erreur="+reponse);
				console.log($("#erreur"));
				console.log($('#erreur').attr('value'));
				//$('#modalConnexion').modal('show');
				alert("Evenement success");
			},
			error: function(reponse){
              	alert("Une ERREUR est survenue lors de la connexion");
            }
		});
		alert("Evenement clique bouton connexion");
	});*/
/*console.log($('#erreur3').attr('value'));
	console.log($('#img_logo').is());
	$('#mdp3').find();
	if($('#erreur2')){
		alert("ERREUR");
	}*/
	console.log($('#erreurConnexion').attr('value'));

	/*$('form').click(function(e){
	/*if($('#erreurConnexion').val() == 'false'){
		$('#modalConnexion').modal('show');
		console.log("test");
	}
	else
		console.log("test2");*/
	/*$.ajax({
			type:'POST',
			url:'header.php',
			data: 'erreurConnexion=' + erreurConnexion,
			success:function(reponse){
				console.log("erreur="+reponse);
				console.log($("#erreurConnexion"));
				console.log($('#erreurConnexion').attr('value'));
				//$('#modalConnexion').modal('show');
				alert("Evenement success");
			},
			error: function(reponse){
              	alert("Une ERREUR est survenue lors de la connexion");
            }
		});

		alert("Une ERREUR "+$('#erreurConnexion').attr('value'));
		console.log("ON EST DANS LE TEST");
	});*/

	/* Permet de fermer une modale avec le bouton Annuler
	*/
	$('.btn_annuler').click(function()
	{
		if($('#modalConnexion').is(":visible"))
			$('#modalConnexion').modal('hide');
		if($('#modalInscrire').is(":visible"))
			$('#modalInscrire').modal('hide');
		if($('#modalChoixQuestionnaire').is(":visible"))
			$('#modalChoixQuestionnaire').modal('hide');
	});
});//fin du fichier JS
