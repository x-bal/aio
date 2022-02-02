<?php
class m_room extends CI_Model
{

    function get_room()
    {
        $this->db->select('*, room.created_at as created_room');
        $this->db->from('room');
        $this->db->where('room.deleted', 0);
        $this->db->join('department', 'department.id_department=room.id_department', 'inner');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function insert_room($data)
    {
        $this->db->insert('room', $data);

        return ($this->db->affected_rows() > 0);
    }

    function room_update($id, $data)
    {
        $this->db->where('id_room', $id);
        $this->db->update('room', $data);

        return ($this->db->affected_rows() > 0);
    }

    function get_room_by_id($id)
    {
        $query = $this->db->where('id_room', $id);
        $q = $this->db->get('room');
        $data = $q->result();

        return $data;
    }

    function get_room_public()
    {
        $query = $this->db->where('type', 'public');
        $query = $this->db->where('deleted', 0);
        $q = $this->db->get('room');
        $data = $q->result();

        return $data;
    }

    function clear_flag_dashboard($data)
    {
        $this->db->update('room', $data);

        return ($this->db->affected_rows() > 0);
    }

    function get_room_dashboard_active()
    {
        $query = $this->db->where('type', 'public');
        $query = $this->db->where('flag_dashboard', 1);
        $query = $this->db->where('deleted', 0);
        $q = $this->db->get('room');
        $data = $q->result();

        return $data;
    }

    function get_room_page($page)
    {
        $datapage = $page;
        $datapage--;
        $datapage *= 6;
        $this->db->select('*, room.created_at as created_room');
        $this->db->from('room');
        $this->db->where('room.deleted', 0);
        $this->db->join('department', 'department.id_department=room.id_department', 'inner');
        $this->db->limit(6, $datapage);          // get 6 data setelah $datapage(0 atau 6 atau kelipatan)

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_room_id_department($id_department)
    {
        $this->db->select('*, room.created_at as created_room');
        $this->db->from('room');
        $this->db->join('department', 'department.id_department=room.id_department', 'inner');
        $this->db->where('room.deleted', 0);
        $this->db->where('room.id_department', $id_department);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
}
