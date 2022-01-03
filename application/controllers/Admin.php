<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('verif');
        $this->verif->cek_session('admin');
        $this->load->model('login');
    }

    public function index(){
       
            $this->load->view('admin/home');
        
    }
//========menambah user ke tabel user=========
    public function add_user(){
        $user = $this->input->post('user_name');
        $pass = sha1($this->input->post('pass'));
        $level = $this->input->post('level');

        $data_user = array(
            'NAMA_USER'=> $user,
            'PASSWORD' => $pass,
            'LEVEL_USER' => $level
        );

        $hasil = $this->login->insert_data('TB_USER', $data_user);
        if ($hasil) {
            echo "success";
        }else{
            echo "gagal";
        }
    }
//========end menambah user ke tabel user======

//========menghapus user==========

public function hapus_user(){
    $id = $this->input->post('id');
    
    $data_user= array(
        'ID_USER'=> $id
    );

    $hasil = $this->login->hapus_data('TB_USER', $data_user);
    if ($hasil) {
      echo "success";
    } else {
        echo "gagal";
    }
}


//========end menghapus user==========

//========end edit user==========

public function edit_user(){
    $id = array('ID_USER' => $this->input->post('id')
        );
    $data = array(
        'LEVEL_USER'=> $this->input->post('level')
    );

    $hasil = $this->login->update_data('TB_USER',$id, $data);

    if ($hasil) {
       echo "success";
    }else{
        echo "gagal";
    }
}

//========end edit user==========


//======Menampilkan tabel user=====================================
    public function datatable_user(){
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $record = $this->login->count_all('TB_USER');
        $totalFiltered = $record;
        
        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->login->get_alldata('TB_USER',$limit,$start);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $posts =  $this->login->search_alldata('TB_USER',$limit,$start,$search);

            $totalFiltered = $this->login->count_search('TB_USER',$search);
        }
        $no = $start;
        $data = array();
        if(!empty($posts))
        {
            
                foreach ($posts as $post)
            {
                $no++;

                
                $nestedData['no'] = "";
                $nestedData['ID_USER'] = $post->ID_USER;
                $nestedData['NAMA_USER'] = $post->NAMA_USER;
                $nestedData['PASSWORD'] = $post->PASSWORD;
                $nestedData['LEVEL_USER'] = $post->LEVEL_USER;
               
                
                
                
                $data[] = $nestedData;

            } 
            
            
        }

        $json_data = array(
            'draw'            => intval($this->input->post('draw')),  
            'recordsTotal'    => intval($record),  
            'recordsFiltered' => intval($totalFiltered), 
            'data'            => $data   
            );
    
        echo json_encode($json_data); 
    }
//==========End menampilkan tabel user==========================
}