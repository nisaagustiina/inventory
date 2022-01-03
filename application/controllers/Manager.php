<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Manager extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('verif');
        $this->verif->cek_session('manager');
        $this->load->model('vendor');
    }

    public function index(){
       
            $this->load->view('manager/home');
    }
    public function approval(){
       
        $this->load->view('manager/approve');
}

public function report(){
       
    $this->load->view('manager/report');
}

//============menampilkan order===============
public function tampil_order(){
    $this->load->model('order');

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    
    $record = $this->order->count_all_where('TB_ORDER');
    $totalFiltered = $record;
    
    
    if(empty($this->input->post('search')['value']))
    {            
        $posts = $this->order->get_alldata_where('TB_ORDER',$limit,$start);
    }
    else {
        $search = $this->input->post('search')['value']; 

        $posts =  $this->order->search_alldata_where('TB_ORDER',$limit,$start,$search);

        $totalFiltered = $this->oerder->count_search_where('TB_ORDER',$search);
    }
    $no = $start;
    $data = array();
    if(!empty($posts))
    {
        
            foreach ($posts as $post)
        {
            $no++;

            
            $nestedData['no'] = "";
            $nestedData['ID_ORDER'] = $post->ID_ORDER;
            $nestedData['TANGGAL_ORDER'] = $post->TANGGAL_ORDER;
            $nestedData['NAMA_VENDOR'] = $post->NAMA_VENDOR;
            $nestedData['NAMA_BARANG'] = $post->NAMA_BARANG;
            $nestedData['QTY_BARANG'] = $post->QTY_BARANG;
            $nestedData['SATUAN'] = $post->SATUAN;
            $nestedData['HARGA_BARANG'] = $post->HARGA_BARANG;
            $nestedData['HARGA_TOTAL'] = $post->HARGA_TOTAL;
            $nestedData['CURRENCY'] = $post->CURRENCY;
            $nestedData['TANGGAL_KIRIM'] = $post->TANGGAL_KIRIM;
            $nestedData['STATUS_ORDER'] = $post->STATUS_ORDER;
            
            
            
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
//===============end menampilkan barang===================

//=================proses approve=====================
public function approve_order(){
    $this->load->model('permintaan');
    $this->load->model('order');
    $myArray = $_REQUEST['idarray'];
    $length = count($myArray);
    $ok = 0;
    for ($i=0; $i <$length; $i++) { 
        
       $id = array('ID_ORDER'=> $myArray[$i]);
        $data = array(
            'STATUS_ORDER'=> 'approved'
        );

        
        $req = $this->order->get_data_order('TB_ORDER',$id,1);
        if ($req) {
           foreach ($req as $key) {
            $id_req = array(
                'ID_PERMINTAAN'=> $key->ID_PERMINTAAN
               
            );
            $data_req = array(
                'STATUS_PERMINTAAN'=> 'ordered'
            );
            $simpan = $this->order->update('TB_ORDER', $id, $data);
            if ($simpan) {
                $hasil = $this->permintaan->edit('TB_PERMINTAAN',$id_req, $data_req);
               if ($hasil) {
                  $ok= 1;
               }
               }else{
                   echo "gagal simpan";
               }
           }
          
         
        }else{
            echo "permintaan tidak ada";
        }
      
    }
    if ($ok == 1) {
        echo "success";
    }else{
        echo "gagal";
    }
   
}
//=================proses approve=====================

}