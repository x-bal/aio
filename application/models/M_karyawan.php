<?php
class m_karyawan extends CI_Model {
        
    function get_karyawan_by_id($id_karyawan)
    {
        $query = $this->db->where('id_karyawan',$id_karyawan);
        $q = $this->db->get('karyawan');
        $data = $q->result();
        
        return $data;
    }

    function karyawan_update($id,$data){
        $this->db->where('id_karyawan', $id);
        $this->db->update('karyawan', $data);

        return ($this->db->affected_rows() > 0);
    }

    function get_public_reader(){
        $query = $this->db->where('id_public_reader_rfid',1);
        $q = $this->db->get('public_reader_rfid');
        $data = $q->result();
        
        return $data;
    }

    function update_public_reader($data){
        $this->db->where('id_public_reader_rfid', 1);
        $this->db->update('public_reader_rfid', $data);

        return ($this->db->affected_rows() > 0);
    }

    function insert_karyawan($data){
       $this->db->insert('karyawan', $data);
       
       return ($this->db->affected_rows() > 0);
    }

    function get_room_by_dep($id_department){
        $query = $this->db->where('id_department',$id_department);
        $query = $this->db->where('type','public');
        $query = $this->db->where('deleted',0);
        $q = $this->db->get('room');
        $data = $q->result();
        
        return $data;
    }

    function get_room_public(){
        $query = $this->db->where('type','public');
        $query = $this->db->where('deleted',0);
        $q = $this->db->get('room');
        $data = $q->result();
        
        return $data;
    }

    function get_room_by_id($id){
        $query = $this->db->where('id_room',$id);
        $query = $this->db->where('type','public');
        $query = $this->db->where('deleted',0);
        $q = $this->db->get('room');
        $data = $q->result();
        
        return $data;
    }

    function remarksactivity(){
        $this->db->select('*');
        $this->db->from('public_remarks');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_remarks_activity_by_id($id){
        $query = $this->db->where('id_public_remarks',$id);
        $q = $this->db->get('public_remarks');
        $data = $q->result();
        
        return $data;
    }

    function insert_remarks($data){
        $this->db->insert('remarks_room', $data);
       
       return ($this->db->affected_rows() > 0);
    }

    function get_log_karyawan_by_id($id_karyawan){
        $this->db->select('*');
        $this->db->from('log');
        $this->db->join('room', 'room.id_room=log.id_room', 'inner');
        $this->db->join('department', 'department.id_department=room.id_department', 'inner');
        $this->db->where('id_karyawan',$id_karyawan);
        $this->db->order_by('id_log', 'desc');
        $this->db->limit(100);
        $q = $this->db->get();
        $data = $q->result();
        
        return $data;
    }

    function get_log_bawahan_s2_by_id_dep($id_department, $id_position){
        $this->db->select('*');
        $this->db->from('log');
        $this->db->join('room', 'room.id_room=log.id_room', 'inner');
        $this->db->join('department', 'department.id_department=room.id_department', 'inner');
        $this->db->join('karyawan', 'karyawan.id_karyawan=log.id_karyawan', 'inner');
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');

        $this->db->where('department_section.id_department',$id_department);
        $this->db->where('karyawan.id_position',$id_position);
        $this->db->order_by('access_time', 'desc');
        $this->db->limit(250);
        $q = $this->db->get();
        $data = $q->result();
        
        return $data;
    }

    function get_log_bawahan_s3_by_id_dep($id_department, $id_position1, $id_position2){
        $this->db->select('*');
        $this->db->from('log');
        $this->db->join('room', 'room.id_room=log.id_room', 'inner');
        $this->db->join('department', 'department.id_department=room.id_department', 'inner');
        $this->db->join('karyawan', 'karyawan.id_karyawan=log.id_karyawan', 'inner');
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');

        $this->db->where('department_section.id_department',$id_department);
        $this->db->where('karyawan.id_position',$id_position1);
        $this->db->or_where('karyawan.id_position',$id_position2);
        $this->db->order_by('access_time', 'desc');
        $this->db->limit(500);
        $q = $this->db->get();
        $data = $q->result();
        
        return $data;
    }

    function get_log_bawahan_m1_by_id_dep($id_department, $id_position1, $id_position2, $id_position3){
        $this->db->select('*');
        $this->db->from('log');
        $this->db->join('room', 'room.id_room=log.id_room', 'inner');
        $this->db->join('department', 'department.id_department=room.id_department', 'inner');
        $this->db->join('karyawan', 'karyawan.id_karyawan=log.id_karyawan', 'inner');
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');

        $this->db->where('department_section.id_department',$id_department);
        $this->db->where('karyawan.id_position',$id_position1);
        $this->db->or_where('karyawan.id_position',$id_position2);
        $this->db->or_where('karyawan.id_position',$id_position3);
        $this->db->order_by('access_time', 'desc');
        $this->db->limit(1000);
        $q = $this->db->get();
        $data = $q->result();
        
        return $data;
    }

    function get_log_bawahan_s3_by_id_dep_time($id_department, $id_position1, $id_position2, $ts1, $ts2){
        $this->db->select('*');
        $this->db->from('log');
        $this->db->join('room', 'room.id_room=log.id_room', 'inner');
        $this->db->join('department', 'department.id_department=room.id_department', 'inner');
        $this->db->join('karyawan', 'karyawan.id_karyawan=log.id_karyawan', 'inner');
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');

        $this->db->where('department_section.id_department',$id_department);
        $this->db->where('karyawan.id_position',$id_position1);
        $this->db->or_where('karyawan.id_position',$id_position2);
        $this->db->order_by('access_time', 'desc');

        $this->db->where('access_time >=', $ts1);
        $this->db->where('access_time <', $ts2);

        $this->db->limit(500);
        $q = $this->db->get();
        $data = $q->result();
        
        return $data;
    }

    function get_log_bawahan_m1_by_id_dep_time($id_department, $id_position1, $id_position2, $id_position3, $ts1, $ts2){
        $this->db->select('*');
        $this->db->from('log');

        $this->db->join('room', 'room.id_room=log.id_room', 'inner');
        $this->db->join('department', 'department.id_department=room.id_department', 'inner');
        $this->db->join('karyawan', 'karyawan.id_karyawan=log.id_karyawan', 'inner');
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');

        $this->db->where('department_section.id_department',$id_department);
        $this->db->where('karyawan.id_position',$id_position1);
        $this->db->or_where('karyawan.id_position',$id_position2);
        $this->db->or_where('karyawan.id_position',$id_position3);
        $this->db->order_by('access_time', 'desc');
        $this->db->where('access_time >=', $ts1);
        $this->db->where('access_time <', $ts2);

        $this->db->limit(1000);
        $q = $this->db->get();
        $data = $q->result();
        
        return $data;
    }

    function get_access_room_karyawan($id_karyawan){
        $query = $this->db->where('id_karyawan',$id_karyawan);
        $q = $this->db->get('access_room_karyawan');
        $data = $q->result();
        
        return $data;
    }
}

?>