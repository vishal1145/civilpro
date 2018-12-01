<?php

include "config/config.php";
$obj = new  connection();
$con = $obj->connect();

// Get search term
$searchTerm = $_GET['term'];


$sql = "SELECT * FROM material WHERE materials_name LIKE '%".$searchTerm."%' ORDER BY id DESC";
$query = mysqli_query($con,$sql);


/*// Generate skills data array
$employeeData = array();
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $data['id'] = $row['id'];
        $data['value'] = $row['materials_name'];
        array_push($employeeData, $data);
    }
}

// Return results as json encoded array
echo json_encode($employeeData);*/
$json=array();
if($query->num_rows > 0){
while($row=mysqli_fetch_array($query))
    {
    	//echo "<pre>"; print_r($row);
    	
        $json[]= $row["materials_name"];
    }
}
echo json_encode($json);

?>