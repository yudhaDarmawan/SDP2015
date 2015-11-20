<?php echo form_open('perwalian/frs');?>
<!--CONTENT-->
	
	<h2 class="text-center">Tahun Ajaran 2015/2016</h2>
	<div class="container">
		<div class="row">
			<div class="span6 offset6 col-md-12">
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
						<!--SEMESTER 1-->
						<div class="col-sm-6" style="background:transparent">
							<div class="panel panel-default">
						  <!-- Default panel contents -->
							  <div class="panel-heading">Semester 1</div>
								<?php echo $semester1;?>
							  <!-- Table -->
							  <table class="table table-striped">
								<tr>
									<th>Kode Matkul</th>
									<th>Nama Matkul</th>
									<th>Hari</th>
									<th>Jam</th>
									<th>SKS</th>
									<th>Grade</th>
									<th>Ambil</th>
								</tr>
								<tr class ="success">
									<td>F101</td>
									<td>Intro To Programming</td>
									<td>Senin</td>
									<td>08.00-10.30</td>
									<td>3</td>
									<td>A</td>
									<td><center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F102</td>
									<td>Bahasa Indonesia</td>
									<td>Kamis</td>
									<td>08.00-10.30</td>
									<td>3</td>
									<td>A</td>
									<td><center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F103</td>
									<td>Algoritma dan Pemrograman 1</td>
									<td>Selasa</td>
									<td>13.00-15.30</td>
									<td>3</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="danger">
									<td>F111</td>
									<td>Internet and World Wide Web</td>
									<td>Jumat</td>
									<td>08.00-10.30</td>
									<td>3</td>
									<td>D</td>
									<?php $checkbox = array('class'=>'checkbox','value'=>'Internet World Web','name'=>'cbx');?>
									<td><center><?php echo form_checkbox($checkbox); ?></center></td>
								</tr>
								<tr class="success">
									<td>F112</td>
									<td>Agama</td>
									<td>Jumat</td>
									<td>15.30-18.00</td>
									<td>3</td>
									<td>B</td>
									<?php $checkbox = array('class'=>'checkbox','value'=>'Agama','name'=>'cbx');?>
									<td><center><?php echo form_checkbox($checkbox); ?></center></td>
								</tr>
								<tr class ="success">
									<td>F113</td>
									<td>Pengantar Teknologi Informasi</td>
									<td>Kamis</td>
									<td>10.30-13.00</td>
									<td>3</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
							  </table>
							</div>
						</div>
						<!-- semester 1-->
						
						<!--SEMESTER 2-->
						<div class="col-sm-6" style="background:transparent">
							<div class="panel panel-default">
							  <div class="panel-heading">Semester 2</div>

							  <!-- Table -->
							  <table class="table table-striped">
								<tr >
									<th>Kode Matkul</th>
									<th>Nama Matkul</th>
									<th>Hari</th>
									<th>Jam</th>
									<th>SKS</th>
									<th>Grade</th>
									<th>Ambil</th>
								</tr>
								<tr class ="success">
									<td>F201</td>
									<td>Matematika 1</td>
									<td>Selasa</td>
									<td>08.00-10.30</td>
									<td>2</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F202</td>
									<td>Bahasa Inggris</td>
									<td>Senin</td>
									<td>08.00-09.40</td>
									<td>2</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F203</td>
									<td>Basis Data</td>
									<td>Jumat</td>
									<td>08.00-10.30</td>
									<td>3</td>
									<td>B+</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class="danger">
									<td>F211</td>
									<td>Pemrograman Visual</td>
									<td>Rabu</td>
									<td>15.30-18.00</td>
									<td>3</td>
									<td>E</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F231</td>
									<td>Algoritma dan Pemrograman 2</td>
									<td>Kamis</td>
									<td>15.30-18.00</td>
									<td>3</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F211</td>
									<td>Jaringan Komputer</td>
									<td>Selasa</td>
									<td>10.30-13.00</td>
									<td>3</td>
									<td>C+</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class="success">
									<td>F241</td>
									<td>Statistika Terapan</td>
									<td>Senin</td>
									<td>15.30-17.10</td>
									<td>2</td>
									<td>B+</td>
									<?php $checkbox = array('class'=>'checkbox','value'=>'Statistika Terapan','name'=>'cbx');?>
									<td><center><?php echo form_checkbox($checkbox); ?></center></td>
								</tr>
							  </table>
							</div>
						</div>
						<!--Semester 2-->
					</div>
					<!-- SEMESTER 1 SAMPAI 2 -->
					
					
					<!-- SEMESTER 3 SAMPAI 4 -->
					<div class="col-sm-12" style="background:white">
						
						<!--SEMESTER 3-->
						<div class="col-sm-6" style="background:transparent">
							<div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-heading">Semester 3</div>

							  <!-- Table -->
							  <table class="table table-striped">
								<tr>
									<th>Kode Matkul</th>
									<th>Nama Matkul</th>
									<th>Hari</th>
									<th>Jam</th>
									<th>SKS</th>
									<th>Grade</th>
									<th>Ambil</th>
								</tr>
								<tr class="success">
									<td>F301</td>
									<td>Struktur Data</td>
									<td>Senin</td>
									<td>13.00-15.30</td>
									<td>3</td>
									<td>C+</td>
									<?php $checkbox = array('class'=>'checkbox','value'=>'Struktur Data','name'=>'cbx');?>
									<td><center><?php echo form_checkbox($checkbox); ?></center></td>
								</tr>
								<tr class ="success">
									<td>F302</td>
									<td>Logika Matematika</td>
									<td>Selasa</td>
									<td>08.50-10.30</td>
									<td>2</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F311</td>
									<td>Analisa dan Desain Sistem</td>
									<td>Selasa</td>
									<td>13.00-15.30</td>
									<td>3</td>
									<td>A</td>
									<td><center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class="danger">
									<td>F321</td>
									<td>Pengembangan Aplikasi Internet</td>
									<td>Rabu</td>
									<td>10.30-13.00</td>
									<td>3</td>
									<td>D</td>
									<?php $checkbox = array('class'=>'checkbox','value'=>'Pengembangan Aplikasi Internet','name'=>'cbx');?>
									<td><center><?php echo form_checkbox($checkbox); ?></center></td>
								</tr>
								<tr class="success">
									<td>F322</td>
									<td>Matematika 2</td>
									<td>Jumat</td>
									<td>13.50-15.30</td>
									<td>2</td>
									<td>B</td>
									<?php $checkbox = array('class'=>'checkbox','value'=>'Matematika','name'=>'cbx');?>
									<td><center><?php echo form_checkbox($checkbox); ?></center></td>
								</tr>
								<tr class ="success">
									<td>F330</td>
									<td>Pemrograman Berorientasi Objek</td>
									<td>Kamis</td>
									<td>15.30-18.00</td>
									<td>3</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F351</td>
									<td>Teori Graf</td>
									<td>Jumat</td>
									<td>13.00-14.40</td>
									<td>2</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
							  </table>
							</div>
						</div>
						<!--Semester 3-->
						
						<!-- SEMESTER 4-->
						<div class="col-sm-6" style="background:transparent">
							<div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-heading">Semester 4</div>

							  <!-- Table -->
							  <table class="table table-striped">
								<tr>
									<th>Kode Matkul</th>
									<th>Nama Matkul</th>
									<th>Hari</th>
									<th>Jam</th>
									<th>SKS</th>
									<th>Grade</th>
									<th>Ambil</th>
								</tr>
								<tr class ="success">
									<td>F401</td>
									<td>Pengolahan Citra Digital</td>
									<td>Rabu</td>
									<td>08.00-10.30</td>
									<td>3</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F402</td>
									<td>Pemrograman Client Server</td>
									<td>Senin</td>
									<td>08.00-10.30</td>
									<td>3</td>
									<td>C</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F410</td>
									<td>Rangkaian Digital</td>
									<td>Jumat</td>
									<td>08.00-10.30</td>
									<td>3</td>
									<td>B+</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F413</td>
									<td>Analisa Desain Berorientasi Objek</td>
									<td>Rabu</td>
									<td>15.30-18.00</td>
									<td>3</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F441</td>
									<td>Pendidikan Kewarganegaraan</td>
									<td>Jumat</td>
									<td>15.30-18.00</td>
									<td>3</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr class ="success">
									<td>F433</td>
									<td>Struktur Data Lanjut</td>
									<td>Selasa</td>
									<td>10.30-13.00</td>
									<td>3</td>
									<td>B+</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								
							  </table>
							</div>
						</div>
						<!-- SEMESTER 4-->
					</div>
					<!-- SEMESTER 3 SAMPAI 4 -->
					
					
					<!-- SEMESTER 5 SAMPAI 6 -->
					<div class="col-sm-12" style="background:white">
						
						<!--SEMESTER 5-->
						<div class="col-sm-6" style="background:transparent">
							<div class="panel panel-default">
								  <!-- Default panel contents -->
								  <div class="panel-heading">Semester 5</div>

								  <!-- Table -->
								  <table class="table table-striped">
									<tr>
										<th>Kode Matkul</th>
										<th>Nama Matkul</th>
										<th>Hari</th>
										<th>Jam</th>
										<th>SKS</th>
										<th>Grade</th>
										<th>Ambil</th>
									</tr>
									<tr >
										<td>F501</td>
										<td>Kewirausahaan</td>
										<td>Senin</td>
										<td>08.00-09.40</td>
										<td>2</td>
										<td></td>
										<?php $checkbox = array('class'=>'checkbox','value'=>'Kewirausahaan','name'=>'cbx');?>
										<td><center><?php echo form_checkbox($checkbox); ?></center></td>
									</tr>
									<tr class ="success">
										<td>F502</td>
										<td>Kecerdasan Buatan</td>
										<td>Senin</td>
										<td>10.30-13.00</td>
										<td>3</td>
										<td>A</td>
										<td>  <center><input type="checkbox" hidden></center></td>
									</tr>
									<tr >
										<td>F503</td>
										<td>Sistem Operasi</td>
										<td>Selasa</td>
										<td>10.30-13.00</td>
										<td>3</td>
										<td></td>
										<?php $checkbox = array('class'=>'checkbox','value'=>'Sistem Operasi','name'=>'cbx');?>
										<td><center><?php echo form_checkbox($checkbox); ?></center></td>
									</tr>
									<tr >
										<td>F504</td>
										<td>Interaksi Manusia dan Komputer</td>
										<td>Selasa</td>
										<td>15.30-18.00</td>
										<td>3</td>
										<td></td>
										<?php $checkbox = array('class'=>'checkbox','value'=>'Interaksi Manusia dan Komputer','name'=>'cbx');?>
										<td><center><?php echo form_checkbox($checkbox); ?></center></td>
									</tr>
									<tr >
										<td>F505</td>
										<td>Organisasi Komputer</td>
										<td>Rabu</td>
										<td>08.00-10.30</td>
										<td>3</td>
										<td></td>
										<?php $checkbox = array('class'=>'checkbox','value'=>'organisasi Komputer','name'=>'cbx');?>
										<td><center><?php echo form_checkbox($checkbox); ?></center></td>
									</tr>
									<tr class="success">
										<td>F521</td>
										<td>Grafika Komputer</td>
										<td>Jumat</td>
										<td>08.00-10.30</td>
										<td>3</td>
										<td>C</td>
										<?php $checkbox = array('class'=>'checkbox','value'=>'Grafika Komputer','name'=>'cbx');?>
										<td><center><?php echo form_checkbox($checkbox); ?></center></td>
									</tr>
									
								</table>
							</div>
						</div>
						<!--Semester 5-->
						
						
						<!-- SEMESTER 6 -->
						<div class="col-sm-6" style="background:transparent">
							<div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-heading">Semester 6</div>

							  <!-- Table -->
							  <table class="table table-striped">
								<tr>
									<th>Kode Matkul</th>
									<th>Nama Matkul</th>
									<th>Hari</th>
									<th>Jam</th>
									<th>SKS</th>
									<th>Grade</th>
									<th>Ambil</th>
								</tr>
								<tr class ="success">
									<td>F601</td>
									<td>Etika Profesi</td>
									<td>Senin</td>
									<td>08.00-09.40</td>
									<td>2</td>
									<td>A</td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr>
									<td>F602</td>
									<td>Multimedia Interaktif</td>
									<td>Senin</td>
									<td>15.30-18.00</td>
									<td>3</td>
									<td></td>
									<?php $checkbox = array('class'=>'checkbox','value'=>'Multimedia Interaktif','name'=>'cbx');?>
									<td><center><?php echo form_checkbox($checkbox); ?></center></td>
								</tr class ="success">
								<tr>
									<td>F621</td>
									<td>Kerja Praktek</td>
									<td>Rabu</td>
									<td>08.00-09.40</td>
									<td>2</td>
									<td></td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr>
									<td>F622</td>
									<td>Rekayasa Perangkat Lunak</td>
									<td>Kamis</td>
									<td>08.00-10.30</td>
									<td>3</td>
									<td></td>
									<?php $checkbox = array('class'=>'checkbox','value'=>'Rekayasa Perangkat Lunak','name'=>'cbx');?>
									<td><center><?php echo form_checkbox($checkbox); ?></center></td>
								</tr class ="success">
								<tr>
									<td>F631</td>
									<td>Software Development Project</td>
									<td>Selasa</td>
									<td>13.00-15.30</td>
									<td>3</td>
									<td></td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								<tr>
									<td>F632</td>
									<td>Embedded Systems</td>
									<td>Selasa</td>
									<td>10.30-13.00</td>
									<td>3</td>
									<td></td>
									<td>  <center><input type="checkbox" hidden></center></td>
								</tr>
								
							  </table>
							</div>
						</div>
						<!-- SEMESTER 6 -->
					
					</div>
					
					<!-- SEMESTER 5 SAMPAI 6 -->
					
					
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