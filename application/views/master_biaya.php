<div class="container-fluid" style="width: 85%; margin: 0 auto;">
	<div class="row">
		<h2> Master Biaya </h2>
	</div>
	<!-- notification goes here -->
	<?php
		if($this->session->flashdata('error_master_biaya') != ''){
			$errorDiv = "<div class='alert alert-danger fade in'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		  		<strong>ERROR!</strong> Semua TextField dan Dropdown harus diisi!.
				</div>";
			echo $errorDiv;
		}
		if($this->session->flashdata('update_master_biaya') != ''){
			$errorDiv = "<div class='alert alert-success fade in'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		  		<strong>SUCCESS!</strong> Update record berhasil!.
				</div>";
			echo $errorDiv;
		}
		if($this->session->flashdata('insert_master_biaya') != ''){
			$errorDiv = "<div class='alert alert-success fade in'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		  		<strong>SUCCESS!</strong> Insert record berhasil!.
				</div>";
			echo $errorDiv;
		}
	?>
    
    <div class="row">
		<?php echo form_open('masterbau/master_biaya'); ?>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align:right;">
					<h4> Jurusan :</h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					$arrayJurusan = array(
						'S1INF' => 'S1-Informatika', 'D3INF' => 'D3-Informatika', 'S1SIB' => 'S1-Sistem Informasi Bisnis',
						'S1IND' => 'S1-Industri', 'S1DKV' => 'S1-Desain Komunikasi Visual', 'S1PRO' => 'S1-Desain Produk',
						'S2INF' => 'S2-Informatika', 'BIT' => 'Business Information Technology',
					);
					echo form_dropdown('cbJurusan', $arrayJurusan, '', 'class=form-control');
					?>
				</div>
			</div>
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align:right;">
					<h4> Tahun :</h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					$arrayTahun = array(
						(substr(date('Y')-5, 2, 2)) => (date('Y')-5).'/'.(date('Y')-4), 
						(substr(date('Y')-4, 2, 2)) => (date('Y')-4).'/'.(date('Y')-3), 
						(substr(date('Y')-3, 2, 2)) => (date('Y')-3).'/'.(date('Y')-2), 
						(substr(date('Y')-2, 2, 2)) => (date('Y')-2).'/'.(date('Y')-1), 
						(substr(date('Y')-1, 2, 2)) => (date('Y')-1).'/'.(date('Y')-0), 
						(substr(date('Y')-0, 2, 2)) => (date('Y')-0).'/'.(date('Y')+1), 
						(substr(date('Y')+1, 2, 2)) => (date('Y')+1).'/'.(date('Y')+2), 
						(substr(date('Y')+2, 2, 2)) => (date('Y')+2).'/'.(date('Y')+3), 
						(substr(date('Y')+3, 2, 2)) => (date('Y')+3).'/'.(date('Y')+4), 
						(substr(date('Y')+4, 2, 2)) => (date('Y')+4).'/'.(date('Y')+5), 
						(substr(date('Y')+5, 2, 2)) => (date('Y')+5).'/'.(date('Y')+6)
					);
					echo form_dropdown('cbTahun', $arrayTahun, '', 'class=form-control');
					?>
				</div>
			</div>
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align:right;">
					<h4> Kategori : </h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					$arrayKategori = array(
						'1' => '1', 
						'2' => '2', 
						'3' => '3', 
						'4' => '4', 
						'5' => '5',  
					);
					echo form_dropdown('cbKategori', $arrayKategori, '', 'class=form-control');
					?>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="text-align:right;">
					<h5> Uang Sumbangan Perkuliahan (USP) : </h5>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
					<?php
					$attributes = array('name'=>'txtUSP', 'placeholder'=>'ex: 7.000.000', 'class'=>'form-control');
					echo form_input($attributes);
					?>
				</div>
			</div>
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="text-align:right;">
					<h5> Sumbangan Pengadaan Perkuliahan (SPP) : </h5>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
					<?php
					$attributes = array('name'=>'txtSPP', 'placeholder'=>'ex: 7.000.000', 'class'=>'form-control');
					echo form_input($attributes);
					?>
				</div>
			</div>
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="text-align:right;">
					<h5> Satuan Kredit Semester (SKS) : </h5>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
					<?php
					$attributes = array('name'=>'txtSKS', 'placeholder'=>'ex: 7.000.000', 'class'=>'form-control');
					echo form_input($attributes);
					?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<?php
			$attributes = array('name'=>'btnSubmit', 'value'=>'Submit', 'class'=>'btn btn-default', 'style'=>'background: #664400; color: white; float:right; margin-right:2vw;');
			echo form_submit($attributes);
		?>
	</div>
	<?php echo form_close(); ?>
	
	<div class="row" style="background:#33dd33; margin-top: 1vw;">
		<table width="100%" class="table table-striped table-bordered" id="dtbKurikulum" cellspacing="0">
        	<thead>
	            <tr>
	                <th>id</th>
	                <th>Jurusan</th>
	                <th>Tahun Angkatan</th>
	                <th>Kategori</th>
	                <th>Harga USP</th>
	                <th>Harga SPP</th>
	                <th>Harga SKS</th>
	            </tr>
			</thead>
        	<tfoot>
	            <tr>
	                <th>id</th>
	                <th>Jurusan</th>
	                <th>Tahun Angkatan</th>
	                <th>Kategori</th>
	                <th>Harga USP</th>
	                <th>Harga SPP</th>
	                <th>Harga SKS</th>
	            </tr>
        	</tfoot>
        	<tbody>
        	<?php
        		for($a = 0; $a < count($table); $a++){
        			echo "<tr>";
					echo "<td>"; echo $table[$a]['id']; echo "</td>";
					echo "<td>"; echo $table[$a]['jurusan']; echo "</td>";
					echo "<td>"; echo $table[$a]['tahun_angkatan']; echo "</td>";
					echo "<td>"; echo $table[$a]['kategori']; echo "</td>";
					echo "<td style='text-align:right;'>"; echo number_format($table[$a]['harga_usp']); echo "</td>";
					echo "<td style='text-align:right;'>"; echo number_format($table[$a]['harga_spp']); echo "</td>";
					echo "<td style='text-align:right;'>"; echo number_format($table[$a]['harga_sks']); echo "</td>";
					echo "</tr>";
				}
        	?>
        	</tbody>
        </table>
	</div>
	
	
</div>