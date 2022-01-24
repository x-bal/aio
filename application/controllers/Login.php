<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->library('bcrypt');
	}

	public function index()
	{
		$data = array('mode' => 'karyawan');
		$this->load->view('v_login', $data);
	}

	public function admin()
	{
		$data = array('mode' => 'admin');
		$this->load->view('v_login', $data);
	}

	public function karyawan_check()
	{
		if (isset($_POST['nik']) && isset($_POST['password'])) {

			$nik = $this->input->post('nik');
			$pass = $this->input->post('password');
			$hash = $this->bcrypt->hash_password($pass);	//encrypt password

			if (isset($_POST["remember"])) {
				$hour = time() + (3600 * 24 * 7);
				setcookie('nik', $nik, $hour);
				setcookie('password', $pass, $hour);
			}

			//ambil data dari database
			$check = $this->m_login->prosesLoginKaryawan($nik);
			$hasil = 0;
			if (isset($check)) {
				$hasil++;
			}

			//echo $pass;
			//echo "<br>";
			if ($hasil > 0) {
				$data = $this->m_login->viewDataByNIK($nik);
				foreach ($data as $dkey) {
					$passDB = $dkey->password;
					$id = $dkey->id_karyawan;
					$uname = $dkey->nik;
					$name = $dkey->nama_karyawan;
					$status = $dkey->status;
					$foto = $dkey->foto;
					$id_section = $dkey->id_section;
					$id_position = $dkey->id_position;
					$disable_remarks = $dkey->disable_remarks;
					$rfid = $dkey->uid_rfid;
				}
				//echo $this->bcrypt->check_password($pass, $passDB);
				if ($this->bcrypt->check_password($pass, $passDB)) {
					if ($status == 1) {
						// Password match
						$this->session->set_userdata('userlogin', $name);
						$this->session->set_userdata('id_karyawan', $id);
						$this->session->set_userdata('nik', $uname);
						$this->session->set_userdata('status', $status);
						$this->session->set_userdata('foto', $foto);
						$this->session->set_userdata('id_section', $id_section);
						$this->session->set_userdata('id_position', $id_position);
						$this->session->set_userdata('disable_remarks', $disable_remarks);
						$this->session->set_userdata('rfid', $rfid);

						$dataSect = $this->m_login->get_section_by_id_secton($id_section);
						$id_department = 0;
						if (isset($dataSect)) {
							foreach ($dataSect as $key => $value) {
								$id_department = $value->id_department;
								$this->session->set_userdata('id_department', $value->id_department);
								$this->session->set_userdata('nama_section', $value->nama_section);
							}
						}

						$dataDept = $this->m_login->get_department_by_id($id_department);
						if (isset($dataDept)) {
							foreach ($dataDept as $key => $value) {
								$this->session->set_userdata('nama_department', $value->nama_department);
							}
						}

						$dataPosition = $this->m_login->get_position_by_id($id_position);
						if (isset($dataPosition)) {
							foreach ($dataPosition as $key => $value) {
								$this->session->set_userdata('nama_position', $value->position);
							}
						}

						if ($id_position >= 4) {
							redirect(base_url() . 'karyawan/dashboard');
						} else {
							redirect(base_url() . 'karyawan/log');
						}
					} else {
						// status disable
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, status disable</div>");
						redirect(base_url() . 'login');
					}
				} else {
					// Password does not match
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, password salah</div>");
					redirect(base_url() . 'login');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, NIK tidak ditemukan</div>");
				redirect(base_url() . 'login');
			}
		} else {
			redirect(base_url() . 'login');
		}
	}

	public function admin_check()
	{
		if (isset($_POST['username']) && isset($_POST['password'])) {

			$username = $this->input->post('username');
			$pass = $this->input->post('password');
			$hash = $this->bcrypt->hash_password($pass);	//encrypt password

			if (isset($_POST["remember"])) {
				$hour = time() + (3600 * 24 * 7);
				setcookie('username', $username, $hour);
				setcookie('password', $pass, $hour);
			}

			//ambil data dari database
			$check = $this->m_login->prosesLogin($username);
			$hasil = 0;
			if (isset($check)) {
				$hasil++;
			}

			//echo $pass;
			//echo "<br>";
			if ($hasil > 0) {
				$data = $this->m_login->viewDataByID($username);
				foreach ($data as $dkey) {
					$passDB = $dkey->password;
					$id = $dkey->id_user;
					$uname = $dkey->username;
					$name = $dkey->nama;
					$email = $dkey->email;
					$image = $dkey->image;
					$role = $dkey->role;
					$id_department = $dkey->id_department;
				}
				//echo $this->bcrypt->check_password($pass, $passDB);
				if ($this->bcrypt->check_password($pass, $passDB)) {
					// Password match
					$this->session->set_userdata('userlogin', $name);
					$this->session->set_userdata('id', $id);
					$this->session->set_userdata('username', $uname);
					$this->session->set_userdata('email', $email);
					$this->session->set_userdata('image', $image);
					$this->session->set_userdata('role', $role);

					if ($role == 2) {
						$dataDept = $this->m_login->get_department_by_id($id_department);
						if (isset($dataDept)) {
							foreach ($dataDept as $key => $value) {
								$this->session->set_userdata('id_department', $id_department);
								$this->session->set_userdata('nama_department', $value->nama_department);
							}
						}
					}

					redirect(base_url() . 'admin/dashboard');
				} else {
					// Password does not match
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, password salah</div>");
					redirect(base_url() . 'login/admin');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, username tidak ditemukan</div>");
				redirect(base_url() . 'login/admin');
			}
		} else {
			redirect(base_url() . 'login/admin');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . 'login');
	}
}
