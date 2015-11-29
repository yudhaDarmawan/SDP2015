<style>
	p { margin-bottom: 0px; }
</style>

<div class="container">
	<div style="margin-left: 42%; margin-top: 4%;">
		<label><b>NRP</b></label> <br>
		<label><b>Nama</b></label> <br>
		<label><b>IPK</b></label> <br>
		<label><b>Total SKS</b></label>
	</div>
	
	<div style="margin-left: 54%; margin-top: -11.9%;">
		<label><b>:</b> <?php echo $nrp; ?></label> <br>
		<label><b>:</b> <?php echo $nama; ?></label> <br>
		<label><b>:</b> <?php echo $ipk; ?></label> <br>
		<label><b>:</b> <?php echo $total_sks; ?></label>
	</div>
	
	<?php for($i = 1; $i <= $jumlah_semester; $i++) {
		echo "<h4>SEMESTER " . $i . "</h4>";
		
		echo "\n <table id='table_transcript' class='table table-striped table-bordered' cellspacing='0' border='1' width='100%'> \n";
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
	} ?>
	
</div> <!-- End of Container -->