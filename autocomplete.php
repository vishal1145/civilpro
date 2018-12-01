<?php

include "config/config.php";
$obj = new  connection();
$con = $obj->connect();

// Get search term
$searchTerm = $_GET['term'];


$sql = "SELECT * FROM employee WHERE first_name LIKE '%".$searchTerm."%' ORDER BY empl_id ASC ";
$query = mysqli_query($con,$sql);


$json=array();
if($query->num_rows > 0){
while($row=mysqli_fetch_array($query))
    {
    	
        $json[]= $row["first_name"];
    }
}
echo json_encode($json);

?>