<?php

class M_Notif extends CI_Model
{
    public function get()
    {
        $this->db->select('*');
        $this->db->from('telegram');
        $this->db->join('room', 'room.id_room=telegram.id_room');
        $this->db->join('karyawan', 'karyawan.id_karyawan=telegram.id_karyawan');
        return $this->db->get()->result();
    }

    public function getByRoom($idroom)
    {
        $this->db->select('*');
        $this->db->from('telegram');
        $this->db->join('room', 'room.id_room=telegram.id_room');
        $this->db->join('karyawan', 'karyawan.id_karyawan=telegram.id_karyawan');
        $this->db->where('telegram.id_room', $idroom);
        return $this->db->get()->result();
    }

    public function getEnableByRoom($idroom)
    {
        $this->db->select('*');
        $this->db->from('telegram');
        $this->db->join('room', 'room.id_room=telegram.id_room');
        $this->db->join('karyawan', 'karyawan.id_karyawan=telegram.id_karyawan');
        $this->db->where('telegram.id_room', $idroom);
        return $this->db->get()->row();
    }

    public function create($data)
    {
        $this->db->insert('telegram', $data);
    }

    public function find($id)
    {
        return $this->db->get_where('telegram', ['id_telegram' => $id])->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id_telegram', $id);
        $this->db->update('telegram', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_telegram', $id);
        $this->db->delete('telegram');
    }
}
