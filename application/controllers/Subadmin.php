<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subadmin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_subadmin');
		$this->load->library('bcrypt');
		date_default_timezone_set("asia/jakarta");
	}

	public function index()
	{
		redirect(base_url() . 'admin/dashboard');
	}

	public function list_karyawan()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');

			if ($role == 2) {
				$data['namauser'] = $namauser;
				$data['username'] = $username;
				$data['avatar'] = $avatar;
				$data['role'] = $role;
				$data['id_department'] = $id_department;
				$data['nama_department'] = $nama_department;

				$data['set'] = "list-karyawan";
				$data['listdata'] = $this->m_subadmin->get_karyawan_by_dep($id_department);

				$this->load->view('admin/v_listkaryawan', $data);
			} else if ($role == 1) {
				$data['namauser'] = $namauser;
				$data['username'] = $username;
				$data['avatar'] = $avatar;
				$data['role'] = $role;
				$data['nama_department'] = $nama_department;

				$data['set'] = "list-karyawan-all";
				$data['listdata'] = $this->m_subadmin->get_karyawan_all();

				$this->load->view('admin/v_listkaryawan', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function add_karyawan()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');

			if ($role == 1 || $role == 2) {
				$data['namauser'] = $namauser;
				$data['username'] = $username;
				$data['avatar'] = $avatar;
				$data['role'] = $role;
				$data['id_department'] = $id_department;
				$data['nama_department'] = $nama_department;

				$data['listdepartment'] = $this->m_admin->get_department();
				$data['listsection'] = $this->m_subadmin->get_section_by_dep($id_department);
				$data['listposition'] = $this->m_admin->get_position();
				$data['set'] = "add-karyawan";

				$this->load->view('admin/v_listkaryawan', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function save_karyawan()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1 || $role == 2) {
				$id_department = $this->input->post('id_department');
				$id_section = $this->input->post('id_section');
				$id_position = $this->input->post('id_position');
				$nik = $this->input->post('nik');
				$nama_karyawan = $this->input->post('nama_karyawan');
				$rfid = $this->input->post('rfid');
				$hash = $this->bcrypt->hash_password($nik);

				$data = array(
					'id_section'  => $id_section, 'id_position' => $id_position,
					'nik' => $nik, 'password' => $hash, 'nama_karyawan' => $nama_karyawan, 'status' => 1,
					'uid_rfid' => $rfid, 'disable_remarks' => 1, 'foto' => 'default.png', 'created_at' => time(), 'deleted' => 0
				);

				if ($this->m_subadmin->insert_karyawan($data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
				}

				redirect(base_url() . 'admin/list_karyawan');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function hapus_karyawan($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 2 || $role == 1) {
				$data = array('deleted' => 1);
				if ($this->m_subadmin->karyawan_update($id, $data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
				}

				redirect(base_url() . 'admin/list_karyawan');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function edit_karyawan($id = null)
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
					$datakaryawan = $this->m_subadmin->get_karyawan_by_id($id);
					$c = 0;
					if (isset($datakaryawan)) {
						foreach ($datakaryawan as $key => $value) {
							//print_r($value);
							$data['id_karyawan'] = $value->id_karyawan;
							$data['id_section'] = $value->id_section;
							$data['id_position'] = $value->id_position;
							$data['nik'] = $value->nik;
							$data['nama_karyawan'] = $value->nama_karyawan;
							$data['status'] = $value->status;
							$data['uid_rfid'] = $value->uid_rfid;
							$data['disable_remarks'] = $value->disable_remarks;
							$c++;
							$id_section = $value->id_section;
						}

						$dataSection = $this->m_admin->get_section_by_id($id_section);
						if (isset($dataSection)) {
							foreach ($dataSection as $key => $value) {
								$data['id_department'] = $value->id_department;
								$id_department = $value->id_department;
							}
							$dataSectionAll = $this->m_admin->get_section_by_dep($id_department);
							$data['listsection'] = $dataSectionAll;
						}

						$data['listdepartment'] = $this->m_admin->get_department();
						$data['listposition'] = $this->m_admin->get_position();
						$data['set'] = "edit-karyawan";
					}
					if ($c > 0) {
						$this->load->view('admin/v_listkaryawan', $data);
					} else {
						redirect(base_url() . 'admin/list_karyawan');
					}
				} else {
					redirect(base_url() . 'admin/list_karyawan');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function save_edit_karyawan()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');
			if ($role == 1) {
				if (isset($_POST['id']) && isset($_POST['id_position'])) {
					$id = $this->input->post('id');
					$id_position = $this->input->post('id_position');
					$id_section = $this->input->post('id_section');
					$nik = $this->input->post('nik');
					$nama = $this->input->post('nama');
					$rfid = $this->input->post('rfid');
					$status = $this->input->post('status');
					$disable_remarks = $this->input->post('disable_remarks');

					if (isset($_POST['changepass'])) {
						$hash = $this->bcrypt->hash_password($nik);
						$data = array(
							'id_section' => $id_section, 'id_position' => $id_position, 'nama_karyawan' => $nama,
							'nik' => $nik, 'uid_rfid' => $rfid, 'disable_remarks' => $disable_remarks, 'password' => $hash, 'status' => $status
						);
					} else {
						$data = array(
							'id_section' => $id_section, 'id_position' => $id_position, 'nama_karyawan' => $nama,
							'nik' => $nik, 'uid_rfid' => $rfid, 'disable_remarks' => $disable_remarks, 'status' => $status
						);
					}

					if ($this->m_subadmin->karyawan_update($id, $data)) {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
					} else {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
					}
				}
				redirect(base_url() . 'admin/list_karyawan');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}


	public function list_room_dep()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');

			if ($role == 2) {
				$data['namauser'] = $namauser;
				$data['username'] = $username;
				$data['avatar'] = $avatar;
				$data['role'] = $role;
				$data['id_department'] = $id_department;
				$data['nama_department'] = $nama_department;

				$data['set'] = "list-room-dep";
				$data['listdata'] = $this->m_subadmin->get_room_by_dep($id_department);

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

	public function set_access($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');

			if ($role == 1 || $role == 2) {
				$data['namauser'] = $namauser;
				$data['username'] = $username;
				$data['avatar'] = $avatar;
				$data['role'] = $role;

				if (isset($id)) {
					$dataKar = $this->m_subadmin->get_karyawan_by_id($id);
					$c = 0;
					$id_karyawan = 0;
					$id_section = 0;

					if (isset($dataKar)) {
						foreach ($dataKar as $key => $value) {
							$id_karyawan = $value->id_karyawan;
							$id_section = $value->id_section;
							$data['id_karyawan'] = $id_karyawan;
							$data['nama_karyawan'] = $value->nama_karyawan;
							$c++;
						}
						$data['set'] = "set-access-karyawan";
					}

					$department = $this->m_subadmin->get_department_by_sec($id_section);
					$id_department = 0;
					if (isset($department)) {
						foreach ($department as $key => $value) {
							$id_department = $value->id_department;
							$data['nama_department'] = $value->nama_department;
							$data['id_department'] = $value->id_department;
						}
					}
					$data['listroom'] = $this->m_subadmin->get_room_by_dep($id_department);
					$data['accessroom'] = $this->m_subadmin->get_access_room_by_idkaryawan($id_karyawan);

					if ($c > 0) {
						$this->load->view('admin/v_setaccesskaryawan', $data);
					} else {
						redirect(base_url() . 'admin/list_karyawan');
					}
				} else {
					redirect(base_url() . 'admin/list_karyawan');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function save_set_access()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');
			if ($role == 1 || $role == 2) {
				if (isset($_POST['id_karyawan']) && isset($_POST['id_department'])) {
					$id_karyawan = $this->input->post('id_karyawan');
					$id_department = $this->input->post('id_department');

					$this->m_subadmin->set_access_del($id_karyawan);

					$room = $this->m_subadmin->get_room_by_dep($id_department);

					if (isset($room)) {
						foreach ($room as $key => $value) {

							$id_checkbox = $value->id_room;
							if (isset($_POST[$id_checkbox])) {

								$data = array(
									'id_karyawan' => $id_karyawan,
									'id_room' => $id_checkbox,
								);

								if ($this->m_subadmin->insert_access_room($data)) {
									$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
								} else {
									$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
								}
							}
						}
					}
				}
				redirect(base_url() . 'admin/list_karyawan');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function menu_access($id)
	{
		$data = [
			'namauser' => $this->session->userdata('userlogin'),
			'iduser' => $this->session->userdata('id'),
			'username' => $this->session->userdata('username'),
			'email' => $this->session->userdata('email'),
			'avatar' => $this->session->userdata('image'),
			'role' => $this->session->userdata('role'),
			'karyawan' => $this->db->get_where('karyawan', ['id_karyawan' => $id])->row()
		];

		$this->load->view('admin/v_menu_access', $data);
	}

	public function menu_access_update($id)
	{
		$input = [
			'control_room' => $this->input->post('control_room'),
			'monitoring_room' => $this->input->post('monitoring_room'),
		];

		$this->db->where('id_karyawan', $id);
		$this->db->update('karyawan', $input);

		redirect(base_url('admin/list_karyawan'));
	}
}
