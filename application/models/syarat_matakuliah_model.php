<?php

/**
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Config $config
 * @property CI_Controller $controller
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Log $log
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Parser $parser
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Session $session
 * @property CI_Sha1 $sha1
 * @property CI_Table $table
 * @property CI_Trackback $trackback
 * @property CI_Typography $typography
 * @property CI_Unit_test $unit_test
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 *
 * Add additional libraries you wish
 * to use in your controllers here
 *
 * @property Class_model $class_model
 * @property Grade_model $grade_model
 *
 */
	class Syarat_Matakuliah_Model extends CI_Model
	{
		/* -----------------------------------------------------
		Function __construct()
		Mengeload Inisialisasi Awal Model class_model
		Input/Output : -
		----------------------------------------------------- */
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		public function insert($courseID,$requirementCourseId)
		{
			$data = array('id_matakuliah'=>$courseID, 'id_syarat_matakuliah'=>$requirementCourseId);
			$this->db->insert('syarat_matakuliah',$data);
			return $this->db->affected_rows();
		}
		
		public function insertDummyData()
		{
			$data = array(array('id_matakuliah'=>'MK007', 'id_syarat_matakuliah'=>'MK001'),
				array('id_matakuliah'=>'MK008', 'id_syarat_matakuliah'=>'MK001'),
				array('id_matakuliah'=>'MK008', 'id_syarat_matakuliah'=>'MK002')
			);
			$this->db->insert_batch('syarat_matakuliah',$data);
		}
		
		public function getRequirement($courseID)
		{
			return $this->db->get_where('syarat_matakuliah',array('id_matakuliah'=>$courseID))->result();
		}
	}
?>