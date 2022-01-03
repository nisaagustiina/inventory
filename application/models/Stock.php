<?php

class Stock extends CI_Model{
    public function create($table, $data){
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
            $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_STOCK.ID_BARANG');
            $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
        }
        
    }

    public function search_alldata($table,$perpage,$offset,$search){
        
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_STOCK.ID_BARANG');
        $this->db->like('TB_BARANG.NAMA_BARANG',$search,'both');
        
        
        $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
    }

    public function count_search($table, $cari){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_STOCK.ID_BARANG');
        $this->db->like('TB_BARANG.NAMA_BARANG',$cari,'both');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function update($table, $id, $data){
        $exe = $this->db->set($data);
        $this->db->where($id);
        $this->db->update($table);
        return $exe;
    }

    public function get_alldata_where($table,$id,$perpage,$offset){
       
        if ($perpage != -1) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_STOCK.ID_BARANG');
            $this->db->where($id);
            $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
        }
        
    }

    public function get_alldata_out($table,$perpage,$offset){
       
        if ($perpage != -1) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PENGELUARAN.ID_BARANG');
            $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
        }
        
    }

    public function search_alldata_out($table,$perpage,$offset,$search){
        
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PENGELUARAN.ID_BARANG');
        $this->db->like('TB_BARANG.NAMA_BARANG',$search,'both');
        
        
        $this->db->limit($perpage,$offset);
        $result = $this->db->get()->result();
        return $result;
    }

    public function count_search_out($table, $cari){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('TB_BARANG','TB_BARANG.ID_BARANG = TB_PENGELUARAN.ID_BARANG');
        $this->db->like('TB_BARANG.NAMA_BARANG',$cari,'both');
        $query = $this->db->get();
        return $query->num_rows();
    }
}