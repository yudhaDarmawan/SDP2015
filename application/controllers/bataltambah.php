<!--
Nama File			: bataltambah.php
Nama program		: Controller Master Batal Tambah Drop
Nama Kelompok		: Perwalian
Nama Penulis		: Ivander Wilson S. / 213116230
Input				:
Output				:
Tujuan				:
Tanggal Buat		: 06 November 2015
Versi				: 1.0
Deskripsi Program 	:
-->
<?php
class Bataltambah extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		//Ambil NRP Mahasiswa yang Login.
		$nrp = $this->session->userdata("username");
		//Cek Status Perwalian. Jika sudah perwalian/Batal Tambah Drop, redirect ke Page Message Success
		$cekPerwalian = $this->mahasiswa_model->getStatusPerwalian($nrp)["status_perwalian"];
		
		if($cekPerwalian == 1){
		redirect('bataltambah/success','refresh');
		};
		$dataform = [];
		//$dataform["activeBatalTambah"] = "active";
		//$dataform["activeDrop"] = "";
		/****
		Ambil Data Informasi mahasiswa dari table mahasiswa
		****/
		$dataform["data_mahasiswa"] = $this->mahasiswa_model->getDataMahasiswa($nrp);
		
		//Ambil Jurusan dari table informasi_kurikulum
		$informasi_kurikulum_mahasiswa = $this->informasi_kurikulum_model->getDataKurikulum($dataform["data_mahasiswa"]["informasi_kurikulum_id"]);
		$dataform["data_mahasiswa"]["informasi_kurikulum_mahasiswa"] = $informasi_kurikulum_mahasiswa;
		
		/****
		Ambil Data Untuk pembuatan table view dari Kelas_Mahasiswa
		berdasarkan NRP Mahasiswa yang login
		****/
		//Ambil Data Mata kuliah yang diambil mahasiswa dari kelas_mahasiswa berdasarkan input NRP
		$arrDataTable = $this->kelas_mahasiswa_model->select($nrp);
		$dataform["dataTable"] = $this->createTableBatalTambah($arrDataTable);
		$stringTable = "";
		/****
		Ubah Hasil return dalam bentuk Array ke bentuk String.
		Batasnya '|' (Pipeline) dan '_' (UnderScore)
		Sekalian juga menghitung SKS total
		****/
		foreach($dataform["dataTable"] as $data){
		$stringTable.=$data["data"]."|".$data["nama"]."|".$data["jumlah_sks"]."|".$data["bg_color"]."_";
		}
		$dataform["dataTable2"] = $stringTable; 
		/****
		Cek Apakah Mahasiswa SEDANG melakukan perwalian.
		Jika YA, maka ambil data perwalian dari session yang telah disimpan
		menggantikan data dari Databasenya.
		****/
		if($this->session->userdata('table_session') != ""){
			$stringTable = $this->session->userdata('table_session');
		}
		/****
		Ambil data dari Database untuk Isi dari Combobox. 
		1. Yang pertama adalah data untuk ComboBox FORM BATAL dan FORM DROP. 
		Isinya adalah data yang diambil dari Kelas_Mahasiswa. 
		Valuenya adalah Kode_Matakuliah-Nama_Matakuliah-Jumlah_SKS
		Keynya adalah Kode_Matakuliah
		****/
		$dataform["dataComboBox"] = $this->createComboBoxBatal($nrp);
		/****
		2. Yang kedua adalah data untuk ComboBox FORM TAMBAH.
		Isinya adalah data yang diambil adalah informasi Mata Kuliah dari table Mata_Kuliah 
		dengan Status 1 (Maksudnya Status Mata Kuliahnya sedang dibuka pada semester ini)
		Valuenya adalah Kode_Matakuliah-Nama_Matakuliah-Jumlah_SKS
		Keynya adalah Kode_Matakuliah
		****/
		$dataform["dataComboBoxTambah"] = $this->createComboBoxTambah($nrp);
		/****
		Jika Button Clear ditekan Maka Data perwalian yang sudah diisi oleh Mahasiswa akan
		dikembalikan ke Keadaan sebelum perwalian. Data akan diambil ulang dari Database kelas_mahasiswa
		****/
		if($this->input->post('btnClear') == true){
		$stringTable = "";
		/****
		Hapus Session table_session yang menyimpan data sementara dari perwalian sebelum di konfirmasi
		****/
		$this->session->unset_userdata('table_session');	
		//Ambil Data lama dari database yang dikembalikan dalam bentuk Array
		$arrDataTable = $this->kelas_mahasiswa_model->select($nrp);
		$dataform["dataTable"] = $this->createTableBatalTambah($arrDataTable);
		//Jadikan data tersebut ke dalam bentuk String
		foreach($dataform["dataTable"] as $data){
		$stringTable.=$data["data"]."|".$data["nama"]."|".$data["jumlah_sks"]."|".$data["bg_color"]."_";
		}
		//Masukkan String Data yang sudah dibuat ke dalam parameter untuk dicetak ke Table
		$dataform["dataTable2"] = $stringTable; 
		//Masukkan ke Data ke dalam Session table_session
		$this->session->set_userdata('table_session', $stringTable);		
		}
		
		if($this->input->post('btnSubmitBatal') == true){
			$temp = $this->input->post('makul',true);
			if($this->session->userdata('table_session') != ""){
				$stringTable = $this->session->userdata('table_session');
			}
			if($temp != "null"){
				$stringReturn = "";
				/***Ganti warna dalam isi String $stringTable
				1. Explode 1x dari String utama '$stringTable'
				2. For dan lakukan pengecekan arraynya.
				3. Explode kedua untuk mengambil isi dari array data
				4. Setelah diganti warnanya, Pakai Implode di concate dengan '_'
				***/
				$explode1 = explode("_",$stringTable);
				for($i = 0 ; $i < count($explode1)-1; $i++){
					//Explode kedua
					$explode2 = explode("|",$explode1[$i]);
					if($explode2[0] == $temp){
					$explode2[3] = "#FF6633";}
					$stringReturn .= implode("|",$explode2)."_";
				}
				$dataform["dataTable2"] = $stringReturn;
				$this->session->set_userdata('table_session', $stringReturn);
			}
			else{
				$dataform["dataTable2"] =$stringTable;
				$this->session->set_userdata('table_session', $stringTable);
			}
			
			
		}
		if($this->input->post('btnSubmitTambah') == true){
			$temp = $this->input->post('makul',true);
			if($this->session->userdata('table_session') != ""){
				$stringTable = $this->session->userdata('table_session');
			}
			if($temp != "null"){
				$arrTampung = $this->matakuliah_model->selectMataKuliah($temp)[0];
				//Tambah Matakuliah ke String
				//Urutan String : ID_MATA_KULIAH-NAMA_MATKUL-JUMLAH_SKS-WARNA
				//Cek apakah data kembar / tidak
				$boolCekKembar = $this->cekKembar($arrTampung,$stringTable);
				//Kalau data tidak kembar maka masukkan ke dalam table. Jika kembar tidak usah
				if($boolCekKembar == 1){
					$stringTable.=$arrTampung["id"]."|".$arrTampung["nama"]."|".$arrTampung["jumlah_sks"]."|"."#00CCFF_";	
				}
				//Hilangkan isi combobox yang dipilih
				foreach($dataform["dataComboBoxTambah"] as $key=>$data){
					if($key == $temp){
						unset($dataform["dataComboBoxTambah"][$key]);
					break;
					}
				}
			}
			$dataform["dataTable2"] = $stringTable; 
			$this->session->set_userdata("table_session", $stringTable);
		}
		if($this->input->post('btnKonfirmasi') == true){
			$dataString = $this->session->userdata('table_session');
			$dataform["dataTable2"] = $dataString;
			$this->session->unset_userdata('table_session');
			//Update data dari table Kelas_Mahasiswa statusnya jadi Tambah / Batal
			$data = explode("_",$dataString);
			for($i=0;$i<count($data)-1;$i++){
				$isiData = explode("|",$data[$i]);
				if($isiData[3] == "#00CCFF"){
					//Update data Status jadi Tambah
					$this->Kelas_Mahasiswa_Model->updateStatusKelas_Mahasiswa($nrp,$isiData[0],"tambah");
				}
				else if($isiData[3] == "#FF6633"){
					//Update data Status jadi Batal
					$this->Kelas_Mahasiswa_Model->updateStatusKelas_Mahasiswa($nrp,$isiData[0],"batal");
				}
			}
			//Kirimkan Notifikasi ke dosen wali mahasiswa
			$this->Kelas_Mahasiswa_Model->kirimNotifikasi($nrp);
		}
		//Hitung Jumlah SKS Yang akan diambil mahasiswa Setelah Batal / Tambah
		$dataform["jumlah_sks_baru"] = $this->generateJumlahSKS($this->session->userdata("table_session"));
		$this->load->view('includes/header');
		$this->load->view('perwalian/bataltambahdrop',$dataform);
		$this->load->view('includes/footer');
	
	}
	public function drop(){
		$nrp = $this->session->userdata("username");
		$dataform = [];
		$arrDataTable = $this->kelas_mahasiswa_model->select($nrp);
		$dataform["dataTable"] = $this->createTableBatalTambah($arrDataTable);
		$stringTable = "";
		//Ubah Array ke bentuk String. Batasnya '|' dan '_'
		foreach($dataform["dataTable"] as $data){
		$stringTable.=$data["data"]."|".$data["nama"]."|".$data["jumlah_sks"]."|".$data["bg_color"]."_";
		}
		$dataform["dataTable2"] = $stringTable; 
		if($this->session->userdata('table_session') != ""){
			//$dataform["dataTable"] = $this->session->userdata('table_session');
			$stringTable = $this->session->userdata('table_session');
		}
		$dataform["dataComboBox"] = $this->createComboBoxBatal($nrp);
		if($this->input->post('btnClear') == true){
		$stringTable = "";
		$this->session->unset_userdata('table_session');	
		//Ambil Data untuk Table
		$dataform["dataTable"] = $this->createTableBatalTambah($arrDataTable);
		
		//Jadikan ke bentuk String + HItung jumlah SKSnya
		$jumSks = 0;
		foreach($dataform["dataTable"] as $data){
		$stringTable.=$data["data"]."|".$data["nama"]."|".$data["jumlah_sks"]."|".$data["bg_color"]."_";
		$jumSks = $jumSks + intval($data["jumlah_sks"]);
		}
		$dataform["dataTable2"] = $stringTable; 
		$dataform["jumlah_sks_baru"] = $jumSks;
		//Masukkan ke dalam Session table_session
		$this->session->set_userdata('table_session', $stringTable);		
		}
		
		if($this->input->post('btnSubmitDrop') == true){
			$temp = $this->input->post('makul',true);
			if($this->session->userdata('table_session') != ""){
			$stringTable = $this->session->userdata('table_session');
			}
			/***Ganti warna dalam isi String $stringTable
			1. Explode 1x dari String utama '$stringTable'
			2. For dan lakukan pengecekan arraynya.
			3. Explode kedua untuk mengambil isi dari array data
			4. Setelah diganti warnanya, Pakai Implode di concate dengan '_'
			***/
			$stringReturn = "";
			$explode1 = explode("_",$stringTable);
			for($i = 0 ; $i < count($explode1)-1; $i++){
				//Explode kedua
				$explode2 = explode("|",$explode1[$i]);
				if($explode2[0] == $temp){
				$explode2[3] = "#FF8833";}
				$stringReturn .= implode("|",$explode2)."_";
			}
			$dataform["dataTable2"] = $stringReturn;
			$this->session->set_userdata('table_session', $stringReturn);
		}
		
		if($this->input->post('btnKonfirmasi') == true){
			$dataString = $this->session->userdata('table_session');
			$dataform["dataTable2"] = $dataString;
			$this->session->unset_userdata('table_session');
			//Update data dari table Kelas_Mahasiswa statusnya jadi Drop
			$data = explode("_",$dataString);
			for($i=0;$i<count($data)-1;$i++){
				$isiData = explode("|",$data[$i]);
				if($isiData[3] == "#FF8833"){
					//Update data Status jadi Drop
					$this->Kelas_Mahasiswa_Model->updateStatusKelas_Mahasiswa($nrp,$isiData[0],"drop");
				}
				
			}
		}
		/****
		Ambil Data Informasi mahasiswa dari table mahasiswa
		****/
		$dataform["data_mahasiswa"] = $this->mahasiswa_model->getDataMahasiswa($nrp);
		
		//Ambil Jurusan dari table informasi_kurikulum
		$informasi_kurikulum_mahasiswa = $this->informasi_kurikulum_model->getDataKurikulum($dataform["data_mahasiswa"]["informasi_kurikulum_id"]);
		$dataform["data_mahasiswa"]["informasi_kurikulum_mahasiswa"] = $informasi_kurikulum_mahasiswa;
		$dataform["jumlah_sks_baru"] = $this->generateJumlahSKS($this->session->userdata("table_session"));
		
		$this->load->view('includes/header');
		$this->load->view('perwalian/bataltambahdrop',$dataform);
		$this->load->view('includes/footer');
	}
	public function cekKembar($arrData, $stringData){
		$explodeData = explode("_",$stringData);
		array_pop($explodeData);
		foreach($explodeData as $data){
			$explodeData2 = explode("|",$data);
			if($explodeData2[0] == $arrData["id"]){return 0;}
		}
		return 1;
	}
	public function success(){	
		echo "Anda sudah Melakukan Batal/Tambah Atau Drop";
	}
	/****
	Function createTableBatalTambah
	Digunakan untuk mengenerate array untuk tampilan Table pada view
	Input : Array hasil query kelas_mahasiswa berdasarkan nrp
	Output : Array berupa id_mata_kuliah, nama_matakuliah, jumlah_sks, dan warna dari table.
		Keterangan Warna yang di generate : 
		-> #FF6633 untuk Batal
		-> #00CCFF untuk Tambah
		-> #FF8833 untuk Drop
	****/
	function createTableBatalTambah($arrDataTable){
		//Untuk Setiap Hasil Query, cari data kelas dari mata_kuliah_id
		foreach($arrDataTable as $data){
			//Buat Row Tabel untuk masing-masing data mata_kuliah
			$temp = $this->matakuliah_model->selectMataKuliah($data["mata_kuliah_id"])[0];
			//Memberikan warna background Merah jika status_ambil adalah 'b' (Batal)
			if($data["status_ambil"] == "b"){
				$arrHasil[] = array(
				'data'=> $temp["id"],
				'nama' => $temp["nama"],
				'jumlah_sks' => $temp["jumlah_sks"],
				'bg_color' => "#FF6633");
			}
			//Memberikan warna background Biru jika status_ambil adalah 't' (Tambah)
			else if($data["status_ambil"] == "t"){
				$arrHasil[] = array(
				'data'=> $temp["id"],
				'nama' => $temp["nama"],
				'jumlah_sks' => $temp["jumlah_sks"],
				'bg_color' => "#00CCFF"
				);
			}
			//Memberikan warna background Putih pada status_ambil yang lain
			else
			{
				$arrHasil[] = array(
				'data'=> $temp["id"],
				'nama' => $temp["nama"],
				'jumlah_sks' => $temp["jumlah_sks"],
				'bg_color' => "none"
				);
			}
		}
		return $arrHasil;
	}
	/****
	Function createComboBoxBatal
	Digunakan untuk mengisi combobox pada form batal.
	Input : nrp mahasiswa
	Output : Array untuk combobox yang sudah jadi
	****/
	function createComboBoxBatal($nrp){
		//Ambil data dari kelas_mahasiswa_model berdasarkan NRP mahasiswa
		$arrData = $this->kelas_mahasiswa_model->select($nrp);
		$arrHasil = [];
		$arrHasil += array("null" => "Pilih Mata Kuliah");
		//Untuk Setiap Hasil Query, cari data kelas dari mata_kuliah_id
		foreach($arrData  as $data){
			/****
			Untuk Setiap Data Mata Kuliah yang diambil Mahasiswa di kelas_mahasiswa
			Ambil informasi dari matakuliah_model berupa id, nama dan jumlah_sks lalu disusun menjadi
			1 string dengan format id-nama-jumlah_sks dengan Key id
			****/
			$temp = $this->matakuliah_model->selectMataKuliah($data["mata_kuliah_id"])[0];
			$arrHasil += array($temp["id"] => $temp["id"]."-".$temp["nama"]."-".$temp["jumlah_sks"]);
		}
		return $arrHasil;
	}
	/****
	Function createComboBoxTambah
	Digunakan untuk mengisi combobox pada form Tambah. 
	Input : nrp
	Output : Array of Data Mata Kuliah buat Combobox
	****/
	function createComboBoxTambah($nrp){
		//Ambil Data dari mata_kuliah berdasarkan Status Aktif (1)
		$arrHasilMataKuliah = $this->matakuliah_model->selectStatus(1);
		//Ambil Data Matakuliah yang diambil mahasiswa yang sekarang sedang diambil
		$arrMatkulAktif = $this->kelas_mahasiswa_model->select($nrp);
		$arrHasil = [];
		$arrHasil += array("null" => "Pilih Mata Kuliah");
		$cekKembar = true;
		foreach($arrHasilMataKuliah as $hasilMataKuliah){
			foreach($arrMatkulAktif as $hasilAktif){
			//Cek setiap matakuliah yang akan dimasukkan combobox. Jika mahasiswa sedang mengambil matakuliah tersebut, maka tidak usah dimasukkan
			if($hasilAktif["mata_kuliah_id"] == $hasilMataKuliah["id"]){$cekKembar = false;}
			}
			if($cekKembar == true){
			//Jika cek kembar sukses
			$arrHasil += array($hasilMataKuliah["id"] => $hasilMataKuliah["id"]."-".$hasilMataKuliah["nama"]."-".$hasilMataKuliah["jumlah_sks"]);
			}
		$cekKembar = true;
		}
		return $arrHasil;
	}
	/****
	Function generateJumlahSKS
	Untuk menghitung jumlah SKS setelah Mahasiswa melakukan batal / tambah / drop
	Input : String data batal/tambah/drop
	Output : Jumlah SKS yang baru
	****/
	function generateJumlahSKS($stringData){
		$jumlahSksBaru = 0;
		//Explode Pertama untuk memisah Tiap Data
		$explodeData1 = explode("_",$stringData);
		//Membuang Array kosongan paling belakang
		array_pop($explodeData1);
		//Untuk setiap Array, Explode sekali lagi, dan ambil jumlah sksnya;
		foreach($explodeData1 as $data){
			$explodeData2 = explode("|",$data);
			//Jika Warna (index ke 4 dari explode Data 2) adalah #FF6633 atau #FF8833 maka Tidak usah dihitung SKSnya 
			if($explodeData2[3] == "none" || $explodeData2[3] == "#00CCFF"){
				$jumlahSksBaru += intval($explodeData2[2]);
			}
		}
		return $jumlahSksBaru;
	}
}

?>