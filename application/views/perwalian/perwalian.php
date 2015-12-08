<?php echo form_open('perwalian/mahasiswa');?>
<!--CONTENT-->
	
	<h2 class="text-center"><?php echo $nowSemester;?></h2>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Form Konfirmasi Perwalian</div>
					<div class="panel-body">
						<?php
						echo '<div class="table-responsive">';
						echo '<table class="table" id="info">';
						echo '<tbody><tr><td class="span5">Nama:</td><td>' . $mahasiswa->nama . '</td></tr>';
						echo '<tr><td class="col-md-2">NRP:</td><td>' . $mahasiswa->nrp . '</td></tr>';
						echo '<tr><td class="col-md-2">Semester:</td><td>' . $smtr . '</td></tr>';
						echo '<tr><td class="col-md-2">IP semester lalu:</td><td>' . '' . '</td></tr>';
						echo '<tr><td class="col-md-2">IPK:</td><td>' . $mahasiswa->ipk . '</td></tr>';
						echo '<tr><td class="col-md-2">Total SKS:</td><td>' . $mahasiswa->sks . '</td></tr>';
						echo '</table></div>';
						?>
					</div>
					<!--GARIS PENUTUP HEADER-->
					<hr class="endHeaderTable"></hr>
					
					<?php 
					if($this->session->flashdata('error')){
					?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
						</button>
						<?php echo $this->session->flashdata('error');?>
					</div>					
					<?php
					}
					
					for($i=0;$i<count($table);$i+=2){
						echo '
						<div class="col-sm-12" style="background:white">
							<div class="col-sm-6" style="background:transparent">
								<div class="panel panel-default">
							  <!-- Default panel contents -->
									<div class="panel-heading">Semester ' . $dataCombobox[$i] . '</div>
									<div class="panel-body" id="courseTable">
										'. $table[$i] .'
									</div>
								</div>
							</div>';
						if($i+1 < count($table)){
							echo '
								<div class="col-sm-6" style="background:transparent">
									<div class="panel panel-default">
								  <!-- Default panel contents -->
										<div class="panel-heading">Semester '. $dataCombobox[$i+1] . '</div>
										<div class="panel-body" id="courseTable">
											'. $table[$i+1] .'
										</div>
									</div>
								</div>
							';
						}
						echo '</div>';
					}
					?>
					
					<!--KONFIRMASI-->
					<div id="konfirmasi" >
						<pre class="bg-info">
							<?php $sumSKS = 0;
								if($this->session->userdata('countSKS'))$sumSKS = $this->session->userdata('countSKS');
							?>
							<p class="pull-right"><b>Jumlah Beban SKS yang akan diambil : <b id="totalSKS"><?php echo $sumSKS; ?></b></b></p>
							
							<?php $stylebutton=array('class'=>'btn btn-primary ','name'=>'submit','value'=>'Konfirmasi'); ?>
							<div class="pull-right"><?php echo form_submit($stylebutton);?></div>
						</pre>
					</div>
					<!--LEGEND-->
					<div class="panel-footer">
						<div class="row" style="padding-left:20px">
							<legend>Legend: </legend>
							<div class="col-xs-12"><pre class="bg-active mylegend"></pre><label> = Matakuliah telah lulus atau Belum menyelesaikan syarat pengambilan</label></div>
							<div class="col-xs-12"><pre class="bg-info mylegend"></pre><label> = Matakuliah bisa diambil</label></div>
							<div class="col-xs-12"><label><b>Untuk tulisan bercetak tebal merupakan matakuliah berpraktikum</b></label></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	$(document).on("click",'.checkbox',function(){
		var val = $("#totalSKS").text();
		var id=this.value;
		var target= this;
		var check = 'false';
		if(this.checked){
			check='true';
		}
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>" + "perwalian/getTotalSks",
			dataType: 'json',
			data: {name:id,status:check,countSKS:val},
			success: function(msg)
			{
				//alert('here');
				if(msg == "1"){
					target.checked = false;	
					alert('Anda tidak bisa mengambil matakuliah ini dikarenakan jadwal kuliah bentrok');
				}else{
					if(target.checked){
						if(val<= 22){
							val = (+val) + (+msg);
							$('#totalSKS').text(val);
						}
					}else{
						val = (+val) - (+msg);
						$('#totalSKS').text(val);
					}
				}
			}
		})
		if(val>23){
			alert('Total SKS anda berlebihan');
			this.checked = false;
		}
	});
	$("a.hovertabel").on("mouseover", function () {
		$('[data-toggle="popover"]').popover();
	});
	
	$(document).ready(function(){
	});
</script>
<?php echo form_close(); ?>