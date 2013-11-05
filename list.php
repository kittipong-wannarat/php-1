<?php

$dateStart=$_REQUEST['date_start'];
$dateEnd=$_REQUEST['date_end'];

//$db_conn=new PDO('mysql:host=localhost;dbname=my-project-1','root','1234');
//perform query
//$stmt=$db_conn->query('SELECT name,chef FROM recipes');

//display results
//while($row=$stmt->fetch()) {

	//echo $row['name'].' by '.$row['chef'] ."<br>";
	//echo "";

//}
echo "date start : ".$dateStart."   date end  ".$dateEnd ;


?>