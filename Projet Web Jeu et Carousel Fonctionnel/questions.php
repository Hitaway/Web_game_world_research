<?php

require ("identifiants.php"); 

$stmt=$bd->prepare("SELECT * FROM questions ");
$stmt->execute();
$res=$stmt->fetch(PDO::FETCH_ASSOC);

do{
		$tableau[] = $res;
  }while($res = $stmt->fetch(PDO::FETCH_ASSOC));

//header("Content-type:application/json");
  //$tableau= json_encode($tableau);
  echo(json_encode($tableau));
  //echo $tableau;
  //return $tableau; 
				


?>