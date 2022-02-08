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

    function get_send_notif_telegram(){
        $this->db->where('send_notif',1);
        $this->db->join('karyawan', 'karyawan.id_karyawan=log.id_karyawan', 'inner');
        $this->db->join('room', 'room.id_room=log.id_room', 'inner');
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $q = $this->db->get('log');
        $data = $q->result();
        
        return $data;
    }

    function log_update($id_log, $data){
        $this->db->where('id_log', $id_log);
        $this->db->update('log', $data);

        return ($this->db->affected_rows() > 0);
    }

    function get_idchat_telegram($id_room){
        $this->db->where('id_room',$id_room);
        $this->db->where('enable',1);
        $q = $this->db->get('telegram');
        $data = $q->result();
        
        return $data;
    }

    function get_token_telegram(){
        $query = $this->db->where('id_key',2);
        $q = $this->db->get('secret_key');
        $data = $q->result();
        
        return $data;
    }
}

?>