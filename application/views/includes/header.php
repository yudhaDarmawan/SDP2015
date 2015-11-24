<html>
<!--JUDUL DAN ICON UNTUK WEB STTS-->
	<head>
        <meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet">
        <!-- JavaScripts -->
        <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>

		<title> <?php echo $title;?> </title>
		<link rel="icon" href="<?php echo base_url("assets/images/icon.ico");?>">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

	</head>
<!--LOGO STTS-->
<?php
	if($this->session->userdata('username')){
		echo form_open('perwalian/mahasiswa');
	}
?>
	<div class="header">
		<!--<p class="navbar-text">Sistem Informasi Mahasiswa</p>--><!-- <a class="navbar-brand" rel="home" href="#"-->
		<?php $stylebutton=array('class'=>'customNavbar','name'=>'home','value'=>'echo '); ?>
		<!-- <input type='image' src='<?php echo base_url("assets/images/logo.png");?>'  onFocus='form.submit' name='home'/>-->
		<!-- <input type="submit" name="home" class="customNavbar" value=""><img src="<?php echo base_url("assets/images/logo.png");?>"/></input>-->
		<input type="image" src='<?php echo base_url("assets/images/logo.png");?>' name="home" onChange='form.submit'/> 
		<!-- <a href=""> <input type="submit" class="customNavbar" name="home"><img src="<?php echo base_url("assets/images/logo.png");?>"/></input> </a>-->
		
	</div>
