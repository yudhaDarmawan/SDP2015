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
					if($this->input->post('home'))
					{
						$this->session->set_userdata('currentPage','home');
						$this->load->view('nav/navbarmahasiswa');
						$this->load->view('contentdefault');
					}
					else if($this->input->post('perwalian'))
					{
						$this->session->set_userdata('currentPage','frs');
						$this->load->view('nav/navbarmahasiswa');
						$data['totalSksAkanDiambil'] = 0;
						$user = '';
						$query = $this->db->query("SELECT * FROM mata_kuliah");
						$data['semester1'] = $this->table->generate($query);
						if($this->session->userdata('username')){$user = $this->session->userdata('username');}
						if($this->input->cookie('username')){$user = get_cookie('username');}
						$data['mahasiswa'] = $this->Mahasiswa_model->getDetailStudent($user);
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
							$data['totalSksAkanDiambil'] = 0;
							
							$data['semester1'] = $this->createTableCourse();
							$user = '';
							if($this->session->userdata('username')){$user = $this->session->userdata('username');}
							if($this->input->cookie('username')){$user = get_cookie('username');}
							$data['mahasiswa'] = $this->Mahasiswa_model->getDetailStudent($user);
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
			echo 3;
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

		function createTableCourse(){
			$matkul = $this->Matakuliah_model->createFRS();
			$tmpl = array ( 'table_open'  => '<table class="table">' );
			$this->table->set_template($tmpl);
			$this->table->set_heading('Kode Matkul','Nama Matkul','Hari','Jam','SKS','Grade','Ambil');
			foreach($matkul as $row)
			{
				if($row->semester == "1"){
					$hari='-';
					if($row->hari == "1"){
						$hari='Senin';
					}if($row->hari == "2"){
						$hari='Selasa';
					}if($row->hari == "3"){
						$hari='Rabu';
					}if($row->hari == "4"){
						$hari='Kamis';
					}if($row->hari == "5"){
						$hari='Jumaat';
					}
					$this->table->add_row($row->id,$row->nama,$hari, $row->jam_mulai,$row->jumlah_sks,$row->nilai_grade);
				}
			}
			return $this->table->generate();
		}
	}

?>