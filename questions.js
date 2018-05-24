$(document).ready(function(){
	var nb_clic = 0;

	$.ajax({

		type: "POST",
		url: "nom_questionnaire.php",
		dataType: "json",
		success: function(reponse){

			$titre=reponse[0].nom_questionnaire;
			$("#titre_questionnaire").text($titre);




		},
		error:function(){

			alert("ERREUR");

		}


	});

	$.ajax({

		type : "POST",
		url: "questions.php",
		dataType: "json",
		success : function(reponse){
			var question =(reponse[0].intitule);

			$("#image_principale_kheops").attr("src",reponse[0].url);
			$("#question").text(question);
			$("#paragraphe1").text(reponse[0].information1);
		    $("#image_slide1").attr('src',reponse[0].url);
		    $("#paragraphe2").text(reponse[0].information2)
			$("#image_slide2").attr('src',reponse[0].url);
			$("#paragraphe3").text(reponse[0].information3)
			$("#image_slide3").attr("src",reponse[0].url);

								

		},
		error: function(){

		}
	});				



			
			window.onload = function (){
				var flechette = L.icon({
				    iconUrl: './Image/flechette.png',
				    iconSize:     [30, 30], // size of the icon
				    radius:60,
		
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
							
					    
					    if($("#numero").text()=="1"){

					    	coordonnees_latitude=(JSON.parse(reponse[0].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[0].longitude));

					    }

					    else if($("#numero").text()=="2"){

					    	coordonnees_latitude=(JSON.parse(reponse[1].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[1].longitude));

					    }
					    else if($("#numero").text()=="3"){

					    	coordonnees_latitude=(JSON.parse(reponse[2].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[2].longitude));
					    }
					    else if($("#numero").text()=="4"){

					    	coordonnees_latitude=(JSON.parse(reponse[3].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[3].longitude));
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

					    	coordonnees_latitude=(JSON.parse(reponse[6].latitude));
					    	coordonnees_longitude=(JSON.parse(reponse[6].longitude));
					    } 

					    

					
						if(nb_essai <5){
							var marker = new L.marker(event.latlng,{icon:flechette}).addTo(mymap);
							

							var test =L.latLng(coordonnees_latitude,coordonnees_longitude);

							
							var point=L.circle(event.latlng).setRadius(100).addTo(mymap);
							var centre =point.getRadius();
							


							var point2=L.circle(test).setRadius(1500);
							
							var centre2 =point2.getRadius();
							

							var radius = point.getRadius(); //in meters
							var circleCenterPoint = point.getLatLng(); //gets the circle's center latlng
							var isInCircleRadius = Math.abs(circleCenterPoint.distanceTo(test));
							
							nb_essai=nb_essai+1;
							

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
							

							if(isInCircleRadius > 250000 && isInCircleRadius < 400000  ){
									score_brule=9;
									
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("TU BRULES !<br> Score : 9")
			        				     .openOn(mymap);

							}
							

							if(isInCircleRadius >2250000 && isInCircleRadius < 4250000 ){
									
									
									score_froid=2;
										
									
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("TU REFRODIS ESSAYE ENCORE !<br> Score : 2")
			        				     .openOn(mymap);
							}
							
							if(isInCircleRadius > 4250000 ){
									
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("TU GELES!<br> Score : 0")
			        				     .openOn(mymap);


							}
							
							score_temp=Math.max(score_gele,score_froid,score_chaud,score_brule,score_plein_mille);
							
							if(score_temp >= score_final ){
								score_final=score_temp;
								
							
								$('#score_cache').attr("value",score_final);
													
							}
							

							


				        	     
				        	}		     
					   else if(flag_reponse==false ) {
					   	 
					   	   event.latlng.lat=coordonnees_latitude;
					   	   event.latlng.lng=coordonnees_longitude;
					   	   
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
						   	//L.DomEvent.preventDefault(event);
						    setTimeout(function(){
						   	mymap.off();
			 				mymap.remove();
			 				window.onload();

							}, 3000);
							$('#cache').attr("value","vrai");
					   }

					   else{

					   }
					   		

							},
							error:function() {
								alert("erreur");
							}


						});

					   
					   
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
	       	

		//console.log($('#cache').attr("value"));
		 nb_clic=nb_clic + 1;
		 
		if($('#cache').attr("value")=="vrai" && tmp==1) {
			 
			 
			 console.log("very GOOOOOOOOOOD");
			var question =reponse[1].intitule;
			$("#question").text(question);
			var numero_question ="2";
			$("#numero").text(numero_question);
			var score=$("#score_cache").val();
			$('#score_cache_bis').attr("value",score);
			score_tmp=score;
			$("#score").attr("value",score);
			//$("#image_merveille").attr("src","./Image/tour_pharos.jpg");

			$("#image_principale_kheops").attr("src",reponse[1].url);

			tmp="2";
			$('#cache').attr("value","faux");

			
		    $("#paragraphe2").text(reponse[1].information1);
			$("#image_slide2").attr('src',reponse[1].url);
			$("#paragraphe3").text(reponse[1].information2)
			$("#paragraphe1").text(reponse[1].information3);
		    $("#image_slide1").attr('src',reponse[1].url);
			$("#image_slide3").attr("src",reponse[1].url);


		}

		 
		else if(tmp=="2" && $('#cache').attr("value")=="vrai") {
			//console.log("score_tmp");
			//console.log(score_tmp)
			question =reponse[2].intitule;
			$("#question").text(question);
			numero_question ="3";
			$("#numero").text(numero_question);
			score_tmp=parseInt(score_tmp);
			score= parseInt($("#score_cache").val());
			score=score + score_tmp;
			$("#score").attr("value",score);
			$('#score_cache_bis').attr("value",score);
			score_tmp=score;
			//$("#image_merveille").attr("src","./Image/jardins_babylone.jpg");
			tmp="3";
			$('#cache').attr("value","faux");
			$("#image_principale_kheops").attr("src",reponse[2].url);
			$("#paragraphe1").text(reponse[2].information1);
		    $("#image_slide1").attr('src',reponse[2].url);
		    $("#paragraphe2").text(reponse[2].information2)
			$("#image_slide2").attr('src',reponse[2].url);
			$("#paragraphe3").text(reponse[2].information3)
			$("#image_slide3").attr("src",reponse[2].url);			

		}
		else if(tmp=="3" && $('#cache').attr("value")=="vrai") {
			question =reponse[3].intitule;
			$("#question").text(question);
			numero_question ="4";
			$("#numero").text(numero_question);
			score=parseInt($("#score_cache").val())+score_tmp;
			$("#score").attr("value",score);
			$("#image_merveille").attr("src","./Image/statue_zeus.jpg");
			tmp="4";
			$('#cache').attr("value","faux");
			score_tmp=score;

			
			$("#image_principale_kheops").attr("src",reponse[3].url);
			$("#paragraphe1").text(reponse[3].information1);
		    $("#image_slide1").attr('src',reponse[3].url);
		    $("#paragraphe2").text(reponse[3].information2);
			$("#image_slide2").attr('src',reponse[3].url);
			$("#paragraphe3").text(reponse[3].information3)
    		$("#image_slide3").attr("src",reponse[3].url);				

		}

		else if(tmp=="4" && $('#cache').attr("value")=="vrai") {
			question =reponse[4].intitule;
			$("#question").text(question);
			numero_question ="5";
			$("#numero").text(numero_question);
			score=parseInt($("#score_cache").val())+score_tmp;
			$("#score").attr("value",score);
			$("#image_merveille").attr("src","./Image/temple_artemis.jpg");
			tmp="5";
			$('#cache').attr("value","faux");
			score_tmp=score;
			$("#image_principale_kheops").attr("src",reponse[4].url);
			$("#paragraphe1").text(reponse[4].information1);
		    $("#image_slide1").attr('src',reponse[4].url);
		    $("#paragraphe2").text(reponse[4].information2)
			$("#image_slide2").attr('src',reponse[4].url);
			$("#paragraphe3").text(reponse[4].information3)
    		$("#image_slide3").attr("src",reponse[4].url);			

		}

		else if(tmp=="5" && $('#cache').attr("value")=="vrai") {
			question =reponse[5].intitule;
			$("#question").text(question);
			numero_question ="6";
			$("#numero").text(numero_question);
			score=parseInt($("#score_cache").val())+score_tmp;
			$("#score").attr("value",score);
			$("#image_merveille").attr("src","./Image/tombeau_mausole.jpg");
			tmp="6";
			$('#cache').attr("value","faux");		
			score_tmp=score;
			$("#image_principale_kheops").attr("src",reponse[5].url);
			$("#paragraphe1").text(reponse[5].information1);
		    $("#image_slide1").attr('src',reponse[5].url);
		    $("#paragraphe2").text(reponse[5].information2);			
		    $("#image_slide2").attr('src',reponse[5].url);
			$("#paragraphe3").text(reponse[5].information3)
    		$("#image_slide3").attr("src",reponse[5].url);	

		}

	
		else if(tmp=="6" && $('#cache').attr("value")=="vrai") {

			question = reponse[6].intitule;
			$("#question").text(question);
			numero_question ="7";
			$("#numero").text(numero_question);
			score=parseInt($("#score_cache").val())+score_tmp;
			$("#score").attr("value",score);
			$("#image_merveille").attr("src","./Image/colosse_rhodes.jpg");
			score_tmp=score;
			tmp="7";
			$("#image_principale_kheops").attr("src",reponse[6].url);
			$("#paragraphe1").text(reponse[6].information1);
		    $("#image_slide1").attr('src',reponse[6].url);
		    $("#paragraphe2").text(reponse[6].information2)			
		    $("#image_slide2").attr('src',reponse[6].url);
			$("#paragraphe3").text(reponse[6].information3)
    		$("#image_slide3").attr("src",reponse[6].url);

		}
		else if(tmp=="7" && $('#cache').attr("value")=="vrai"){
			score=parseInt($("#score_cache").val())+score_tmp;
			$("#score").attr("value",score);
			tmp="8";
			console.log(score);
			$(".suivant").remove();
			$('#quitter').append('<input type="submit" class="btn btn-primary suivant" value="Quitter"/>');
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
