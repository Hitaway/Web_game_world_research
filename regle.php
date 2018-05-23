<?php 
	session_start();
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>
	<body>
		<?php require("header.php"); ?>
		<?php require("footer.php"); ?>
<br><br>
		<form method="post" action="accueil.php" id="test_btn">
			<input  type="text" name="score" id="score" value="0"/>
			<input type="submit" value="Quittez le questionnaire"/>
		</form>

		<?php
			
			if(isset($_POST['score'])){
				echo "SUCCESS";
			}
			else
			{
				echo "ERROR";
			}
		?>
	</body>
</html>