<footer class="footer<?php if($isFooterFixed == true) echo ' navbar-fixed-bottom'; ?>" style="color: white; background: #664444;">
	<div class="container-fluid">
		<div class="col-sm-6">
			<p class="navbar-text">©Copyright 2015     Sekolah Tinggi Teknik Surabaya
			<br>web_admin@stts.edu
			</p>
		</div>
		
		<div class="col-sm-6 ">
			<p align="right" class="pull-right navbar-text">Jalan Ngagel Jaya Tengah 73 - 77
			<br>Surabaya, Indonesia
			<br>Tel. +62 31 502 7920     Fax. +62 31 504 1509, +62 31 503 1818
			</p>
		</div>
	</div>
</footer>

<?php // script untuk show error modal. 
if($this->session->flashdata('error_modal') == true):?>
	<script> $('#modalLogin').modal('show');</script>
<?php endif;?>

</body>
</html>