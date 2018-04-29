<script>
var googleLayerROADMAP = new L.Google('ROADMAP');
var googleLayerSATELLITE = new L.Google('SATELLITE');
var googleLayerHYBRID  = new L.Google("HYBRID");
var googleLayerTERRAIN = new L.Google('TERRAIN');



var baseMap = {
    "Route" : googleLayerROADMAP,
    "Satellite" : googleLayerSATELLITE,
    "Hybride" : googleLayerHYBRID,
    "Relief" : googleLayerTERRAIN
};


var map = new L.Map('map_tuto', 
	{
		center: new L.LatLng(42.63685, 2.59415),
		zoom: 9,
		layers: [googleLayerROADMAP]
	});

//Contrôles pour les layers contenant les données.
var overlaysMaps = {

};

L.control.layers(baseMap, null, { collapsed: false }).addTo(map);


</script>
