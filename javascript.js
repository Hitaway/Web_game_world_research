$(document).ready(function()
{
    console.log("Le document est prêt");

	window.setTimeout(function(){
		$(".notification").fadeTo(500, 0).slideUp(500, function(){
		$(this).remove(); 
		});
	}, 4000);

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
