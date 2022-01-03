<?php

class Order extends CI_Model{
    public function simpan($table, $data){
        $exe = $this->db->insert($table,$data);
        return $exe;
    }

    public function count_all($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function get_alldata($table,$perpage,$offset){
       
        if ($perpage != -1) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->join('TB_PERMINTAAN','TB_PERMINTAAN.ID_PERMINTAAN = TB_ORDER.ID_PERMINTAAN');
            $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PERMINTAAN.ID_BARANG');
            $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');
            $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
        }
        
    }

    public function search_alldata($table,$perpage,$offset,$search){
        
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('TB_PERMINTAAN','TB_PERMINTAAN.ID_PERMINTAAN = TB_ORDER.ID_PERMINTAAN');
        $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PERMINTAAN.ID_BARANG');
        $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');
        $this->db->like('TB_BARANG.NAMA_BARANG',$search,'both');
        
        
        $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
    }

    public function count_search($table, $cari){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('TB_PERMINTAAN','TB_PERMINTAAN.ID_PERMINTAAN = TB_ORDER.ID_PERMINTAAN');
        $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PERMINTAAN.ID_BARANG');
        $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');
        $this->db->like('TB_BARANG.NAMA_BARANG',$cari,'both');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_data_order($table, $data,$limit){
        $this->db->select('*');
        $this->db->from($table);
         $this->db->where($data);
         $this->db->limit($limit,0);
        $result = $this->db->get()->result();
        return $result;
    }

    public function update($table, $id, $data){
        $exe = $this->db->set($data);
        $this->db->where($id);
        $this->db->update($table);
        return $exe;
    }

    public function count_all_where($table)
    {
        $this->db->from($table);
        $this->db->where('STATUS_ORDER IS NULL',null,false);
        return $this->db->count_all_results();
    }

    public function get_alldata_where($table,$perpage,$offset){
       
        if ($perpage != -1) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->join('TB_PERMINTAAN','TB_PERMINTAAN.ID_PERMINTAAN = TB_ORDER.ID_PERMINTAAN');
            $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PERMINTAAN.ID_BARANG');
            $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');
            $this->db->where('TB_ORDER.STATUS_ORDER IS NULL',null,false);
            $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
        }
        
    }

    public function search_alldata_where($table,$perpage,$offset,$search){
        
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('TB_PERMINTAAN','TB_PERMINTAAN.ID_PERMINTAAN = TB_ORDER.ID_PERMINTAAN');
        $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PERMINTAAN.ID_BARANG');
        $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');
        $this->db->where('TB_ORDER.STATUS_ORDER IS NULL',null,false);
        $this->db->like('TB_BARANG.NAMA_BARANG',$search,'both');
        
        
        $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
    }

    public function count_search_where($table, $cari){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('TB_PERMINTAAN','TB_PERMINTAAN.ID_PERMINTAAN = TB_ORDER.ID_PERMINTAAN');
        $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PERMINTAAN.ID_BARANG');
        $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');
        $this->db->where('TB_ORDER.STATUS_ORDER IS NULL',null,false);
        $this->db->like('TB_BARANG.NAMA_BARANG',$cari,'both');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function select_data($table, $id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($id);
        $this->db->limit(1,0);
        $result = $this->db->get()->result();
        return $result;
    }

    public function delete_order($table,$data){
        $exe = $this->db->delete($table,$data);
        return $exe;
    }

    public function count_all_approve($table)
    {
        $this->db->from($table);
        $this->db->where('STATUS_ORDER','approved');
        return $this->db->count_all_results();
    }

    public function get_alldata_approve($table,$perpage,$offset){
       
        if ($perpage != -1) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->join('TB_PERMINTAAN','TB_PERMINTAAN.ID_PERMINTAAN = TB_ORDER.ID_PERMINTAAN');
            $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PERMINTAAN.ID_BARANG');
            $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');
            $this->db->where('TB_ORDER.STATUS_ORDER','approved');
            $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
        }
        
    }

    public function search_alldata_approve($table,$perpage,$offset,$search){
        
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('TB_PERMINTAAN','TB_PERMINTAAN.ID_PERMINTAAN = TB_ORDER.ID_PERMINTAAN');
        $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PERMINTAAN.ID_BARANG');
        $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');
        $this->db->where('TB_ORDER.STATUS_ORDER','approved');
        $this->db->like('TB_BARANG.NAMA_BARANG',$search,'both');
        
        
        $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
    }

    public function count_search_approve($table, $cari){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('TB_PERMINTAAN','TB_PERMINTAAN.ID_PERMINTAAN = TB_ORDER.ID_PERMINTAAN');
        $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PERMINTAAN.ID_BARANG');
        $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');
        $this->db->where('TB_ORDER.STATUS_ORDER','approved');
        $this->db->like('TB_BARANG.NAMA_BARANG',$cari,'both');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function select_order($table, $id){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('TB_PERMINTAAN','TB_PERMINTAAN.ID_PERMINTAAN = TB_ORDER.ID_PERMINTAAN');
        $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PERMINTAAN.ID_BARANG');
        $this->db->join('TB_VENDOR','TB_VENDOR.ID_VENDOR = TB_BARANG.ID_VENDOR');
        $this->db->where($id);
        $this->db->limit(1,0);
        $result = $this->db->get()->result();
        return $result;
    }
}