<html>
<head>
	<title>SPD BAU</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-------------------------------------------------------
	load css bootstrap, jquery bootstrap, javascript bootstrap.
	-------------------------------------------------------->
	<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
	<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
	<!-------------------------------------------------------
	load css datatables, jquery datatables.
	-------------------------------------------------------->
	<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/datatables/css/jquery.dataTables.min.css')?>" rel="stylesheet">
	<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/currency.js')?>"></script>
	<!-------------------------------------------------------
	load css presequites.
	-------------------------------------------------------->
	<link href="<?php echo base_url('assets/customcss/header.css')?>" rel="stylesheet">
	<style>
		.container-fluid{
			margin: 0 0 0 0;
			padding: 0 0 0 0;
		}
		.row{
			margin: 0 0 0 0;
			padding: 0 0 0 0;
		}
		.navbar{
			margin: 0 0 0 0;
			padding: 0 0 0 0;
		}
	</style>
	<!-------------------------------------------------------
	javascript and jquery.
	<------------------------------------------------------->
	<script>
		
$(document).ready(function() {

    $('#dtbKurikulum').DataTable();

} );
		
	</script>
</head>
<body <?php if($isOverflowHidden == true) echo " style='overflow-y: hidden;'" ?>>
<div class="container-fluid banner">
    <a href="#">
        <img class="img-responsive" src="<?php echo base_url('assets/images/logobau.png');?>"/>
    </a>
</div>