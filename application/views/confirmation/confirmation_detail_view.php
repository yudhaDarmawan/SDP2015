<?php
/* -----------------------------------------------------
Nama   				: confirmation_detail_view.php
Pembuat 			: Nancy Yonata
Tanggal Pembuatan 	: 16 November 2015
Edit 				: 27 November 2015
Version Control		:
v0.1 - 7 Januari 2015
	
----------------------------------------------------- */
?>
<div class="container">
    <?php if($this->session->flashdata('alert')){
        echo '<div class="alert alert-'.$this->session->flashdata('alert_level').'" role="alert">'.$this->session->flashdata('alert').'</div>';
    }?>
    <div class="page-header"><h2><span class="label label-info">Konfirmasi Nilai</span> <?= $class[0] ?> / <?= $class[3]?> <small><?= $class[1] ?></small><h2></div>
	<div class="panel panel-info">
	  <div class="panel-heading">Detail Kelas</div>
	  <div class="panel-body">
		<?php 
			//HASIL LEMPARAN TABEL DARI FUNCTION VIEW DARI CONITROLER CONFIRMATION.PHP DI GENERATE JADI HEADER PAGE
			echo $this->table->generate();
		?>
	  </div>



	</div>
    <div class="row">
        <div class="col-md-12">
            <button id='btnPrint' type='button' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#managePrint">Cetak</button>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">

            <table id="table_score" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>No</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>UTS</th>
            <th >Tugas</th>
			 <th >UAS</th>
            <th >NA</th>
            <th >NA+</th>
            <th >Grade</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
     </div>
    </div>


    <div class="row">
        <div class=" col-md-4 col-sm-4 col-xs-12">
            <div class="panel panel-default">
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
		<?php
            if ($class[10] != 3) {
                echo form_open('confirmation/sendComment');
                echo "Komentar Kajur :";
                echo form_hidden('hidden_classId', $classId);
                echo form_hidden('hidden_tahunAjaran', $tahun_ajaran);
                echo "<div class= 'row'>";
                echo "<div class='col-md-12 text-right'>";

                echo form_textarea([
                    'name' => 'comment_kajur',
                    'class' => 'form-control',
                    'rows' => 2
                ]);
                echo "<br>";
                echo form_submit([
                    'id' => 'btnTidakSetuju',
                    'name' => 'btnTidakSetuju',
                    'class' => 'btn btn-primary'
                ], 'Tidak Setuju');

                echo "&nbsp&nbsp";
                echo form_submit([
                    'id' => 'btnKonfirmasi',
                    'name' => 'btnKonfirmasi',
                    'class' => 'btn btn-primary'
                ], 'Konfirmasi');
                echo "</div>";
                echo "</div>";
                echo form_close();
            }
            else {
                echo "Komentar Kajur :"."<br/>";
                echo "<div class='well'>".$class[19]."</div>";
            }
		?>
        </div>

	</div>

    <?php if (isset($revisions) && count($revisions) > 0){
        $ctrRevisi = 0;
        $statusRevisi = ["0" => "<span class='label label-warning'>Menunggu</span>",
            "1" => "<span class='label label-danger'>Ditolak</span>",
            "2" => "<span class='label label-success'>Disetujui</span>"]
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="page-header"><h2>Daftar Revisi</h2></div>
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
                                <?php if ($revision["status_revisi"] == 0){ $revisionExist = true; ?>
                                    <div class="panel-footer text-right">
                                        <?php
                                        echo form_open();
                                        echo form_hidden('revision_id', $revision['id']);
                                        echo form_submit('btnRejectRevision','Reject Revision','class="btn btn-danger"').' ';
                                        echo form_submit('btnAcceptRevision','Accept Revision','class="btn btn-success"');
                                        echo form_close();
                                        ?>
                                    </div>

                                <?php }?>
                            </div>
                        </div>
                    <?php };?>

                </div>
            </div>
        </div>
    <?php }?>
</div>
</div><!-- End of Container -->
  <script>
		var table;
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

            table = $('#table_score').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "paging":   false,
                "bFilter": false,
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('confirmation/ajax_score/'.$classId)?>",
                    "type": "POST"
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                    {
                        "targets": [ 0], //last column
                        "orderable": false, //set not orderable
                    },
                ],
                "createdRow": function ( row, data, index ) {
                    if (data[8].charCodeAt(0) > <?php echo ord($class[18]);?>) {
                        $(row).addClass('danger');
                    }
                }

            });
            
			$.post('<?php echo site_url('grade/ajax_percentage/'.$classId);?>', function (data){
                arrPercent = data.split(" ");
                $('.percentA').html(arrPercent[0]+"%");
                $('.percentB').html(arrPercent[1]+"%");
                $('.percentC').html(arrPercent[2]+"%");
                $('.percentD').html(arrPercent[3]+"%");
                $('.percentE').html(arrPercent[4]+"%");
            });
			
        });
        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax
        }
    </script>

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