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

							if(isInCircleRadius <= (centre2*centre2) && isInCircleRadius > 250000){
									
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
								//console.log("score temp");
								//console.log(score_temp);
								//score_final_bis=score_final;
							if(score_temp > score_final ){
								score_final=score_temp;
								//score_final_bis= stocker_score(score_final);
								//score_temp=0;
								//console.log("score html");
								$('#score_cache').attr("value",score_final);
								score_html=parseInt($('#score').val());

								//console.log(score_html);							
							}
							if(nb_essai==5){


							
							
							//	console.log(score_html);
								//console.log("score_final_bis");
								//onsole.log(score_final_bis);
								//score_final=score_temp + score_final_bis;
							}


				        	console.log(score_final);		     
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
