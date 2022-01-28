<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Control extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_room');
		date_default_timezone_set("asia/jakarta");
	}

	public function index()
	{
		redirect(base_url() . 'admin/dashboard');
	}

	public function control()
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

				$data['set'] = "list-control";
				$Doorlock = $this->m_room->get_room();
				$totalDoorlock = count($Doorlock);
				$data['totaldoorlock'] = $totalDoorlock;
				$data['alldoorlock'] = $Doorlock;

				$page = 1;
				if (isset($_GET['page'])) {
					$page = $_GET['page'];
					if ($page == 0) {
						$page = 1;
					}
					$data['listdoorlock'] = $this->m_room->get_room_page($page);
				} else {
					$id_department = 0;
					if (isset($_GET['id_department'])) {
						$id_department = $_GET['id_department'];

						if ($id_department == "all") {
							redirect(base_url() . 'admin/control?page=1');
						}
						$data['listdoorlock'] = $this->m_room->get_room_id_department($id_department);
					} else {
						$all = 0;
						if (isset($_GET['all'])) {
							$all = $_GET['all'];
						}
						if ($all == 1) {
							$data['listdoorlock'] = $this->m_room->get_room();
						}
					}
				}

				$data['listdepartment'] = $this->m_admin->get_department();

				//print_r($data['listdoorlock']);

				$this->load->view('admin/v_control', $data);
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus super admin</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function positionswitch()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');

			$data['namauser'] = $namauser;
			$data['username'] = $username;
			$data['avatar'] = $avatar;
			$data['role'] = $role;

			if (isset($_POST['id_room'])) {
				$id_room = $_POST['id_room'];
				$checkbox_position = 1;
				if (isset($_POST['checkbox_position'])) {
					$checkbox_position = $_POST['checkbox_position'];
				}

				$link = "all=1";
				if (isset($_POST['link'])) {
					$link = $_POST['link'];
				}

				$data = array('auto' => $checkbox_position, 'relay_open' => 0);
				$this->m_room->room_update($id_room, $data);
				if ($role == 1) {
					redirect(base_url() . 'admin/control?' . $link);
				} else {
					redirect(base_url() . 'karyawan/control?all=1');
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

	public function control_relay()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');

			$data['namauser'] = $namauser;
			$data['username'] = $username;
			$data['avatar'] = $avatar;
			$data['role'] = $role;

			if (isset($_POST['id_room'])) {
				$id_room = $_POST['id_room'];
				$checkbox_relay = 0;
				if (isset($_POST['checkbox_relay'])) {
					$checkbox_relay = $_POST['checkbox_relay'];
				}

				$link = "all=1";
				if (isset($_POST['link'])) {
					$link = $_POST['link'];
				}

				$data = array('relay_open' => $checkbox_relay);
				$this->m_room->room_update($id_room, $data);
				if ($role == 1) {
					redirect(base_url() . 'admin/control?' . $link);
				} else {
					redirect(base_url() . 'karyawan/control?all=1');
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

	public function monitoring()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');

			$data['namauser'] = $namauser;
			$data['username'] = $username;
			$data['avatar'] = $avatar;
			$data['role'] = $role;

			$data['set'] = "monitoring";
			$Doorlock = $this->m_room->get_room();
			$totalDoorlock = count($Doorlock);
			$data['totaldoorlock'] = $totalDoorlock;
			$data['alldoorlock'] = $Doorlock;

			$data['listdepartment'] = $this->m_admin->get_department();
			if ($role == 1) {
				$this->load->view('admin/v_monitoring', $data);
			} else {
				$this->load->view('karyawan/v_control', $data);
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function monitoringdep()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$iduser = $this->session->userdata('id');
			$username = $this->session->userdata('username');
			$email = $this->session->userdata('email');
			$avatar = $this->session->userdata('image');
			$role = $this->session->userdata('role');

			$data['namauser'] = $namauser;
			$data['username'] = $username;
			$data['avatar'] = $avatar;
			$data['role'] = $role;

			$id_department = 0;
			if (isset($_GET['id_department'])) {
				$id_department = $_GET['id_department'];

				if ($id_department == "all") {
					if ($role == 1) {
						redirect(base_url() . 'admin/monitoring');
					} else {
						redirect(base_url() . 'karyawan/monitoring');
					}
				}
			}

			$data['set'] = "monitoring-department";
			$Doorlock = $this->m_room->get_room_id_department($id_department);

			$data['alldoorlock'] = $Doorlock;
			$data['id_department'] = $id_department;

			$data['listdepartment'] = $this->m_admin->get_department();


			if ($role == 1) {
				$this->load->view('admin/v_monitoring', $data);
			} else {
				redirect(base_url('karyawan/monitoring'));
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}
}
