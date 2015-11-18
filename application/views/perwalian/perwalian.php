<?php echo form_open('perwalian/frs');?>
<!--CONTENT-->
	
	<h2 class="text-center">Tahun Ajaran 2015/2016</h2>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10">
				<div class="panel panel-default">
					<div class="panel-heading">Form Konfirmasi Perwalian</div>
					<div class="panel-body">
						<?php
						/*
						<p>
						Nama = Lukas Kristianto<br>
						NRP = 213116241<br>
						Semester = 5<br>
						Ips = 3.5<br>
						Ipk = 3.469<br>
						Total SKS yang telah diambil = 80<br>
						Jumlah SKS Maksimal = 22
						</p>
						*/
						$sql = $this->db->get_where('data_umum',array('index'=>'tahun_ajaran_sekarang'));
						$now = $sql->row();
						$addTahun = 0;
						$tahun = substr($now->value,8,2);
						if(substr($now->value,0,5) == "GASAL"){
							$addTahun = 1;
						}else{
							$addTahun=2;
						}
						$smtr = (($tahun - substr($mahasiswa->nrp,1,2)) * 2) + $addTahun;
						
						echo 'Nama = ' . $mahasiswa->nama . '<br>';
						echo 'Nrp = ' . $mahasiswa->nrp . '<br>';
						echo 'Semester = ' . $smtr . '<br>';
						echo 'IP Semester lalu = ' . '<br>';
						echo 'IPK = ' . $mahasiswa->ipk . '<br>';
						echo 'Total SKS yang sudah diambil = ' . $mahasiswa->sks . '<br>';
						echo 'Jumlah pengambilan SKS maksimal = 22';
						?>
					</div>
					<!--GARIS PENUTUP HEADER-->
					<hr class="endHeaderTable"></hr>
										
					<!-- SEMESTER 1 SAMPAI 2 -->
					<div class="col-sm-12" style="background:white">
						<div class = "col-sm-4 col-sm-offset-4">
							<h3 class="text-center">Pilih Semester</h3>
							<?php $data = array('Semester 1','Semester 2', 'Semester 3', 'Semester 4','Semester 5','Semester 6','Semester 7','Semester 8'); ?>
							<b><?php echo form_dropdown('chooseCourse',$data,$smtr-1,'class="form-control" onChange="message()"'); ?>
						<br></div>
						<div class="col-md-10 col-md-offset-1" style="background:transparent">
							<div class="panel panel-default">
						  <!-- Default panel contents -->
							  <div class="panel-heading">Semester <?php echo $this->input->post('chooseCourse') ?></div>
							  <div class="panel-body">
								<?php echo $semester1;?>
							  </div>
							</div>
						</div>
					</div>
					
					<!--KONFIRMASI-->
					<div id="konfirmasi" >
						<pre class="bg-info">
							<p class="pull-right"><b>Jumlah Beban SKS yang akan diambil : <b id="totalSKS"><?php echo $totalSksAkanDiambil ?></b></b></p>
							<?php $stylebutton=array('class'=>'btn btn-primary ','name'=>'submit','value'=>'Konfirmasi'); ?>
							<?php //echo form_submit($stylebutton);?>
							<div class="pull-right"><?php echo form_submit($stylebutton);?></div>
						</pre>
					</div>
					<!--LEGEND-->
					<div class="panel-footer">
						<div class="row" style="padding-left:20px">
							<legend>Legend: </legend>
							<div class="col-xs-12"><pre class="bg-danger mylegend"></pre><label> = Tidak Lulus</label></div>
							<div class="col-xs-12"><pre class="bg-success mylegend"></pre><label> = Lulus</label></div>
							<div class="col-xs-12"><pre class="mylegend" style="background:white"></pre><label> = Belum Diambil</label></div>
						</div>
						
					</div>
				
				</div>
			</div>
		</div>
	</div>
	<script>
	$(document).ready(function(){
		$(".checkbox").change(function(event) {
			event.preventDefault();
			var val = $("#totalSKS").text();
			var id=this.value;
			if(this.checked) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>" + "perwalian/getTotalSks",
					dataType: 'json',
					data: {name:id},
					success: function(msg)
					{
						if(val<= 22){
							val = (+val) + (+msg);
							$('#totalSKS').text(val);
						}
					}
				})
				if(val>23){
					alert('Total SKS anda berlebihan');
					this.checked = false;
				}
			}else{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>" + "perwalian/getTotalSks",
					dataType: 'json',
					data: {name:id},
					success: function(msg)
					{
						if(val<= 22){
							val = (+val) - (+msg);
							$('#totalSKS').text(val);
						}
					}
				})
			}
		});
	
		 
	   });
		</script>
	
<?php echo form_close(); ?>