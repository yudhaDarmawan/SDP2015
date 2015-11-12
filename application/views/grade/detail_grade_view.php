	<div class="panel panel-info">
	  <div class="panel-heading"><?php echo $title;?></div>
	  <div class="panel-body">
		<?php echo $this->table->generate();?>
	  </div>
	</div>
    <div class="row">
        <div class="col-md-8">
            <button id='btnCetak' type='button' class='btn btn-primary'>Cetak</button>
            <button id='btnRevisi' type='button' class='btn btn-primary' >Revisi</button>
            <button id='btnProsentase' type='button' class='btn btn-primary' data-toggle="modal" data-target="#managePercentage">Atur Prosentase</button>
            <button id='btnGrade' type='button' class='btn btn-primary' data-toggle="modal" data-target="#manageGrade">Grade</button>
        </div>
        <div class="col-md-4 text-right">
            <button id="btnEditAll" type='button' class="btn btn-primary">Edit All</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
    <table id="table_grade" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>No</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>UTS</th>
            <th >UAS</th>
            <th >Tugas</th>
            <th >NA</th>
            <th >NA+</th>
            <th >Grade</th>
            <th>Pengaturan</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
     </div>
    </div>

    </div><!-- End of Container -->
  
  <script>
	var statusGrade = <?php echo $class[10];?>;
	if (statusGrade < 3){
		$('#btnRevisi').attr('disabled','');
	}
	else {
		$('#btnProsentase').attr('disabled','');
		$('#btnGrade').attr('disabled','');
	}

        var table;
        $(document).ready(function() {
            table = $('#table_grade').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "paging":   false,
                "bFilter": false,
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('grade/ajax_grade/'.$classId)?>",
                    "type": "POST"
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                    {
                        "targets": [ 0,-1 ], //last column
                        "orderable": false, //set not orderable
                    },
                ],

            });
            // Method untuk mengganti button Edit menjadi button Edit All
            $('#table_grade').on('click', '.grade_edit', function(event){
                // do something
                event.preventDefault();
                rowIndex = $(this).attr('data-value');
                $('.nilai_'+rowIndex).removeAttr('disabled');
                $('#btnEditAll').attr('disabled','');
                $(this).parent().html('<button class="btn btn-primary grade_save btn-sm" data-value="'+rowIndex+'">Save</button> <button class="btn btn-default btn-sm grade_cancel" data-value="'+rowIndex+'">Cancel</button>');
            });
            // Method untuk button Cancel
            $('#table_grade').on('click', '.grade_cancel', function(event){
                // do something
                event.preventDefault();
                rowIndex = $(this).attr('data-value');
                $('.nilai_'+rowIndex).attr('disabled','');
                $('#btnEditAll').removeAttr('disabled');
                $(this).parent().html('<button class="btn btn-primary grade_edit btn-sm" data-value="'+rowIndex+'">Edit</button>');
            });
            $('#btnEditAll').click(function(event){
                event.preventDefault();
                $('.nilai_uts').removeAttr('disabled');
                $('.nilai_uas').removeAttr('disabled');
                $('.nilai_tugas').removeAttr('disabled');
                $('.grade_edit').attr('disabled','');
            });
        });
        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax
        }
    </script>
 <!-- Manage Grade Modal -->
<div class="modal fade" id="manageGrade" tabindex="-1" role="dialog" aria-labelledby="manageGrade">
  <div class="modal-dialog modal-sm"" role="document">
    <div class="modal-content">
	  <?php echo form_open();?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="manageGradeLabel">Atur Grade</h4>
      </div>
      <div class="modal-body">
			<?php 
			$data = [ 'name' => 'inputGrade','value' => $class[12],'class' => "form-control",'id' => 'inputGrade','type'=>'number','min'=>0, 'max' => 100];
			echo form_input($data);
			?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		<?php echo form_submit('btnInputGrade','Simpan','class="btn btn-primary"');?>
      </div>
	  <?php echo form_close();?>
    </div>
  </div>
</div>

<!-- Manage Prosentase Modal -->
<div class="modal fade" id="managePercentage" tabindex="-1" role="dialog" aria-labelledby="managePercentage">
  <div class="modal-dialog modal-sm"" role="document">
    <div class="modal-content">
	  <?php echo form_open();?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="manageGradeLabel">Atur Grade</h4>
      </div>
      <div class="modal-body">
			
			<?php 
			echo form_label('Prosentase UTS','inputUTS');
			$data = [ 'name' => 'inputUTS','value' => $class[13],'class' => "form-control",'id' => 'inputUTS','type'=>'number','min'=>0, 'max' => 100];
			echo form_input($data);
			
			echo form_label('Prosentase UAS','inputUAS');
			$data = [ 'name' => 'inputUAS','value' => $class[14],'class' => "form-control",'id' => 'inputUAS','type'=>'number','min'=>0, 'max' => 100];
			echo form_input($data);
			
			echo form_label('Prosentase Tugas','inputHomework');
			$data = [ 'name' => 'inputHomework','value' => $class[15],'class' => "form-control",'id' => 'inputHomework','type'=>'number','min'=>0, 'max' => 100];
			echo form_input($data);
			?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
		<?php echo form_submit('btnInputPercentage','Simpan','class="btn btn-primary"');?>
      </div>
	  <?php echo form_close();?>
    </div>
  </div>
</div>