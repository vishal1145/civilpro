<?php 
$obj = new  connection();
$con = $obj->connect();
$id=$_POST['id'];
$sql="DELETE FROM Client WHERE id=$id";
$deleteid=mysqli_query($con,$sql);
?>


			
			
<script>
$(document).ready(function(){
jQuery('#clientid').click(function(){
var id = jQuery("#client_id").val();
jQuery.ajax({
          type: 'POST',         
          url: "",
         data: {"id":id},
        success: function (data) {			
          location.reload();
        }
    });
	
});
});
</script>