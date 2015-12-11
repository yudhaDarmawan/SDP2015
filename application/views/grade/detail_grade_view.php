<div class="container">
    <?php if($this->session->flashdata('alert')){
        echo '<div class="alert alert-'.$this->session->flashdata('alert_level').'" role="alert">'.$this->session->flashdata('alert').'</div>';
    }?>
    <div class="page-header"><h2><?=$class[6]?> <?= $class[0] ?> / <?= $class[3]?> <small><?= $class[1] ?></small><h2></div>
<div class="panel panel-info">
    <div class="panel-heading">Detail Kelas</div>
	  <div class="panel-body">
		<?php echo $this->table->generate();?>
	  </div>
	</div>
    <div class="row">
        <div class="col-md-8 col-sm-6">

            <?php
                echo form_open();
                echo form_submit(['name' => 'btnRevisi','value' => 'Revisi' , 'class'=>'btn btn-primary btn-sm','id'=>'btnRevisi']);
            ?>
            <button id='btnPrint' type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#managePrint">Cetak</button>
            <button id='btnProsentase' type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#managePercentage">Atur Prosentase</button>
            <button id='btnGrade' type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#manageGrade">Grade</button>
            <?php
                echo form_close();
            ?>


        </div>
        <div class="col-md-4 col-sm-6 text-right">
            <div class="btn-group" role="group" aria-label="...">
                <button id="btnEditUTS" type='button' class="btn btn-default btn-sm">Enable Edit UTS</button>
                <button id="btnEditTugas" type='button' class="btn btn-default btn-sm">Enable Edit Tugas</button>
                <button id="btnEditUAS" type='button' class="btn btn-default btn-sm">Enable Edit UAS</button>
            </div>

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
                <th>UTS (<?php echo $class[13];?>%)</th>
                <th >Tugas (<?php echo $class[15];?>%)</th>
                <th >UAS (<?php echo $class[14];?>%)</th>
                <th >NA</th>
                <th >NA+</th>
                <th >Grade</th>
                <th>Pengaturan</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="10">
                    <div class="text-right">
                        <button id="btnSaveAll" type='button' class="btn btn-primary btn-sm" disabled="">Save All</button>
                        <button id="btnCancelAll" type='button' class="btn btn-default btn-sm" disabled="">Cancel</button>
                    </div>
                </td>
            </tr>
            </tfoot>
            </table>
        </div>
    </div>
    </br>


    <div class="row">
        <div class=" col-md-4 col-sm-4 col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">Summary Kelas</div>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-right">A</th>
                        <td class="percentA text-right">0%</td>
                    </tr>
                    <tr>
                        <th class="text-right">B</th>
                        <td class="percentB text-right">0%</td>
                    </tr>
                    <tr>
                        <th class="text-right">C</th>
                        <td class="percentC text-right">0%</td>
                    </tr>
                    <tr>
                        <th class="text-right">D</th>
                        <td class="percentD text-right">0%</td>
                    </tr>
                    <tr>
                        <th class="text-right">E</th>
                        <td class="percentE text-right">0%</td>
                    </tr>
                    <tr>
                        <th class="text-right">IP Dosen</th>
                        <td class="ipdosen text-right">0%</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12">
            <?php if($class[19] != ""){ ?>
            <div class="row">
                <div class="col-md-12">
                <strong>Komentar Kajur: </strong>
                <div class="well"><?php echo $class[19];?></div>
                </div>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12 text-right">
                    <?php echo form_open();?>
                    <?php echo form_submit(['id'=>'btnSend','name'=>'btnSend','value'=>'Kirim','class'=>'btn btn-primary']);?>
                     <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
    <?php
    $ctrRevisi = 0;
    if (isset($revisions) && count($revisions) > 0){
        $statusRevisi = ["0" => "<span class='label label-warning'>Menunggu</span>",
            "1" => "<span class='label label-danger'>Ditolak</span>",
            "2" => "<span class='label label-success'>Disetujui</span>"]
        ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="page-header"><h3>Daftar Revisi</h3></div>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php foreach ($revisions as $revision) { $ctrRevisi++;?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="h<?= $revision['id']?>">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#c<?= $revision['id']?>" aria-expanded="true" aria-controls="c<?= $revision['id']?>">
                                        <?php echo $statusRevisi[$revision["status_revisi"]];?> Revisi #<?php echo $revision['id'];?> <small><?= date_format(date_create_from_format('Y-m-d H:i:s',$revision['tanggal_create']),'d M Y'); ?></small>
                                    </a>
                                </h4>
                            </div>
                            <div id="c<?= $revision['id']?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="h<?= $revision['id']?>">
                                <div class="panel-body">
                                    <strong>Catatan Revisi</strong> : <?= $revision["catatan"]?>
                                </div>
                                <table class="table table-bordered">
                                    <thead><tr>
                                        <th>#</th>
                                        <th>NRP</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Nilai Akhir Sebelum</th>
                                        <th>Nilai Akhir Sesudah</th>
                                    </tr></thead>
                                    <tbody>
                                    <?php
                                    $ctrMahasiswa = 1;
                                    foreach ($revision["mahasiswa"] as $student){
                                        echo "<tr>";
                                        echo "<td>".$ctrMahasiswa++."</td>";
                                        echo "<td>".$student['nrp']."</td>";
                                        echo "<td>".$student['nama']."</td>";
                                        echo "<td>".$student['nilai_akhir_sebelum']."</td>";
                                        echo "<td><strong>".$student['nilai_akhir_sesudah']."</strong></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php if ($revision["status_revisi"] == 0){ $revisionExist = true; }?>
                            </div>
                        </div>
                    <?php };?>
                </div>
            </div>
        </div>
    <?php }?>


    </div><!-- End of Container -->
</div>
  <script>

        var table;
        var listGrade = []; // Menyimpan Nilai Sebelum di Edit
        var open = 0; // Untuk Menyimpan Data Ke berapa yang dibuka

        var logGrade = '<?php if($this->session->userdata('logClass') == $classId){ echo $this->session->userdata('logGrade');}?>';
        $(document).ready(function() {
            $('#accordion').collapse();
            $('#accordion .panel-collapse').each(function (index) {
                if (index < <?= $ctrRevisi-1 ?>){
                    $(this).collapse('hide');
                    console.log(index);
                }
            })
            // Method untuk mendisable kan Button Revision jika ada revisi
            <?php if(isset($revisionExist)){ ?>
            $('#btnRevisi').attr('disabled','')
            <?php }?>

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
                        "orderable": false //set not orderable
                    },
                ],
                "createdRow": function ( row, data, index ) {
                    var temp = $(data[8]).html();
                    if (temp.charCodeAt(0) > <?php echo ord($class[18]);?>){
                        $(row).addClass('danger');
                    }

                }

            });

            // Method untuk mengganti button Edit menjadi button Edit All
            statusGrade = <?php echo $class[10];?>;
            if (statusGrade < 3){
                $('#btnRevisi').attr('disabled','');
                $('#table_grade').on('click', '.grade_edit', function(event){
                    // do something
                    event.preventDefault();
                    rowIndex = $(this).attr('data-value');
                    nrpIndex = $(this).attr('data-nrp');
                    arr = [];
                    $('.nilai_'+rowIndex).removeAttr('disabled');
                    $('.nilai_'+rowIndex).each( function(index){
                        arr[index] = $(this).val();
                    });
                    listGrade[open] = arr;
                    $('#btnEditUTS').attr('disabled','');
                    $('#btnEditUAS').attr('disabled','');
                    $('#btnEditTugas').attr('disabled','');
                    $(this).parent().html('<button class="btn btn-primary grade_save btn-sm" data-nrp="'+nrpIndex+'" data-value="'+rowIndex+'">Save</button> <button class="btn btn-default btn-sm grade_cancel" data-value="'+rowIndex+'" data-open="'+(open++)+'">Cancel</button>');
                });
                // Method untuk button Cancel
                $('#table_grade').on('click', '.grade_cancel', function(event){
                    // do something
                    event.preventDefault();
                    rowIndex = $(this).attr('data-value');
                    openIndex= $(this).attr('data-open');
                    nrpIndex = $(this).parent().find('.grade_save').attr('data-nrp');
                    $('.nilai_'+rowIndex).attr('disabled','');
                    $('.nilai_'+rowIndex).each( function(index){
                        $(this).val(listGrade[openIndex][index]);
                    });
                    $('#btnEditUTS').removeAttr('disabled');
                    $('#btnEditUAS').removeAttr('disabled');
                    $('#btnEditTugas').removeAttr('disabled');
                    $(this).parent().html('<button class="btn btn-primary grade_edit btn-sm" data-nrp="'+nrpIndex+'" data-value="'+rowIndex+'">Edit</button>');
                });
                $('#table_grade').on('click','.grade_save', function(event){
                    event.preventDefault();
                    rowIndex = $(this).attr('data-value');
                    midTerm = $('.nilai_'+rowIndex+'.nilai_uts').val();
                    finalTerm = $('.nilai_'+rowIndex+'.nilai_uas').val();
                    homework = $('.nilai_'+rowIndex+'.nilai_tugas').val();
                    nrpStudent = $(this).attr('data-nrp');
                    $.post('<?php echo site_url('grade/saveGrade');?>', {uts:midTerm,uas:finalTerm,tugas:homework,class_id:'<?php echo $class[17];?>', nrp:nrpStudent, log:logGrade}, function(data){
                        logGrade = data;

                        reload_table();
                    });
                    $('#btnEditUTS').removeAttr('disabled');
                    $('#btnEditUAS').removeAttr('disabled');
                    $('#btnEditTugas').removeAttr('disabled');
                    $('.nilai_'+rowIndex).attr('disabled','');
                    $(this).parent().html('<button class="btn btn-primary grade_edit btn-sm"  data-nrp="'+nrpStudent+'" data-value="'+rowIndex+'">Edit</button>');

                });
                $('#btnEditUTS').click(function(event){
                    event.preventDefault();
                    if ($(this).hasClass('active')){
                        $(this).removeClass('active');
                        $(this).html('Enable Edit UTS');
                        $('.nilai_uts').attr('disabled','');
                        if (!$('#btnEditUAS').hasClass('active') && !$('#btnEditTugas').hasClass('active')){
                            $('.grade_edit').removeAttr('disabled');
                            $('#btnSaveAll').attr('disabled','');
                            $('#btnCancelAll').attr('disabled','');
                        }
                    }
                    else {
                        $(this).addClass('active');
                        $(this).html('Disable Edit UTS');
                        $('.nilai_uts').removeAttr('disabled');
                        $('.grade_edit').attr('disabled','');
                        $('#btnSaveAll').removeAttr('disabled');
                        $('#btnCancelAll').removeAttr('disabled');
                    }

                });
                $('#btnEditUAS').click(function(event){
                    event.preventDefault();
                    if ($(this).hasClass('active')){
                        $(this).removeClass('active');
                        $(this).html('Enable Edit UAS');
                        $('.nilai_uas').attr('disabled','');
                        if (!$('#btnEditUTS').hasClass('active') && !$('#btnEditTugas').hasClass('active')){
                            $('.grade_edit').removeAttr('disabled');
                            $('#btnSaveAll').attr('disabled','');
                            $('#btnCancelAll').attr('disabled','');
                        }
                    }
                    else {
                        $(this).addClass('active');
                        $(this).html('Disable Edit UAS');
                        $('.nilai_uas').removeAttr('disabled');
                        $('.grade_edit').attr('disabled','');
                        $('#btnSaveAll').removeAttr('disabled');
                        $('#btnCancelAll').removeAttr('disabled');
                    }
                });
                $('#btnEditTugas').click(function(event){
                    event.preventDefault();
                    if ($(this).hasClass('active')){
                        $(this).removeClass('active');
                        $(this).html('Enable Edit Tugas');
                        $('.nilai_tugas').attr('disabled','');
                        if (!$('#btnEditUTS').hasClass('active') && !$('#btnEditUAS').hasClass('active')){
                            $('.grade_edit').removeAttr('disabled');
                            $('#btnSaveAll').attr('disabled','');
                            $('#btnCancelAll').attr('disabled','');
                        }
                    }
                    else {
                        $(this).addClass('active');
                        $(this).html('Disable Edit Tugas');
                        $('.nilai_tugas').removeAttr('disabled');
                        $('.grade_edit').attr('disabled','');
                        $('#btnSaveAll').removeAttr('disabled');
                        $('#btnCancelAll').removeAttr('disabled');
                    }
                });
                $('#btnSaveAll').click(function(event){
                    event.preventDefault();
                    midTerm = [];
                    finalTerm = [];
                    homework = [];
                    nrpStudent = [];
                    $('.nilai_uts').each(function(index){
                        midTerm.push($(this).val());
                    });
                    $('.nilai_uas').each(function(index){
                        finalTerm.push($(this).val());
                    });
                    $('.nilai_tugas').each(function(index){
                        homework.push($(this).val());
                    });
                    $('.grade_edit').each(function(index){
                        nrpStudent.push($(this).attr('data-nrp'));
                    });
                    $.post('<?php echo site_url('grade/saveAllGrade');?>', {uts:midTerm,uas:finalTerm,tugas:homework,class_id:'<?php echo $class[17];?>', nrp:nrpStudent, log:logGrade}, function(data){
                        logGrade = data;
                        reload_table();
                    });
                    $('.grade_edit').removeAttr('disabled');
                    $('#btnSaveAll').attr('disabled','');
                    $('#btnCancelAll').attr('disabled','');
                    $('.nilai_tugas').attr('disabled','');
                    $('.nilai_uts').attr('disabled','');
                    $('.nilai_uas').attr('disabled','');
                    $('#btnEditUAS').removeClass('active');
                    $('#btnEditUTS').removeClass('active');
                    $('#btnEditTugas').removeClass('active');
                    $('#btnEditUAS').html('Enable Edit UAS');
                    $('#btnEditUTS').html('Enable Edit UTS');
                    $('#btnEditTugas').html('Enable Edit Tugas');
                });
                $('#btnCancelAll').click(function(event) {
                    event.preventDefault();
                    $('.grade_edit').removeAttr('disabled');
                    $('#btnSaveAll').attr('disabled','');
                    $('#btnCancelAll').attr('disabled','');
                    $('.nilai_tugas').attr('disabled','');
                    $('.nilai_uts').attr('disabled','');
                    $('.nilai_uas').attr('disabled','');
                    $('#btnEditUAS').removeClass('active');
                    $('#btnEditUTS').removeClass('active');
                    $('#btnEditTugas').removeClass('active');
                    $('#btnEditUAS').html('Enable Edit UAS');
                    $('#btnEditUTS').html('Enable Edit UTS');
                    $('#btnEditTugas').html('Enable Edit Tugas');
                });
            }
            else {
                $('#btnProsentase').remove();
                $('#btnGrade').remove();
                $('#btnEditUTS').remove();
                $('#btnEditUAS').remove();
                $('#btnEditTugas').remove();
                $('#btnSaveAll').remove();
                $('#btnCancelAll').remove();
                $('#btnSend').remove();

                // Menghilangkan
                table.on('draw.dt', function (e) {
                    e.preventDefault()
                    $('.grade_edit').attr('disabled','');
                });
            }
            $.post('<?php echo site_url('grade/ajax_percentage/'.$classId);?>', function (data){
                arrPercent = data.split(" ");
                $('.percentA').html(arrPercent[0]+"%");
                $('.percentB').html(arrPercent[1]+"%");
                $('.percentC').html(arrPercent[2]+"%");
                $('.percentD').html(arrPercent[3]+"%");
                $('.percentE').html(arrPercent[4]+"%");
                $('.ipdosen').html(arrPercent[5])
            });


        });
        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax
            $.post('<?php echo site_url('grade/ajax_percentage/'.$classId);?>', function (data){
                arrPercent = data.split(" ");
                $('.percentA').html(arrPercent[0]+"%");
                $('.percentB').html(arrPercent[1]+"%");
                $('.percentC').html(arrPercent[2]+"%");
                $('.percentD').html(arrPercent[3]+"%");
                $('.percentE').html(arrPercent[4]+"%");
                $('.ipdosen').html(arrPercent[5]);
            });
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
        <h4 class="modal-title" id="manageGradeLabel">Atur Prosentase</h4>
      </div>
      <div class="modal-body">
			
			<?php 
			echo form_label('Prosentase UTS','inputUTS');
			$data = [ 'name' => 'inputUTS','value' => $class[13],'class' => "form-control",'id' => 'inputUTS','type'=>'number','min'=>0, 'max' => 100];
			echo form_input($data);

			echo form_label('Prosentase Tugas','inputHomework');
			$data = [ 'name' => 'inputHomework','value' => $class[15],'class' => "form-control",'id' => 'inputHomework','type'=>'number','min'=>0, 'max' => 100];
			echo form_input($data);

            echo form_label('Prosentase UAS','inputUAS');
            $data = [ 'name' => 'inputUAS','value' => $class[14],'class' => "form-control",'id' => 'inputUAS','type'=>'number','min'=>0, 'max' => 100];
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


<!-- Manage Cetak Print -->
<div class="modal fade" id="managePrint" tabindex="-1" role="dialog" aria-labelledby="managePrint">
    <div class="modal-dialog modal-sm"" role="document">
    <div class="modal-content">
        <?php echo form_open('grade/printPdf/'.$classId);?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="managePrint">Atur Cetak</h4>
        </div>
        <div class="modal-body">

         <?php
                echo form_checkbox('uts','uts',true). ' UTS <br>';
                echo form_checkbox('uas','uas',true).' UAS <br>';
                echo form_checkbox('tugas','tugas',true).' Tugas <br>';
                echo form_checkbox('nilai_akhir','nilai_akhir',true).' Nilai Akhir <br>';
                echo form_checkbox('nilai_akhir_grade','nilai_akhir_grade',true).' Nilai Akhir Setelah Grade <br>';
                echo form_checkbox('nilai_grade','nilai_grade',true).' Nilai Grade <br>';
            ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <?php echo form_submit('btnCetak','Cetak','class="btn btn-primary"');?>
        </div>
        <?php echo form_close();?>
    </div>
</div>
</div>