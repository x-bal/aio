<?php
class m_admin extends CI_Model
{

    function get_position()
    {
        $this->db->select('*');
        $this->db->from('position');
        $this->db->order_by('id_position', 'desc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_admin()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user.role', 2);
        $this->db->where('user.deleted', 0);
        $this->db->join('department', 'department.id_department=user.id_department', 'inner');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function insert_admin($data)
    {
        $this->db->insert('user', $data);

        return ($this->db->affected_rows() > 0);
    }

    function admin_update($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);

        return ($this->db->affected_rows() > 0);
    }

    function get_admin_by_id($id)
    {
        $query = $this->db->where('id_user', $id);
        $query = $this->db->where('deleted', 0);
        $q = $this->db->get('user');
        $data = $q->result();

        return $data;
    }

    function get_department()
    {
        $this->db->select('*');
        $this->db->from('department');
        $this->db->where('deleted', 0);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function insert_department($data)
    {
        $this->db->insert('department', $data);

        return ($this->db->affected_rows() > 0);
    }

    function get_department_by_id($id)
    {
        $query = $this->db->where('id_department', $id);
        $q = $this->db->get('department');
        $data = $q->result();

        return $data;
    }

    function department_update($id, $data)
    {
        $this->db->where('id_department', $id);
        $this->db->update('department', $data);

        return ($this->db->affected_rows() > 0);
    }

    function get_section($id_department)
    {
        $this->db->select('*');
        $this->db->from('department_section');
        $this->db->where('id_department', $id_department);
        $this->db->where('deleted', 0);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function insert_section($data)
    {
        $this->db->insert('department_section', $data);

        return ($this->db->affected_rows() > 0);
    }

    function section_update($id, $data)
    {
        $this->db->where('id_section', $id);
        $this->db->update('department_section', $data);

        return ($this->db->affected_rows() > 0);
    }

    function get_section_by_id($id)
    {
        $query = $this->db->where('id_section', $id);
        $q = $this->db->get('department_section');
        $data = $q->result();

        return $data;
    }

    function get_section_by_dep($id_department)
    {
        $query = $this->db->where('id_department', $id_department);
        $q = $this->db->get('department_section');
        $data = $q->result();

        return $data;
    }

    function get_device_rfid()
    {
        $this->db->select('*');
        $this->db->from('device_rfid');
        $this->db->where('device_rfid.deleted', 0);
        $this->db->join('department', 'department.id_department=device_rfid.id_department', 'inner');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function device_rfid_update($id, $data)
    {
        $this->db->where('id_device_rfid', $id);
        $this->db->update('device_rfid', $data);

        return ($this->db->affected_rows() > 0);
    }

    function insert_device_rfid($data)
    {
        $this->db->insert('device_rfid', $data);

        return ($this->db->affected_rows() > 0);
    }

    function get_device_by_id($id)
    {
        $query = $this->db->where('id_device_rfid', $id);
        $q = $this->db->get('device_rfid');
        $data = $q->result();

        return $data;
    }

    function getSecretKey()
    {
        $query = $this->db->where('id_key', 1);
        $q = $this->db->get('secret_key');
        $data = $q->result();

        return $data;
    }

    function getTokenTelegram()
    {
        return $this->db->get_where('secret_key', ['id_key' => 2])->row();
    }

    function getlog()
    {
        $this->db->select('*');
        $this->db->from('log');
        $this->db->join('room', 'room.id_room=log.id_room', 'inner');
        $this->db->join('karyawan', 'karyawan.id_karyawan=log.id_karyawan', 'inner');
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');
        $this->db->join('department', 'department.id_department=department_section.id_department', 'inner');
        $this->db->order_by('log.id_log', 'desc');
        $this->db->limit(1000);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_log_by_time($ts1, $ts2)
    {
        $this->db->select('*');
        $this->db->from('log');
        $this->db->join('room', 'room.id_room=log.id_room', 'inner');
        $this->db->join('karyawan', 'karyawan.id_karyawan=log.id_karyawan', 'inner');
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');
        $this->db->join('department', 'department.id_department=department_section.id_department', 'inner');
        $this->db->order_by('log.id_log', 'desc');
        $this->db->where('log.access_time >=', $ts1);
        $this->db->where('log.access_time <', $ts2);
        $this->db->limit(1000);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getRoomByID($id_room, $thismonth, $nextmonth, $exclude)
    {
        $this->db->select('*');
        $this->db->from('room');
        $this->db->where('room.id_room', $id_room);
        $this->db->join('log', 'log.id_room=room.id_room', 'inner');
        $this->db->join('karyawan', 'karyawan.id_karyawan=log.id_karyawan', 'inner');
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');
        $this->db->join('department', 'department.id_department=department_section.id_department', 'inner');

        $this->db->where('log.access_time >=', $thismonth);
        $this->db->where('log.access_time <', $nextmonth);
        $this->db->where('department.id_department !=', $exclude);
        // $this->db->where('log.keterangan', 'Access Granted');
        $this->db->limit(1000);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getKaryawan()
    {
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');
        $this->db->join('department', 'department.id_department=department_section.id_department', 'inner');
        $this->db->where('karyawan.deleted', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getRoom()
    {
        $this->db->select('*');
        $this->db->from('room');
        $this->db->where('deleted', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getlogthismonth($thismonth, $nextmonth)
    {
        $this->db->select('*');
        $this->db->from('log');

        $this->db->where('log.access_time >=', $thismonth);
        $this->db->where('log.access_time <', $nextmonth);
        $this->db->where('log.keterangan', 'Access Granted');
        $this->db->limit(1000);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function get_free_access_room()
    {
        $this->db->select('*');
        $this->db->from('free_access_room');
        $this->db->join('karyawan', 'karyawan.id_karyawan=free_access_room.id_karyawan', 'inner');
        $this->db->join('position', 'position.id_position=karyawan.id_position', 'inner');
        $this->db->join('department_section', 'department_section.id_section=karyawan.id_section', 'inner');
        $this->db->join('department', 'department.id_department=department_section.id_department', 'inner');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function insert_free_access_room($data)
    {
        $this->db->insert('free_access_room', $data);

        return ($this->db->affected_rows() > 0);
    }

    function getFreeAccessRoombyIDKaryawan($id_karyawan)
    {
        $query = $this->db->where('id_karyawan', $id_karyawan);
        $q = $this->db->get('free_access_room');
        $data = $q->result();

        return $data;
    }

    function delete_free_access_room($id)
    {
        $this->db->where('id_free_access_room', $id);
        $this->db->delete('free_access_room');

        return ($this->db->affected_rows() > 0);
    }
}
