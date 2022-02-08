<?php

class NotifDoor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_NotifDoor');

        if (!$this->session->userdata('userlogin')) {
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
            redirect(base_url() . 'login/admin');
        }
    }

    public function index()
    {
        $data = [
            'namauser' => $this->session->userdata('userlogin'),
            'iduser' => $this->session->userdata('id'),
            'username' => $this->session->userdata('username'),
            'email' => $this->session->userdata('email'),
            'avatar' => $this->session->userdata('image'),
            'role' => $this->session->userdata('role'),
            'rooms' => $this->db->get('room')->result(),
            'notifs' => !$this->input->get('room') | $this->input->get('room') == 'all' ? $this->M_NotifDoor->get() : $this->M_NotifDoor->getByRoom($this->input->get('room')),
            'enable' => $this->input->get('room') != 'all' ? $this->M_NotifDoor->getEnableByRoom($this->input->get('room')) : $this->M_NotifDoor->get()
        ];

        $this->load->view('admin/notif-door/index', $data);
    }

    public function create()
    {
        $data = [
            'namauser' => $this->session->userdata('userlogin'),
            'iduser' => $this->session->userdata('id'),
            'username' => $this->session->userdata('username'),
            'email' => $this->session->userdata('email'),
            'avatar' => $this->session->userdata('image'),
            'role' => $this->session->userdata('role'),
            'rooms' => $this->db->get('room')->result(),
            'karyawan' => $this->db->get('karyawan')->result()
        ];

        $this->load->view('admin/notif-door/create', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('room', 'Room', 'required');
        $this->form_validation->set_rules('karyawan', 'Karyawan', 'required');
        $this->form_validation->set_rules('idchat', 'ID Chat', 'required');

        if ($this->form_validation->run() != false) {
            $data = [
                'id_room' => $this->input->post('room'),
                'id_karyawan' => $this->input->post('karyawan'),
                'id_chat' => $this->input->post('idchat'),
                'waktu' => $this->input->post('waktu'),
                'enable' => 1
            ];

            $this->M_NotifDoor->create($data);
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di tambahkan</div>");
            redirect(base_url('admin/notif-door'));
        }
    }

    public function enable()
    {
        if ($this->input->post('enable') == 1) {
            $this->db->where('id_room', $this->input->post('room'));
            $rooms = $this->db->get('telegram')->result();

            foreach ($rooms as $room) {
                $this->db->where('id_telegram', $room->id_telegram);
                $this->db->update('telegram', [
                    'enable' => 0
                ]);
            }
        }

        if ($this->input->post('enable') == 0) {
            $this->db->where('id_room', $this->input->post('room'));
            $rooms = $this->db->get('telegram')->result();

            foreach ($rooms as $room) {
                $this->db->where('id_telegram', $room->id_telegram);
                $this->db->update('telegram', [
                    'enable' => 1
                ]);
            }
        }

        redirect(base_url('admin/notif-door?room=' . $this->input->post('room')));
    }

    public function edit($id)
    {
        $data = [
            'namauser' => $this->session->userdata('userlogin'),
            'iduser' => $this->session->userdata('id'),
            'username' => $this->session->userdata('username'),
            'email' => $this->session->userdata('email'),
            'avatar' => $this->session->userdata('avatar'),
            'role' => $this->session->userdata('role'),
            'rooms' => $this->db->get('room')->result(),
            'karyawan' => $this->db->get('karyawan')->result(),
            'notif' => $this->M_NotifDoor->find($id)
        ];

        $this->load->view('admin/notif-door/edit', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('room', 'Room', 'required');
        $this->form_validation->set_rules('karyawan', 'Karyawan', 'required');
        $this->form_validation->set_rules('idchat', 'ID Chat', 'required');

        if ($this->form_validation->run() != false) {
            $data = [
                'id_room' => $this->input->post('room'),
                'id_karyawan' => $this->input->post('karyawan'),
                'id_chat' => $this->input->post('idchat'),
                'waktu' => $this->input->post('waktu'),
            ];

            $this->M_NotifDoor->update($id, $data);
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
            redirect(base_url('admin/notif-door'));
        }
    }

    public function delete($id)
    {
        $this->M_NotifDoor->delete($id);
        redirect(base_url('admin/notif-door'));
    }

    public function setToken($id)
    {
        $data = [
            'key' => $this->input->post('token', true)
        ];

        $this->db->where('id_key', $id);
        $this->db->update('secret_key', $data);

        $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
        redirect(base_url('admin/setting'));
    }
}
