<div class="container-fluid" style="width: 85%; margin: 0 auto;">
	<div class="row">
		<h2> Master Keuangan </h2>
	</div>
	<!-- notification goes here -->
	<?php
		if($this->session->flashdata('error_master_biaya') != ''){
			$errorDiv = "<div class='alert alert-danger fade in'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		  		<strong>Error!</strong> Semua TextField dan Dropdown harus diisi!.
				</div>";
			echo $errorDiv;
		}
	?>
    <?php
    if($countMatriculant > 0){
        echo "<div class='alert alert-info fade in'>
		      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		      <strong>NEW!</strong> Ada $countMatriculant Calon Mahasiswa Baru.
	          </div>";
    }
    if($countStudent > 0){
        echo "<div class='alert alert-info fade in'>
		      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		      <strong>NEW!</strong> Ada $countStudent Mahasiswa Baru.
	          </div>";
    }
    ?>
	<div class="row">
		<?php
			echo form_open('masterbau/master_keuangan');
			echo '<h3> Generate Tagihan USP untuk '. $countMatriculant .' Calon Mahasiswa.</h3>';
			$attributes = array('name'=>'btnSubmitUSP', 'value'=>'Generate Sim SalaBim Ada Kadabra USP', 'class'=>'btn btn-default', 'style'=>'background:#664400; color:white;');
			echo form_submit($attributes);
			echo form_close();
		?>
	</div>
	<div class="row">
		<?php
			echo form_open('masterbau/master_keuangan');
			echo '<h3> Generate Tagihan UPP untuk '. $countStudent .' Mahasiswa Baru.</h3>';
			$attributes = array('name'=>'btnSubmitUPP', 'value'=>'Generate Dibantu ya dibantu jadi apa UPP', 'class'=>'btn btn-default', 'style'=>'background:#664400; color:white;');
			echo form_submit($attributes);
			echo form_close();
		?>
	</div>
</div>