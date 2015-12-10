<div class="container-fluid" style="width: 85%; margin: 0 auto;">
	<div class="row">
		<h2> Master Beasiswa </h2>
	</div>
	<!-- notification goes here -->
	<?php
		if($this->session->flashdata('error_master_beasiswa') != ''){
			$errorDiv = "<div class='alert alert-danger fade in'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		  		<strong>ERROR!</strong> Semua TextField dan Dropdown harus diisi!.
				</div>";
			echo $errorDiv;
		}
		if($this->session->flashdata('update_master_beasiswa') != ''){
			$errorDiv = "<div class='alert alert-success fade in'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		  		<strong>SUCCESS!</strong> Update record berhasil!.
				</div>";
			echo $errorDiv;
		}
		if($this->session->flashdata('insert_master_beasiswa') != ''){
			$errorDiv = "<div class='alert alert-success fade in'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		  		<strong>SUCCESS!</strong> Insert record berhasil!.
				</div>";
			echo $errorDiv;
		}
	?>
    
    <div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <?php echo form_open('masterbau/master_beasiswa'); ?>
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align:right;">
					<h4> Nama Beasiswa :</h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					echo form_dropdown('cbBeasiswa', $arrayBeasiswa, '', 'class=form-control');
					?>
				</div>
			</div>
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align:right;">
					<h4> Aspek Dipotong :</h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					$arrayAspek = array(
						'SPP' => 'SPP',
                        'SKS' => 'SKS',
                        'USP' => 'USP'
					);
					echo form_dropdown('cbAspek1', $arrayAspek, '', 'class=form-control');
					?>
				</div>
			</div>
            <!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align:right;">
					<h4> Berapa Dipotong :</h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					$attributes = array('name'=>'txtBerapa1', 'placeholder'=>'ex: (100%, 6)', 'class'=>'form-control');
					echo form_input($attributes);
					?>
				</div>
			</div>
            <!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align:right;">
					
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					$attributes = array('name'=>'btnSubmit1', 'value'=>'Submit', 'class'=>'btn btn-default', 'style'=>'background: #664400; color: white; float:right;');
			echo form_submit($attributes);
					?>
				</div>
			</div>
		</div>
        <?php echo form_close(); ?>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <?php echo form_open('masterbau/master_beasiswa'); ?>
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="text-align:right;">
					<h4> Beasiswa Baru : </h4>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
					<?php
					$attributes = array('name'=>'txtNewBeasiswa', 'placeholder'=>'ex: Beasiswa Kawinan', 'class'=>'form-control');
					echo form_input($attributes);
					?>
				</div>
			</div>
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="text-align:right;">
					<h4> Aspek Dipotong :</h4>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
					<?php
					$arrayAspek = array(
						'SPP' => 'SPP',
                        'SKS' => 'SKS',
                        'USP' => 'USP'
					);
					echo form_dropdown('cbAspek2', $arrayAspek, '', 'class=form-control');
					?>
				</div>
			</div>
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="text-align:right;">
					<h4> Berapa Dipotong :</h4>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
					<?php
					$attributes = array('name'=>'txtBerapa2', 'placeholder'=>'ex: (100%, 6)', 'class'=>'form-control');
					echo form_input($attributes);
					?>
				</div>
			</div>
            <!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="text-align:right;">
					
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
					<?php
					$attributes = array('name'=>'btnSubmit2', 'value'=>'Submit', 'class'=>'btn btn-default', 'style'=>'background: #664400; color: white; float:right;');
			echo form_submit($attributes);
					?>
				</div>
			</div>
		</div>
	</div>
    
	<?php echo form_close(); ?>
	
	<div class="row" style="background:#33dd33; margin-top: 1vw;">
		<table width="100%" class="table table-striped table-bordered" id="dtbKurikulum" cellspacing="0">
        	<thead>
	            <tr>
	                <th>id</th>
	                <th>Nama Beasiswa</th>
	                <th>Aspek Dipotong</th>
	                <th>Berapa Dipotong</th>
	                <th>Tanggal Created</th>
	            </tr>
			</thead>
        	<tfoot>
	            <tr>
	                <th>id</th>
	                <th>Nama Beasiswa</th>
	                <th>Aspek Dipotong</th>
	                <th>Berapa Dipotong</th>
	                <th>Tanggal Created</th>
	            </tr>
        	</tfoot>
        	<tbody>
        	<?php
        		for($a = 0; $a < count($table); $a++){
        			echo "<tr>";
					echo "<td>"; echo $table[$a]->id; echo "</td>";
					echo "<td>"; echo $table[$a]->nama_beasiswa; echo "</td>";
					echo "<td>"; echo $table[$a]->aspek_dipotong; echo "</td>";
					echo "<td>"; echo $table[$a]->berapa_dipotong; echo "</td>";
					echo "<td>"; echo $table[$a]->tanggal_created; echo "</td>";
					echo "</tr>";
				}
        	?>
        	</tbody>
        </table>
	</div>
	
	
</div>