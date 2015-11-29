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
			
			for($j = 0; $j < count($semester[$i]); $j++) {
				echo "		<tr> \n";
				
				echo "			<th><p align='center' style='font-weight:normal;'><label>" . $semester[$i]['data']['id'] . " </label></p></th> \n";
				echo "			<th><p align='center' style='font-weight:normal;'><label>" . $semester[$i]['data']['nama'] . " </label></p></th> \n";
				echo "			<th><p align='center' style='font-weight:normal;'><label>" . $semester[$i]['data']['jumlah_sks'] . " </label></p></th> \n";
				echo "			<th><p align='center' style='font-weight:normal;'><label>" . $semester[$i]['data']['nilai_grade'] . " </label></p></th> \n";
				
				echo "		</tr> \n \n";
			}
			echo "	</tbody> \n";
			echo "</table> \n";
			
			if ($i % 2 == 0){
				echo "\n </td></tr> <br><br>\n"; 
			} else echo "</td> \n\n";
		} ?>
	</table>
	
	<?php echo form_open('revision/student_transcript'); ?>
		<div class="text-right">
		    <?php echo form_submit(['id'=>'print','name'=>'print','value'=>'Cetak Transkip','class'=>'btn btn-primary','style'=>'margin-left:80%;']); ?>
		</div>
	<?php echo form_close(); ?>
	
</div> <!-- End of Container -->