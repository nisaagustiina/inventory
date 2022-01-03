<?php

class Barang extends CI_Model{
//===========count all row on table================
    public function count_all($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }
//===========end count all row on table================

//============simpan barang===================

public function simpan($table, $data){
    $exe = $this->db->insert($table,$data);
    return $exe;
}

//============ end simpan barang===================

//============edit barang==================
public function edit($table, $id, $data){
    $exe = $this->db->set($data);
    $this->db->where($id);
    $this->db->update($table);
    return $exe;
}

//=============end edit barang==============

//==============hapus barang================
public function hapus($table, $data){
    $exe = $this->db->delete($table,$data);
    return $exe;
}

//==============end hapus barang================

    public function get_alldata($table,$perpage,$offset){
       
        if ($perpage != -1) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');

            $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
        }
        
    }

    public function search_alldata($table,$perpage,$offset,$search){
        
        $this->db->select('*');
        $this->db->from($table);
         $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');
        $this->db->like('NAMA_BARANG',$search,'both');
        
        
        $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
    }

    public function count_search($table, $cari){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('NAMA_BARANG',$cari,'both');
        $query = $this->db->get();
        return $query->num_rows();
    }
}