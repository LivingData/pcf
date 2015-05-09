<?php

$con=mysqli_connect("localhost","root","","orderform");
   // Check connection
    if (mysqli_connect_errno()) {
    echo "Database connection failed: " . mysqli_connect_error();
    }
   // mysql_select_db("orderform")or die ("couldn't find db");
    
    $result = mysqli_query($con,"SELECT * FROM neworders");
     $array = array ();

$i = 0;
while ($row = mysqli_fetch_array($result)) {

//$array['Users'][$i++] = $row;
//array_push($array,$row);
//echo json_encode($array);
$array[]=$row;
    }

$arrayreverse = array_reverse($array)  ;

$json = json_encode($arrayreverse);

echo $json;


?>