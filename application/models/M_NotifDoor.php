<?php

class M_NotifDoor extends CI_Model
{
    public function get()
    {
        $this->db->select('*');
        $this->db->from('telegram_door');
        $this->db->join('room', 'room.id_room=telegram_door.id_room');
        $this->db->join('karyawan', 'karyawan.id_karyawan=telegram_door.id_karyawan');
        return $this->db->get()->result();
    }

    public function getByRoom($idroom)
    {
        $this->db->select('*');
        $this->db->from('telegram_door');
        $this->db->join('room', 'room.id_room=telegram_door.id_room');
        $this->db->join('karyawan', 'karyawan.id_karyawan=telegram_door.id_karyawan');
        $this->db->where('telegram_door.id_room', $idroom);
        return $this->db->get()->result();
    }

    public function getEnableByRoom($idroom)
    {
        $this->db->select('*');
        $this->db->from('telegram_door');
        $this->db->join('room', 'room.id_room=telegram_door.id_room');
        $this->db->join('karyawan', 'karyawan.id_karyawan=telegram_door.id_karyawan');
        $this->db->where('telegram_door.id_room', $idroom);
        return $this->db->get()->row();
    }

    public function create($data)
    {
        $this->db->insert('telegram_door', $data);
    }

    public function find($id)
    {
        return $this->db->get_where('telegram_door', ['id_telegram_door' => $id])->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id_telegram_door', $id);
        $this->db->update('telegram_door', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_telegram_door', $id);
        $this->db->delete('telegram_door');
    }
}
