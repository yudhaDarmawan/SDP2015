<?php
	class Perwalian extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		public function index()
		{
			if($this->session->userdata('username')){
				if($this->Mahasiswa_model->isStudent($this->session->userdata('username')))
				{
					redirect('perwalian/mahasiswa');
				}
				else if($this->Dosen_model->isLecture($this->session->userdata('username')))
				{
					redirect('perwalian/dosen');
				}
			}
			else if(get_cookie('username')){
				if($this->Mahasiswa_model->isStudent(get_cookie('username')))
				{
					redirect('perwalian/mahasiswa');	
				}
				else if(  $this->Dosen_model->isLecture(get_cookie('username')))
				{
					redirect('perwalian/dosen');
				}				
			}
			else{
				redirect('home/login');
			}
		}
		
		public function mahasiswa()
		{
			if($this->session->userdata('username') or get_cookie('username')){
				if($this->Mahasiswa_model->isStudent($this->session->userdata('username')) or $this->Mahasiswa_model->isStudent($this->input->cookie('username')))
				{
					$data['title'] = 'Sistem Informasi Mahasiswa STTS';
					$this->load->view('includes/header',$data);
					if($this->input->post('home_x'))
					{
						$this->session->set_userdata('currentPage','home');
						$this->load->view('nav/navbarmahasiswa');
						$this->load->view('contentdefault');
					}
					else if($this->input->post('perwalian'))
					{
						$this->session->set_userdata('currentPage','frs');
						$this->load->view('nav/navbarmahasiswa');
						$data['countSKS']=0;
						if($this->session->userdata('countSKS')){
							$data['countSKS'] = $this->session->userdata('countSKS');
						}
						$arr= array();
						foreach($this->Matakuliah_model->getClassSemesterOpen() as $row){
							array_push($arr,$row->semester);
						}
						$data['dataCombobox']=$arr;
						$user = '';
						if($this->session->userdata('username')){$user = $this->session->userdata('username');}
						if($this->input->cookie('username')){$user = get_cookie('username');}
						$data['mahasiswa'] = $this->Mahasiswa_model->getDetailStudent($user);
						$data['smtr'] = $this->getSemesterStudent($data['mahasiswa']->nrp);
						$data['semester'] = $this->createTableCourse($data['smtr']);
						$this->load->view('perwalian/perwalian',$data);
					}
					else if($this->input->post('batal'))
					{
						$this->session->set_userdata('currentPage','batal');
						$this->load->view('nav/navbarmahasiswa');
						$this->load->view('contentdefault');
					}
					else if($this->input->post('jadwal'))
					{
						$this->session->set_userdata('currentPage','jadwal');
						$this->load->view('nav/navbarmahasiswa');
						$this->load->view('contentdefault');
					}
					else if($this->input->post('logout'))
					{
						$this->session->sess_destroy();
						$cookie = array('name'=>'username','value'=>'','expire'=>'0');
						delete_cookie($cookie);
						redirect('perwalian/index');
					}
					else
					{
						if(!$this->session->userdata('currentPage')){
							$this->session->set_userdata('currentPage','home');	
						}
						if($this->session->userdata('currentPage') == 'home'){
							$this->load->view('nav/navbarmahasiswa');
							$this->load->view('contentdefault');
						}
						else if($this->session->userdata('currentPage') == 'frs'){
							$this->session->set_userdata('currentPage','frs');
							$this->load->view('nav/navbarmahasiswa');
							$data['countSKS']=0;
							if($this->session->userdata('countSKS')){
								$data['countSKS'] = $this->session->userdata('countSKS');
							}
							$arr= array();
							foreach($this->Matakuliah_model->getClassSemesterOpen() as $row){
								array_push($arr,$row->semester);
							}
							$data['dataCombobox']=$arr;
							$user = '';
							if($this->session->userdata('username')){$user = $this->session->userdata('username');}
							if($this->input->cookie('username')){$user = get_cookie('username');}
							$data['mahasiswa'] = $this->Mahasiswa_model->getDetailStudent($user);
							$data['smtr'] = $this->getSemesterStudent($data['mahasiswa']->nrp);
							$data['semester'] = $this->createTableCourse($data['smtr']);
							$this->load->view('perwalian/perwalian',$data);
						}
					}
					$this->load->view('includes/footer');
				}
				else if($this->Dosen_model->isLecture($this->session->userdata('username')) or $this->Dosen_model->isLecture($this->input->cookie('username')))
				{
					redirect('');
				}
			}
			else{
				redirect('home/login');
			}
		}
		
		
		//FUNCTION INI DIGUNAKAN OLEH AJAX 
		//UNTUK MENDAPATKAN SKS SUATU MATA KULIAH
		public function getTotalSks(){
			$query = $this->Matakuliah_model->getSKS($this->input->post('name'));
			if($this->session->userdata('getCourseNow')){
				$array = $this->session->userdata('getCourseNow');
				if($this->input->post('status')){
					$count = (+$this->input->post('countSKS')) + (+3);
					$this->session->set_userdata('countSKS',$count);
					array_push($array,$this->input->post('name'));
				}else{
					$count = (+$this->input->post('countSKS')) - (+3);
					$this->session->set_userdata('countSKS',$count);
					array_diff($array, $this->input->post('name'));
				}
				$this->session->set_userdata('getCourseNow',$array);
			}else{
				$array = array($this->input->post('name'));
				$this->session->set_userdata('getCourseNow',$array);
			}
			print $query->jumlah_sks;
		}
		
		//FUNCTION INI UNTUK MEMBUAT SEBUAH DIV
		function divOpen($class = NULL, $id = NULL)
		{
			$code   = '<div ';
			$code   .= ( $class != NULL )   ? 'class="'. $class .'" '   : '';
			$code   .= ( $id != NULL )      ? 'id="'. $id .'" '         : '';
			$code   .= '>';
			return $code;
		}

		function createTableCourse($semester){
			$matkul = $this->Matakuliah_model->createFRS($this->session->userdata('username'));
			$tmpl = array ( 'table_open'  => '<table class="table">');
			$this->table->set_template($tmpl);
			$this->table->set_heading('Kode Matkul','Nama Matkul','Hari','Jam','SKS','Grade','Ambil');
			foreach($matkul as $row)
			{	
				$hari='-';
				if($row->semester == $semester && $row->hari <> ''){
					$class='info';
					if($row->hari == "1"){
						$hari='Senin';
					}else if($row->hari == "2"){
						$hari='Selasa';
					}else if($row->hari == "3"){
						$hari='Rabu';
					}else if($row->hari == "4"){
						$hari='Kamis';
					}else if($row->hari == "5"){
						$hari='Jumaat';
					}else{
						$class='';
					}
					$checkbox = form_checkbox(array('class'=>'checkbox','value'=>$row->nama,'name'=>'cbx'));
					if($this->session->userdata('getCourseNow')){
						$array = $this->session->userdata('getCourseNow');
						if(in_array($row->nama,$array)){
							$checkbox = form_checkbox(array('class'=>'checkbox','value'=>$row->nama,'name'=>'cbx', 'checked'=>'true'));
						}
					}
					if($row->nilai_grade=='A'){
						$class='active';
						$checkbox = '<fieldset disabled>' .  form_checkbox(array('class'=>'checkbox','value'=>$row->nama,'name'=>'cbx')) .  '</fieldset>';
					}
					$rowData = array($row->id,$row->nama,$hari, $row->jam_mulai,$row->jumlah_sks,$row->nilai_grade, $checkbox);
					$this->table->add_row(array('data'=>$rowData,'class'=>$class));
				}
			}
			return $this->table->generate();
		}
		
		public function setSelectedDropDown(){
			print $this->createTableCourse($this->input->post('index'));
		}
		
		public function getSemesterStudent($nrp){			
			$sql = $this->db->get_where('data_umum',array('index'=>'tahun_ajaran_sekarang'));
			$now = $sql->row();
			$addTahun = 0;
			$tahun = substr($now->value,8,2);
			if(substr($now->value,0,5) == "GASAL"){
				$addTahun = 1;
			}else{
				$addTahun=2;
			}
			$smtr = (($tahun - substr($nrp,1,2)) * 2) + $addTahun;
			return $smtr;
		}
	}

?>