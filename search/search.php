<?php
    $key=$_REQUEST['key'];
    $array = array();
    $con=mysqli_connect("localhost","root","","civilpro");
    $query=mysqli_query($con, "select * from machine where machine_name LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['machine_name'];
    }
    echo json_encode($array);
    mysqli_close($con);
?>
