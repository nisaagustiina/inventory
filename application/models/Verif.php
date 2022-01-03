<?php

class Verif extends CI_Model{

    public function cek_session($level){
        if ($this->session->userdata('login_status') != TRUE) {
            redirect(base_url());
        }elseif ($this->session->userdata('level_user') != $level){
            redirect(base_url());
        }
    }
   
}