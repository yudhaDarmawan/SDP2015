<?php
/**
 * Created by PhpStorm.
 * User: MESHIANG
 * Date: 11/11/2015
 * Time: 6:45 PM
 *
 * v0.1 11 Nov 2015
 * generateLogID,insertStudentGrade, updateStudentGrade
 * countTotalGrade, createHeaderLog, existLog, insertDetailLog,
 * getAllGradeOfClass, getDatatableGradeOfClass, getAllScoreOfClass,
 * getDatatableScoreOfClass, countAllStudentInClass
 *
 * v0.2 - 18 Nov 2015
 * getAllScoreOfClass, getPercentageClass,changeConfirmationStatus,
 * memindahkan generateLogID dipindahkan ke dalam insertDetailLog
 * menhapus fungsi existLog
 * Menambahkan updateAdditionalGrade dan updateGradePercentage
 * pada grade_model
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
 * @property Grade_model $grade_model
 *
 */
class Grade_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /**
     * Digunakan untuk insert atau buat nilai baru pada tabel Nilai
     * @param string $studentNrp
     * @return string ID Nilai yang dibuat
     */
    public function insertStudentGrade($studentNrp){
        $id = "N".substr($studentNrp,-4);
        $this->db->select('IFNULL(MAX(SUBSTR(ID,5)),0)+1 as nilai', false);
        $this->db->from('nilai');
        $this->db->where('SUBSTR(ID,1,4)',$id);
        $query = $this->db->get();
        $id .= str_pad($query->row()->nilai,4,"0",STR_PAD_LEFT);
        // Insert
        $this->db->set('id',$id);
        $this->db->insert('nilai');
        return $id;
    }

    /**
     * Update nilai UTS,UAS,Tugas untuk mahasiswa dengan NRP pada Kelas dengan ID tertentu
     * @param $classId Kelas Mahasiswa
     * @param $studentNrp NRP Mahasiswa
     * @param $midTest Nilai UTS
     * @param $finalTest Nilai UAS
     * @param $homework Nilai Tugas
     * @param string $logPenilaian Log Penilaian jika ada
     * @return bool|string ID Log Penilaian yang Dipakai
     */
    public function updateStudentGrade($classId,$studentNrp,$midTest, $finalTest, $homework, $logPenilaian=''){
        //Ambil Kelas classId yang mereference classId yang ada
        $this->load->model('class_model');
        $class = $this->class_model->getAllClassConnected($classId);

        // Check Ada row pada nilai yang diassign pada row kelas_mahasiswa
        $this->db->select('status_ambil, nilai_id');
        $this->db->where('mahasiswa_nrp',$studentNrp);
        $this->db->where_in('kelas_id',$class);
        $result = $this->db->get('kelas_mahasiswa')->row();
        if ($result->status_ambil == 'A' || $result->status_ambil == 'd') {
            $gradeId = $result->nilai_id;
            // Hitung Nilai pada nilai_id
            $grade = $this->countTotalGrade($midTest,$finalTest,$homework,$classId);
            // Update Nilai pada nilai_id
            if ($grade[0] > 100){
                $grade[0] = 100;
            }
            if ($grade[1] > 100){
                $grade[1] = 100;
            }
            $dataGrade = ['uts'=>$midTest, 'uas'=>$finalTest,'tugas'=>$homework, "nilai_akhir" => $grade[0], "nilai_akhir_grade" => $grade[1], "nilai_grade" => $grade[2]];
            $this->db->where('id',$gradeId);
            $this->db->update('nilai',$dataGrade);
            // Jika logPenilaian masih null maka insert padaLog Penilaian
            if ($logPenilaian == '') {
                $logPenilaian = $this->createHeaderLog($classId);
            }
            // Insert pada log_penilaian_nilai
            $this->insertDetailLog($logPenilaian, $gradeId, $classId);
            // Return log_penilaian_id
            return $logPenilaian;
        }
        return false;
    }

    /**
     * Digunakan untuk menghitung nilai_akhir, nilai_akhir_grade, dan nilai_grade
     * dari suatu kumpulan nilai berdasarkan UTS,UAS,Tugas dan Kelasnya
     * @param $midTest Nilai UTS
     * @param $finalTest Nilai UAS
     * @param $homework Nilai Tugas
     * @param $classId ID Kelas
     * @return array Mengembalikan Array dengan [0]=>nilai_akhir, [1]=>nilai_akhir_grade,[2]=>nilai_grade
     */
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

    /**
     * Membuat Header dari Log Penilaian
     * @param $classId ID Kelas
     * @param null $note
     * @return bool|string
     */
    public function createHeaderLog($classId,$note=null){
        // Regenerate Log Id
        $id = "NL".date('ymd');
        $this->db->select('IFNULL(MAX(SUBSTR(ID,9)),0)+1 as nilai', false);
        $this->db->from('log_penilaian');
        $this->db->where('SUBSTR(ID,1,8)',$id);
        $query = $this->db->get();
        $id .= str_pad($query->row()->nilai,3,"0",STR_PAD_LEFT);

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

    /**
     * Digunakan untuk mengecek apakah logID sudah ada didatabase atau belum.
     * @param $logId ID Log Penilaian
     * @return bool , false tidak ada, true sudah ada
     */
    public function existLog($logId){
        $this->db->where('id',$logId);
        $this->db->get('log_penilaian');
        return $this->db->affected_rows();
    }

    /**
     * @param $logId
     * @param $gradeId
     * @param $kelasId
     */
    public function insertDetailLog($logId,$gradeId,$kelasId){
        $this->db->where('log_penilaian_id',$logId);
        $this->db->where('nilai_id',$gradeId);
        $result = $this->db->get('log_penilaian_nilai');
        if ($this->db->affected_rows() == 0) {
            $this->db->set('nilai_id', $gradeId);
            $this->db->set('log_penilaian_id', $logId);
            $this->db->insert('log_penilaian_nilai');
        }
        $this->db->set('tanggal_update', 'now()', false);
        $this->db->where('id', $kelasId);
        $this->db->update('kelas');
    }

    /**
     * Mengambil semua data (QUERY) dari suatu kelas
     * @param $classId ID kelas
     * @param null $orders Assoc. Array dengan nama_kolom => desc/asc
     * @return mixed CI_QUERY_RESULT
     */
    public function getAllGradeOfClass($classId, $orders=null){
        // Ambil Class Yang mereference $classId
        $this->load->model('class_model');
        $class = $this->class_model->getAllClassConnected($classId);

        // Ambil Semua mahasiswa yang ada
        $this->db->select("km.mahasiswa_nrp as nrp, m.nama as nama, n.uts as uts, n.uas as uas, n.tugas as tugas, n.nilai_akhir as nilai_akhir, n.nilai_akhir_grade as nilai_akhir_grade, n.nilai_grade as nilai_grade");
        $this->db->where('km.mahasiswa_nrp = m.nrp');
        $this->db->where('m.status',1);
        $this->db->where('km.nilai_id = n.id');
        $this->db->where('(km.status_ambil = "A" or km.status_ambil = "d")');
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

    /**
     * Menyiapkan data lengkap berda
     * @param $classId
     * @param null $orders
     * @return array
     */
    public function getDatatableGradeOfClass($classId,$orders=null){
        $results = $this->getAllGradeOfClass($classId,$orders);
        $this->load->helper('form');
        $students = [];
        $ctr = 0;
        foreach ($results as $result){
            $student = [];
            $student[] = ++$ctr;
            $student[] = $result->nrp;
            $student[] = $result->nama;
            $student[] = form_input(["type"=> "number","name"=>'uts', "class"=>'nilai_'.$ctr.' nilai_uts form-control', 'value' => $result->uts, "disabled" => ""]);
            $student[] = form_input(["type"=> "number","name"=>'tugas', "class"=>'nilai_'.$ctr.' nilai_tugas form-control', 'value' => $result->tugas, "disabled" => ""]);
            $student[] = form_input(["type"=> "number","name"=>'uas', "class"=>'nilai_'.$ctr.' nilai_uas form-control', 'value' => $result->uas, "disabled" => ""]);
            $student[] = "<span class='nilai_".$ctr." nilai_akhir'>".$result->nilai_akhir."</span>";
            $student[] = "<span class='nilai_".$ctr." nilai_akhir_grade'>".$result->nilai_akhir_grade."</span>";
            $student[] = "<span class='nilai_".$ctr." nilai_grade'>".$result->nilai_grade."</span>";
            $student[] = "<span class='grade_tools'><button class='btn btn-primary grade_edit btn-sm' data-nrp='".$result->nrp."' data-value='".$ctr."'>Edit</button></span>";
            $students[] = $student;
        }
        return $students;
    }

    /**
     * @param $classId
     * @param null $orders
     * @return array
     */
    public function getDatatableScoreOfClass($classId,$orders=null){
        $results = $this->getAllScoreOfClass($classId,$orders);
        $students = [];
        $ctr = 0;
        foreach ($results as $result){
            $student = [];
            $student[] = ++$ctr;
            $student[] = $result->nrp;
            $student[] = $result->nama;
            $student[] = $result->uts;
            $student[] = $result->tugas;
			$student[] = $result->uas;
            $student[] = $result->nilai_akhir;
            $student[] = $result->nilai_akhir_grade;
            $student[] = $result->nilai_grade;
            $students[] = $student;
        }
        return $students;
    }

    /**
     * @param $classId
     * @return string
     */
    public function countAllStudentInClass($classId){
        $this->load->model('class_model');
        $class = $this->class_model->getAllClassConnected($classId);
        $this->db->where('km.mahasiswa_nrp = m.nrp');
        $this->db->where('m.status',1);
        $this->db->where('km.nilai_id = n.id');
        $this->db->where('(km.status_ambil = "A" or km.status_ambil = "d")');
        $this->db->where_in('km.kelas_id', $class);
        $this->db->from('kelas_mahasiswa km, mahasiswa m, nilai n');
        return $this->db->count_all_results();
    }

    public function countIPSforClass($classId){
        // NANCY

    }
    /**
     * @param $classId
     * @param $status
     * @param null $comment
     * @return mixed
     */
    public function changeConfirmationStatus($classId,$status ,$comment=null){
        $this->db->where('id',$classId);
        $this->db->set('status_konfirmasi',$status);
        if($comment != null){
        $this->db->set('komentar_kajur',$comment);
        }
        $this->db->update('kelas');

        // Insert Notifikasi

        // Kalau misalnya $status = confirmed maka hitung lagi IPS semua nilai

        return $this->db->affected_rows();
    }

    /**
     * @param $classId
     * @return array
     */
    public function getPercentageClass($classId){

        $this->db->where('kelas_id',$classId);
        $total = $this->db->get('kelas_mahasiswa')->num_rows();
        $percentage = [];
        $percentage["A"] = 0;
        $percentage["B"] = 0;
        $percentage["C"] = 0;
        $percentage["D"] = 0;
        $percentage["E"] = 0;
        foreach ($percentage as $key => $value){
            $this->db->from('kelas_mahasiswa km , nilai  n');
            $this->db->where('km.kelas_id',$classId);
            $this->db->where('km.nilai_id = n.id');
            $this->db->like('n.nilai_grade',$key);
            $num = $this->db->get()->num_rows();
            if ($num != 0) {
                $percentage[$key] = round($num / $total * 100, 2);
            }
        }
        return $percentage;
    }


    /**
     * @param $classId
     * @param null $orders
     * @return mixed
     */
    public function getAllScoreOfClass($classId, $orders=null){
        // Ambil Class Yang mereference $classId
        $this->load->model('confirmation_model');
        $class = $this->class_model->getAllClassConnected($classId);

        // Ambil Semua mahasiswa yang ada
        $this->db->select("km.mahasiswa_nrp as nrp, m.nama as nama, n.uts as uts, n.uas as uas, n.tugas as tugas, n.nilai_akhir as nilai_akhir, n.nilai_akhir_grade as nilai_akhir_grade, n.nilai_grade as nilai_grade");
        $this->db->where('km.mahasiswa_nrp = m.nrp');
        $this->db->where('m.status',1);
        $this->db->where('km.nilai_id = n.id');
        $this->db->where('(km.status_ambil = "A" or km.status_ambil = "d")');
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

    /**
     * @param $class_id
     * @param $updatedValue
     * @return mixed
     */
    public function updateAdditionalGrade($class_id, $updatedValue){
        $this->db->where('id',$class_id);
        $this->db->where('status_konfirmasi <',3);
        $this->db->set('tambahan_grade',$updatedValue);
        $this->db->set('tanggal_update','now()',false);
        $this->db->update('kelas');
        $success = $this->db->affected_rows();
        if ($success == 0){
            return 0;
        }
        // Update Seluruh Nilai Mahasiswa
        $this->load->model('class_model');
        $classes = $this->class_model->getAllClassConnected($class_id);
        $this->db->select('nilai_id');
        $this->db->where_in('kelas_id',$classes);
        $this->db->where('(status_ambil = "A" or status_ambil = "d")');
        $results = $this->db->get('kelas_mahasiswa')->result();

        // Untuk setiap Mahasiswa
        foreach ($results as $result){
            $gradeId = $result->nilai_id;
            $this->db->select('uts,uas,tugas');
            $this->db->where('id',$gradeId);
            $grade = $this->db->get('nilai')->row();
            // update
            $mark = $this->countTotalGrade($grade->uts,$grade->uas,$grade->tugas,$class_id);
            $this->db->where('id',$gradeId);
            $this->db->set('nilai_akhir',$mark[0]);
            $this->db->set('nilai_akhir_grade',$mark[1]);
            $this->db->set('nilai_grade',$mark[2]);
            $this->db->update('nilai');
        }
        return $success;
    }

    /**
     * @param $class_id
     * @param $percentUTS
     * @param $percentUAS
     * @param $percentHomework
     * @return mixed
     */
    public function updateGradePercentage($class_id,$percentUTS, $percentUAS, $percentHomework){
        $this->db->where('id',$class_id);
        $this->db->where('status_konfirmasi <',3);
        $this->db->set('persentase_uts',$percentUTS);
        $this->db->set('persentase_uas',$percentUAS);
        $this->db->set('persentase_tugas',$percentHomework);
        $this->db->set('tanggal_update','now()',false);
        $this->db->update('kelas');
        $success = $this->db->affected_rows();
        if ($success == 0){
            return 0;
        }
        // Update Seluruh Nilai Mahasiswa
        $this->load->model('class_model');
        $classes = $this->class_model->getAllClassConnected($class_id);
        $this->db->select('nilai_id');
        $this->db->where_in('kelas_id',$classes);
        $this->db->where('(status_ambil = "A" or status_ambil = "d")');
        $results = $this->db->get('kelas_mahasiswa')->result();

        // Untuk setiap Mahasiswa
        foreach ($results as $result){
            $gradeId = $result->nilai_id;
            $this->db->select('uts,uas,tugas');
            $this->db->where('id',$gradeId);
            $grade = $this->db->get('nilai')->row();
            // update
            $mark = $this->countTotalGrade($grade->uts,$grade->uas,$grade->tugas,$class_id);
            $this->db->where('id',$gradeId);
            $this->db->set('nilai_akhir',$mark[0]);
            $this->db->set('nilai_akhir_grade',$mark[1]);
            $this->db->set('nilai_grade',$mark[2]);
            $this->db->update('nilai');
        }
        return  $success;
    }


}