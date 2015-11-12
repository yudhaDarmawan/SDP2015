<?php
/**
 * Created by PhpStorm.
 * User: MESHIANG
 * Date: 11/11/2015
 * Time: 6:45 PM
 */

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
 *
 */
class Grade_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function generateLogId(){
        $id = "NL".date('ymd');
        $this->db->select('IFNULL(MAX(SUBSTR(ID,11)),0)+1 as nilai', false);
        $this->db->from('log_penilaian');
        $this->db->where('SUBSTR(ID,1,10)',$id);
        $query = $this->db->get();
        $id .= str_pad($query->row()->nilai,3,"0",STR_PAD_LEFT);
        return $id;
    }
    public function insertStudentGrade($studentNrp){
        $id = "N".substr($studentNrp,-4);
        $this->db->select('IFNULL(MAX(SUBSTR(ID,5)),0)+1 as nilai', false);
        $this->db->from('nilai');
        $this->db->where('SUBSTR(ID,1,4)',$id);
        $query = $this->db->get();
        $id .= str_pad($query->row()->nilai,4,"0",STR_PAD_LEFT);

        // Now insert!
        $this->db->set('id',$id);
        $this->db->insert('nilai');
        return $id;
    }
    public function updateStudentGrade($classId,$studentNrp,$midTest, $finalTest, $homework, $logPenilaian=null){
        //Ambil Kelas classId yang mereference classId yang ada
        $this->load->model('class_model');
        $class = $this->class_model->getAllClassConnected($classId);

        // Check Ada row pada nilai yang diassign pada row kelas_mahasiswa
        $this->db->where('status_ambil, nilai_id');
        $this->db->where('mahasiswa_nrp',$studentNrp);
        $this->db->where_in('kelas_id',$class);
        $result = $this->db->get('kelas_mahasiswa')->row();

        if ($result->status_ambil == 'A' || $result->status_ambil == 'd') {
            $gradeId = $result->nilai_id;
            // Hitung Nilai pada nilai_id
            $grade = $this->countTotalGrade($midTest,$finalTest,$homework,$classId);
            // Update Nilai pada nilai_id
            $dataGrade = ['uts'=>$midTest, 'uas'=>$finalTest,'tugas'=>$homework, "nilai_akhir" => $grade[0], "nilai_akhir_grade" => $grade[1], "nilai_grade" => $grade[2]];
            $this->db->where('id',$gradeId);
            $this->db->update('nilai',$dataGrade);
            // Jika logPenilaian masih null maka insert padaLog Penilaian
            if ($logPenilaian == null) {
                $logPenilaian = $this->createHeaderLog($classId);
            }
            // Insert pada log_penilaian_nilai
            $this->insertDetailLog($logPenilaian, $gradeId, $classId);
            // Return log_penilaian_id
            return $logPenilaian;
        }
        return false;
    }
    public function countTotalGrade($midTest,$finalTest,$homework, $classId ){
        // Ambil Prosentase dan Grade untuk Class Id
        $this->db->select('persentase_uts,persentase_uas,persentase_tugas,tambahan_grade');
        $this->db->where('id',$classId);
        $result = $this->db->get('kelas')->row();
        $percentUTS = $result->persentase_uts;
        $percentUAS = $result->persentase_uas;
        $percentHomework = $result->persentase_tugas;
        $addGrade = $result->tambahan_grade;
        // Mengitung nilai Akhir untuk ini

        $finalMark = round(($midTest*$percentUTS/100) + ($finalTest*$percentUAS/100) + ($homework*$percentHomework/100));
        $finalMarkAfterGrade = $finalMark + $addGrade;
        if ($finalMarkAfterGrade > 79){
            $finalGrade = 'A';
        }
        else if($finalMarkAfterGrade > 74){
            $finalGrade = 'B+';
        }
        else if($finalMarkAfterGrade > 69){
            $finalGrade = 'C+';
        }
        else if($finalMarkAfterGrade > 60){
            $finalGrade = 'C';
        }
        else if($finalMarkAfterGrade > 55){
            $finalGrade = 'D';
        }
        else {
            $finalGrade = 'E';
        }
        // Kembalikan Array[3] dimana ke-0 adalah nilai akhir angka, nilai akhir grade dan
        // ke-2 adalah nilai huruf dari nilai akhir grade.
        return [$finalMark,$finalMarkAfterGrade,$finalGrade];
    }
    public function createHeaderLog($classId,$note=null){
        // Regenerate Log Id
        $id = $this->generateLogId();
        $this->db->set('tanggal_create','now()',false);
        $this->db->set('kelas_id',$classId);
        // Insert Log
        $this->db->set('id',$id);
        if ($note != null){
            $this->db->set('keterangan',$note);
        }
        $this->db->insert('log_penilaian');
        if ($this->db->affected_rows()){
            // Return Log
            return $id;
        }
        return false;
    }
    public function existLog($logId){
        $this->db->where('id',$logId);
        $this->db->get('log_penilaian');
        return $this->db->affected_rows();
    }
    public function insertDetailLog($logId,$gradeId,$kelasId){
        $this->db->set('nilai_id',$gradeId);
        $this->db->set('log_penilaian_id',$logId);
        $this->db->insert('log_penilaian_nilai');

        $this->db->set('tanggal_update','now()',false);
        $this->db->where('id',$kelasId);
        $this->db->update('kelas');
    }

    public function getAllGradeOfClass($classId, $orders=null){
        // Ambil Class Yang mereference $classId
        $this->load->model('class_model');
        $class = $this->class_model->getAllClassConnected($classId);

        // Ambil Semua mahasiswa yang ada
        $this->db->select("km.mahasiswa_nrp as nrp, m.nama as nama, n.uts as uts, n.uas as uas, n.tugas as tugas, n.nilai_akhir as nilai_akhir, n.nilai_akhir_grade as nilai_akhir_grade, n.nilai_grade as nilai_grade");
        $this->db->where('km.mahasiswa_nrp = m.nrp');
        $this->db->where('m.status',1);
        $this->db->where('km.nilai_id = n.id');
        $this->db->where('(km.status_ambil = "A" or km.status_ambil = "r")');
        $this->db->where_in('km.kelas_id', $class);
        $this->db->from('kelas_mahasiswa km, mahasiswa m, nilai n');
        if ($orders== null){
            $orders = ["km.mahasiswa_nrp" => "asc"];
        }
        foreach ($orders as $key => $value){
            $this->db->order_by($key, $value);
        }
        return $this->db->get()->result();
    }
    public function getDatatableGradeOfClass($classId,$orders=null){
        $results = $this->getAllGradeOfClass($classId,$orders);
        $students = [];
        $ctr = 0;
        foreach ($results as $result){
            $student = [];
            $student[] = ++$ctr;
            $student[] = $result->nrp;
            $student[] = $result->nama;
            $student[] = $result->uts;
            $student[] = $result->uas;
            $student[] = $result->tugas;
            $student[] = $result->nilai_akhir;
            $student[] = $result->nilai_akhir_grade;
            $student[] = form_input(["name"=>'nilai_akhir', "class"=>'nilai_akhir form-control', 'value' => $result->nilai_akhir]);
            $student[] = form_input(["name"=>'nilai_akhir_grade', "class"=>'nilai_akhir_grade form-control', 'value' => $result->nilai_akhir_grade]);
            $student[] = form_input(["name"=>'nilai_grade', "class"=>'nilai_grade form-control', 'value' => $result->nilai_grade]);
            $student[] = "<span class='grade_tools'><button class='btn btn-primary' data-value='".$ctr."'>Edit</button></span>";
            $students[] = $student;
        }
        return $students;
    }
    public function countAllStudentInClass($classId){
        $this->load->model('class_model');
        $class = $this->class_model->getAllClassConnected($classId);
        $this->db->where('km.mahasiswa_nrp = m.nrp');
        $this->db->where('m.status',1);
        $this->db->where('km.nilai_id = n.id');
        $this->db->where('(km.status_ambil = "A" or km.status_ambil = "r")');
        $this->db->where_in('km.kelas_id', $class);
        $this->db->from('kelas_mahasiswa km, mahasiswa m, nilai n');
        return $this->db->count_all_results();
    }
}