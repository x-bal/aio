<?php
class m_subadmin extends CI_Model {

    function get_karyawan_all(){
        $this->db->select('*, karyawan.created_at as created_karyawan');
        $this->db->from('karyawan');
        $this->db->where('karyawan.deleted', 0);
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');
        $this->db->join('department', 'department.id_department=department_section.id_department', 'inner');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
        
    function get_karyawan_by_id($id){
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->where('deleted', 0);
        $this->db->where('id_karyawan', $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_karyawan_by_dep($id_department){
        $this->db->select('*, karyawan.created_at as created_karyawan');
        $this->db->from('karyawan');
        $this->db->where('karyawan.deleted', 0);
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');
        $this->db->where('department_section.id_department', $id_department);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function insert_karyawan($data){
       $this->db->insert('karyawan', $data);
       
       return ($this->db->affected_rows() > 0);
    }

    function karyawan_update($id,$data){
        $this->db->where('id_karyawan', $id);
        $this->db->update('karyawan', $data);

        return ($this->db->affected_rows() > 0);
    }

    function get_section_by_dep($id_department) {
        $this->db->where('id_department',$id_department);
        $q = $this->db->get('department_section');
        $data = $q->result();
        
        return $data;
    }

    function get_department_by_sec($id_section) {
        $this->db->where('id_section',$id_section);
        $this->db->join('department', 'department.id_department=department_section.id_department', 'inner');
        $q = $this->db->get('department_section');
        $data = $q->result();
        
        return $data;
    }

    function get_room_by_dep($id_department){
        $this->db->select('*');
        $this->db->from('room');

        $this->db->where('id_department', $id_department);
        $this->db->or_where('type', 'public');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_access_room_by_idkaryawan($id_karyawan){
        $this->db->select('*');
        $this->db->from('access_room_karyawan');
        $this->db->join('room', 'room.id_room=access_room_karyawan.id_room', 'inner');
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('room.deleted', 0);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function set_access_del($id_karyawan){
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->delete('access_room_karyawan');

        return ($this->db->affected_rows() > 0);
    }

    function insert_access_room($data){
        $this->db->insert('access_room_karyawan', $data);
       
       return ($this->db->affected_rows() > 0);
    }
}

?>