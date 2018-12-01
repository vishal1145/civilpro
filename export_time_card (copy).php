<?php

include "config/config.php";
$obj = new  connection();
$con = $obj->connect();

	if(isset($_POST['export_button'])){	
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];

		$sql_query = "SELECT * FROM Time_Card WHERE card_date BETWEEN '$start_date' AND '$end_date'";
		$resultset = mysqli_query($con, $sql_query) or die("database error:". mysqli_error($con));
		$developer_records = array();
		while( $rows = mysqli_fetch_assoc($resultset) ) {
			$developer_records[] = $rows;
		}
	
?>

<table id="" class="table table-striped table-bordered">
<tr>
<th>SILVERSTONE SOILS & EXCAVATING LTD - PAYROLL 07/15/18 - 07/28/18</th>
</tr>
<tr>
<th>Date</th>
<th>Day</th>
<th>machine1</th>
<th>machine2</th>
<th>description</th>
</tr>
<tbody>
<?php foreach($developer_records as $developer) { ?>
<tr>
<td><?php echo $developer['card_date']; ?></td>
<td><?php echo $developer['employee_id']; ?></td>
<td><?php echo $developer['machine']; ?></td>
<td><?php echo $developer['machine_hours']; ?></td>
<td><?php echo $developer['description']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<?php
		
		$filename = "export_payrol_".date('Ymd') . ".xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$show_coloumn = false;
		if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		if(!$show_coloumn) {
		// display field/column names in first row
		echo implode("\t", array_keys($record)) . "\n";
		$show_coloumn = true;
		}
		echo implode("\t", array_values($record)) . "\n";
		}
		}
		exit;

	}

?>
