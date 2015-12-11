<div class="container-fluid" style="width: 85%; margin: 0 auto;">
	<div class="row">
		<h2> Pembayaran USP </h2>
	</div>
	<div class="row">
		<?php echo form_open('keuangan/pembayaran_usp'); ?>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align:right;">
					<h4> Tahun :</h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					$arrayTahun = array( 'ALLYEAR' => 'All Year',
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
					<h4> Jurusan :</h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					$arrayJurusan = array( 'ALLJURUSAN' => 'All Department',
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
					<h4> From : </h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					echo "<input name='dtpAwal' type='date' value='";
					echo date('Y').'-'.(date('m') > 7 ? '07' : '01').'-01';
					echo "' class='form-control'>"
					?>
				</div>
			</div>
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align:right;">
					<h4> To : </h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					echo "<input name='dtpAkhir' type='date' value='";
					echo date('Y').'-'.(date('m') > 7 ? '12' : '06').'-30';
					echo "' class='form-control'>";
					?>
				</div>
			</div>
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="text-align:right;">
					<h4> Status : </h4>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<?php
					echo form_checkbox('cbBelumLunas', 'BelumLunas', 'class=form-control') . '  Belum Lunas<br>';
					echo form_checkbox('cbLunas', 'Lunas', 'class=form-control') . '  Lunas<br>';
					?>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<!-- row untuk masing masing element input -->
			<div class="row">
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 pull-right" style="">
					<?php
					$attributes = array('name'=>'txtSearch', 'placeholder'=>'Masukkan nama calon mahasiswa', 'class'=>'form-control');
					echo form_input($attributes);
					?>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 pull-right" style="padding-right: 0px;">
					<?php
						$attributes = array('name'=>'btnSearch', 'value'=>'Search', 'class'=>'btn btn-default', 'style'=>'background: #664400; color: white; float:right; margin-right:2vw;');
						echo form_submit($attributes);
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
	<div class="row" style="margin-top: 1vw; background: #33cc33">
		<table width="100%" class="table table-striped table-bordered" id="dtbKurikulum" cellspacing="0">
        	<thead>
	            <tr>
	                <th>Nomor Registrasi</th>
	                <th>Jurusan</th>
	                <th>Nama Calon Mahasiswa</th>
	                <th>Jumlah</th>
	                <th>Tanggal Batas</th>
	                <th>Status</th>
	            </tr>
			</thead>
        	<tfoot>
	            <tr>
	                <th>Nomor Registrasi</th>
	                <th>Jurusan</th>
	                <th>Nama Calon Mahasiswa</th>
	                <th>Jumlah</th>
	                <th>Tanggal Batas</th>
	                <th>Status</th>
	            </tr>
        	</tfoot>
        	<tbody>
        	<?php
        		for($a = 0; $a < count($table); $a++){
        			if($table[$a]['tanggal_batas'] >= $tanggalAwal AND $table[$a]['tanggal_batas'] <= $tanggalAkhir AND $tanggalAwal != '' AND $tanggalAkhir != ''){
	        			echo "<tr>";
						echo "<td>"; echo $table[$a]['noreg']; echo "</td>";
						echo "<td>"; echo $table[$a]['jurusan']; echo "</td>";
						echo "<td>"; echo $table[$a]['nama']; echo "</td>";
						echo "<td>"; echo number_format($table[$a]['jumlah']); echo "</td>";
						echo "<td>"; echo $table[$a]['tanggal_batas']; echo "</td>";
						echo "<td>"; 
						$no = $table[$a]['noreg'];
						//echo ($table[$a]['status'] == 1 ? 'Belum lunas' : 'Lunas');
						$belum = false;$lunas = true;
						if($table[$a]['status'] == 1){
							$belum = true;$lunas = false;
						}
						echo form_radio("rdStatus$no",true,$belum,'class=radio-inline') . '  Belum Lunas';
						echo form_radio("rdStatus$no",false,$lunas,'class=radio-inline') . '  Lunas';
						echo "</td>";
						echo "</tr>";
					}
				}
        	?>
        	</tbody>
        </table>
	</div>
	</div>
</div>