<?php

class Login extends CI_Model{
//=========check user for login==============
    function check($username, $password){
        $query = $this->db->get_where('TB_USER', array('NAMA_USER' => $username, 'PASSWORD' => $password), 1);
        if ($query->num_rows()==1) {
           return $query->result();
        } else{
            return false;
        }
    }
//==========end check user for login==============
    function create($table, $data){
        $exe = $this->db->insert($table,$data);
        return $exe;

    }

//==========insert data to table============
    public function insert_data($table, $data){
        $exe = $this->db->insert($table,$data);
        return $exe;
    }
//==========end insert data to table============

//==========delete data from user==============

    public function hapus_data($table, $data){
    $exe = $this->db->delete($table,$data);
    return $exe;
}

//==========end delete data from table============

//==========update data from table==============

public function update_data($table,$id, $data){
    $exe = $this->db->set($data);
            $this->db->where($id);
            $this->db->update($table);
    return $exe;
}

//==========end update data from table============

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
        $result = $this->db->get('TB_USER')->result();
        return $result;
        }
        
    }

    public function search_alldata($table,$perpage,$offset,$search){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('NAMA_USER',$search,'both');
        
        
        $this->db->limit(10,$offset);
        $result = $this->db->get()->result();
        return $result;
    }

    public function count_search($table, $cari){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('NAMA_USER',$cari,'both');
        $query = $this->db->get();
        return $query->num_rows();
    }
}