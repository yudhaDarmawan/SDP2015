<style>
	.combobox{display:block;width:100%;height:34px;padding:6px 12px;font-size:14px;line-height:1.42857143;color:#555;background-color:#fff;background-image:none;border:1px solid #ccc;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s}
	.combobox:focus{border-color:#66afe9;outline:0;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)}
</style>

<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">Detail <?php echo $class[1]; ?></div>
			<div class="panel-body">
				<table border="0" cellpadding="4" cellspacing="0">
					<tbody>
						<tr>
							<td>Mata Kuliah / Semester / SKS :&nbsp;&nbsp;</td>
							<td><?php echo $class[1].' / '. $class[9]. ' / '. $class[8].' SKS'; ?></td>
						</tr>
						<tr>
							<td>Ruang / Hari, Jam : </td>
							<td><?php echo $class[5].' / '.$class[3].', '.$class[4]; ?></td>
						</tr>
						<tr>
							<td>Kelas / Dosen : </td>
							<td><?php echo $class[2].' / '.$class[7]; ?></td>
						</tr>
						<tr>
							<td>Tahun Ajaran : </td>
							<td><?php echo $class[11]; ?></td>
						</tr>
						<tr>
							<td>Status Penilaian :</td>
							<td><?php echo $class[6]; ?></td>
						</tr>
						<tr>
							<td>Terakhir Update :</td>
							<td><?php echo $class[16]; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
	</div> <!-- End of Class' Information -->

    <h1> Revisi Penilaian </h1>
	
    <?php echo form_open('revision'); ?>
		<input type="hidden" id="how_many" name="how_many" value="<?php echo $how_many; ?>" />
		<input type="hidden" id="class_id" name="class_id" value="<?php echo $class_id; ?>" />
		
		<?php
			$arrStudents = NULL;
			$arrStudents[""] = "";
			foreach($students as $student){
				$arrStudents[$student->nrp] = $student->nrp . " - ". $student->nama;
				echo "<input type='hidden' id='" . $student->nrp . "' name='" . $student->nrp . "' value='" . $student->nilai_akhir_grade . "' />";
			}
		?>
    	
	    <table id="table_revision" class="table table-striped table-bordered" cellspacing="0" width="100%">
	      	<thead>
		        <tr>
		          	<th> # </th>
		          	<th> NRP </th>
		            <th> Nilai Akhir Lama </th>
		          	<th> Nilai Akhir Baru </th>
		        </tr>
	      	</thead>
	      	<tbody>
	      		<?php 
	      			// create for how many rows
					for($i = 0; $i < $how_many; $i++) {
						echo "<tr>";
							echo "<th> <label>" . ($i + 1) . "</label> </th>";
							
							$id = "combo_nrp_" . $i; 
							$attr = "id='" . $id . "' class='combobox'";
							echo "<th> " . form_dropdown($id, $arrStudents, $input[$id], $attr) . " </th>";
							
							$id = "old_score_" . $i;
							echo "<input type='hidden' id='" . $id . "' name='" . $id . "' value='" . $input[$id] . "' />";
							echo "<th> <label id='label_old_score_" . $i . "' class='form-control width='20'>" . $input[$id] . "</label> </th>";
							
							$id = "new_score_" . $i;
							echo "<th> <input type='number' id='" . $id . "' name='" . $id . "' value='" . $input[$id] . "' min='0' max='100' class='form-control'/> </th>";
						echo "</tr> \n";
					} 
				?>
	      	</tbody>
	    </table>
	    
	    <br> Komentar: <br>
	    <?php echo form_textarea('comment', $comment, 'class=form-control'); ?>
	    
	    <br><br>
	    
	    <div class="text-right">
		    <!--input type="submit" id="add_row" name="add_row" value="Tambah" class="btn btn-primary" style="margin-left:80%;"/-->
		    <?php echo form_submit(['id'=>'add_row','name'=>'add_row','value'=>'Tambah','class'=>'btn btn-primary','style'=>'margin-left:80%;']); ?>
			<!--input type="submit" name="sendRevision" value="Send Revision" class="btn btn-primary"/-->
			<?php echo form_submit(['id'=>'send_revision','name'=>'send_revision','value'=>'Kirim','class'=>'btn btn-primary']); ?>
		</div>
	<?php echo form_close(); ?>
</div> <!-- End of Container -->

<script>
    $(document).ready(function() {
    	$(".combobox").change(function(event){
			//alert(event.target.id);
			
			var id_combo_nrp = "#" + event.target.id;
			var selected_nrp = $(id_combo_nrp).val(); //alert(selected_nrp);
			
			var id_old_score_ = "#old_score_" + id_combo_nrp.substring(11);
			var id_label_old_score_ = "#label_old_score_" + id_combo_nrp.substring(11);
			
			if (selected_nrp != ""){
				var get_score = "#" + selected_nrp;
				var old_score = $(get_score).val();
				$(id_old_score_).val(old_score);
				$(id_label_old_score_).html(old_score);
			} else {
				$(id_old_score_).val("");
				$(id_label_old_score_).html("");
			}
	    });
    });
</script>