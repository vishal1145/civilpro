<!DOCTYPE html>
<html>
<head>


	<title>PHP - Input multiple tags with dynamic autocomplete example</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

 
	<!---<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">--->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="tagmanager.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>  

<style>
.tm-tag-info {
    float: left;
    display: block;
    width: 100%;
    padding: 3px;
}
</style>
</head>
<body>


<div class="container">
	<form>


		
		<div class="form-group">
			<label>Add Tags:</label><br/>
			<input type="text" name="machine_name" placeholder="machine_name" class="typeahead tm-input form-control tm-input-info" autocomplete="off"/>
		</div>


		<div class="form-group">
			<button class="btn btn-success">Submit</button>
		</div>


	</form>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    var tagApi = $(".tm-input").tagsManager();


    jQuery(".typeahead").typeahead({
		
      name: 'machine_name',
      displayKey: 'machine_name',
	  valueKey: 'machine_id',
      source: function (query, process) {
        return $.get('ajaxpro.php', { query: query }, function (data) {
			console.log(data);
          data = $.parseJSON(data);
          return process(data);
        });
      },
      afterSelect :function (item){
        tagApi.tagsManager("pushTag", item);
      }
    });
  });
</script>


</body>
</html>