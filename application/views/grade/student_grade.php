<style>
	.my_tables {
		display: none;
		margin-left: 8%;
		width: 80%;
	}
	p { margin-bottom: 0px; }
</style>

<div class="container">
	<h1 style="text-align: center;">Laporan Nilai Semester</h1>
	<h3 style="text-align: center;"><?php echo $jurusan; ?></h3>
	<input type="hidden" id="jumlah_semester" name="jumlah_semester" value="<?php echo $jumlah_semester; ?>" />
	
	<hr> <br>
	
	<label>Semester : </label> 
	<select id="semester" name="semester" class="form-control" style="width: 5.5%; margin-top: -2.75%; margin-left: 7%;">
		<option value="none"></option>
		<?php 
		for($i = 1; $i <= $jumlah_semester; $i++) {
			echo "\n		<option value='table_semester_" . $i . "'>" . $i . "</option>";
		} ?>
	</select>
	
	<!--div style="margin-top: -2.4%; margin-left: 15%;">
		<label>Tahun ajaran: </label>
		<label id="tahun_ajaran">GASAL 2015/2016</label>
	</div-->
	
	<br>
	
	<div id="table_content" style="width: 100%;">
		<?php for($i = 1; $i <= $jumlah_semester; $i++) {
			echo "\n <table id='table_semester_" . $i . "' class='my_tables table table-striped table-bordered' cellspacing='0' width='100%'> \n";
			echo "	<thead> \n";
			echo "		<tr> \n";
			echo "			<th><p align='center'> Kode </p></th> \n";
			echo "			<th><p align='center'> Mata Kuliah </p></th> \n"; 
			echo "			<th><p align='center'> UTS </p></th> \n";
			echo "			<th><p align='center'> UAS </p></th> \n";
			echo "			<th><p align='center'> Tugas </p></th> \n";
			echo "			<th><p align='center'> Nilai Akhir </p></th> \n"; 
			echo "			<th><p align='center'> Grade </p></th> \n";
			echo "		</tr> \n";
			echo "	</thead> \n";
			echo "	<tbody> \n";
			
			
			if (count($semester[$i]) == 0){
				echo "<tr><th colspan='7'><p align='center' style='font-weight:normal;'>Tidak ada mata kuliah yang diambil</p></th></tr>";
			} else {
				for($j = 0; $j < count($semester[$i]); $j++) {
					echo "		<tr> \n";
					echo "			<th><p align='center'> " . $semester[$i]['data']['id'] . " </p></th> \n";
					echo "			<th><p align='center'> " . $semester[$i]['data']['nama'] . " </p></th> \n";
					echo "			<th><p align='center'> " . $semester[$i]['data']['uts'] . " </p></th> \n";
					echo "			<th><p align='center'> " . $semester[$i]['data']['uas'] . " </p></th> \n";
					echo "			<th><p align='center'> " . $semester[$i]['data']['tugas'] . " </p></th> \n";
					echo "			<th><p align='center'> " . $semester[$i]['data']['nilai_akhir_grade'] . " </p></th> \n";
					echo "			<th><p align='center'> " . $semester[$i]['data']['nilai_grade'] . " </p></th> \n";
					echo "		</tr> \n \n";
				}
			}
			
			echo "	</tbody> \n";
			echo "</table> \n\n";
		} ?>
	</div>
	
	<br>
	
	<div class="text-right">
		<?php echo form_open('revision/student_grade'); ?>
		<input type="hidden" id="selected_semester" name="selected_semester" value="<?php echo $selected_semester; ?>" />
		<?php echo form_submit(['id'=>'print','name'=>'print','value'=>'Cetak Transkip','class'=>'btn btn-primary']); ?>
		<?php echo form_close(); ?>
	</div></div>
</div> <!-- End of Container -->

<script>
	$(document).ready(function() {    
    	$("#semester").change(function(){
			$(".my_tables").hide();
			$("#selected_semester").val($("#semester").val());
			$("#" + $("#semester").val()).show();
			
			return false;
	    });
    });
</script>