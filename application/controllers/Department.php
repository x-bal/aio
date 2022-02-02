<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
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

	public function department()
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

				$data['set'] = "list-department";
				$data['listdata'] = $this->m_admin->get_department();

				$this->load->view('admin/v_department', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function add_department()
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

				$data['set'] = "add-department";
				$data['listdata'] = $this->m_admin->get_department();

				$this->load->view('admin/v_department', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function save_department()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$namadepartment = $this->input->post('department');

				$data = array('nama_department'  => $namadepartment, 'deleted' => 0, 'created_at' => time());

				if ($this->m_admin->insert_department($data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
				}

				redirect(base_url() . 'admin/department');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function hapus_department($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$data = array('deleted' => 1);
				if ($this->m_admin->department_update($id, $data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
				}

				redirect(base_url() . 'admin/department');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function edit_department($id = null)
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
					$datadepartment = $this->m_admin->get_department_by_id($id);
					if (isset($datadepartment)) {
						foreach ($datadepartment as $key => $value) {
							//print_r($value);
							$data['id'] = $value->id_department;
							$data['nama_department'] = $value->nama_department;
						}
						$data['set'] = "edit-department";
						$this->load->view('admin/v_department', $data);
					}
				} else {
					redirect(base_url() . 'admin/department');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function save_edit_department()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');
			if ($role == 1) {
				if (isset($_POST['id']) && isset($_POST['department'])) {
					$id = $this->input->post('id');
					$department = $this->input->post('department');

					$data = array('nama_department' => $department);

					if ($this->m_admin->department_update($id, $data)) {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
					} else {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
					}
				}
				redirect(base_url() . 'admin/department');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function add_section($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');

			if ($role == 1) {
				if (isset($id)) {
					$data['namauser'] = $namauser;
					$data['username'] = $username;
					$data['avatar'] = $avatar;
					$data['role'] = $role;

					$data['set'] = "add-section";
					$department = $this->m_admin->get_department_by_id($id);

					$id_department = 0;
					if (isset($department)) {
						foreach ($department as $key => $value) {
							$id_department = $value->id_department;
							$nama_department = $value->nama_department;
						}
					}

					if ($id_department == 0) {
						redirect(base_url() . 'admin/department');
					} else {
						$data['id_department'] = $id_department;
						$data['nama_department'] = $nama_department;
					}

					$this->load->view('admin/v_section', $data);
				} else {
					redirect(base_url() . 'admin/department');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function save_section()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$id_department = $this->input->post('id_department');
				$nama_section = $this->input->post('nama_section');

				$data = array('id_department'  => $id_department, 'nama_section' => $nama_section, 'deleted' => 0, 'created_at' => time());

				if ($this->m_admin->insert_section($data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
				}

				redirect(base_url() . 'admin/list_section/' . $id_department);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function list_section($id = null)
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

				$data['set'] = "list-section";
				$department = $this->m_admin->get_department_by_id($id);

				$id_department = 0;
				if (isset($department)) {
					foreach ($department as $key => $value) {
						$id_department = $value->id_department;
						$nama_department = $value->nama_department;
					}
				}

				if ($id_department == 0) {
					redirect(base_url() . 'admin/department');
				} else {
					$data['id_department'] = $id_department;
					$data['nama_department'] = $nama_department;

					$datasection = $this->m_admin->get_section($id_department);

					$data['listdata'] = $datasection;
				}

				$this->load->view('admin/v_section', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function hapus_section($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$data = array('deleted' => 1);
				if ($this->m_admin->section_update($id, $data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
				}

				redirect(base_url() . 'admin/department');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function edit_section($id = null)
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
					$datasection = $this->m_admin->get_section_by_id($id);
					if (isset($datasection)) {

						$id_section = 0;
						foreach ($datasection as $key => $value) {
							//print_r($value);

							$id_section = $value->id_section;
							$nama_section = $value->nama_section;
							$id_department = $value->id_department;
						}

						if ($id_section == 0) {
							redirect(base_url() . 'admin/department');
						} else {
							$data['id_section'] = $id_section;
							$data['nama_section'] = $nama_section;
							$department = $this->m_admin->get_department_by_id($id_department);

							if (isset($department)) {
								foreach ($department as $key => $value) {
									$nama_department = $value->nama_department;
								}
							}
						}

						$data['id_department'] = $id_department;
						$data['nama_department'] = $nama_department;

						$data['set'] = "edit-section";
						$this->load->view('admin/v_section', $data);
					}
				} else {
					redirect(base_url() . 'admin/department');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}


	public function save_edit_section()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');
			if ($role == 1) {
				if (isset($_POST['id_section']) && isset($_POST['nama_section']) && isset($_POST['id_department'])) {
					$id = $this->input->post('id_section');
					$nama_section = $this->input->post('nama_section');
					$id_department = $this->input->post('id_department');

					$data = array('nama_section' => $nama_section);

					if ($this->m_admin->section_update($id, $data)) {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
					} else {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
					}
				}
				redirect(base_url() . 'admin/list_section/' . $id_department);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}
}
