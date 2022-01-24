<?php
class m_login extends CI_Model {

    function get_department_by_id($id) {
        $query = $this->db->where('id_department',$id);
        $q = $this->db->get('department');
        $data = $q->result();
        
        return $data;
    }
        
    function prosesLogin($username){
        $this->db->where('username',$username);
        $this->db->where('deleted',0);
        
        return $this->db->get('user')->row();
    }

    function checkEmail($email){
        $this->db->where('email',$email);
        
        return $this->db->get('user')->row();
    }
    
    function viewDataByID($username){
        $query = $this->db->where('username',$username);
        $q = $this->db->get('user');
        $data = $q->result();
        
        return $data;
    }

    function viewDataByIDemail($email){
        $query = $this->db->where('email',$email);
        $q = $this->db->get('user');
        $data = $q->result();
        
        return $data;
    }

    function checkDataUsrbyID($id,$pass){
        $this->db->where('id_user',$id);
        $this->db->where('password',$pass);
        
        return $this->db->get('user')->row();
    }

    function changepassUser($id,$data){
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);

        return TRUE;
    }

    function adduser($data){
        $this->db->insert('user', $data);

        return TRUE;
    }

    function prosesLoginKaryawan($nik){
        $this->db->where('nik',$nik);
        $this->db->where('deleted',0);
        
        return $this->db->get('karyawan')->row();
    }

    function get_section_by_id_secton($id_section){
        $query = $this->db->where('id_section',$id_section);
        $q = $this->db->get('department_section');
        $data = $q->result();
        
        return $data;
    }

    function viewDataByNIK($nik){
        $query = $this->db->where('nik',$nik);
        $q = $this->db->get('karyawan');
        $data = $q->result();
        
        return $data;
    }

    function get_position_by_id($id_position){
        $query = $this->db->where('id_position',$id_position);
        $q = $this->db->get('position');
        $data = $q->result();
        
        return $data;
    }
}

?>