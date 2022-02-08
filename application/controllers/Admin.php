<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_room');
		$this->load->library('bcrypt');
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

	public function dashboard()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');
			$control_room = $this->session->userdata('control_room');
			$monitoring_room = $this->session->userdata('monitoring_room');

			$data['namauser'] = $namauser;
			$data['username'] = $username;
			$data['avatar'] = $avatar;
			$data['role'] = $role;
			$data['control_room'] = $control_room;
			$data['monitoring_room'] = $monitoring_room;

			$thismonth = strtotime(date("Y-m", strtotime('+0 month')));
			$nextmonth = strtotime(date('Y-m', strtotime('+1 month')));
			$data['note'] = "last 30 days";

			if (isset($_GET['tanggal'])) {
				$tanggal = $this->input->get('tanggal');
				//echo $tanggal;

				$split = explode("-", $tanggal);
				$x = 0;
				foreach ($split as $key => $value) {
					$date[$x] = $value;
					$x++;
				}

				$thismonth = strtotime($date[0]);
				$nextmonth = strtotime($date[1]);

				$data['note'] = date("d M Y", $thismonth) . " - " . date("d M Y", $nextmonth);

				$nextmonth += 86400;	// tambah 1 hari (hitungan detik)
			}

			$getRoomDashboard = $this->m_room->get_room_dashboard_active();
			$id_room_dash = 0;
			$nama_room_dash = "";
			if (isset($getRoomDashboard)) {
				foreach ($getRoomDashboard as $key => $value) {
					$id_room_dash = $value->id_room;
					$nama_room_dash = $value->nama_room;
				}
			}

			$flag2 = $this->db->get_where('room', ['flag_dashboard_dua' => 1])->row();
			$flag3 = $this->db->get_where('room', ['flag_dashboard_tiga' => 1])->row();
			$flag4 = $this->db->get_where('room', ['flag_dashboard_empat' => 1])->row();

			$exclude = $this->db->get_where('department', ['exclude' => 1])->row();

			$data['allRoom'] = $this->db->get_where('room', ['type' => 'public'])->result();
			$data['nama_room_dash'] = $nama_room_dash;
			$data['nama_room_dash_dua'] = $flag2->nama_room;
			$data['nama_room_dash_tiga'] = $flag3->nama_room;
			$data['nama_room_dash_empat'] = $flag4->nama_room;
			$data['nama_exclude'] = $exclude->nama_department;
			$data['dataAccess'] = $this->m_admin->getRoomByID($id_room_dash, $thismonth, $nextmonth, $exclude->id_department);
			$data['dataAccessDua'] = $this->m_admin->getRoomByID($flag2->id_room, $thismonth, $nextmonth, $exclude->id_department);
			$data['dataAccessTiga'] = $this->m_admin->getRoomByID($flag3->id_room, $thismonth, $nextmonth, $exclude->id_department);
			$data['dataAccessEmpat'] = $this->m_admin->getRoomByID($flag4->id_room, $thismonth, $nextmonth, $exclude->id_department);
			$data['department'] = $this->m_admin->get_department();
			$data['karyawan'] = $this->m_admin->getKaryawan();
			$data['room'] = $this->m_admin->getRoom();
			$data['totalAccess'] = $this->m_admin->getlogthismonth($thismonth, $nextmonth);

			$this->load->view('admin/v_dashboard', $data);
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function position()
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

				$data['set'] = "position";
				$data['listdata'] = $this->m_admin->get_position();

				$this->load->view('admin/v_position', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function list_admin()
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

				$data['set'] = "list-admin";
				$data['listdata'] = $this->m_admin->get_admin();

				$this->load->view('admin/v_listadmin', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function add_admin()
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
				$data['set'] = "add-admin";

				$this->load->view('admin/v_listadmin', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function save_admin()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$department = $this->input->post('department');
				$nama = $this->input->post('nama');
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$pass = $this->input->post('pass');
				$hash = $this->bcrypt->hash_password($pass);
				$roleAdmin = 2;

				$type = explode('.', $_FILES["image"]["name"]);
				$type = strtolower($type[count($type) - 1]);
				$imgname = uniqid(rand()) . '.' . $type;
				$url = "component/dist/img/admin/" . $imgname;
				if (in_array($type, array("jpg", "jpeg", "gif", "png"))) {
					if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["image"]["tmp_name"], $url)) {
							$data = array(
								'nama'    => $nama,
								'role'    => $roleAdmin,
								'username' => $username,
								'password' => $hash,
								'image'   => $imgname,
								'email'	  => $email,
								'id_department' => $department
							);
							$this->m_admin->insert_admin($data);
							$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
						}
					}
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Data gagal di simpan, ekstensi gambar salah</div>");
				}

				redirect(base_url() . 'admin/list_admin');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function hapus_admin($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$data = array('deleted' => 1);
				if ($this->m_admin->admin_update($id, $data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
				}

				redirect(base_url() . 'admin/list_admin');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function edit_admin($id = null)
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
					$dataadmin = $this->m_admin->get_admin_by_id($id);
					$c = 0;
					if (isset($dataadmin)) {
						foreach ($dataadmin as $key => $value) {
							//print_r($value);
							$data['id_user'] = $value->id_user;
							$data['id_department'] = $value->id_department;
							$data['nama'] = $value->nama;
							$data['email'] = $value->email;
							$data['username'] = $value->username;
							$data['gambar'] = $value->image;
							$c++;
						}
						$data['listdepartment'] = $this->m_admin->get_department();
						$data['set'] = "edit-admin";
					}
					if ($c > 0) {
						$this->load->view('admin/v_listadmin', $data);
					} else {
						redirect(base_url() . 'admin/list_admin');
					}
				} else {
					redirect(base_url() . 'admin/list_admin');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function save_edit_admin()
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

				if (isset($_POST['id']) && isset($_POST['department'])) {
					$id = $this->input->post('id');
					$id_department = $this->input->post('department');
					$nama = $this->input->post('nama');
					$email = $this->input->post('email');
					$username = $this->input->post('username');

					$arrayData = array('id_department' => $id_department, 'nama' => $nama, 'email' => $email, 'username' => $username);

					$this->m_admin->admin_update($id, $arrayData);
					if ($this->m_admin->admin_update($id, $arrayData)) {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
					} else {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
					}

					if (isset($_POST['changepass'])) {
						$hash = $this->bcrypt->hash_password($username);
						$DataPass = array('password' => $hash);
						$this->m_admin->admin_update($id, $DataPass);
					}


					$type = explode('.', $_FILES["image"]["name"]);
					$type = strtolower($type[count($type) - 1]);
					$imgname = uniqid(rand()) . '.' . $type;
					$url = "component/dist/img/admin/" . $imgname;
					if (in_array($type, array("jpg", "jpeg", "gif", "png"))) {
						if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
							if (move_uploaded_file($_FILES["image"]["tmp_name"], $url)) {
								$dataGambar = array(
									'image'   => $imgname
								);
								$file = $this->input->post('img');
								$path = "component/dist/img/admin/" . $file;

								if (file_exists($path)) {
									unlink($path);
								}

								if ($this->m_admin->admin_update($id, $dataGambar)) {
									$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
								} else {
									$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
								}
							}
						}
					}
				}
				redirect(base_url() . 'admin/list_admin');
			}
		}
	}

	public function list_device_rfid()
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

				$data['set'] = "list-device-rfid";
				$data['listdata'] = $this->m_admin->get_device_rfid();

				$this->load->view('admin/v_listdevicerfid', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function hapus_device_rfid($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$data = array('deleted' => 1);
				if ($this->m_admin->device_rfid_update($id, $data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
				}

				redirect(base_url() . 'admin/list_device_rfid');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function add_device_rfid()
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
				$data['set'] = "add-device-rfid";

				$this->load->view('admin/v_listdevicerfid', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function save_device_rfid()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$id_department = $this->input->post('id_department');

				$data = array(
					'deleted' => 0,
					'created_at' => time(),
					'data_rfid'   => '-',
					'status'	  => 0,
					'id_department' => $id_department
				);

				if ($this->m_admin->insert_device_rfid($data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
				}
				redirect(base_url() . 'admin/list_device_rfid');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function edit_device_rfid($id = null)
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
					$datadev = $this->m_admin->get_device_by_id($id);
					$c = 0;
					if (isset($datadev)) {
						foreach ($datadev as $key => $value) {
							//print_r($value);
							$data['id_device_rfid'] = $value->id_device_rfid;
							$data['id_department'] = $value->id_department;
							$c++;
						}
						$data['listdepartment'] = $this->m_admin->get_department();
						$data['set'] = "edit-device-rfid";
					}
					if ($c > 0) {
						$this->load->view('admin/v_listdevicerfid', $data);
					} else {
						redirect(base_url() . 'admin/list_device_rfid');
					}
				} else {
					redirect(base_url() . 'admin/list_device_rfid');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function save_edit_device_rfid()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');
			if ($role == 1) {
				if (isset($_POST['id_device_rfid']) && isset($_POST['id_department'])) {
					$id = $this->input->post('id_device_rfid');
					$id_department = $this->input->post('id_department');

					$data = array('id_department' => $id_department);

					if ($this->m_admin->device_rfid_update($id, $data)) {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
					} else {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
					}
				}
				redirect(base_url() . 'admin/list_device_rfid');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function log()
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

				$data['set'] = "log";
				$data['datalog'] = $this->m_admin->getlog();
				$this->load->view('admin/v_log', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function setting()
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

				$data['set'] = "setting";
				$data['secretKey'] = $this->m_admin->getSecretKey();
				$data['tokenTelegram'] = $this->m_admin->getTokenTelegram();
				$data['room_dashboard'] = $this->m_room->get_room_public();
				$data['departments'] = $this->db->get('department')->result();

				$this->load->view('admin/v_setting', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function free_access_room()
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

				$data['set'] = "list-free-access-room";
				$data['listdata'] = $this->m_admin->get_free_access_room();

				$this->load->view('admin/v_freeaccessroom', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function add_free_access_room()
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

				$data['set'] = "add-free-access-room";
				$data['listkaryawan'] = $this->m_admin->getKaryawan();

				$this->load->view('admin/v_freeaccessroom', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function save_free_access_room()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$id_karyawan = $this->input->post('id_karyawan');

				$getKaryawan = $this->m_admin->getFreeAccessRoombyIDKaryawan($id_karyawan);

				$x = 0;
				if (isset($getKaryawan)) {
					foreach ($getKaryawan as $key => $value) {
						$x++;
					}
				}

				if ($x == 0) {
					$data = array(
						'id_karyawan' => $id_karyawan
					);

					if ($this->m_admin->insert_free_access_room($data)) {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
					} else {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
					}
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Karyawan sudah terdaftar Free Access Room</div>");
				}

				redirect(base_url() . 'admin/free_access_room');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function hapus_free_access_room($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				if ($this->m_admin->delete_free_access_room($id)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
				}

				redirect(base_url() . 'admin/free_access_room');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function downloadlog()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				if (isset($_POST['tanggal'])) {
					$tanggal = $this->input->post('tanggal');
					//echo $tanggal;

					$split = explode("-", $tanggal);
					$x = 0;
					foreach ($split as $key => $value) {
						$date[$x] = $value;
						$x++;
					}

					$ts1 = strtotime($date[0]);
					$ts2 = strtotime($date[1]);

					$ts2 += 86400;	// tambah 1 hari (hitungan detik)

					$datalog = $this->m_admin->get_log_by_time($ts1, $ts2);

					$spreadsheet = new Spreadsheet;
					$baris = 1;
					$spreadsheet->setActiveSheetIndex(0)
						->setCellValue('A1', 'No')
						->setCellValue('B1', 'Room')
						->setCellValue('C1', 'Nama')
						->setCellValue('D1', 'NIK')
						->setCellValue('E1', 'Position')
						->setCellValue('F1', 'Date')
						->setCellValue('G1', 'Time')
						->setCellValue('H1', 'Department')
						->setCellValue('I1', 'Section')
						->setCellValue('J1', 'Remarks')
						->setCellValue('K1', 'Keterangan');

					$baris++;
					$nomor = 1;

					if (isset($datalog)) {
						foreach ($datalog as $log) {

							$tgl = Date("d M Y", $log->access_time);
							$tm = Date("H:i:s", $log->access_time);

							$spreadsheet->setActiveSheetIndex(0)
								->setCellValue('A' . $baris, $nomor)
								->setCellValue('B' . $baris, $log->nama_room)
								->setCellValue('C' . $baris, $log->nama_karyawan)
								->setCellValue('D' . $baris, $log->nik)
								->setCellValue('E' . $baris, $log->position)
								->setCellValue('F' . $baris, $tgl)
								->setCellValue('G' . $baris, $tm)
								->setCellValue('H' . $baris, $log->nama_department)
								->setCellValue('I' . $baris, $log->nama_section)
								->setCellValue('J' . $baris, $log->remarks_log)
								->setCellValue('K' . $baris, $log->keterangan);

							$baris++;
							$nomor++;
						}
					}

					$writer = new Xlsx($spreadsheet);

					header('Content-Type: application/vnd.ms-excel');
					header('Content-Disposition: attachment;filename="Log_' . $tanggal . '.xlsx"');
					header('Cache-Control: max-age=0');

					$writer->save('php://output');
				} else {
					redirect(base_url() . 'admin/log');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		}
	}

	public function set_room_dashboard()
	{
		if ($this->session->userdata('userlogin')) {
			$role = $this->session->userdata('role');

			if ($role == 1) {
				$room = $this->db->get_where('room', ['type' => 'public'])->result();

				if ($this->input->post('room_dash')) {
					foreach ($room as $rm) {
						$this->db->where('id_room', $rm->id_room);
						$this->db->update('room', ['flag_dashboard' => 0]);
					}

					$this->db->where('id_room', $this->input->post('room_dash'));
					$this->db->update('room', ['flag_dashboard' => 1]);
				}

				if ($this->input->post('room_dash_dua')) {
					foreach ($room as $rm) {
						$this->db->where('id_room', $rm->id_room);
						$this->db->update('room', ['flag_dashboard_dua' => 0]);
					}

					$this->db->where('id_room', $this->input->post('room_dash_dua'));
					$this->db->update('room', ['flag_dashboard_dua' => 1]);
				}

				if ($this->input->post('room_dash_tiga')) {
					foreach ($room as $rm) {
						$this->db->where('id_room', $rm->id_room);
						$this->db->update('room', ['flag_dashboard_tiga' => 0]);
					}

					$this->db->where('id_room', $this->input->post('room_dash_tiga'));
					$this->db->update('room', ['flag_dashboard_tiga' => 1]);
				}

				if ($this->input->post('room_dash_empat')) {
					foreach ($room as $rm) {
						$this->db->where('id_room', $rm->id_room);
						$this->db->update('room', ['flag_dashboard_empat' => 0]);
					}

					$this->db->where('id_room', $this->input->post('room_dash_empat'));
					$this->db->update('room', ['flag_dashboard_empat' => 1]);
				}

				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
				redirect(base_url() . 'admin/setting');
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function exclude()
	{
		$departments = $this->db->get('department')->result();

		foreach ($departments as $department) {
			$this->db->where('id_department', $department->id_department);
			$this->db->update('department', ['exclude' => 0]);
		}

		$this->db->where('id_department', $this->input->post('exclude'));
		$this->db->update('department', ['exclude' => 1]);

		$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
		redirect(base_url() . 'admin/setting');
	}
}
