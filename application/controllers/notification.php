<?php

class Notification extends CI_Controller{

    public function __construct(){
        parent::__construct();
    }

    public function get(){
        if($this->session->userdata('username')){
            $limit = $this->input->post('limit');
            $start = $this->input->post('start');
            $results = $this->notifikasi_model->getNotification($limit, $start);
            foreach ($results as $result){
                echo '<a class="content" href="#">
                        <div class="notification-item">
                        <small class="pull-right">'.date_format(date_create_from_format('Y-m-d H:i:s',$result->tanggal_create),'d M Y').'</small><h4 class="item-title">'.$result->judul.' dari '.$result->nama_asal.'</h4>
                        </div>
						</a>';
            }
        }
    }
}