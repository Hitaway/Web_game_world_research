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
					center: [51.505, -0.09],
					zoom: 13,
					layers: [tilesStreets, tilesSatellite , tilesPirates]
					});

				var baseMaps = {
				    "Rues": tilesStreets,
				    "Satellite": tilesSatellite,
				    "Pirates": tilesPirates
				};


				L.control.layers(baseMaps).addTo(mymap);

				//function addMarker(e){
				// Add marker to map at click location; add popup window
				//var newMarker = new L.marker(e.latlng).addTo(mymap);
				//}
				
					var nb_essai=0;				
					mymap.on('click',function(event){
						var flag_reponse=false;
						var popup = L.popup();
						var coordonnees_kheops = {
					    latitude:31.133889,
					    longitude:29.978889
					    };

						if(nb_essai <5){
							var marker = new L.marker(event.latlng,{icon:flechette}).addTo(mymap);
							var test =L.latLng(coordonnees_kheops.latitude,coordonnees_kheops.longitude);

							
							var point=L.circle(event.latlng).setRadius(100).addTo(mymap);
							var centre =point.getRadius();
							//console.log(centre);


							var point2=L.circle(test).setRadius(1500).addTo(mymap);
							console.log("CENTRE de kheops :" );
							var centre2 =point2.getRadius();
							console.log(centre2);
							//console.log(centre2);
							//console.log("distance");
							//console.log(centre2 - centre);

							var radius = point.getRadius(); //in meters
							var circleCenterPoint = point.getLatLng(); //gets the circle's center latlng
							var isInCircleRadius = Math.abs(circleCenterPoint.distanceTo(test));
							//var isInCircleRadius = Math.abs(circleCenterPoint.distanceTo(test))
							console.log("RES");
							console.log(isInCircleRadius);
							//console.log("centre2");
							//console.log(centre2);

							//L.marker([51.5, -0.09], {icon: greenIcon}).addTo(map);
							nb_essai=nb_essai+1;
							console.log(event);

							if(isInCircleRadius <= (centre2*centre2) && isInCircleRadius > 250000){
								
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("TU CHAUFFES ESSAYE ENCORE ! <br> Score : 5 ")
			        				     .openOn(mymap);
							}
							if(isInCircleRadius <= 250000){
									flag_reponse=true;
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
							console.log(nb_essai);

							if(isInCircleRadius > 250000 && isInCircleRadius < 400000  ){
								
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("TU BRULES !<br> Score : 9")
			        				     .openOn(mymap);

							}
							console.log(nb_essai);

							if(isInCircleRadius >2250000 && isInCircleRadius < 4250000 ){
								
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("TU REFRODIS ESSAYE ENCORE !<br> Score : 2")
			        				     .openOn(mymap);
							}
							console.log(nb_essai);
							if(isInCircleRadius > 4250000 ){
									popup
			        					 .setLatLng(event.latlng)
			        					 .setContent("TU GELES!<br> Score : 0")
			        				     .openOn(mymap);


							}


			        			     
			        	}		     
					   else if(flag_reponse==false) {

					   	   event.latlng.lat=31.133889;
					   	   event.latlng.lng=29.978889;
					   	   console.log(event.latlng);
					   	   popup
					   	   		.setLatLng(event.latlng)
					   	   		.setContent("MODE LANGUE AU CHAT <br> VOICI LA SOLUTION")
					   	   		.openOn(mymap);
						   	L
						   		.circle([31.133889,29.978889],
						   	 	400,
						   	 	{color:'#ff0b0b',opacity:1,fillColor: 'ffb0b0',fillOpacity:.4,weight:10})
						   		.addTo(mymap);

						   	mymap.setView(new L.LatLng(31.133889,29.978889), 13);
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
					   
					   //$('#cache').attr("value","vrai");
					});
					

				

       

     			 
				
			}


			window.setTimeout(function() {
			    $("#notification").fadeTo(500, 0).slideUp(500, function(){
			        $(this).remove(); 
			    });
			}, 4000);

		
	

	
    var tmp=1;
	$(".suivant").click(function(){
		 console.log($('#cache').attr("value"));
		 nb_clic=nb_clic + 1;
		 //var tmp=$('#cache').attr("value");
		if($('#cache').attr("value")=="vrai" && tmp==1) {
			 //$(".suivant").removeProp('disabled');
			 
			 console.log("very GOOOOOOOOOOD");
			var question = "Localiser la Tour de Pharos";
			$("#question").text(question);
			var numero_question ="2";
			$("#numero").text(numero_question);
			var score= "2/7"
			$("#score").text (score);
			$("#image_merveille").attr("src","tour_pharos.jpg");
			tmp="2";
			$('#cache').attr("value","faux");
		}

		 
		else if(tmp=="2" && $('#cache').attr("value")=="vrai") {
			console.log("GOOOOOOOOOOD");
			question = " Localiser Les jardins suspendus de Babylone ";
			$("#question").text(question);
			numero_question ="3";
			$("#numero").text(numero_question);
			score= "3/7"
			$("#score").text (score);
			$("#image_merveille").attr("src","jardins_babylone.jpg");
			tmp="3";
			$('#cache').attr("value","faux");			

		}
		else if(tmp=="3" && $('#cache').attr("value")=="vrai") {
			question = "Localiser La statue chryselephantine de Zeus";
			$("#question").text(question);
			numero_question ="4";
			$("#numero").text(numero_question);
			score= "4/7"
			$("#score").text (score);
			$("#image_merveille").attr("src","statue_zeus.jpg");
			tmp="4";
			$('#cache').attr("value","faux");				

		}

		else if(tmp=="4" && $('#cache').attr("value")=="vrai") {
			question = "Localiser Le Temple d'Artemis";
			$("#question").text(question);
			numero_question ="5";
			$("#numero").text(numero_question);
			score= "5/7"
			$("#score").text (score);
			$("#image_merveille").attr("src","temple_artemis.jpg");
			tmp="5";
			$('#cache').attr("value","faux");			

		}

		else if(tmp=="5" && $('#cache').attr("value")=="vrai") {
			question = "Localiser Le tombeau de Mausole";
			$("#question").text(question);
			numero_question ="6";
			$("#numero").text(numero_question);
			score= "6/7"
			$("#score").text (score);
			$("#image_merveille").attr("src","tombeau_mausole.jpg");
			tmp="6";
			$('#cache').attr("value","faux");		


		}

	
		else if(tmp=="6" && $('#cache').attr("value")=="vrai") {

				question = "Localiser Le colosse de Rhodes ";
			$("#question").text(question);
			numero_question ="7";
			$("#numero").text(numero_question);
			score= "7/7"
			$("#score").text (score);
			$("#image_merveille").attr("src","colosse_rhodes.jpg");


		}
		else{

			console.log("VEUILLEZ LOCALISEZ LA CIBLE !");


		}
		
		


	});

	


});