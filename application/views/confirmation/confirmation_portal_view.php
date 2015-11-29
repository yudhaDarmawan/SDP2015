<?php
/* -----------------------------------------------------
Nama   				: confirmation_portal_view.php
Pembuat 			: Nancy Yonata
Tanggal Pembuatan 	: 16 November 2015
Edit 				: 27 November 2015

Version Control		:
v0.1 - 7 Januari 2015
	
----------------------------------------------------- */
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class='row'>
                <div class="col-md-12">
                    <?php if($this->session->flashdata('alert')){
                        echo '<div class="alert alert-'.$this->session->flashdata('alert_level').'" role="alert">'.$this->session->flashdata('alert').'</div>';
                    }?>
                    <div class="page-header"><h1>Konfirmasi Nilai Kelas</h1></div>
                    <?php echo 'Tahun Ajaran : '.form_dropdown('ddYear',$ddYear, $selectedDdYear,"id='ddYear'")."<br/><br/>";?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                         <th>Nama MK</th>
                         <th>Dosen</th>
                          <th width="20">SKS</th>


                          <th>Hari, Jam</th>
                          <th>Ruang</th>
                          <th>Status</th>
                          <th>Terakhir Update</th>
                          <th>Pengaturan</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

	<script type="text/javascript">
		var table;
		$(document).ready(function() {
		  table = $('#table').DataTable({ 
			
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"bFilter": false,
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('confirmation/ajax_class/')?>"+"/"+$("#ddYear").val(),
				"type": "POST"
			},

			//Set column definition initialisation properties.
			"columnDefs": [
			{ 
			  "targets": [-1], //last column
			  "orderable": false //set not orderable
			},
			]
		  });
		  $('#ddYear').on('change',function (){
				var end = this.value;
				reload_table();
		  });
		});
		 function reload_table()
		{
		table.ajax.url("<?php echo site_url('confirmation/ajax_class/')?>"+"/"+$("#ddYear").val());
		table.ajax.reload(null,false); //reload datatable ajax
    }
	</script>
	
	
  
