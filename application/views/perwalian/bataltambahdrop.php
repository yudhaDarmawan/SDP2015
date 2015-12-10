<!--
Nama File			: bataltambahdrop.php
Nama program		: View Master Batal Tambah Drop
Kelompok			: Perwalian
Nama Penulis		: Ivander Wilson S. / 213116230
Input				:
Output				:
Tujuan				:
Tanggal Buat		: 06 November 2015
Versi				: 1.0
Deskripsi Program 	: 
	View yang dibuat disini merupakan tampilan dari Master Batal Tambah dan Drop. Tampilan ini 
meliputi 3 form yaitu form Konfirmasi (yang paling atas), Form Batal, dan Form Tambah. Ketiga Form ini
Saling berkaitan. Form Batal, fungsinya untuk mengganti field status_ambil dari Table kelas_mahasiswa
menjadi 'Batal'. Sedangkan Form Tambah, fungsinya untuk menambah data pada table status_ambil dengan status 'Tambah'. Sedangkan Form Konfirmasi, fungsinya untuk mengirim informasi kepada Dosen Wali Mahasiswa yang bersangkutan.
-->
<!--CONTENT-->
	<div class="container">
		<div class="row">
			<div class="span6 offset6">
				<ul class="nav nav-tabs" role="tablist">
					<li class="active"><a data-toggle="tab" href="#bataltambah">Batal Tambah</a></li>
					<li class=""><a data-toggle="tab" href="#drop">Drop</a></li>
				</ul>
				<div class="tab-content">
					<!--Header Informasi Mahasiswa-->
					<div class = "col-sm-12">
						<div class= "panel panel-primary">
							<div class="panel-heading">Biodata Mahasiswa</div>
							<div class="panel panel-body" style="font-size:16px;">
							Nama Mahasiswa : <?= $data_mahasiswa["nama"];?>	<br>
							NRP Mahasiswa : <?= $data_mahasiswa["nrp"];?>	<br>
							Total SKS : <?= $data_mahasiswa["sks"];?><br>
							IPK : <?= $data_mahasiswa["ipk"];?><br>
							Semester : <?= $data_mahasiswa["semester"];?><br>
							Jurusan : <?= $data_mahasiswa["informasi_kurikulum_mahasiswa"]["jurusan"];?><br>
							</div>
						</div>
					</div>
					
					<div role="tabpanel" class="tab-pane fade in active" id="bataltambah">
						<!--Mata Kuliah Yang Diambil MHS-->
						
						<div class = "col-sm-12">
						
						<?php
						$attr = array('class' => 'panel panel-primary');
						echo form_open('bataltambah',$attr);
						echo "<div class='panel-heading '>Mata Kuliah Yang Diambil Mahasiswa</div>";
						echo "<div class='panel-body'>";
						$templateTable = array(
						  'table_open' => '<table border="1" cellpadding="4" cellspacing="0" class="table table-striped">'
						);
						$this->table->set_template($templateTable);
						$this->table->set_heading('Kode Matkul', 'Nama Matkul', 'Jumlah SKS');
						//echo $dataTable2;
						//Pecah String
						$splitData1 = explode('_',$dataTable2);
						$data = [];
						for($i = 0 ; $i < count($splitData1)-1 ;$i++){
						$splitData2 = explode('|',$splitData1[$i]);
							//Ini Id Matkul
							$cell_1 = array('data' => $splitData2[0], 'style' => "background-color: $splitData2[3]");
							//Ini Nama Matkul
							$cell_2 = array('data' => $splitData2[1], 'style' => "background-color: $splitData2[3]");
							//Ini Jumlah SKSnya
							$cell_3 = array('data' => $splitData2[2], 'style' => "background-color: $splitData2[3]");
							array_push($data, array($cell_1,$cell_2,$cell_3));
						}
						//Cetak Data ke Table
						echo $this->table->generate($data);
						echo "<p style='font-size:16px;'>Jumlah SKS yang diambil 	: 
						".$jumlah_sks_baru."
						</p>";
						//echo $this->table->generate($dataTable); //Ambil dari Data Table hasil query
						$attrTombol = "class='btn btn-primary pull-right' id='tombolKonfirmasi'";
						//echo form_hidden('tampungArrayTable', $dataTable);
						echo "<div class='col-md-0 pull-right'>".form_submit('btnKonfirmasi','Konfirmasi', $attrTombol)."</div>";
						echo "<div class='col-md-1 pull-right'>".form_submit('btnClear','Clear', $attrTombol)."</div>";
						echo "</div>";
						echo form_close();
						?>
						</div>
						<!--END-->
						<div class="col-sm-6">
							<?php 
							$attr = array('class' => 'panel panel-danger');
							echo form_open('bataltambah',$attr);
							echo "<div class='panel-heading '>Form Batal Mata Kuliah</div>";
							echo "<div class='panel-body'>";
							echo "
							<div class='form-group'>
										<label class='col-xs-3 control-label'>Mata Kuliah</label>
										<div class='col-xs-8 selectContainer'>
											";
							$attr = "class='form-control'";
							echo form_dropdown('makul',$dataComboBox,'null',$attr);
							$attrTombol = "class='btn btn-primary pull-right' id='tombolBatal'";
							echo "<div id='konfirmasi' class='col-sm-12' style='background:white;padding-top:10px;'>";
							echo form_submit('btnSubmitBatal','Batal',$attrTombol);
							echo "</div>";
							echo "
										</div>
									</div>
							";
							
							echo "</div>";
							echo form_close();
							?>
							<!--Edit Sampai Disini-->
						</div>
						<!--TAMBAH-->
						<div class="col-sm-6">
							<?php 
							$attr = array('class' => 'panel panel-primary');
							echo form_open('bataltambah',$attr);
							echo "<div class='panel-heading '>Form Tambah Mata Kuliah</div>";
							echo "<div class='panel-body'>";
							echo "
							<div class='form-group'>
										<label class='col-xs-3 control-label'>Mata Kuliah</label>
										<div class='col-xs-8 selectContainer'>
											";
							/*$options = array(
											'null' => 'Pilih Mata Kuliah',
											'itp' => 'Intro to Programming'
											);*/
							$attr = "class='form-control'";
							echo form_dropdown('makul',$dataComboBoxTambah,'null',$attr);
							$attrTombol = "class='btn btn-primary pull-right' id='tombolTambah'";
							echo "<div id='konfirmasi' class='col-sm-12' style='background:white;padding-top:10px;'>";
							echo form_submit('btnSubmitTambah','Tambah',$attrTombol);
							echo "</div>";
											/*<select class='form-control' name='matkul'>
												<option value=''>Pilih Mata Kuliah</option>
												<option value='itp'>Intro to Programming</option>
												<option value='green'>Agama</option>
												<option value='red'>Bahasa Indonesia</option>
												<option value='yellow'>Algoritma dan Pemrograman 1</option>
												<option value='white'>Internet World Wide Web</option>
											</select>*/
							echo "
										</div>
									</div>
							";
							echo "</div>";
							echo form_close();
							?>
							
							<!--END TAMBAH	-->
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="drop">
						
						<div class="col-md-10 col-md-offset-1">
						<?php
						$attr = array('class' => 'panel panel-danger');
						echo form_open('bataltambah/drop',$attr);
						echo "<div class='panel-heading '>Mata Kuliah Yang Diambil Mahasiswa</div>";
						echo "<div class='panel-body'>";
						$templateTable = array(
						  'table_open' => '<table border="1" cellpadding="4" cellspacing="0" class="table table-striped">'
						);
						$this->table->set_template($templateTable);
						$this->table->set_heading('Kode Matkul', 'Nama Matkul', 'Jumlah SKS');
						$data = [];
						for($i = 0 ; $i < count($splitData1)-1 ;$i++){
							$splitData2 = explode('|',$splitData1[$i]);
							//print_r($splitData2);
							//Ini Kode Matkul
							//$cell_1 = array('data' => $splitData2[0],'background_color' => $splitData2[3]);
							$cell_1 = array('data' => $splitData2[0], 'style' => "background-color: $splitData2[3]");
							
							//Ini Nama Matkul
							$cell_2 = array('data' => $splitData2[1], 'style' => "background-color: $splitData2[3]");
							//Ini Jumlah SKSnya
							$cell_3 = array('data' => $splitData2[2], 'style' => "background-color: $splitData2[3]");
							array_push($data, array($cell_1,$cell_2,$cell_3));
						}
						//Cetak Data ke Table
						echo $this->table->generate($data);
						$attrTombol = "class='btn btn-danger pull-right'";
						echo form_submit('btnKonfirmasiDrop','Konfirmasi',$attrTombol);
						echo "<div class='col-md-1 pull-right'>".form_submit('btnClear','Clear', $attrTombol)."</div>";
						echo form_close();
						?>
						</div>
						<?php
							//DropDown Drop MAta kuliah
							$attr = array('class' => 'panel panel-danger');
							echo form_open('bataltambah/drop',$attr);
							echo "<div class='panel-heading '>Form Drop Mata Kuliah</div>";
							echo "<div class='panel-body'>";
							echo "
							<div class='form-group'>
										<label class='col-xs-3 control-label'>Mata Kuliah</label>
										<div class='col-xs-8 selectContainer'>
											";
							/*$options = array(
											'null' => 'Pilih Mata Kuliah',
											'itp' => 'Intro to Programming'
											);*/
							//$options += ['asd' => 'ewq'];
							
							$attr = "class='form-control'";
							echo form_dropdown('makul',$dataComboBox,'null',$attr);
							$attrTombol = "class='btn btn-danger pull-right'";
							echo "<div id='konfirmasi' class='col-sm-12' style='background:white;padding-top:10px;'>";
							echo form_submit('btnSubmitDrop','Drop',$attrTombol);
							
							echo "</div>";
											/*<select class='form-control' name='matkul'>
												<option value=''>Pilih Mata Kuliah</option>
												<option value='itp'>Intro to Programming</option>
												<option value='green'>Agama</option>
												<option value='red'>Bahasa Indonesia</option>
												<option value='yellow'>Algoritma dan Pemrograman 1</option>
												<option value='white'>Internet World Wide Web</option>
											</select>*/
							echo "
										</div>
									</div>
							";
							echo "</div>";
							echo form_close();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

