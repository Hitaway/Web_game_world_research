<?php 
session_start();
require("identifiants.php");
$_SESSION['nom_questionnaire'] = $_GET['nom_questionnaire'];
?>

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
	
	
	<body>
		<input type="hidden" id="cache" name="hiddenPhone" value="faux" />
		<input type="hidden" id="score_cache" name="hiddenPhone" value="0" />
		<input type="hidden" id="score_cache_bis" name="hiddenPhone" value="0" />
		<h1 id="titre_questionnaire"></h1>
		<div class="container" style="width: auto;height: 250px;background-color:#DFF2FF;border-radius: 10px;margin-top: 10px;">

                <div class="row">

                    <div id="label_question"class="col-md-2">  
                            <p>Q<span id="numero" >1</span></p>     
                    </div>

                     <div class="col-md-2 offset-md-4">  
                                 
                    </div>

                     <div class="col-md-6"> 
                            <button id="btn_infos" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModal" style=""><span class="glyphicon glyphicon-question-sign">Infos</button>          
                    </div>

                    <div class="col-md-2"> 

                            <form id="test_btn" method="post" action="ajouter_score.php" class="pull-right">
                                <p id="paragraphe_score">Score <input type="text" name="score" id="score" value="0" readonly="readonly"/></p>
                                
                                
                    </div>
                </div>
                 <div class="row">


                    <div class="col-md-1 offset-md-1">  
                    </div>

                    <div class="col-md-4">
                         <img id="image_principale_kheops">
                             

                    </div>
                    <div class="col-md-5">
                            <p id="question"></p>
                    </div>
                    

                    <div class="col-md-2" id="quitter">

                            <button type="button" class="btn btn-primary suivant">Suivant<span class="glyphicon glyphicon-menu-right"></span></button>
                            
                    </div>              
                           </form>  
                
                    </div>
                </div>   
                  
            </div> 

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h2 class="modal-title">Infos</h5>
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
				    	<p id="paragraphe1"></p>	
				      <img  id="image_slide1" class="image_slide" src="" >
				    </div>
				    <div class="item">
				      <p id="paragraphe2"></p>	
				      <img id="image_slide2" class="image_slide">
				    </div>

				    <div class="item">
				      <p  id="paragraphe3"></p>	
				      <img id="image_slide3" class="image_slide">
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

		<div id="mapid" class='custom-popup'></div>
		
		<a id="back-to-top" href="#" class="btn btn-danger btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>	

	</body>
</html>	