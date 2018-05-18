<?php require("identifiants.php"); ?>

<!DOCTYPE html>
	<head>
	<meta charset="utf-8">
	<title>Map</title>


	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Merienda+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
   integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
   crossorigin=""/>
   <link rel="stylesheet" type="text/css" href="carte.css">
   		<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
   integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
   crossorigin=""></script>

	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	<script type="text/javascript" src="questions.js" ></script>
	

	</head>
	<style>
/*
 * These CSS rules affect the tooltips within maps with the custom-popup
 * class. See the full CSS for all customizable options:
 * https://github.com/mapbox/mapbox.js/blob/001754177f3985c0e6b4a26e3c869b0c66162c99/theme/style.css#L321-L366
*/
.custom-popup .leaflet-popup-content-wrapper {
  background:#5bc0de;
  color:white;
  font-size:16px;
  font-family:'Merienda One', Helvetica, sans-serif ;
  line-height:24px;
  }
.custom-popup .leaflet-popup-content-wrapper a {
  color:rgba(255,255,255,0.5);
  }
.custom-popup .leaflet-popup-tip-container {
  width:30px;
  height:15px;
  }
.custom-popup .leaflet-popup-tip {
  border-left:15px solid transparent;
  border-right:15px solid transparent;
  border-top:15px solid #2c3e50;
  }
</style>
	
	<body style="font-family: 'Helvetica Neue', Helvetica, sans-serif ; margin-left: 10px; margin-right: 10px; ">
		<input type="hidden" id="cache" name="hiddenPhone" value="faux" />
		<input type="hidden" id="score_cache" name="hiddenPhone" value="0" />
		<input type="hidden" id="score_cache_bis" name="hiddenPhone" value="0" />
		<h1 style="text-align: center; color: #054458 ;font-weight:bold;  "	> LES 7 MERVEILLES DU MONDE </h1>
		<div id ="notification" style="font-size: 20px" class="alert alert-success alert-dismissible">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Bienvenue</strong> pseudo joueur.
		</div>
		<div style="width: auto	; height: 250px; background-color:#DFF2FF;  border-radius: 10px;">



			<div style="font-size: 20px; margin-left: 10px; color: #054458">	
					QUESTION
					<span id="numero" >1</span>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-left:400px; font-size: 20px; width: 150px;">Informations</button>
					<div style="float: right"">	
					Score 
					<span id="score" style="margin-right: 10px; color: #054458">0</span>
					</div>
			</div>

			<div>
					<img id="image_principale_kheops" src="./Image/kheops2.jpg">
					<p id="question" style="text-align: center; padding-top: 80px; float: left; font-size:25px; margin-left: 50px ;color: #054458"> Localiser la Pyramide de Kheops </p>
					
					
			</div>
			<button type="button" class="btn btn-primary suivant"  style="float:right; margin-top: 150px; margin-right: 10px; font-size: 20px;">Suivant</button>
			
			

		</div>



		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h2 class="modal-title" id="titreCarousel" style="text-align: center;">Pyramide de Kheops</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body" >
		       
		      	<div  id="myCarousel" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel" data-slide-to="1"></li>
				    <li data-target="#myCarousel" data-slide-to="2"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" >
				    <div  class="item active">
				    	<p id="paragraphe1"> Aux portes de la ville du Caire, en Egypte, se dresse la plus ancienne et la seule survivante des 7 merveilles du monde antique: la pyramide de Khéops. située à Gizeh, elle domine de quelques mètres deux autres plus petites pyramides : Khephren et Mykérinos.</p>	
				      <img  class="image_kheops" src="./Image/kheops2.jpg" >

				    </div>



				    <div class="item">
				      <p id="paragraphe2">On estime que Khéops fut construite aux alentours de 2800 av. J.-C mais l’incertitude concernant cette date reste importante. Cette pyramide aurait été dessinée par Imhotep, architecte égyptien de la IIIèmedynastie de l’ancienne Égypte.</p>	
				      <img class="image_kheops" src="./Image/kheops2.jpg" alt="Chicago">
				    </div>

				    <div class="item">
				      <p  id="paragraphe3">Les Egyptiens atteignirent la perfection en construisant le monument que se fit élever le pharaon Khéops et que nous connaissons sous le nom de grande pyramide de Gizeh. Un tombeau gigantesque, inviolable qui conserverait sa divine dépouille pour l’éternité. Exceptionnelle, cette pyramide l’est par ses dimensions (232 mètres de large et 146 mètres de haut) et par ses aménagements intérieurs : pas moins de trois chambres.Pour mener à la chambre du roi, une galerie longue de 47 mètres et haute de 8,50 mètres fut imaginée.</p>	
				      <img class="image_kheops" src="./Image/kheops2.jpg"  alt="New York">
				    </div>
				  </div>

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>

		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
		        
		      </div>
		    </div>
		  </div>
		</div>

		<div id="mapid" class='custom-popup' style="height: 700px; margin-top:10px"></div>
		<style type="text/css">.back-to-top {
		    cursor: pointer;
		    position: fixed;
		    bottom: 20px;
		    right: 20px;
		    display:none;
		    background-color:#c9302c;

			}
		</style>
		<a id="back-to-top" href="#" class="btn btn-danger btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>	

		


		
	





	</body>

</html>	