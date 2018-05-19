$(document).ready(function(){
	var nb_clic = 0;

	var coordonnees_kheops = {
    latitude:31.133889,
    longitude:29.978889
    };

			
			window.onload = function (){

			var flechette = L.icon({
			    iconUrl: 'flechette.png',
			    

			    iconSize:     [30, 30], // size of the icon
			    radius:60,
			    //iconAnchor:   [0,0], // point of the icon which will correspond to marker's location
			    
			});

			
			

				var mapboxUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}';

				var mapboxAttribution ='Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>';

				var mapboxToken = 'pk.eyJ1Ijoic2x5MTIzIiwiYSI6ImNqZXNuOXQ1aTEyNjYyeHA5dDgyYjlyZjgifQ.OGFCp15cp-8tHsz9WO527Q';
				

				var tilesStreets=  L.tileLayer(mapboxUrl, {
				    attribution: mapboxAttribution,
				    maxZoom: 18,
				    id: 'mapbox.streets',
				    accessToken: mapboxToken
					});

				var tilesSatellite=  L.tileLayer(mapboxUrl, {
				    attribution: mapboxAttribution,
				    maxZoom: 18,
				    id: 'mapbox.satellite',
				    accessToken: mapboxToken
					});

				var tilesPirates=  L.tileLayer(mapboxUrl, {
				    attribution: mapboxAttribution,
				    maxZoom: 18,
				    id: 'mapbox.pirates',
				    accessToken: mapboxToken
					});

				var mymap = L.map('mapid',{
					center: [46.55886,2.28516],
					zoom: 2,
					maxZoom: 6,
					layers: [tilesStreets, tilesSatellite , tilesPirates]
					});

				var baseMaps = {
				    "Pirates": tilesPirates,
				    "Rues": tilesStreets,
				    "Satellite": tilesSatellite
				};


				L.control.layers(baseMaps).addTo(mymap);


				//function addMarker(e){
				// Add marker to map at click location; add popup window
				//var newMarker = new L.marker(e.latlng).addTo(mymap);
				//}
					
					var nb_essai=0;
					var score_final=0;
					var score_temp=0;
					var score_stocke=0;
				
					var score_final_bis=0
					var score=[]
								
					mymap.on('click',function(event){

						var flag_reponse=false;
						var popup = L.popup();
						var coordonnees_latitude;
						var coordonnees_longitude;
						var score_gele=0;
						var score_froid=0;
						var score_chaud=0;
						var score_brule=0;
						var score_plein_mille=0;
						var score_html=8;	

						
						
	
						$.ajax({

							type : "POST",
							url: "questions.php",
							dataType: "json",
							success : function(reponse){
							
					    //coordonnees_latitude=(JSON.parse(reponse[2].latitude));
					    //coordonnees_longitude=(JSON.parse(reponse[2].longitude));
					    //alert($("#numero").text());
					    if($("#numero").text()=="1"){

					    	coordonnees_latitude=(JSON.parse(reponse[0].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[0].longitude));

					    }

					    else if($("#numero").text()=="2"){

					    	coordonnees_latitude=(JSON.parse(reponse[2].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[2].longitude));

					    }
					    else if($("#numero").text()=="3"){

					    	coordonnees_latitude=(JSON.parse(reponse[6].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[6].longitude));
					    }
					    else if($("#numero").text()=="4"){

					    	coordonnees_latitude=(JSON.parse(reponse[1].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[1].longitude));
					    } 
					    else if($("#numero").text()=="5"){

					    	coordonnees_latitude=(JSON.parse(reponse[4].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[4].longitude));
					    } 
					    else if($("#numero").text()=="6"){

					    	coordonnees_latitude=(JSON.parse(reponse[5].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[5].longitude));
					    } 
					    else{

					    	coordonnees_latitude=(JSON.parse(reponse[3].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[3].longitude));
					    } 

					    //if(nb_essai==0){
							//score_final=score_final + score_temp;
							//console.log(score_final);
							//console.log("score apres");
							//console.log(score_final);
							
							//console.log("score combineeee");
							//score_final=score_final+score_stocke;
							//console.log(score_final);

						//} 

					
						if(nb_essai <5){
							var marker = new L.marker(event.latlng,{icon:flechette}).addTo(mymap);
							//console.log("latitude");
							//console.log(coordonnees_latitude);
							//console.log("longitude");
							//console.log(coordonnees_longitude);

							var test =L.latLng(coordonnees_latitude,coordonnees_longitude);

							
							var point=L.circle(event.latlng).setRadius(100).addTo(mymap);
							var centre =point.getRadius();
							//console.log(centre);


							var point2=L.circle(test).setRadius(1500);
							//console.log("CENTRE de kheops :" );
							var centre2 =point2.getRadius();
							//console.log(centre2);
							//console.log(centre2);
							//console.log("distance");
							//console.log(centre2 - centre);

							var radius = point.getRadius(); //in meters
							var circleCenterPoint = point.getLatLng(); //gets the circle's center latlng
							var isInCircleRadius = Math.abs(circleCenterPoint.distanceTo(test));
							//var isInCircleRadius = Math.abs(circleCenterPoint.distanceTo(test))
							//console.log("RES");
							//console.log(isInCircleRadius);
							//console.log("centre2");
							//console.log(centre2);

							//L.marker([51.5, -0.09], {icon: greenIcon}).addTo(map);
							nb_essai=nb_essai+1;
							//console.log(event);

							if(isInCircleRadius <2250000 && isInCircleRadius > 450000){
									
									score_chaud=5;
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("TU CHAUFFES ESSAYE ENCORE ! <br> Score : 5 ")
			        				     .openOn(mymap);
							}
							if(isInCircleRadius <= 250000){
									flag_reponse=true;
									score_plein_mille=10;
									
									$('#cache').attr("value","vrai");
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("BRAVO C'EST GAGNE !<br> EN PLEIN DANS LE MILLE ! <br> Score : 10")
			        				     .openOn(mymap);
			        				    setTimeout(function(){
										   	mymap.off();
							 				mymap.remove();
							 				window.onload();
										}, 3000);
			        				     
							}
							//console.log(nb_essai);

							if(isInCircleRadius > 250000 && isInCircleRadius < 400000  ){
									score_brule=9;
									
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("TU BRULES !<br> Score : 9")
			        				     .openOn(mymap);

							}
							//console.log(nb_essai);

							if(isInCircleRadius >2250000 && isInCircleRadius < 4250000 ){
									
									
									score_froid=2;
										
									
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("TU REFRODIS ESSAYE ENCORE !<br> Score : 2")
			        				     .openOn(mymap);
							}
							//console.log(nb_essai);
							if(isInCircleRadius > 4250000 ){
									
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("TU GELES!<br> Score : 0")
			        				     .openOn(mymap);


							}
							//console.log("MAX");	
							//console.log(Math.max(score_gele,score_froid,score_chaud,score_brule,score_plein_mille));
							score_temp=Math.max(score_gele,score_froid,score_chaud,score_brule,score_plein_mille);
								console.log("score_temporaire");
								console.log(score_temp);
								//console.log("score temp");
								//console.log(score_temp);
								//score_final_bis=score_final;
							if(score_temp >= score_final ){
								score_final=score_temp;
								//score_final_bis= stocker_score(score_final);
								//score_temp=0;
								//console.log("score html");
							
								$('#score_cache').attr("value",score_final);
								//score_html=parseInt($('#score').val());
								//console.log(score_html);							
							}
							

							


				        	//console.log(score_final);		     
				        	}		     
					   else if(flag_reponse==false ) {
					   	   //score_stocke=score_final;
					   	   //score_final=score_final + score_temp;
					   	   

					   	   if($("#numero").text()!="1"){
					   	   	//console.log("SCORE finalllllllllllllllle");
					   	   	//score_final=score_html + score_final ;
					   	   
					   	   	//console.log(score_final);
					   	   	//score_stocke=stocker_score(score_final,score_final_bis);
					   	   	//console.log(score_stocke);
					   	   }
					   	   //if(($("#numero").text()!="1")){
					   	   	//console.log("testtttttttt");
					   	   	//score_final=score_final + score_temp;
					   	   //}
					   	   //console.log(stocker_score(score_final));
					   	   //if(($("#numero").text()!="1")){
					   	  //console.log("score totaux");
					   	   //score_final=stocker_score(score_final) +score_temp;
					   	   //console.log(score_final);

					   	   //}
					   	   event.latlng.lat=coordonnees_latitude;
					   	   event.latlng.lng=coordonnees_longitude;
					   	   console.log(event.latlng);
					   	   popup
					   	   		.setLatLng(event.latlng)
					   	   		.setContent("MODE LANGUE AU CHAT <br> VOICI LA SOLUTION")
					   	   		.openOn(mymap);
						   	L
						   		.circle([coordonnees_latitude,coordonnees_longitude],
						   	 	400,
						   	 	{color:'#ff0b0b',opacity:1,fillColor: 'ffb0b0',fillOpacity:.4,weight:10})
						   		.addTo(mymap);

						   	mymap.setView(new L.LatLng(coordonnees_latitude,coordonnees_longitude), 13);
						   	L.DomEvent.preventDefault(event);
						    setTimeout(function(){
						   	mymap.off();
			 				mymap.remove();
			 				window.onload();

							}, 3000);
							$('#cache').attr("value","vrai");
					   }

					   else{

					   }
					   		//console.log("score");
					   		//console.log(score_final);


							},
							error:function() {
								alert("erreur");
							}


						});

					   
					   //$('#cache').attr("value","vrai");
					});
	
			}


			window.setTimeout(function() {
			    $("#notification").fadeTo(500, 0).slideUp(500, function(){
			        $(this).remove(); 
			    });
			}, 4000);

			function stocker_score(score_final){
					var score;
					score =score_final;
			
				return score;

			}
	 $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');	
		
	

	
    var tmp=1;
    var reponse;
    var score_tmp=0;
	$(".suivant").click(function(){

		$.ajax({

	       type : "POST",
	       url : "questions.php",
	       dataType: "json",
	       success : function(reponse){
	       	//alert("lets go ");
	       	//var reponseb=JSON.parse(reponse);
	       	//alert((JSON.stringify(reponse[0].intitule)));


		 console.log($('#cache').attr("value"));
		 nb_clic=nb_clic + 1;
		 //var tmp=$('#cache').attr("value");
		if($('#cache').attr("value")=="vrai" && tmp==1) {
			 //$(".suivant").removeProp('disabled');
			 
			 console.log("very GOOOOOOOOOOD");
			var question =JSON.stringify(reponse[2].intitule);
			$("#question").text(question);
			var numero_question ="2";
			$("#numero").text(numero_question);
			var score=$("#score_cache").val();
			$('#score_cache_bis').attr("value",score);
			score_tmp=score;
			$("#score").text (score);
			$("#image_merveille").attr("src","tour_pharos.jpg");
			tmp="2";
			$('#cache').attr("value","faux");

			$("#titreCarousel").text("La Tour de Pharos");
			$("#paragraphe1").text("Le célèbre phare d'Alexandrie, la septième merveille du monde antique,vit le jour sous Ptolémée II, près de la célèbre cité d'Alexandre le Grand : Alexandrie. Monument entouré d'un voile de mystère, il a inspiré de nombreuses légendes. Considéré comme la plus haute construction du monde durant l'Antiquité, et d'une finesse technologique rare, les scientifiques étaient nombreux à venir l'admirer car le miroir reflétait le foyer lumineux à plus de 50 kilomètres. Le phare d'Alexandrie est un bâtiment de forme monolithique qui mesurait 135m de haut. Il était à 3 étages");
		    $("#image1").attr('src','tour_pharos1.jpg');
		    $("#paragraphe2").text("Il existe deux raisons qui ont motivées la construction du phare d'Alexandrie. Tout d'abord une raison utilitaire. La ville disposait, à faible distance, d'une île nommée Pharos. L'autre raison est symbolique.Parvenir à construire un phare à l'entrée du port n'était donc pas seulement utile : Il marquait aussi la puissance de l'Egypte, et plus particulièrement d'Alexandrie. Le phare était donc un symbole de puissance, il a servi à propager le nom d'Alexandrie dans la Monde.")
			$("#image2").attr('src','tour_pharos2.jpg');
			$("#paragraphe3").text("Le feu était allumé sur la partie la plus haute, celle sur laquelle il y avait la statue. Il était important, visiblement puissant, et il était entretenu jour et nuit. Le jour, c'est la fumée qui dirigeait les bâteaux, la nuit c'est l'éclat. Il parait que le phare d'Alexandrie était visible à 50Kms à la ronde.")
			$("#image3").attr("src","tour_pharos3.jpg");


		}

		 
		else if(tmp=="2" && $('#cache').attr("value")=="vrai") {
			console.log("score_tmp");
			console.log(score_tmp)
			question =JSON.stringify(reponse[6].intitule);
			$("#question").text(question);
			numero_question ="3";
			$("#numero").text(numero_question);
			score_tmp=parseInt(score_tmp);
			score= parseInt($("#score_cache").val());
			score=score + score_tmp;
			$("#score").text (score);
			$('#score_cache_bis').attr("value",score);
			score_tmp=score;
			$("#image_merveille").attr("src","jardins_babylone.jpg");
			tmp="3";
			$('#cache').attr("value","faux");

			$("#titreCarousel").text("Les Jardins de Babylone");
			$("#paragraphe1").text("Les jardins suspendus de Babylone sont un ensemble de jardins situé dans l'antique cité de Babylone, en Irak. Leurs beautés fait qu'ils ont été inscrits sur les listes antiques des merveilles du monde.Les origines des jardins suspendus de Babylone remontent à Nabuchodonosor II, si l'on en croit la thèse de Bérose. Il était roi de Babylone au VIe siècle avant JC et c'est sous son règne que son royaume fut le plus vaste, il était à son apogée. Nabuchodonosor II fit construire dans sa capitale Babylone de nombreux monuments ainsi que des temples. Selon la légende il aurait construit les jardins pour son épouse qui venait de Médie, une région montagneuse de l'Iran occidental où la végétation était plus dense que dans le désert babylonien ");
		    $("#image1").attr('src','jardins_babylone1.jpg');
		    $("#paragraphe2").text("Un jardin en hauteur basé sur un plan carré d'à peu près 120m de côté. Ce jardin, immense carré de 4 plèthres de côté, se compose de plusieurs étages de terrasses supportées par des arcades dont les voûtes retombent sur des piliers de forme cubique. Ces piliers sont creux et remplis de terre, ce qui a permis d'y faire venir les plus grands arbres. Piliers, arcades et voûtes ont été construits rien qu'avec des briques cuites au feu et de l'asphalte.")
			$("#image2").attr('src','jardins_babylone2.jpg');
			$("#paragraphe3").text("Avant tout il faut savoir que le mot suspendu n\'a aucun sens quand on parles des jardins. Ces jardins n'étaient pas suspendus, ils n'auraient pas pu l'être, au vu du poids qu'ils représentaient. Cette expression est issue de la description de Philon qui livre plus une image iréelle du monument qu'une réelle description dans son ouvrage, De septem orbis spectaculis. Il décrit un jardin flottant dans l'air, et c'est cette image qui marque fortement les esprits qui s'est propagée jusqu'à nous. En réalité ils étaient en hauteur, sur un bâtiment, c'est ce qui leur donnait cette impression de flottement.")
			$("#image3").attr("src","jardins_babylone3.jpg");			

		}
		else if(tmp=="3" && $('#cache').attr("value")=="vrai") {
			question = JSON.stringify(reponse[1].intitule);
			$("#question").text(question);
			numero_question ="4";
			$("#numero").text(numero_question);
			score=parseInt($("#score_cache").val())+score_tmp;
			$("#score").text (score);
			$("#image_merveille").attr("src","statue_zeus.jpg");
			tmp="4";
			$('#cache').attr("value","faux");
			score_tmp=score;

			$("#titreCarousel").text("La Statue de Zeus");
			$("#paragraphe1").text("La statue de Zeus est l'une des sept merveilles du Monde antique. Il s'agit d'une statue chryséléphantine, ce qui signifie qu'elle était faite d'ivoire et d'or.Son constructeur est Phidias, un sculpteur athénien ayant réalisé une oeuvre comparable peu avant celle d'Olympie qui nous sert de référence de nos jours, mais cet artiste était connu pour d'autres sculptures. Il a créé la statue de Zeus en 436 avant JC.");
		    $("#image1").attr('src','statue_zeus1.jpg');
		    $("#paragraphe2").text(" La ville était placée sous la protection de Zeus, le Dieu des Dieux selon la mythologie grecque. Elle possédait un temple qui fut refait complètement au Ve siècle. Ce nouveau temple, très grand, se devait d'accueillir une statue gigantesque.C'est donc tout simplement une croyance religieuse qui est à l'origine de la construction de la statue de Zeus. Il s'agissait d'honorer le Dieu protecteur de la ville, tout simplement, à une époque où Olympie gagnait en popularité dans toute la Grèce antique.")
			$("#image2").attr('src','statue_zeus2.jpg');
			$("#paragraphe3").text("La statue mesurait 13m de hauteur, elle était plus grande que celle d'Athéna que Phidias avait fait peu avant, à Athènes. Les parties visibles du corps étaient en ivoire pour simuler la blancheur de la peu tandis que les vêtements, la barbe et la chevelure étaient en or. La chevelure recevait une couronne d'olivier faite en argent. La victoire tenue dans sa main droite et la couronne d\'olivier, symbole de puissance sont symboliques.")
    		$("#image3").attr("src","statue_zeus3.jpg");				

		}

		else if(tmp=="4" && $('#cache').attr("value")=="vrai") {
			question =JSON.stringify(reponse[4].intitule);
			$("#question").text(question);
			numero_question ="5";
			$("#numero").text(numero_question);
			score=parseInt($("#score_cache").val())+score_tmp;
			$("#score").text (score);
			$("#image_merveille").attr("src","temple_artemis.jpg");
			tmp="5";
			$('#cache').attr("value","faux");
			score_tmp=score;

			$("#titreCarousel").text("Le Temple d'Artemis");
			$("#paragraphe1").text("Le temple d'Artemis, qui est aussi appelé l'Artemision, est un édifice sacré de l'époque hellénique bâti sur les vestiges de temples plus anciens. Il se trouve à Selçuk, en Turquie, près de la mer Egée, sur un territoire autrefois dominé par l'empire grec");
		    $("#image1").attr('src','temple_artemis1.jpg');
		    $("#paragraphe2").text("  Cet édifice a été placé sur la liste des sept merveilles du Monde de part sa grandeur et ses décorations, une raison identique au mausolée d'Halicarnasse, une autre des sept merveilles du monde.")
			$("#image2").attr('src','temple_artemis2.jpg');
			$("#paragraphe3").text("Le temple d'Artémis possédait un grand nombre de sculptures d'artistes célèbres. L'autel était également richement décoré.Le temple était également un lieu de rencontre, une sorte de forum qui n'est pas à ciel ouvert. Il abritait en particulier des marchands et probablement divers autres corps de métier. Le culte d'Artemis était relativement important à l'époque, le temple recevait donc très régulièrement des offrandes, ce qui a permit aux archéologues modernes de récupérer des bijoux dédiés à Artemis sur le site.")
    		$("#image3").attr("src","temple_artemis3.jpg");			

		}

		else if(tmp=="5" && $('#cache').attr("value")=="vrai") {
			question = JSON.stringify(reponse[5].intitule);
			$("#question").text(question);
			numero_question ="6";
			$("#numero").text(numero_question);
			score=parseInt($("#score_cache").val())+score_tmp;
			$("#score").text (score);
			$("#image_merveille").attr("src","tombeau_mausole.jpg");
			tmp="6";
			$('#cache').attr("value","faux");		
			score_tmp=score;

			$("#titreCarousel").text("Le Tombeau de Mausole");
			$("#paragraphe1").text("Le mausolée d'Halicarnasse est un monument funéraire qui fut achevé en -350 avant JC et fut démoli définitivement durant le XVe siècle. Ce monument a été classé parmi les sept merveilles du monde non pas en raison de sa taille ou de sa majesté, mais en raison de la beauté de son aspect et la façon dont il a été décoré avec des sculptures ou des ornements.");
		    $("#image1").attr('src','tombeau_mausole1.jpg');
		    $("#paragraphe2").text("La hauteur totale du bâtiment faisant 43m - d'après les études les plus récentes - on a donc la répartition suivante : \n Tombeau : 13m \n Colonnade : 12m \n Toit : 12m \n Quadrige : 6m")			
		    $("#image2").attr('src','tombeau_mausole2.jpg');
			$("#paragraphe3").text("Les décorations du mausolée était, parait-il, splendides. Il était entouré de nombreuses statues en rondes-bossesPar exemple il y a une course de chars, des lions, des scènes de combatLes décorations du mausolée était donc d'inspiration grecque et montraient des combats entre les grecs et les Amazones ou les Centaures, deux thèmes originaux pour l'époque")
    		$("#image3").attr("src","tombeau_mausole3.jpg");	

		}

	
		else if(tmp=="6" && $('#cache').attr("value")=="vrai") {

			question = JSON.stringify(reponse[3].intitule);
			$("#question").text(question);
			numero_question ="7";
			$("#numero").text(numero_question);
			score=parseInt($("#score_cache").val())+score_tmp;
			$("#score").text (score);
			$("#image_merveille").attr("src","colosse_rhodes.jpg");
			score_tmp=score;
			tmp="7";

			$("#titreCarousel").text("Le Colosse de Rhodes");
			$("#paragraphe1").text("Le colosse de Rhodes était une gigantesque statue de bronze représentant Hélios, le dieu grec du Soleil. Elle fut édifiée par le sculpteur Charès de Lindos pour commémorer la levée du siège de la ville (en 305 avant J.C.) et la victoire des Rhodiens contre le chef macédonien Démétrios Poliorcète. aite de bronze et élevée sur une base en marbre, la statue mesurait de la tête aux pieds 32 mètres (soit 14 mètres de moins que la statue de la liberté de New York), ce qui lui permettait d'être visible par les navires approchant du port. De son bras levé, le dieu tenait un flambeau tandis que son autre bras s'appuyait sur une lance");
		    $("#image1").attr('src','colosse_rhodes1.jpg');
		    $("#paragraphe2").text("On peut dire que le colosse de Rhodes se classe parmi les 7 merveilles du monde antique car son immensité est exemplaire. De plus, il faut bien se rendre compte que cette œuvre grecque est le résultat d'une très grande prouesse technique qui se caractérise, entre autre, par l'utilisation de moules en terre cuite nécessaire au coulage du colosse de Rhodes. Nous pouvons comprendre que la préparation à la construction devait être délicate. D'ailleurs, il parait même que Charès de Lindos se suicida lorsqu'il découvrit une erreur dans ses calculs; erreur que dut corriger l'un de ses assistants.")			
		    $("#image2").attr('src','colosse_rhodes2.jpg');
			$("#paragraphe3").text("La raison pour laquelle les Rhodaniens ont construit cette tour est simple, c'est suite à une victoire qu'ils ont remporté en 304. Cette année-là l'île survécu à un terrible siège provoqué par Démétrios Poliorcète, un des généraux d'Alexandre le Grand qui avait reçu l'ordre d'Antigone de devenir maître de la Méditerranée et d'assoir sa domination sur les îles grecques. le protecteur de Rhodes, les habitants savaient qu'en construisant la plus grande statue jamais faite sur Terre ils allaient accroître le prestige de leur île. La volonté politique de marquer les esprits est évidente et rejoint en ça le Phare d'Alexandrie qui fut aussi construit, en plus de servir de phare, pour montrer le prestige de l'Egypte.")
    		$("#image3").attr("src","colosse_rhodes3.jpg");

		}
		else if(tmp=="7" && $('#cache').attr("value")=="vrai"){
			console.log("mamennnnnn");
			score=parseInt($("#score_cache").val())+score_tmp;
			$("#score").text (score);
			tmp="8";

		}
		else{
			console.log("VEUILLEZ LOCALISEZ LA CIBLE !");

		}


	       },
	       error:function(retour) {
	       	// body...
	       	alert("erreur");
	       }

    	});



		
		


	});

	


});
