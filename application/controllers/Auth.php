<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('login');
    }

    function index(){
        if ($this->session->userdata('login_status') != TRUE) {
           $this->load->view('page-login');
        } else {
            if ($this->session->userdata('level_user')=='admin') {
                redirect (base_url('admin'));
            }elseif ($this->session->userdata('level_user')=='purchasing'){
                redirect (base_url('purchasing'));
            }elseif ($this->session->userdata('level_user')=='warehouse'){
                redirect (base_url('warehouse'));
            }elseif ($this->session->userdata('level_user')=='manager') {
                redirect (base_url('manager'));
            }
           
        }
        
    }

    function login(){
        $user = trim($this->input->post('user'));
        $pass = sha1($this->input->post('password'));

        $check = $this->login->check($user, $pass);

        if ($check) {
            $sess_array = array();
            foreach ($check as $row) {
                $sess_array = array('nama'=>$row->NAMA_USER,'id_user'=>$row->ID_USER,'level_user'=>$row->LEVEL_USER, 'login_status'=>TRUE,);
                $this->session->set_userdata($sess_array);}

                echo "success";

            }else {
                echo "gagal";
        }
        
    }

    function logout(){
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('level_user');
        $this->session->unset_userdata('login_status');

        redirect('');
    }
}