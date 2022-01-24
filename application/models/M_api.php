<?php
class m_api extends CI_Model {
        
    function update_public_reader($data){
        $this->db->where('id_public_reader_rfid', 1);
        $this->db->update('public_reader_rfid', $data);

        return ($this->db->affected_rows() > 0);
    }

    function getkey(){
        $query = $this->db->where('id_key',1);
        $q = $this->db->get('secret_key');
        $data = $q->result();
        
        return $data;
    }

    function checkRFID($rfid){
        $query = $this->db->where('uid_rfid',$rfid);
        $query = $this->db->where('deleted',0);
        $q = $this->db->get('karyawan');
        $data = $q->result();
        
        return $data;
    }

    function getdevice($iddev){
        $query = $this->db->where('id_room',$iddev);
        $q = $this->db->get('room');
        $data = $q->result();
        
        return $data;
    }

    function insert_log($data){
        $this->db->insert('log', $data);
       return TRUE;
    }

    function get_department_by_id($id) {
        $query = $this->db->where('id_department',$id);
        $q = $this->db->get('department');
        $data = $q->result();
        
        return $data;
    }

    function get_section_by_id($id) {
        $query = $this->db->where('id_section',$id);
        $q = $this->db->get('department_section');
        $data = $q->result();
        
        return $data;
    }

    function remarks_room($iddev,$id_karyawan,$waktuambil){
        $query = $this->db->where('id_room',$iddev);
        $query = $this->db->where('id_karyawan',$id_karyawan);
        $query = $this->db->where('waktu_remarks >= ',time()-$waktuambil);
        $this->db->order_by('id_remarks_room', 'desc');
        $this->db->limit(1);
        $q = $this->db->get('remarks_room');
        $data = $q->result();
        
        return $data;
    }

    function getFreeAccessbyIDkaryawan($id_karyawan){
        $query = $this->db->where('id_karyawan',$id_karyawan);
        $q = $this->db->get('free_access_room');
        $data = $q->result();
        
        return $data;
    }

    function checkAccessRoom($id_karyawan, $iddev){
        $query = $this->db->where('id_karyawan',$id_karyawan);
        $query = $this->db->where('id_room',$iddev);
        $q = $this->db->get('access_room_karyawan');
        $data = $q->result();
        
        return $data;
    }
}

?>