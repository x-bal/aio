<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_api');
		$this->load->model('m_room');
		date_default_timezone_set("asia/jakarta");
	}

	public function index()
	{
		echo "REST API for Device";
	}

	public function registerdev()
	{
		if (isset($_POST['key']) && isset($_POST['rfid']) && isset($_POST['token'])) {
			$key = $this->input->post('key');
			$cekkey = $this->m_api->getkey();

			if ($cekkey[0]->key == $key) {
				$rfid = $this->input->post('rfid');
				$token = $this->input->post('token');

				$checkDoubleRFID = $this->m_api->checkRFID($rfid);
				$z = 0;
				if (isset($checkDoubleRFID)) {
					foreach ($checkDoubleRFID as $key => $value) {
						$z++;
					}
				}

				if ($z > 0) {
					$notif = array('status' => 'failed', 'ket' => 'RFID sudah terdaftar');
					echo json_encode($notif);
				} else {

					$savedata = array('token' => $token, 'uid_rfid' => $rfid, 'status' => 1, 'last_update' => time());
					if ($this->m_api->update_public_reader($savedata)) {
						$notif = array('status' => 'success', 'ket' => 'berhasil tambah rfid card');
						echo json_encode($notif);
					}
				}
			} else {
				$notif = array('status' => 'failed', 'ket' => 'salah secret key');
				echo json_encode($notif);
			}
		} else {
			$notif = array('status' => 'failed', 'ket' => 'salah parameter');
			echo json_encode($notif);
		}
	}

	public function access_room()
	{
		if (isset($_POST['key']) && isset($_POST['rfid']) && isset($_POST['iddev'])) {
			$key = $this->input->post('key');
			$cekkey = $this->m_api->getkey();

			if ($cekkey[0]->key == $key) {
				$rfid = $this->input->post('rfid');
				$iddev = $this->input->post('iddev');

				$checkDoubleRFID = $this->m_api->checkRFID($rfid);
				$z = 0;
				$id_karyawan = 0;
				$nik = "";
				$nama_karyawan = "";
				$disable_remarks = 0;
				$status = 0;
				$deleted = 0;
				$id_section = 0;

				if (isset($checkDoubleRFID)) {
					foreach ($checkDoubleRFID as $key => $value) {
						$z++;
						$id_karyawan = $value->id_karyawan;
						$nik = $value->nik;
						$nama_karyawan = $value->nama_karyawan;
						$disable_remarks = $value->disable_remarks;
						$status = $value->status;
						$deleted = $value->deleted;
						$id_section = $value->id_section;
					}
				}

				$id_department = 0;
				$getDeptBySection = $this->m_api->get_section_by_id($id_section);

				if (isset($getDeptBySection)) {
					foreach ($getDeptBySection as $key => $value) {
						$id_department = $value->id_department;
					}
				}

				$nama_department = "";
				$dataDept = $this->m_api->get_department_by_id($id_department);
				if (isset($dataDept)) {
					foreach ($dataDept as $key => $value) {
						$nama_department = $value->nama_department;
					}
				}

				$device = $this->m_api->getdevice($iddev);
				$count = 0;
				$namadev = "";
				$id_department_dev = 0;
				$type_dev = "";
				$need_remarks = 0;

				foreach ($device as $key => $value) {
					$count++;
					$namadev = $value->nama_room;
					$id_department_dev = $value->id_department;
					$type_dev = $value->type;
					$need_remarks = $value->need_remarks;
				}

				$accessRoom = 0;
				$dataAccess = $this->m_api->checkAccessRoom($id_karyawan, $iddev);
				if (isset($dataAccess)) {
					foreach ($dataAccess as $key => $value) {
						$accessRoom++;
					}
				}

				$wkt = date("d/M/Y H:i:s", time());

				if ($z > 0) {
					if ($count > 0) {

						$imgname = "";
						$statFoto = "capture foto gagal";
						if (isset($_FILES["foto"])) {
							$type = explode('.', $_FILES["foto"]["name"]);
							$type = strtolower($type[count($type) - 1]);
							$imgname = date("dmY_H-i-s_", time()) . uniqid(rand()) . '.' . $type;
							$url = "component/dist/log_img/" . $imgname;
							if (in_array($type, array("jpg", "jpeg", "gif", "png"))) {
								if (is_uploaded_file($_FILES["foto"]["tmp_name"])) {
									if (move_uploaded_file($_FILES["foto"]["tmp_name"], $url)) {
										$statFoto = "capture foto sukses";
									}
								}
							} else {
								$statFoto = "capture foto gagal";
							}
						}

						if ($status == 1) {
							$freeAccess = $this->m_api->getFreeAccessbyIDkaryawan($id_karyawan);
							$fa = 0;
							if (isset($freeAccess)) {
								foreach ($freeAccess as $key => $value) {
									$fa++;
								}
							}
							if ($fa > 0) {			// free access
								$notif = array('status' => 'success', 'ket' => 'Access Granted', 'nama' => $nama_karyawan, 'department' => $nama_department, 'lock' => 'open', 'nama_room' => $namadev, 'foto' => $statFoto);
								echo json_encode($notif);
								$histori = array('id_karyawan' => $id_karyawan, 'keterangan' => 'Access Granted, Free Access Room', 'access_time' => time(), 'id_room' => $iddev, 'remarks_log' => '-', 'cam' => $imgname);
								$this->m_api->insert_log($histori);
							} else {
								if ($type_dev == "restricted") {
									if ($id_department_dev == $id_department) {
										if ($accessRoom > 0) {
											$notif = array('status' => 'success', 'ket' => 'Access Granted', 'nama' => $nama_karyawan, 'department' => $nama_department, 'lock' => 'open', 'nama_room' => $namadev, 'foto' => $statFoto);
											echo json_encode($notif);
											$histori = array('id_karyawan' => $id_karyawan, 'keterangan' => 'Access Granted', 'access_time' => time(), 'id_room' => $iddev, 'remarks_log' => '-', 'cam' => $imgname);
											$this->m_api->insert_log($histori);
										} else {
											$notif = array('status' => 'failed', 'ket' => 'No Access', 'nama' => $nama_karyawan, 'department' => $nama_department, 'lock' => 'close', 'nama_room' => $namadev, 'foto' => $statFoto);
											echo json_encode($notif);
											$histori = array('id_karyawan' => $id_karyawan, 'keterangan' => 'Access Denied, akses ruangan ditolak', 'access_time' => time(), 'id_room' => $iddev, 'remarks_log' => '-', 'cam' => $imgname);
											$this->m_api->insert_log($histori);
										}
									} else {
										$notif = array('status' => 'failed', 'ket' => 'No Access', 'nama' => $nama_karyawan, 'department' => $nama_department, 'lock' => 'close', 'nama_room' => $namadev, 'foto' => $statFoto);
										echo json_encode($notif);
										$histori = array('id_karyawan' => $id_karyawan, 'keterangan' => 'Access Denied, Department Tidak Sesuai', 'access_time' => time(), 'id_room' => $iddev, 'remarks_log' => '-', 'cam' => $imgname);
										$this->m_api->insert_log($histori);
									}
								} else {
									//public
									if ($need_remarks == 0) {
										if ($accessRoom > 0) {
											$notif = array('status' => 'success', 'ket' => 'Access Granted', 'nama' => $nama_karyawan, 'department' => $nama_department, 'lock' => 'open', 'nama_room' => $namadev, 'foto' => $statFoto);
											echo json_encode($notif);
											$histori = array('id_karyawan' => $id_karyawan, 'keterangan' => 'Access Granted', 'access_time' => time(), 'id_room' => $iddev, 'remarks_log' => '-', 'cam' => $imgname);
											$this->m_api->insert_log($histori);
										} else {
											$notif = array('status' => 'failed', 'ket' => 'No Access', 'nama' => $nama_karyawan, 'department' => $nama_department, 'lock' => 'close', 'nama_room' => $namadev, 'foto' => $statFoto);
											echo json_encode($notif);
											$histori = array('id_karyawan' => $id_karyawan, 'keterangan' => 'Access Denied, akses ruangan ditolak', 'access_time' => time(), 'id_room' => $iddev, 'remarks_log' => '-', 'cam' => $imgname);
											$this->m_api->insert_log($histori);
										}
									} else {
										if ($accessRoom > 0) {
											//cek remarks for access room
											$waktuambildata = 3600;	// detik | 1jam kebelakang
											$remarks_room = $this->m_api->remarks_room($iddev, $id_karyawan, $waktuambildata);
											$id_remarks_room = 0;
											$remarks_text = "";
											if (isset($remarks_room)) {
												foreach ($remarks_room as $key => $value) {
													$id_remarks_room = $value->id_remarks_room;
													$remarks_text = $value->remarks_text;
												}
											}

											//echo $id_remarks_room;
											//echo $remarks_text;
											if ($id_remarks_room > 0) {
												$notif = array('status' => 'success', 'ket' => 'Access Granted', 'nama' => $nama_karyawan, 'department' => $nama_department, 'lock' => 'open', 'nama_room' => $namadev, 'foto' => $statFoto);
												echo json_encode($notif);
												$histori = array('id_karyawan' => $id_karyawan, 'keterangan' => 'Access Granted', 'access_time' => time(), 'id_room' => $iddev, 'remarks_log' => $remarks_text, 'cam' => $imgname);
												$this->m_api->insert_log($histori);
											} else {
												if ($disable_remarks) {
													$notif = array('status' => 'success', 'ket' => 'Access Granted', 'nama' => $nama_karyawan, 'department' => $nama_department, 'lock' => 'open', 'nama_room' => $namadev, 'foto' => $statFoto);
													echo json_encode($notif);
													$histori = array('id_karyawan' => $id_karyawan, 'keterangan' => 'Access Granted', 'access_time' => time(), 'id_room' => $iddev, 'remarks_log' => 'pengecualian, tanpa remarks', 'cam' => $imgname);
													$this->m_api->insert_log($histori);
												} else {
													$notif = array('status' => 'failed', 'ket' => 'Belum isi remarks', 'nama' => $nama_karyawan, 'department' => $nama_department, 'lock' => 'close', 'nama_room' => $namadev, 'foto' => $statFoto);
													echo json_encode($notif);
													$histori = array('id_karyawan' => $id_karyawan, 'keterangan' => 'Access Denied, belum isi remarks', 'access_time' => time(), 'id_room' => $iddev, 'remarks_log' => '-', 'cam' => $imgname);
													$this->m_api->insert_log($histori);
												}
											}
										} else {
											$notif = array('status' => 'failed', 'ket' => 'No Access', 'nama' => $nama_karyawan, 'department' => $nama_department, 'lock' => 'close', 'nama_room' => $namadev, 'foto' => $statFoto);
											echo json_encode($notif);
											$histori = array('id_karyawan' => $id_karyawan, 'keterangan' => 'Access Denied, akses ruangan ditolak', 'access_time' => time(), 'id_room' => $iddev, 'remarks_log' => '-', 'cam' => $imgname);
											$this->m_api->insert_log($histori);
										}
									}
								}
							}
						} else {
							$notif = array('status' => 'failed', 'ket' => 'Access Denied', 'nama' => $nama_karyawan, 'department' => $nama_department, 'lock' => 'close', 'nama_room' => $namadev, 'foto' => $statFoto);
							echo json_encode($notif);
							$histori = array('id_karyawan' => $id_karyawan, 'keterangan' => 'Access Denied, Card Disable', 'access_time' => time(), 'id_room' => $iddev, 'remarks_log' => '-', 'cam' => $imgname);
							$this->m_api->insert_log($histori);
						}
					} else {
						$notif = array('status' => 'failed', 'ket' => 'id device tidak ditemukan');
						echo json_encode($notif);
					}
				} else {
					$notif = array('status' => 'failed', 'ket' => 'RFID tidak terdaftar');
					echo json_encode($notif);
				}
			} else {
				$notif = array('status' => 'failed', 'ket' => 'salah secret key');
				echo json_encode($notif);
			}
		} else {
			$notif = array('status' => 'failed', 'ket' => 'salah parameter');
			echo json_encode($notif);
		}
	}


	public function getroom()
	{
		if (isset($_POST['key']) && isset($_POST['iddev'])) {
			$key = $this->input->post('key');
			$cekkey = $this->m_api->getkey();

			if ($cekkey[0]->key == $key) {
				$iddev = $this->input->post('iddev');

				$device = $this->m_api->getdevice($iddev);
				$count = 0;
				$namadev = "";
				$id_department_dev = 0;
				$type_dev = "";
				$need_remarks = 0;

				foreach ($device as $key => $value) {
					$count++;
					$namadev = $value->nama_room;
					$id_department_dev = $value->id_department;
					$type_dev = $value->type;
					$need_remarks = $value->need_remarks;
					if ($value->deleted == 1) {
						$count = 0;
					}
				}

				$nama_department = "";
				$dataDept = $this->m_api->get_department_by_id($id_department_dev);
				if (isset($dataDept)) {
					foreach ($dataDept as $key => $value) {
						$nama_department = $value->nama_department;
					}
				}

				if ($count > 0) {
					$notif = array('status' => 'success', 'ket' => 'Device terdaftar', 'nama_room' => $namadev, 'department' => $nama_department, 'type' => $type_dev);
					echo json_encode($notif);
				} else {
					$notif = array('status' => 'failed', 'ket' => 'Device tidak ada');
					echo json_encode($notif);
				}
			} else {
				$notif = array('status' => 'failed', 'ket' => 'salah secret key');
				echo json_encode($notif);
			}
		} else {
			$notif = array('status' => 'failed', 'ket' => 'salah parameter');
			echo json_encode($notif);
		}
	}

	public function realtimemonitoring()
	{
		$allRoom = $this->m_room->get_room();
		//echo "<pre>";
		//print_r($allRoom);
		if (isset($allRoom)) {
			$data = array("status" => "ok", "data" => $allRoom);
			echo json_encode($data);
		}
	}

	public function doorsensor()
	{
		if (isset($_POST['key']) && isset($_POST['iddev']) && isset($_POST['doorsensor'])) {
			$key = $this->input->post('key');
			$cekkey = $this->m_api->getkey();
			$doorsensor = $this->input->post('doorsensor');

			if ($cekkey[0]->key == $key) {
				$iddev = $this->input->post('iddev');

				$device = $this->m_api->getdevice($iddev);
				$count = 0;

				foreach ($device as $key => $value) {
					$count++;
				}

				if ($count > 0) {
					$data = array('open' => $doorsensor);
					$this->m_room->room_update($iddev, $data);
					$notif = array('status' => 'success', 'ket' => 'Door Sensor Updated');
					echo json_encode($notif);
				} else {
					$notif = array('status' => 'failed', 'ket' => 'Device tidak ada');
					echo json_encode($notif);
				}
			} else {
				$notif = array('status' => 'failed', 'ket' => 'salah secret key');
				echo json_encode($notif);
			}
		} else {
			$notif = array('status' => 'failed', 'ket' => 'salah parameter');
			echo json_encode($notif);
		}
	}

	public function doorcontrol()
	{
		if (isset($_POST['key']) && isset($_POST['iddev'])) {
			$key = $this->input->post('key');
			$cekkey = $this->m_api->getkey();

			if ($cekkey[0]->key == $key) {
				$iddev = $this->input->post('iddev');

				$device = $this->m_api->getdevice($iddev);
				$count = 0;
				$relay_open = 0;
				$auto = 0;

				foreach ($device as $key => $value) {
					$count++;
					$relay_open = $value->relay_open;
					$auto = $value->auto;
				}

				if ($count > 0) {
					$notif = array('status' => 'success', 'auto' => $auto, 'relay_open' => $relay_open);
					echo json_encode($notif);
				} else {
					$notif = array('status' => 'failed', 'ket' => 'Device tidak ada');
					echo json_encode($notif);
				}
			} else {
				$notif = array('status' => 'failed', 'ket' => 'salah secret key');
				echo json_encode($notif);
			}
		} else {
			$notif = array('status' => 'failed', 'ket' => 'salah parameter');
			echo json_encode($notif);
		}
	}
}
