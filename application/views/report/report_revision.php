<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">&nbsp;<b>Detail Kelas :</b></div>
			<div class="panel-body">
				<table border="0" cellpadding="4" cellspacing="0">
					<tbody>
						<tr>
							<td>Mata Kuliah / Semester / SKS &nbsp;&nbsp;</td>
                            <td>:</td>
							<td><?php echo $class[0].' / '. $class[3]. ' / '. $class[8].' SKS'; ?></td>
						</tr>
						<tr>
							<td>Jurusan / Semester &nbsp;&nbsp;  </td>
                            <td>:</td>
							<td><?php echo $class[1].' / '.$class[9].', '.$class[4]; ?></td>
						</tr>
                        <tr>
                            <td>Ruang / Hari, Jam </td>
                            <td>:</td>
                            <td><?php echo  $class[5].' / '.$class[4];?></td>
                        </tr>
						<tr>
							<td>Dosen  </td>
                            <td>:</td>
							<td><?php echo $class[7]; ?></td>
						</tr>
						<tr>
							<td>Tahun Ajaran  </td>
                            <td>:</td>
							<td><?php echo $class[11]; ?></td>
						</tr>
						<tr>
							<td>Status Penilaian </td>
                            <td>:</td>
							<td><?php echo $class[6]; ?></td>
						</tr>
						<tr>
							<td>Terakhir Update </td>
                            <td>:</td>
							<td><?php echo $class[16]; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
	</div> <!-- End of Class' Information -->

	<br><br>
	
	<?php echo form_open('revision/revisi'); ?>
		<input type="hidden" id="how_many" name="how_many" value="<?php echo $how_many; ?>" />
		<input type="hidden" id="class_id" name="class_id" value="<?php echo $class_id; ?>" />
		
	    <table id="table_revision" class="table table-striped table-bordered" cellspacing="0" width="100%" border="1">
	      	<thead>
		        <tr>
		          	<th><p align='center'> No. </p></th>
		          	<th><p align='center'> NRP </p></th>
		            <th><p align='center'> Nilai Akhir Lama </p></th>
		          	<th><p align='center'> Nilai Akhir Baru </p></th>
		        </tr>
	      	</thead>
	      	<tbody>
	      		<?php 
	      			// create for how many rows
					for($i = 0; $i < $how_many; $i++) {
						echo "<tr>";
							echo "<th> <p align='center' style='font-weight:normal;'>" . ($i + 1) . "</p> </th>";
							
							$id = "combo_nrp_" . $i; 
							echo "<th> <p align='center' style='font-weight:normal;'>" . $input[$id] . "</p> </th>";
							
							$id = "old_score_" . $i;
							echo "<th> <p align='center' style='font-weight:normal;'>" . $input[$id] . "</p> </th>";
							
							$id = "new_score_" . $i;
							echo "<th> <p align='center' style='font-weight:normal;'>" . $input[$id] . "</p> </th>";
						echo "</tr> \n";
					} 
				?>
	      	</tbody>
	    </table>
	    
	    <br> <b>Komentar :</b> <br>
	    <p style='font-weight:normal;'> <?php echo $comment; ?> </p>
	<?php echo form_close(); ?>
</div> <!-- End of Container -->