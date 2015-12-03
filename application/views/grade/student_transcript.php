<style>
	p { margin-bottom: 0px; }
</style>

<div class="container">
	<h1 style="text-align: center;">Transkip Nilai Sementara</h1>
	
	<hr>
	
	<div style="margin-left: 42%; margin-top: 4%;">
		<label><b>NRP</b></label> <br>
		<label><b>Nama</b></label> <br>
		<label><b>IPK</b></label> <br>
		<label><b>Total SKS</b></label>
	</div>
	
	<div style="margin-left: 48.5%; margin-top: -8.9%;">
		<label>: <?php echo $nrp; ?></label> <br>
		<label>: <?php echo $nama; ?></label> <br>
		<label>: <?php echo $ipk; ?></label> <br>
		<label>: <?php echo $total_sks; ?></label>
	</div>
	
	<table width="100%" style="margin-top: -8%;">
		<?php for($i = 1; $i <= $jumlah_semester; $i++) {
			if ($i % 2 == 0){
				echo "\n <td width='52.75%' style='padding-left:5%;'> \n";
			} else echo "\n <tr><td> \n"; 
			
			echo "<h3>SEMESTER " . $i . "</h3>";
			
			echo "\n <table id='table_transcript' class='table table-striped table-bordered' cellspacing='0'> \n";
			echo "	<thead> \n";
			echo "		<tr> \n";
			echo "			<th><p align='center'> Kode </p></th> \n";
			echo "			<th><p align='center'> Mata Kuliah </p></th> \n";
			echo "			<th><p align='center'> SKS </p></th> \n";
			echo "			<th><p align='center'> Grade </p></th> \n";
			echo "		</tr> \n";
			echo "	</thead> \n";
			echo "	<tbody> \n";
			
			if (count($semester[$i]) == 0){
				echo "<tr><th colspan='4'><p align='center' style='font-weight:normal;'>Tidak ada mata kuliah yang diambil</p></th></tr>";
			} else {
				for($j = 0; $j < count($semester[$i]); $j++) {
					echo "		<tr> \n";
					echo "			<th><p align='center' style='font-weight:normal;'>" . $semester[$i]['data']['id'] . " </p></th> \n";
					echo "			<th><p align='center' style='font-weight:normal;'>" . $semester[$i]['data']['nama'] . " </p></th> \n";
					echo "			<th><p align='center' style='font-weight:normal;'>" . $semester[$i]['data']['jumlah_sks'] . " </p></th> \n";
					echo "			<th><p align='center' style='font-weight:normal;'>" . $semester[$i]['data']['nilai_grade'] . " </p></th> \n";
					echo "		</tr> \n \n";
				}
			}
			
			echo "	</tbody> \n";
			echo "</table> \n";
			
			// set spacing
			if ($i % 2 == 0){
				echo "\n </td></tr> <br><br>\n"; 
			} else echo "</td> \n\n";
		} ?>
	</table>
	
	<div class="text-right">
		<?php echo form_open('revision/student_transcript'); ?>
		<?php echo form_submit(['id'=>'print','name'=>'print','value'=>'Cetak Transkip','class'=>'btn btn-primary']); ?>
		<?php echo form_close(); ?>
	</div>
	
</div> <!-- End of Container -->