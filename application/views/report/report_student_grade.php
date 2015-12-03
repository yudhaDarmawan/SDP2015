<style>
	p { margin-top: 0px; }
</style>

<div class="container">
	<h2 style="text-align: center;"><?php echo $jurusan; ?></h2>
	<input type="hidden" id="jumlah_semester" name="jumlah_semester" value="<?php echo $jumlah_semester; ?>" />
	<input type="hidden" id="selected_semester" name="selected_semester" value="<?php echo $selected_semester; ?>" />
	
	<hr> <br>
	
	<!--div style="margin-top: -2.4%; margin-left: 15%;">
		<label>Tahun ajaran: </label>
		<label id="tahun_ajaran">GASAL 2015/2016</label>
	</div-->
	
	<br><br>
	
	<div id="table_content" style="width: 100%;">
		<table class='table table-striped table-bordered' cellspacing='0' width='100%' border="1">
			<thead>
				<tr>
					<th><p align='center'> Kode </p></th>
					<th><p align='center'> Mata Kuliah </p></th>
					<th><p align='center'> UTS </p></th>
					<th><p align='center'> UAS </p></th>
					<th><p align='center'> Tugas </p></th>
					<th><p align='center'> Nilai Akhir </p></th>
					<th><p align='center'> Grade </p></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if (count($semester[$selected_semester]) == 0){
						echo "<tr><th colspan='7'><p align='center' style='font-weight:normal;'>Tidak ada mata kuliah yang diambil</p></th></tr>";
					} else {
						for($j = 0; $j < count($semester[$selected_semester]); $j++) {
							echo "		<tr> \n";
							echo "			<th><p align='center' style='font-weight:normal;'> " . $semester[$selected_semester]['data']['id'] . " </p></th> \n";
							echo "			<th><p align='center' style='font-weight:normal;'> " . $semester[$selected_semester]['data']['nama'] . " </p></th> \n";
							echo "			<th><p align='center' style='font-weight:normal;'> " . $semester[$selected_semester]['data']['uts'] . " </p></th> \n";
							echo "			<th><p align='center' style='font-weight:normal;'> " . $semester[$selected_semester]['data']['uas'] . " </p></th> \n";
							echo "			<th><p align='center' style='font-weight:normal;'> " . $semester[$selected_semester]['data']['tugas'] . " </p></th> \n";
							echo "			<th><p align='center' style='font-weight:normal;'> " . $semester[$selected_semester]['data']['nilai_akhir_grade'] . " </p></th> \n";
							echo "			<th><p align='center' style='font-weight:normal;'> " . $semester[$selected_semester]['data']['nilai_grade'] . " </p></th> \n";
							echo "		</tr> \n \n";
						}
					}
				?>
			</tbody>
		</table>
	</div>	
</div> <!-- End of Container -->
