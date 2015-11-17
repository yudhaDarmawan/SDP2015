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
            <th >UAS</th>
            <th >Tugas</th>
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
        <div class="col-md-8">
            <button id='btnCetak' type='button' class='btn btn-primary'>Cetak</button>
            
			<button id='btnTidakSetuju' type='button' class='btn btn-primary'>Tidak Setuju</button>
            
			<button id='btnKonfirmasi' type='button' class='btn btn-primary'>Konfirmasi</button>
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

            });
        });
        function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax
        }
    </script>
