<?php

class Vendor extends CI_Model {


//===========creat vendor================
    public function create($table, $data){
        $exe = $this->db->insert($table,$data);
        return $exe;
    }

//=========== end creat vendor================

//=========== edit vendor================
public function edit($table, $id, $data){
    $exe = $this->db->set($data);
    $this->db->where($id);
    $this->db->update($table);
    return $exe;
}

//=========== edit vendor================


//=========== hapus vendor================

public function hapus($table, $data){
    $exe = $this->db->delete($table,$data);
    return $exe;
}

//=========== end hapus vendor================

//===========count all row on table================
    public function count_all($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }
//===========end count all row on table================



    public function get_alldata($table,$perpage,$offset){
       
        if ($perpage != -1) {
            $this->db->limit(10,$offset);
        $result = $this->db->get($table)->result();
        return $result;
        }
        
    }

    public function search_alldata($table,$perpage,$offset,$search){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('NAMA_VENDOR',$search,'both');
        
        
        $this->db->limit(10,$offset);
        $result = $this->db->get()->result();
        return $result;
    }

    public function count_search($table, $cari){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('NAMA_VENDOR',$cari,'both');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function cari_vendor($keyword){
        //$this->db->select('*');
       // $this->db->from('TB_VENDOR');
       // $this->db->like('NAMA_VENDOR',$keyword,'both');
       // $this->db->limit(6,0);
        $query ="SELECT * FROM TB_VENDOR WHERE NAMA_VENDOR like '%" . $keyword. "%' ORDER BY NAMA_VENDOR LIMIT 0,6";
        //$query ="SELECT * FROM TB_VENDOR ORDER BY NAMA_VENDOR LIMIT 0,6";
        $result = $this->db->query($query)->result();
        return $result;
    }

    public function select_all($table){
        $result = $this->db->get($table)->result();
        return $result;
    }
    
}
