<div class="container">
    <h1>List Mata Kuliah yang Diajar</h1>
	<?php echo 'Tahun Ajaran : '.form_dropdown('ddYear',$ddYear, $selectedDdYear,"id='ddYear'")."<br/>";?>
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th width="70">Kode MK</th>
          <th>Nama MK</th>
            <th width="20">SKS</th>
          <th width="30">Kelas</th>
          <th>Hari, Jam</th>
          <th>Ruangan</th>
          <th>Status</th>
          <th>Pengaturan</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <script type="text/javascript">

    var table;
    $(document).ready(function() {
      table = $('#table').DataTable({ 
		
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "paging":   false,
		"bFilter": false,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('grade/ajax_class/')?>"+"/"+$("#ddYear").val(),
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
	   $("#ddYear").change(function () {
			var end = this.value;
			reload_table();
		});
    });
    $.get( "<?php echo site_url('grade/ajax_totalSKS/')?>"+"/"+$("#ddYear").val(), function( data ) {
        $( "#table_wrapper > .row:last-child .col-sm-7" ).html('<div class="dataTables_info text-right">Total Beban SKS : '+data+' SKS</div>' );
    });
    function reload_table()
    {
		table.ajax.url("<?php echo site_url('grade/ajax_class/')?>"+"/"+$("#ddYear").val());
		table.ajax.reload(null,false); //reload datatable ajax
		$.get( "<?php echo site_url('grade/ajax_totalSKS/')?>"+"/"+$("#ddYear").val(), function( data ) {
            $( "#table_wrapper > .row:last-child .col-sm-7 .dataTables_info ").html('Total Beban SKS : '+data +' SKS');
        });
    }
  </script>
