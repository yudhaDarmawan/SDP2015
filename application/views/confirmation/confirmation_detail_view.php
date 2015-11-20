<?php
/* -----------------------------------------------------
Nama   				: confirmation_detail_view.php
Pembuat 			: Nancy Yonata
Tanggal Pembuatan 	: 16 November 2015
Version Control		:
v0.1 - 7 Januari 2015
	
----------------------------------------------------- */
?>
	<div class="panel panel-info">
	  <div class="panel-heading"><?php echo $title;?></div>
	  <div class="panel-body">
		<?php 
			//HASIL LEMPARAN TABEL DARI FUNCTION VIEW DARI CONITROLER CONFIRMATION.PHP DI GENERATE JADI HEADER PAGE
			echo $this->table->generate();
		?>
	  </div>
	</div>
    
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
    <div class="col-md-offset-8 col-md-4 col-sm-offset-6 col-sm-6">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                Prosentase A :
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 percentA text-right">0%
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                Prosentase B :
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 percentB text-right">0%
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                Prosentase C :
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 percentC text-right">0%
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                Prosentase D :
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 percentD text-right">0%
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-8 text-right">
                Prosentase E :
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 percentE text-right">0%
            </div>
        </div>
        <div class="row text-right">
            <div class="col-md-12">
                <button id='btnCetak' type='button' class='btn btn-primary'>Cetak</button>

                <button id='btnTidakSetuju' type='button' class='btn btn-primary'>Tidak Setuju</button>

                <button id='btnKonfirmasi' type='button' class='btn btn-primary'>Konfirmasi</button>
            </div>
        </div>
    </div>
</div>

	
	</div><!-- End of Container -->
  <script>

        var table;
        $(document).ready(function() {
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
