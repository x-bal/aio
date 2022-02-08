<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Karyawan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_karyawan');
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
		redirect(base_url() . 'karyawan/dashboard');
	}

	public function register()
	{
		$data['listdepartment'] = $this->m_admin->get_department();
		$data['listposition'] = $this->m_admin->get_position();
		$this->load->view('karyawan/v_register', $data);
	}

	public function getsectionbydept($id = null)
	{
		$data['status'] = "error";
		if (isset($id)) {
			$section = $this->m_admin->get_section($id);
			if (isset($section)) {
				$data['section'] = $section;
				$data['status'] = "success";
			}
		}
		echo json_encode($data);
	}

	public function publicrfidreader()
	{
		$data['status'] = "error";
		$reader = $this->m_karyawan->get_public_reader();
		if (isset($reader)) {
			$data['reader'] = $reader;
			$data['status'] = "success";
			$dt = array('status' => 0, 'last_update' => time());
			$this->m_karyawan->update_public_reader($dt);
		}
		echo json_encode($data);
	}

	public function register_save()
	{
		if (isset($_POST['token'])) {
			$token = $this->input->post('token');

			$reader = $this->m_karyawan->get_public_reader();
			if (isset($reader)) {
				foreach ($reader as $key => $value) {
					if ($value->token == $token) {
						$id_department = $this->input->post('id_department');
						$id_section = $this->input->post('id_section');
						$id_position = $this->input->post('id_position');
						$nik = $this->input->post('nik');
						$nama_karyawan = $this->input->post('nama');
						$rfid = $this->input->post('rfid');
						$hash = $this->bcrypt->hash_password($nik);

						$data = array(
							'id_section'  => $id_section, 'id_position' => $id_position,
							'nik' => $nik, 'password' => $hash, 'nama_karyawan' => $nama_karyawan, 'status' => 0,
							'uid_rfid' => $rfid, 'disable_remarks' => 0, 'foto' => 'default.png', 'created_at' => time(), 'deleted' => 0
						);

						if ($this->m_karyawan->insert_karyawan($data)) {
							$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Berhasil daftar, tunggu persetujuan Admin</div>");
						} else {
							$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Daftar</div>");
						}

						redirect(base_url() . 'login');
					} else {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Daftar, token tidak valid</div>");
						redirect(base_url() . 'login');
					}
				}
			}
		}
	}

	public function dashboard()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$id_karyawan = $this->session->userdata('id_karyawan');
			$nik = $this->session->userdata('nik');
			$status = $this->session->userdata('status');
			$avatar = $this->session->userdata('foto');
			$id_section = $this->session->userdata('id_section');
			$nama_section = $this->session->userdata('nama_section');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');
			$id_position = $this->session->userdata('id_position');
			$nama_position = $this->session->userdata('nama_position');
			$disable_remarks = $this->session->userdata('disable_remarks');

			if ($id_position >= 4) {
				$data['namauser'] = $namauser;
				$data['nik'] = $nik;
				$data['avatar'] = $avatar;
				$data['status'] = $status;
				$data['nama_department'] = $nama_department;
				$data['nama_section'] = $nama_section;
				$data['nama_position'] = $nama_position;
				$data['disable_remarks'] = $disable_remarks;


				//$data['namauser'] = $namauser;
				//$data['username'] = $username;
				//$data['avatar'] = $avatar;

				$thismonth = strtotime(date("Y-m", strtotime('+0 month')));
				$nextmonth = strtotime(date('Y-m', strtotime('+1 month')));

				$getRoomDashboard = $this->m_room->get_room_dashboard_active();
				$id_room_dash = 0;
				$nama_room_dash = "";
				if (isset($getRoomDashboard)) {
					foreach ($getRoomDashboard as $key => $value) {
						$id_room_dash = $value->id_room;
						$nama_room_dash = $value->nama_room;
					}
				}

				$data['nama_room_dash'] = $nama_room_dash;
				$data['dataAccess'] = $this->m_admin->getRoomByID($id_room_dash, $thismonth, $nextmonth);
				$data['department'] = $this->m_admin->get_department();
				$data['karyawan'] = $this->m_admin->getKaryawan();
				$data['room'] = $this->m_admin->getRoom();
				$data['totalAccess'] = $this->m_admin->getlogthismonth($thismonth, $nextmonth);

				$this->load->view('karyawan/v_dashboard', $data);
			} else {
				redirect(base_url() . 'karyawan/log');
			}
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login');
		}
	}

	public function setting()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$id_karyawan = $this->session->userdata('id_karyawan');
			$nik = $this->session->userdata('nik');
			$status = $this->session->userdata('status');
			$avatar = $this->session->userdata('foto');
			$id_section = $this->session->userdata('id_section');
			$nama_section = $this->session->userdata('nama_section');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');
			$id_position = $this->session->userdata('id_position');
			$nama_position = $this->session->userdata('nama_position');
			$disable_remarks = $this->session->userdata('disable_remarks');
			$rfid = $this->session->userdata('rfid');

			$data['id_karyawan'] = $id_karyawan;
			$data['namauser'] = $namauser;
			$data['nik'] = $nik;
			$data['avatar'] = $avatar;
			$data['status'] = $status;
			$data['nama_department'] = $nama_department;
			$data['nama_section'] = $nama_section;
			$data['nama_position'] = $nama_position;
			$data['disable_remarks'] = $disable_remarks;
			$data['rfid'] = $rfid;

			$data['set'] = "setting";

			$this->load->view('karyawan/v_setting', $data);
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login');
		}
	}

	public function save_change_password()
	{
		if ($this->session->userdata('userlogin')) {
			$id_karyawan = $this->session->userdata('id_karyawan');

			$id_karyawan_post = 0;
			if (isset($_POST['id_karyawan'])) {
				$id_karyawan_post = $this->input->post('id_karyawan');
			}

			if ($id_karyawan_post == $id_karyawan) {
				if (isset($_POST['password']) && isset($_POST['password1']) && isset($_POST['password2'])) {
					$password = $this->input->post('password');
					$password1 = $this->input->post('password1');
					$password2 = $this->input->post('password2');
					$hash = $this->bcrypt->hash_password($password1);

					$dataUser = $this->m_karyawan->get_karyawan_by_id($id_karyawan);

					$oldPass = "";
					if (isset($dataUser)) {
						foreach ($dataUser as $key => $value) {
							$oldPass = $value->password;
						}
					}

					if ($this->bcrypt->check_password($password, $oldPass)) {
						if ($password1 == $password2) {
							$data = array('password' => $hash);

							if ($this->m_karyawan->karyawan_update($id_karyawan, $data)) {
								$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
							} else {
								$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
							}
						} else {
							$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Password baru tidak sama</div>");
						}
					} else {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Password saat ini tidak cocok</div>");
					}
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
			}
			redirect(base_url() . 'karyawan/setting');
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Tidak bisa mengakses</div>");
			redirect(base_url() . 'login');
		}
	}

	public function log()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$id_karyawan = $this->session->userdata('id_karyawan');
			$nik = $this->session->userdata('nik');
			$status = $this->session->userdata('status');
			$avatar = $this->session->userdata('foto');
			$id_section = $this->session->userdata('id_section');
			$nama_section = $this->session->userdata('nama_section');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');
			$id_position = $this->session->userdata('id_position');
			$nama_position = $this->session->userdata('nama_position');
			$disable_remarks = $this->session->userdata('disable_remarks');
			$rfid = $this->session->userdata('rfid');

			$data['id_karyawan'] = $id_karyawan;
			$data['namauser'] = $namauser;
			$data['nik'] = $nik;
			$data['avatar'] = $avatar;
			$data['status'] = $status;
			$data['nama_department'] = $nama_department;
			$data['nama_section'] = $nama_section;
			$data['nama_position'] = $nama_position;
			$data['disable_remarks'] = $disable_remarks;
			$data['rfid'] = $rfid;

			$data['set'] = "log";

			if ($id_position == 1) {	//staff = s1
				$data['logkaryawan'] = $this->m_karyawan->get_log_karyawan_by_id($id_karyawan);
			} else if ($id_position == 2) {	//leader = s2
				$data['set'] = "log2";
				$id_position_bawahan = 1;	//s1
				$data['logkaryawan'] = $this->m_karyawan->get_log_karyawan_by_id($id_karyawan);
				$data['logbawahan']	= $this->m_karyawan->get_log_bawahan_s2_by_id_dep($id_department, $id_position_bawahan);
			} else if ($id_position == 3) {	//superviser = s3
				$data['set'] = "log3";
				$data['flagjabatan'] = "S3";
				$id_position_bawahan1 = 1;	//s1
				$id_position_bawahan2 = 2;	//s2
				$data['logkaryawan'] = $this->m_karyawan->get_log_karyawan_by_id($id_karyawan);
				$data['logbawahan']	= $this->m_karyawan->get_log_bawahan_s3_by_id_dep($id_department, $id_position_bawahan1, $id_position_bawahan2);
			} else if ($id_position == 4 || $id_position == 5 || $id_position == 6) {	//manager = m1 | m2 | m3
				$data['set'] = "log4";
				$data['flagjabatan'] = "M1";
				$id_position_bawahan1 = 1;	//s1
				$id_position_bawahan2 = 2;	//s2
				$id_position_bawahan3 = 3;	//s3
				$data['logkaryawan'] = $this->m_karyawan->get_log_karyawan_by_id($id_karyawan);
				$data['logbawahan']	= $this->m_karyawan->get_log_bawahan_m1_by_id_dep($id_department, $id_position_bawahan1, $id_position_bawahan2, $id_position_bawahan3);
			}

			$this->load->view('karyawan/v_log', $data);
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login');
		}
	}

	public function remarksroom()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$id_karyawan = $this->session->userdata('id_karyawan');
			$nik = $this->session->userdata('nik');
			$status = $this->session->userdata('status');
			$avatar = $this->session->userdata('foto');
			$id_section = $this->session->userdata('id_section');
			$nama_section = $this->session->userdata('nama_section');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');
			$id_position = $this->session->userdata('id_position');
			$nama_position = $this->session->userdata('nama_position');
			$disable_remarks = $this->session->userdata('disable_remarks');
			$rfid = $this->session->userdata('rfid');

			$data['id_karyawan'] = $id_karyawan;
			$data['namauser'] = $namauser;
			$data['nik'] = $nik;
			$data['avatar'] = $avatar;
			$data['status'] = $status;
			$data['nama_department'] = $nama_department;
			$data['nama_section'] = $nama_section;
			$data['nama_position'] = $nama_position;
			$data['disable_remarks'] = $disable_remarks;
			$data['rfid'] = $rfid;

			$data['set'] = "remarksroom";
			$data['room'] = $this->m_karyawan->get_room_public();
			$data['access_room'] = $this->m_karyawan->get_access_room_karyawan($id_karyawan);

			$this->load->view('karyawan/v_remarksroom', $data);
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login');
		}
	}

	public function fillremarks($id = null)
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$id_karyawan = $this->session->userdata('id_karyawan');
			$nik = $this->session->userdata('nik');
			$status = $this->session->userdata('status');
			$avatar = $this->session->userdata('foto');
			$id_section = $this->session->userdata('id_section');
			$nama_section = $this->session->userdata('nama_section');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');
			$id_position = $this->session->userdata('id_position');
			$nama_position = $this->session->userdata('nama_position');
			$disable_remarks = $this->session->userdata('disable_remarks');
			$rfid = $this->session->userdata('rfid');

			$data['id_karyawan'] = $id_karyawan;
			$data['namauser'] = $namauser;
			$data['nik'] = $nik;
			$data['avatar'] = $avatar;
			$data['status'] = $status;
			$data['nama_department'] = $nama_department;
			$data['nama_section'] = $nama_section;
			$data['nama_position'] = $nama_position;
			$data['disable_remarks'] = $disable_remarks;
			$data['rfid'] = $rfid;

			$data['set'] = "fillremarks";
			$data['dataroom'] = $this->m_karyawan->get_room_by_id($id);
			$data['remarksactivity'] = $this->m_karyawan->remarksactivity();

			$this->load->view('karyawan/v_remarksroom', $data);
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login');
		}
	}

	public function fillremarkssave()
	{
		if ($this->session->userdata('userlogin')) {
			$id_karyawan = $this->session->userdata('id_karyawan');

			$id_karyawan_post = 0;
			if (isset($_POST['id_karyawan'])) {
				$id_karyawan_post = $this->input->post('id_karyawan');
			}

			if ($id_karyawan_post == $id_karyawan) {
				if (isset($_POST['id_room']) && isset($_POST['remarks_activity'])) {
					$id_room = $this->input->post('id_room');
					$id_remarks_activity = $this->input->post('remarks_activity');

					$getRemarksAct = $this->m_karyawan->get_remarks_activity_by_id($id_remarks_activity);
					$remarks_activity = "";
					if (isset($getRemarksAct)) {
						foreach ($getRemarksAct as $key => $value) {
							$remarks_activity = $value->remarks_activity;
						}
					}

					$remarks_text = $remarks_activity;

					if (isset($_POST['remarks_activity2'])) {
						$remarks_activity2 = $this->input->post('remarks_activity2');
						$remarks_text = $remarks_text . " - " . $remarks_activity2;
					}

					$data = array('id_karyawan' => $id_karyawan, 'id_room' => $id_room, 'waktu_remarks' => time(), 'remarks_text' => $remarks_text);

					if ($this->m_karyawan->insert_remarks($data)) {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
					} else {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
					}
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
			}
			redirect(base_url() . 'karyawan/remarksroom');
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Tidak bisa mengakses</div>");
			redirect(base_url() . 'login');
		}
	}

	public function save_change_foto()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$id_karyawan = $this->session->userdata('id_karyawan');
			$nik = $this->session->userdata('nik');
			$status = $this->session->userdata('status');
			$avatar = $this->session->userdata('foto');
			$id_section = $this->session->userdata('id_section');
			$nama_section = $this->session->userdata('nama_section');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');
			$id_position = $this->session->userdata('id_position');
			$nama_position = $this->session->userdata('nama_position');
			$disable_remarks = $this->session->userdata('disable_remarks');
			$rfid = $this->session->userdata('rfid');

			$type = explode('.', $_FILES["image"]["name"]);
			$type = strtolower($type[count($type) - 1]);
			$imgname = uniqid(rand()) . '.' . $type;
			$url = "component/dist/img/karyawan/" . $imgname;
			if (in_array($type, array("jpg", "jpeg", "gif", "png"))) {
				if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
					if (move_uploaded_file($_FILES["image"]["tmp_name"], $url)) {
						$data = array(
							'foto'   => $imgname
						);
						$this->m_karyawan->karyawan_update($id_karyawan, $data);
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Foto berhasil di update</div>");
						if ($avatar != "default.png") {
							$path = "component/dist/img/karyawan/" . $avatar;

							if (file_exists($path)) {
								unlink($path);
							}
						}
						$this->session->set_userdata('foto', $imgname);
					}
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Foto gagal di update, ekstensi gambar salah</div>");
			}

			redirect(base_url() . 'karyawan/setting');
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login');
		}
	}

	public function downloadlog()
	{
		if ($this->session->userdata('userlogin')) {
			$id_position = $this->session->userdata('id_position');
			$id_department = $this->session->userdata('id_department');

			if ($id_position >= 3) {
				if (isset($_POST['flagjabatan'])) {
					$flagjabatan = $this->input->post('flagjabatan');

					if ($flagjabatan == "S3") {
						$id_position_bawahan1 = 1;
						$id_position_bawahan2 = 2;
						$datalog = $this->m_karyawan->get_log_bawahan_s3_by_id_dep($id_department, $id_position_bawahan1, $id_position_bawahan2);
					} else if ($flagjabatan == "M1") {
						$id_position_bawahan1 = 1;	//s1
						$id_position_bawahan2 = 2;	//s2
						$id_position_bawahan3 = 3;	//s3
						$datalog = $this->m_karyawan->get_log_bawahan_m1_by_id_dep($id_department, $id_position_bawahan1, $id_position_bawahan2, $id_position_bawahan3);
					} else {
						redirect(base_url() . 'karyawan/log');
					}


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
					header('Content-Disposition: attachment;filename="Log.xlsx"');
					header('Cache-Control: max-age=0');

					$writer->save('php://output');
				} else {
					redirect(base_url() . 'karyawan/log');
				}
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Area khusus</div>");
				redirect(base_url() . 'login');
			}
		}
	}

	public function control()
	{
		if ($this->session->userdata('userlogin') && $this->session->userdata('control_room') == 1) {
			$namauser = $this->session->userdata('userlogin');
			$id_karyawan = $this->session->userdata('id_karyawan');
			$nik = $this->session->userdata('nik');
			$status = $this->session->userdata('status');
			$avatar = $this->session->userdata('foto');
			$id_section = $this->session->userdata('id_section');
			$nama_section = $this->session->userdata('nama_section');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');
			$id_position = $this->session->userdata('id_position');
			$nama_position = $this->session->userdata('nama_position');
			$disable_remarks = $this->session->userdata('disable_remarks');
			$rfid = $this->session->userdata('rfid');

			$data['id_karyawan'] = $id_karyawan;
			$data['namauser'] = $namauser;
			$data['nik'] = $nik;
			$data['avatar'] = $avatar;
			$data['status'] = $status;
			$data['nama_department'] = $nama_department;
			$data['nama_section'] = $nama_section;
			$data['nama_position'] = $nama_position;
			$data['disable_remarks'] = $disable_remarks;
			$data['rfid'] = $rfid;


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
						redirect(base_url() . 'karyawan/control?page=1');
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

			$this->load->view('karyawan/v_control', $data);
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function monitoring()
	{
		if ($this->session->userdata('monitoring') == 1) {
			$namauser = $this->session->userdata('userlogin');
			$id_karyawan = $this->session->userdata('id_karyawan');
			$nik = $this->session->userdata('nik');
			$status = $this->session->userdata('status');
			$avatar = $this->session->userdata('foto');
			$id_section = $this->session->userdata('id_section');
			$nama_section = $this->session->userdata('nama_section');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');
			$id_position = $this->session->userdata('id_position');
			$nama_position = $this->session->userdata('nama_position');
			$disable_remarks = $this->session->userdata('disable_remarks');
			$rfid = $this->session->userdata('rfid');

			$data['id_karyawan'] = $id_karyawan;
			$data['namauser'] = $namauser;
			$data['nik'] = $nik;
			$data['avatar'] = $avatar;
			$data['status'] = $status;
			$data['nama_department'] = $nama_department;
			$data['nama_section'] = $nama_section;
			$data['nama_position'] = $nama_position;
			$data['disable_remarks'] = $disable_remarks;
			$data['rfid'] = $rfid;

			$data['set'] = "monitoring";
			$Doorlock = $this->m_room->get_room();
			$totalDoorlock = count($Doorlock);
			$data['totaldoorlock'] = $totalDoorlock;
			$data['alldoorlock'] = $Doorlock;

			$data['listdepartment'] = $this->m_admin->get_department();
			$this->load->view('karyawan/v_monitoring', $data);
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}

	public function monitoringdep()
	{
		if ($this->session->userdata('userlogin')) {
			$namauser = $this->session->userdata('userlogin');
			$id_karyawan = $this->session->userdata('id_karyawan');
			$nik = $this->session->userdata('nik');
			$status = $this->session->userdata('status');
			$avatar = $this->session->userdata('foto');
			$id_section = $this->session->userdata('id_section');
			$nama_section = $this->session->userdata('nama_section');
			$id_department = $this->session->userdata('id_department');
			$nama_department = $this->session->userdata('nama_department');
			$id_position = $this->session->userdata('id_position');
			$nama_position = $this->session->userdata('nama_position');
			$disable_remarks = $this->session->userdata('disable_remarks');
			$rfid = $this->session->userdata('rfid');

			$data['id_karyawan'] = $id_karyawan;
			$data['namauser'] = $namauser;
			$data['nik'] = $nik;
			$data['avatar'] = $avatar;
			$data['status'] = $status;
			$data['nama_department'] = $nama_department;
			$data['nama_section'] = $nama_section;
			$data['nama_position'] = $nama_position;
			$data['disable_remarks'] = $disable_remarks;
			$data['rfid'] = $rfid;

			$id_department = 0;
			if (isset($_GET['id_department'])) {
				$id_department = $_GET['id_department'];

				if ($id_department == "all") {
					redirect(base_url() . 'karyawan/monitoring');
				}
			}

			$data['set'] = "monitoring-department";
			$Doorlock = $this->m_room->get_room_id_department($id_department);

			$data['alldoorlock'] = $Doorlock;
			$data['id_department'] = $id_department;

			$data['listdepartment'] = $this->m_admin->get_department();


			$this->load->view('karyawan/v_monitoring', $data);
		} else {
			$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
			redirect(base_url() . 'login/admin');
		}
	}
}
