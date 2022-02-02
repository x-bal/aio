<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_room');
		date_default_timezone_set("asia/jakarta");

		if (!$this->session->userdata('userlogin')) {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function index()
	{
		redirect(base_url() . 'admin/dashboard');
	}

	public function list_room()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$data['namauser'] = $namauser;
				$data['username'] = $username;
				$data['avatar'] = $avatar;
				$data['role'] = $role;

				$data['set'] = "list-room";
				$data['listdata'] = $this->m_room->get_room();

				$this->load->view('admin/v_listroom', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function add_room()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$data['namauser'] = $namauser;
				$data['username'] = $username;
				$data['avatar'] = $avatar;
				$data['role'] = $role;

				$data['listdepartment'] = $this->m_admin->get_department();
				$data['set'] = "add-room";

				$this->load->view('admin/v_listroom', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function save_room()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$id_department = $this->input->post('department');
				$namaroom = $this->input->post('room');
				$type = $this->input->post('type');

				if (isset($_POST['remarks'])) {
					$remarks = $this->input->post('remarks');
				} else {
					$remarks = 0;
				}

				$data = array('nama_room' => $namaroom, 'id_department'  => $id_department, 'type' => $type, 'need_remarks' => $remarks, 'deleted' => 0, 'created_at' => time());

				if ($this->m_room->insert_room($data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Data gagal di simpan</div>");
				}

				redirect(base_url() . 'admin/list_room');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function hapus_room($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$data = array('deleted' => 1);
				if ($this->m_room->room_update($id, $data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Data gagal di hapus</div>");
				}

				redirect(base_url() . 'admin/list_room');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function edit_room($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$data['namauser'] = $namauser;
				$data['username'] = $username;
				$data['avatar'] = $avatar;
				$data['role'] = $role;

				if (isset($id)) {
					$dataroom = $this->m_room->get_room_by_id($id);
					$c = 0;
					if (isset($dataroom)) {
						foreach ($dataroom as $key => $value) {
							//print_r($value);
							$data['id_room'] = $value->id_room;
							$data['id_department'] = $value->id_department;
							$data['nama_room'] = $value->nama_room;
							$data['type'] = $value->type;
							$data['need_remarks'] = $value->need_remarks;
							$c++;
						}
						$data['listdepartment'] = $this->m_admin->get_department();
						$data['set'] = "edit-room";
					}
					if ($c > 0) {
						$this->load->view('admin/v_listroom', $data);
					} else {
						redirect(base_url() . 'admin/list_room');
					}
				} else {
					redirect(base_url() . 'admin/list_room');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function save_edit_room()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$id_room = $this->input->post('id');
				$id_department = $this->input->post('department');
				$namaroom = $this->input->post('nama');
				$type = $this->input->post('type');

				if (isset($_POST['remarks'])) {
					$remarks = $this->input->post('remarks');
				} else {
					$remarks = 0;
				}

				$data = array('nama_room' => $namaroom, 'id_department'  => $id_department, 'type' => $type, 'need_remarks' => $remarks, 'deleted' => 0);

				if ($this->m_room->room_update($id_room, $data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di ubah</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Data gagal di ubah</div>");
				}

				redirect(base_url() . 'admin/list_room');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function uploadimg_room($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$data['namauser'] = $namauser;
				$data['username'] = $username;
				$data['avatar'] = $avatar;
				$data['role'] = $role;

				if (isset($id)) {
					$dataroom = $this->m_room->get_room_by_id($id);
					$c = 0;
					if (isset($dataroom)) {
						foreach ($dataroom as $key => $value) {
							//print_r($value);
							$data['id_room'] = $value->id_room;
							$data['id_department'] = $value->id_department;
							$data['nama_room'] = $value->nama_room;
							$data['type'] = $value->type;
							$data['need_remarks'] = $value->need_remarks;
							$data['img_room'] = $value->img_room;
							$c++;
						}
						$data['listdepartment'] = $this->m_admin->get_department();
						$data['set'] = "uploadimg-room";
					}
					if ($c > 0) {
						$this->load->view('admin/v_listroom', $data);
					} else {
						redirect(base_url() . 'admin/list_room');
					}
				} else {
					redirect(base_url() . 'admin/list_room');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function save_upload_room()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$id_room = $this->input->post('id');

				$type = explode('.', $_FILES["image"]["name"]);
				$type = strtolower($type[count($type) - 1]);
				$imgname = uniqid(rand()) . '.' . $type;
				$url = "component/dist/room/" . $imgname;
				if (in_array($type, array("jpg", "jpeg", "gif", "png"))) {
					if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["image"]["tmp_name"], $url)) {

							$file = $this->input->post('img');
							$path = "component/dist/room/" . $file;

							if (file_exists($path)) {
								unlink($path);
							}
							$data = array('img_room' => $imgname, 'deleted' => 0);

							if ($this->m_room->room_update($id_room, $data)) {
								$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Gambar berhasil di upload</div>");
							} else {
								$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gambar gagal di upload</div>");
							}
						}
					}
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Data gagal di simpan, ekstensi gambar salah</div>");
				}

				redirect(base_url() . 'admin/list_room');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}
}
