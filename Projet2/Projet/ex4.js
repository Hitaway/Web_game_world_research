$(document).ready(function(){	

	$('#myTab li a').click(function (e) {
	  e.preventDefault();
	  console.log('azertyui');
	  $(this).tab('show');
	});

});