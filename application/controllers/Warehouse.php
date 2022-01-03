<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Warehouse extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('verif');
        $this->verif->cek_session('warehouse');
        $this->load->model('vendor');
    }
    
    public function index(){
        
            $this->load->view('warehouse/home');
        
    }

    public function incoming(){
        $this->load->view('warehouse/incoming');
    }

    public function stock(){
        $this->load->view('warehouse/stock');
    }

    public function request(){
        $this->load->view('warehouse/request');
    }

    public function report(){
        $this->load->view('warehouse/report');
    }

    public function out(){
        $this->load->view('warehouse/out');
    }
//=============menampilkan daftar barang============
    public function tampil_barang(){
        $this->load->model('barang');
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        
        $record = $this->barang->count_all('TB_BARANG');
        $totalFiltered = $record;
        
        if(empty($this->input->post('search')['value']))
        {            
            $posts = $this->barang->get_alldata('TB_BARANG',$limit,$start);
        }
        else {
            $search = $this->input->post('search')['value']; 
    
            $posts =  $this->barang->search_alldata('TB_BARANG',$limit,$start,$search);
    
            $totalFiltered = $this->barang->count_search('TB_BARANG',$search);
        }
        $no = $start;
        $data = array();
        if(!empty($posts))
        {
            
                foreach ($posts as $post)
            {
                $no++;
    
                
                $nestedData['no'] = "";
                $nestedData['ID_BARANG'] = $post->ID_BARANG;
                $nestedData['KODE_BARANG'] = $post->KODE_BARANG;
                $nestedData['NAMA_BARANG'] = $post->NAMA_BARANG;
                $nestedData['SATUAN'] = $post->SATUAN;
                $nestedData['HARGA_BARANG'] = $post->HARGA_BARANG;
                $nestedData['CURRENCY'] = $post->CURRENCY;
                $nestedData['NAMA_VENDOR'] = $post->NAMA_VENDOR;
                
                
                
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
//============= end menampilkan daftar barang============

public function tampil_request(){
    $this->load->model('permintaan');
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    
    $record = $this->permintaan->count_all('TB_PERMINTAAN');
    $totalFiltered = $record;
    
    if(empty($this->input->post('search')['value']))
    {            
        $posts = $this->permintaan->get_alldata('TB_PERMINTAAN',$limit,$start);
    }
    else {
        $search = $this->input->post('search')['value']; 

        $posts =  $this->permintaan->search_alldata('TB_PERMINTAAN',$limit,$start,$search);

        $totalFiltered = $this->permintaan->count_search('TB_PERMINTAAN',$search);
    }
    $no = $start;
    $data = array();
    if(!empty($posts))
    {
        
            foreach ($posts as $post)
        {
            $no++;

            
            $nestedData['no'] = "";
            $nestedData['ID_PERMINTAAN'] = $post->ID_PERMINTAAN;
            $nestedData['TANGGAL_PERMINTAAN'] = $post->TANGGAL_PERMINTAAN;
            $nestedData['NAMA_BARANG'] = $post->NAMA_BARANG;
            $nestedData['QTY_BARANG'] = $post->QTY_BARANG;
            $nestedData['SATUAN'] = $post->SATUAN;
            $nestedData['TANGGAL_KIRIM'] = $post->TANGGAL_KIRIM;
            $nestedData['STATUS_PERMINTAAN'] = $post->STATUS_PERMINTAAN;
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
//==============simpan permintaan============
public function simpan_permintaan(){
    $this->load->model('permintaan');
    $data = array(
        'ID_BARANG' => $this->input->post('id_barang'),
        'QTY_BARANG' => $this->input->post('qty'),
        'TANGGAL_KIRIM' => $this->input->post('tgl_kirim'),
        'TANGGAL_PERMINTAAN' => date('Y-m-d')
        
    );

    $hasil = $this->permintaan->simpan('TB_PERMINTAAN', $data);
    if ($hasil) {
        echo "success";
    }else{
        echo "gagal";
    }

}
//================end simpan permintaan=============

//================edit permintaan==================
public function edit_permintaan(){
    $this->load->model('permintaan');
    $id = array('ID_PERMINTAAN' => $this->input->post('id')
        );

        $data = array(
            'QTY_BARANG' => $this->input->post('qty'),
            'TANGGAL_KIRIM' => $this->input->post('tgl_kirim')
            
        );

        $hasil = $this->permintaan->edit('TB_PERMINTAAN',$id, $data);

        if ($hasil) {
           echo "success";
        }else{
            echo "gagal";
        }
    }
//================edit permintaan==================

//================hapus permintaan=================
public function hapus_permintaan(){
    $this->load->model('permintaan');
    $id = array('ID_PERMINTAAN'=> $this->input->post('id'));

    $hasil = $this->permintaan->hapus('TB_PERMINTAAN', $id);
    if ($hasil) {
      echo "success";
    } else {
        echo "gagal";
    }
}
//================end hapus permintaan=============

//============menampilkan order===============
public function tampil_order(){
    $this->load->model('order');

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    
    $record = $this->order->count_all_approve('TB_ORDER');
    $totalFiltered = $record;
    
    if(empty($this->input->post('search')['value']))
    {            
        $posts = $this->order->get_alldata_approve('TB_ORDER',$limit,$start);
    }
    else {
        $search = $this->input->post('search')['value']; 

        $posts =  $this->order->search_alldata_approve('TB_ORDER',$limit,$start,$search);

        $totalFiltered = $this->oerder->count_search_approve('TB_ORDER',$search);
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
//===============end menampilkan order===================

//============menampilkan incoming===============
public function tampil_incoming(){
    $this->load->model('incoming');

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    
    $record = $this->incoming->count_all('TB_PENERIMAAN');
    $totalFiltered = $record;
    
    if(empty($this->input->post('search')['value']))
    {            
        $posts = $this->incoming->get_alldata('TB_PENERIMAAN',$limit,$start);
    }
    else {
        $search = $this->input->post('search')['value']; 

        $posts =  $this->incoming->search_alldata('TB_PENERIMAAN',$limit,$start,$search);

        $totalFiltered = $this->incoming->count_search('TB_PENERIMAAN',$search);
    }
    $no = $start;
    $data = array();
    if(!empty($posts))
    {
        
            foreach ($posts as $post)
        {
            $no++;

            
            $nestedData['no'] = "";
            $nestedData['ID_PENERIMAAN'] = $post->ID_PENERIMAAN;
            $nestedData['TANGGAL_TERIMA'] = $post->TANGGAL_TERIMA;
            $nestedData['NAMA_VENDOR'] = $post->NAMA_VENDOR;
            $nestedData['NAMA_BARANG'] = $post->NAMA_BARANG;
            $nestedData['QTY_AWAL'] = $post->QTY_AWAL;
            $nestedData['QTY_MASUK'] = $post->QTY_MASUK;
            $nestedData['QTY_STOCK'] = $post->QTY_STOCK;
            $nestedData['SATUAN'] = $post->SATUAN;
            $nestedData['STAFF_GUDANG'] = $post->STAFF_GUDANG;
            
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
//===============end menampilkan incoming===================

//================simpan incoming=======================
public function simpan_incoming(){
    $this->load->model('incoming');
    $this->load->model('order');
    $this->load->model('stock');

    $id_order= $this->input->post('id');
    $qty_masuk =$this->input->post('qty');

    $order = $this->order->select_order('TB_ORDER', array('ID_ORDER'=>$id_order));
    $id_barang =0;
    $qty_awal =0;
    $id_permintaan=0;
    foreach ($order as $key) {
       $id_barang = array('ID_BARANG'=>$key->ID_BARANG);
       $id_permintaan= array('ID_PERMINTAAN'=>$key->ID_PERMINTAAN);

       $data_order = array('STATUS_ORDER'=>'completed');
    $data_permintaan = array('STATUS_PERMINTAAN'=>'completed');

    $stock = $this->order->select_data('TB_STOCK',$id_barang);
    if (!$stock) {
       
        
        $data = array(
            'TANGGAL_TERIMA' => date('Y-m-d'),
            'ID_ORDER' => $this->input->post('id'),
            'QTY_MASUK' => $qty_masuk,
            'QTY_AWAL' => 0,
            'QTY_STOCK' => $qty_masuk,
            'STAFF_GUDANG' => $this->session->userdata('nama')
        );
        $data_stock = array(
            'ID_BARANG'=> $key->ID_BARANG,
            'END_STOCK'=> $this->input->post('qty')
        );
       
       
       //echo $id_barang;
        $simpan = $this->incoming->simpan('TB_PENERIMAAN', $data);
       
        if ($simpan) {
            $in = $this->stock->create('TB_STOCK', $data_stock);
            $set = $this->order->update('TB_ORDER',array('ID_ORDER'=>$id_order), $data_order);
            $z =$this->order->update('TB_PERMINTAAN',$id_permintaan, $data_permintaan);
            echo "success";
        }else{
            echo "gagal simpan";
       }
    }else{
        foreach ($stock as $j) {
           $qty_awal = $j->END_STOCK;
        }
        $qty_stock = $qty_awal + $qty_masuk;
        $data = array(
            'TANGGAL_TERIMA' => date('Y-m-d'),
            'ID_ORDER' => $this->input->post('id'),
            'QTY_MASUK' => $qty_masuk,
            'QTY_AWAL' => $qty_awal,
            'QTY_STOCK' => $qty_stock,
            'STAFF_GUDANG' => $this->session->userdata('nama')
        );

        $data_stock = array(
            'END_STOCK'=> $qty_stock
        );

       

        $simpan = $this->incoming->simpan('TB_PENERIMAAN', $data);
        if ($simpan) {
           $tambah = $this->incoming->update('TB_STOCK',$id_barang, $data_stock);
           $set = $this->order->update('TB_ORDER',array('ID_ORDER'=>$id_order), $data_order);
            $z =$this->order->update('TB_PERMINTAAN',$id_permintaan, $data_permintaan);
          echo "success";
           
        }else{
            echo "gagal simpan";
        }
    }
    }
}
//================ end simpan incoming=======================

//============menampilkan stock===============
public function tampil_stock(){
    $this->load->model('stock');

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    
    $record = $this->stock->count_all('TB_STOCK');
    $totalFiltered = $record;
    
    if(empty($this->input->post('search')['value']))
    {            
        $posts = $this->stock->get_alldata('TB_STOCK',$limit,$start);
    }
    else {
        $search = $this->input->post('search')['value']; 

        $posts =  $this->stock->search_alldata('TB_STOCK',$limit,$start,$search);

        $totalFiltered = $this->stock->count_search('TB_STOCK',$search);
    }
    $no = $start;
    $data = array();
    if(!empty($posts))
    {
        
            foreach ($posts as $post)
        {
            $no++;

            
            $nestedData['no'] = "";
            $nestedData['ID_STOCK'] = $post->ID_STOCK;
            $nestedData['ID_BARANG'] = $post->ID_BARANG;           
            $nestedData['NAMA_BARANG'] = $post->NAMA_BARANG;          
            $nestedData['QTY_STOCK'] = $post->END_STOCK;
            $nestedData['SATUAN'] = $post->SATUAN;
            $nestedData['MIN_STOCK'] = $post->MIN_STOCK;
            $nestedData['STATUS_STOCK'] = $post->STATUS_STOCK;
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
//===============end menampilkan order===================

//================pengeluaran barang====================
public function pengeluaran(){
    $this->load->model('stock');

    $id = $this->input->post('id');
    $qty = $this->input->post('qty');

    $id_stock = array('TB_STOCK.ID_STOCK'=>$id);
    $beg_stock=0;
    $satuan=0;
    $stock = $this->stock->get_alldata_where('TB_STOCK',$id_stock,1,0);
    foreach ($stock as $key) {

       $beg_stock = $key->END_STOCK;
       $satuan = $key->SATUAN;
       $id_barang= $key->ID_BARANG;
    }

    $update = array(
        'END_STOCK' => $beg_stock - $qty
    );

    $data = array(
        'TANGGAL_KELUAR'=> date('Y-m-d'),
        'ID_BARANG'=> $id_barang,
        'BEG_QTY'=> $beg_stock,
        'QTY_KELUAR'=> $qty,
        'END_QTY'=> ($beg_stock - $qty),
        'SATUAN'=> $satuan,
        'STAFF_GUDANG'=> $this->session->userdata('nama')
    );

    $kurang = $this->stock->update('TB_STOCK',$id_stock,$update);
    if ($kurang) {
        $out = $this->stock->create('TB_PENGELUARAN', $data);
        echo "success";
    }else{
        echo "gagal simpan";
    }

}
//=================end pengeluaran barang===============

//============menampilkan out===============
public function tampil_out(){
    $this->load->model('stock');

    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    
    $record = $this->stock->count_all('TB_PENGELUARAN');
    $totalFiltered = $record;
    
    if(empty($this->input->post('search')['value']))
    {            
        $posts = $this->stock->get_alldata_out('TB_PENGELUARAN',$limit,$start);
    }
    else {
        $search = $this->input->post('search')['value']; 

        $posts =  $this->stock->search_alldata_out('TB_PENGELUARAN',$limit,$start,$search);

        $totalFiltered = $this->stock->count_search_out('TB_PENGELUARAN',$search);
    }
    $no = $start;
    $data = array();
    if(!empty($posts))
    {
        
            foreach ($posts as $post)
        {
            $no++;

            
            $nestedData['no'] = "";
            $nestedData['ID_PENGELUARAN'] = $post->ID_PENGELUARAN;
            $nestedData['TANGGAL_KELUAR'] = $post->TANGGAL_KELUAR;
            $nestedData['ID_BARANG'] = $post->ID_BARANG;
            $nestedData['NAMA_BARANG'] = $post->NAMA_BARANG;
            $nestedData['QTY_AWAL'] = $post->BEG_QTY;
            $nestedData['QTY_OUT'] = $post->QTY_KELUAR;
            $nestedData['END_QTY'] = $post->END_QTY;
            $nestedData['SATUAN'] = $post->SATUAN;
            $nestedData['STAFF_GUDANG'] = $post->STAFF_GUDANG;
            
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
//===============end menampilkan out===================

}