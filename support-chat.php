<?php 
include "header.php";
include "sidebar.php";

?>

<style>
iframe#chat_iframe {
    border: 0px;
}
</style>

	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="row">
				<div class="col-sm-8">
					<h4 class="page-title"> Chat </h4>
				</div>
			</div>
				<iframe id="chat_iframe" width="100%" height="610px" src="http://112.196.9.211:8230/civilpro/include-chat.php?id=<?php echo $_GET['id']; ?>"></iframe>
		</div>
	</div>