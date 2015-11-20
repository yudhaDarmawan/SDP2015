<html>
<!--JUDUL DAN ICON UNTUK WEB STTS-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css");?>"> 
		<link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css");?>">
		<script src="<?php echo base_url("assets/bootstrap/js/respon.js");?>"></script>
		<title> <?php echo $title;?> </title>
		<link rel="icon" href="<?php echo base_url("assets/images/icon.png");?>">
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
<!-- javascript -->
	<script src="<?php echo base_url("assets/jquery/jquery-latest.min.js");?>"></script>
	<script src="<?php echo base_url("assets/bootstrap/js/bootstrap.min.js");?>"></script>