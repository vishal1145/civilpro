<?php

include "config/config.php";
$obj = new  connection();
$con = $obj->connect();

	if(isset($_POST['export_button'])){	
		    $from_date =$_POST['start_date'];
			$to_date =$_POST['end_date'];
			$dateshow = [$_POST['start_date'],$_POST['end_date']];
			
			$from_date = new DateTime($from_date);
			$to_date = new DateTime($to_date);

			for ($date = $from_date; $date <= $to_date; $date->modify('+1 day')) {
			  $arrDates[] = $date->format('m/d/Y');
			  $arrDays[] = $date->format('l');
			}
			$employes = "SELECT * FROM employee";
			$resultset = mysqli_query($con, $employes) or die("database error:". mysqli_error($con));
			$empIds = array();
			$empName = array();
			$dayIndex = [];
			//print_r(in_array('Sunday',$arrDays));die;
			foreach($arrDays AS $dKey => $days)
			{
				if(trim($days)=='Saturday')
				{
					$dayIndex[] = $dKey;
					$dayDates[] = $arrDates[$dKey];
				}
			}
			while( $rows = mysqli_fetch_assoc($resultset) ) {
				$employs[] = $rows['empl_id'];
				$empName[] = $rows['username'];
			}
			$developer_records = array();
			$totalhours = 0;
			$weeklyhours = 0;
			$weeklyhoursarr = [];
			foreach($arrDates AS $key => $date)
			{
				$developer_records[$date][] = $arrDays[$key];
				$totalhours += 8.00;
				$weeklyhours += 8.00;
				
				if(in_array($key,$dayIndex))
				{
					$weeklyhoursarr[] = $weeklyhours;
					$weeklyhours = 0;
				}
				
				foreach($employs AS $key1 => $emp)
				{
					$sql_query = "SELECT * FROM time_card WHERE card_date ='".trim($date)."' AND employee_id ='".trim($emp)."'";
					$resultset1 = mysqli_query($con, $sql_query) or die("database error:". mysqli_error($con));				
					if(mysqli_num_rows($resultset1))
					{
						$rows1 = mysqli_fetch_assoc($resultset1);
						$developer_records[$date]['hours'][] = $rows1['hours'];
						$developer_records[$date]['total'][$emp] = $rows1['hours'];  	
						//	$developer_records[$date]['weekly'][$emp] = $rows1['hours'];  	
					}
					else
					{
						$developer_records[$date]['hours'][] = 0.00;
						$developer_records[$date]['total'][$emp] = 0.00;
						
						//$developer_records[$date]['weekly'][$emp] = 0.00;
						
					}					
				}
				
			}
			
			if($weeklyhours>0)
			{
				$weeklyhoursarr[] = $weeklyhours;
				$weeklyhours = 0;
			}
			//print_r($developer_records); die;
			//echo "<pre>";print_r($weeklyhoursarr); 
			//$developer_records['employee'] = $empName;
			//echo "<pre>"; print_r(end($developer_records));die;
			//print_r($arrDays);
		// die;	
		/*$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];

		$sql_query = "SELECT * FROM Time_Card WHERE card_date BETWEEN '$start_date' AND '$end_date'";
		$resultset = mysqli_query($con, $sql_query) or die("database error:". mysqli_error($con));
		$developer_records = array();
		while( $rows = mysqli_fetch_assoc($resultset) ) {
			$developer_records[] = $rows;
		}*/
?>

<table id="" class="table table-striped table-bordered"  cellpadding="0">
<tr style="border: 1px solid black">
<td style="font-weight:bold; font-size:16px;width:400px;color:red;">SILVERSTONE SOILS & EXCAVATING LTD - PAYROLL </td>
<td style="font-weight:bold; font-size:16px;color:red;"><?php echo $dateshow[0]; ?> - <?php echo $dateshow[1]; ?></td>
</tr>

<tbody>
<?php 
$sumHours = [];
$weeklyHours = [];
$weekly_ot_total = [];	
$i = 1;
foreach($developer_records as $k => $developer) { ?>
<tr style="border: 1px solid black">
<td style="font-weight:bold; font-size:17px; border: 1px solid black; text-align:left; width: 220px"><?php echo date('y-m-d',strtotime($k)); ?></td>
<td style="font-weight:bold; font-size:17px; border: 1px solid black; width: 180px; text-align:left;"><?php echo $developer[0]; ?></td>

	
	<?php
	foreach($developer['hours'] as $hkey => $hours)
	{ ?>
		<td style="font-weight:bold; font-size:15px;border: 1px solid black; text-align:center;width: 180px;">
			<?php echo $hours; ?>
		</td>
		
<?php } 

	foreach($developer['total'] AS $tKey => $total)
	{
		$sumHours[$tKey] += $total;	
		$weeklyHours[$tKey] += $total;
	}
?>
	
	
	
	<td style="border: 1px solid black; width: 180px;"></td>

</tr>

<?php 
	if(in_array($k,$dayDates))
	{
		$total_wot = 0;
		$weekly_ot_total = [];
		 ?>
		<tr style="border: 1px solid black">
			<td style="font-weight:bold; font-size:17px; background-color:#26d9d9; border: 1px solid black; width: 180px;">Total week <?php echo $i; ?></td>
			<td style="font-weight:bold; font-size:17px; background-color:#26d9d9; border: 1px solid black; width: 180px;"></td>
			
			<?php
			foreach($employs AS $wkey => $wemp)
			{
				?>
				<td style="font-weight:bold; font-size:15px; background-color:#26d9d9; border: 1px solid black; text-align:center; width: 180px;"><?php echo $weeklyHours[$wemp]; ?></td>
				<?php
				if($weeklyHours[$wemp] > $weeklyhoursarr[$i-1])
				{
					$weekly_ot_total[] = $weeklyHours[$wemp]-$weeklyhoursarr[$i];
				}
				else
				{
					$weekly_ot_total[] = 0.00;
				}
			}
			$weeklyHours = [];
			$i++;
		?>
		<td style="border: 1px solid black;width: 180px;"></td>
		</tr>	
		<tr style="border: 1px solid black">
			<td style="font-weight:bold; font-size:17px; border: 1px solid black;width: 180px;">OT</td>
			<td style="font-weight:bold; font-size:17px; border: 1px solid black;width: 180px;"></td>
			<?php
		//	echo "<pre>";print_r($weekly_ot_total);
			foreach($weekly_ot_total AS $wokey => $wot)
			{ 
				?>
				<td style="font-weight:bold; font-size:15px; border: 1px solid black; text-align:center;width: 180px;"><?php echo $wot;?></td>
			<?php	
				$total_wot += $wot;
				$weekly_ot_total = [];
			}
			?>
			<td style="font-weight:bold; font-size:15px; border: 1px solid black; text-align:center;width: 180px;"><?php echo $total_wot; ?></td>
		</tr>
		<tr style="border: 1px solid black;">
		</tr>	
		<?php	
	}
} 
//print_r($weeklyHours);
//die;
//print_r($sumHours); die;
if(count($weeklyHours) >0)
{
	$weekly_ot_total = [];
	?>
	<tr style="border: 1px solid black">
			<td style="font-weight:bold; font-size:17px; background-color:#26d9d9; border: 1px solid black;width: 180px;">Total week <?php echo $i; ?></td>
			<td style="font-weight:bold; font-size:17px; background-color:#26d9d9; border: 1px solid black;width: 180px;"></td>
			
			<?php
			foreach($employs AS $wkey => $wemp)
			{
				?>
				
				<td style="font-weight:bold; font-size:15px; background-color:#26d9d9;border: 1px solid black; text-align:center;width: 180px;"><?php echo $weeklyHours[$wemp]; ?></td>
				<?php
				if($weeklyHours[$wemp] > $weeklyhoursarr[$i-1])
				{
					$weekly_ot_total[] = $weeklyHours[$wemp]-$weeklyhoursarr[$i];
				}
				else
				{
					$weekly_ot_total[] = 0.00;
				}
			}
		?>
			<td style="border: 1px solid black;width: 180px;"></td>
		</tr>	
		
		<?php	
		$weeklyHours = [];
		$i++;
		?>
		<tr style="border: 1px solid black">
			<td style="font-weight:bold; font-size:17px; border: 1px solid black;width: 180px;">OT</td>
			<td style="font-weight:bold; font-size:17px; border: 1px solid black;width: 180px;"></td>
			<?php
		//	echo "<pre>";print_r($weekly_ot_total);
			foreach($weekly_ot_total AS $wokey => $wot)
			{ 
				?>
				<td style="font-weight:bold; font-size:15px; border: 1px solid black; text-align:center;width: 180px;"><?php echo $wot;?></td>
			<?php	
				$total_wot += $wot;
				$weekly_ot_total = [];
			}
			?>
			<td style="font-weight:bold; font-size:15px; border: 1px solid black; text-align:center;width: 180px;"><?php echo $total_wot; ?></td>
		</tr>
		<tr style="border: 1px solid black">
		</tr>
		<?php
}
?>
<tr style="border: 1px solid black">
	<th style="border: 1px solid black"></th>
	<th style="border: 1px solid black"></th>
	<?php 
		foreach($empName As $ename)
		{ ?>
			<th><h4 style="font-weight:bold; font-size:17px; border: 1px solid black;"><?php echo $ename; ?></h4></th>
<?php	}
	?>
	<th style="font-weight:bold; font-size:17px; border: 1px solid black">Total</th>
</tr>
<tr style="border: 1px solid black"></tr>
<tr style="border: 1px solid black">
	<td style="font-weight:bold; font-size:17px; border: 1px solid black;width: 180px;">Total Hours</td>
	<td style="border: 1px solid black;width: 180px;"></td>
	<?php
	$total = 0;
	$ot_total = [];
	foreach($employs AS $ikey => $emp)
	{ 
		?>
		<td style="font-weight:bold; font-size:15px; border: 1px solid black; text-align:center;width: 180px;"><?php echo $sumHours[$emp];?></td>
	<?php	
		$total += $sumHours[$emp];
		
		if($sumHours[$emp] > $totalhours)
		{
			$ot_total[] = $sumHours[$emp]-$totalhours;
		}
		else
		{
			$ot_total[] = 0.00;
		}
	}
	?>
	<td style="font-weight:bold; font-size:15px; border: 1px solid black; text-align:center;width: 180px;"><?php echo $total; ?></td>
</tr>
<tr style="border: 1px solid black">
	<td style="font-weight:bold; font-size:17px; border: 1px solid black;width: 180px;">OT Hours</td>
	<td style="border: 1px solid black;width: 180px;"></td>
	<?php
	$total_ot = 0; 
	foreach($ot_total AS $okey => $ot)
	{ 
		?>
		<td style="font-weight:bold; font-size:15px; border: 1px solid black; text-align:center;width: 180px;"><?php echo $ot;?></td>
	<?php	
		$total_ot += $ot;
	}
	?>
	<td style="font-weight:bold; font-size:15px; border: 1px solid black; text-align:center;width: 180px;"><?php echo $total_ot; ?></td>
</tr>
</tbody>
</table>

<?php
//die;
		$filename = "export_payrol_".date('Ymd') . ".xls";
		header("Content-Type: application/excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$show_coloumn = false;
		if(!empty($developer_records)) {
		foreach($developer_records as $record) {
		if(!$show_coloumn) {
		// display field/column names in first row
	//	echo implode("\t", array_keys($record)) . "\n";
		$show_coloumn = true;
		}
//		echo implode("\t", array_values($record)) . "\n";
		}
		}
		exit;

	}

?>
