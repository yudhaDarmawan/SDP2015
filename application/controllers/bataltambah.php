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
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->library('table');
		$this->load->model('Kelas_Mahasiswa_Model','',true);
	}
	
	public function index(){
		//Ambil NRP Mahasiswa yang Login.
		$nrp = $this->session->userdata("username");
		//Cek Status Perwalian. Jika sudah perwalian/Batal Tambah Drop, redirect ke Page Message Success
		$cekPerwalian = $this->Kelas_Mahasiswa_Model->getStatusPerwalianFromMahasiswa($nrp)["status_perwalian"];
		if($cekPerwalian == 1){
		redirect('bataltambah/success','refresh');
		};
		$dataform = [];
		$dataform["activeBatalTambah"] = "active";
		$dataform["activeDrop"] = "";
		/****
		Ambil Data Untuk pembuatan table view dari Kelas_Mahasiswa
		berdasarkan NRP Mahasiswa yang login
		****/
		$dataform["dataTable"] = $this->Kelas_Mahasiswa_Model->getTableForBatalTambahMhs($nrp);
		$stringTable = "";
		/****
		Ubah Hasil return dalam bentuk Array ke bentuk String.
		Batasnya '|' (Pipeline) dan '_' (UnderScore)
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
		$dataform["dataComboBox"] = $this->Kelas_Mahasiswa_Model->getDataForComboBoxFromKelas($nrp);
		/****
		2. Yang kedua adalah data untuk ComboBox FORM TAMBAH.
		Isinya adalah data yang diambil adalah informasi Mata Kuliah dari table Mata_Kuliah 
		dengan Status 1 (Maksudnya Status Mata Kuliahnya sedang dibuka pada semester ini)
		Valuenya adalah Kode_Matakuliah-Nama_Matakuliah-Jumlah_SKS
		Keynya adalah Kode_Matakuliah
		****/
		$dataform["dataComboBoxTambah"] = $this->Kelas_Mahasiswa_Model->getDataForComboBoxFromKelas_Tambah($nrp);
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
		$dataform["dataTable"] = $this->Kelas_Mahasiswa_Model->getTableForBatalTambahMhs($nrp);
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
			echo $temp;
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
				echo "lalaal";
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
				$arrTampung = $this->Kelas_Mahasiswa_Model->selectFromMataKuliah($temp)[0];
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
		$this->load->view('includes/header');
		$this->load->view('nav/navbarmahasiswa',array('nameStudent' => $this->Mahasiswa_Model->getNameStudent($this->session->userdata("username"))));
		$this->load->view('bataltambahdrop',$dataform);
		$this->load->view('includes/footer');
	
	}
	public function drop(){
		$nrp = $this->session->userdata("username");
		$dataform = [];
		$dataform["activeBatalTambah"] = "";
		$dataform["activeDrop"] = "active";
		$dataform["dataTable"] = $this->Kelas_Mahasiswa_Model->getTableForBatalTambahMhs($nrp);
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
		$dataform["dataComboBox"] = $this->Kelas_Mahasiswa_Model->getDataForComboBoxFromKelas($nrp);
		if($this->input->post('btnClear') == true){
		$stringTable = "";
		$this->session->unset_userdata('table_session');	
		//Ambil Data untuk Table
		$dataform["dataTable"] = $this->Kelas_Mahasiswa_Model->getTableForBatalTambahMhs($nrp);
		
		//Jadikan ke bentuk String
		foreach($dataform["dataTable"] as $data){
		$stringTable.=$data["data"]."|".$data["nama"]."|".$data["jumlah_sks"]."|".$data["bg_color"]."_";
		}
		$dataform["dataTable2"] = $stringTable; 
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
		$this->load->view('includes/header');
		$this->load->view('nav/navbarmahasiswa',array('nameStudent' => $this->Mahasiswa_Model->getNameStudent($this->session->userdata("username"))));
		$this->load->view('bataltambahdrop',$dataform);
		$this->load->view('includes/footer');
	}
	public function cekKembar($arrData, $stringData){
		echo "Data yang akan ditambah: <br>";
		print_r($arrData);
		$explodeData = explode("_",$stringData);
		array_pop($explodeData);
		print_r($explodeData);
		foreach($explodeData as $data){
			$explodeData2 = explode("|",$data);
			if($explodeData2[0] == $arrData["id"]){return 0;}
		}
		return 1;
	}
	public function success(){	
		echo "Anda sudah Melakukan Batal/Tambah Atau Drop";
	}
}

?>