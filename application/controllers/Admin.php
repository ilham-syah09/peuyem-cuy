<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Data_model', 'role');
		is_logged_in();
	}

	public function index()
	{

		$data['title'] = 'Dashboard';
		$data['monitoring'] = $this->Data_model->DataMonitoring();
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function get_realtime()
	{
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('tbl_sensor')->row();

		echo json_encode([
			'data'	=> $query
		]);
	}

	public function profile()
	{
		if ($this->session->userdata('role_id') != 1) {
			redirect('user');
		}
		$data['title'] = 'Profile';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/profile', $data);
		$this->load->view('templates/footer');
	}

	public function resetPwd($id)
	{
		$data = [
			'password'	=> password_hash('user123', PASSWORD_BCRYPT)
		];

		$this->db->where('id', $id);
		$this->db->update('tbl_user', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil di reset!</div>');
		redirect('admin/datauser');
	}

	public function ubahData()
	{
		if ($this->session->userdata('role_id') != 1) {
			redirect('user');
		}
		$data['title'] = 'Ubah Data Profile';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();


		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
			'required' => 'Nama Lengkap Harus Di Isi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/ubah-data', $data);
			$this->load->view('templates/footer');
		} else {
			$nama = $this->input->post('nama', true);
			$username = $this->input->post('username', true);

			//jika ada gambar yang akan diupload
			$upload_image = $_FILES['image']['name'];
			if ($upload_image) {
				$config['upload_path'] = './assets/img/profile/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '3000';
				$config['max_width'] = '1024';
				$config['max_height'] = '1000';
				$config['file_name'] = 'pp' . time();
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('image')) {
					$gambar_lama = $data['tbl_user']['image'];
					if ($gambar_lama != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
					}
					$gambar_baru = $this->upload->data('file_name');
					$this->db->set('image', $gambar_baru);
				} else {
				}
			}

			$this->db->set('nama', $nama);
			$this->db->where('username', $username);
			$this->db->update('tbl_user');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Profile Berhasil Di Ubah</div>');
			redirect('admin/profile');
		}
	}

	public function ubahpw()
	{
		$data['title'] = 'Ubah Password';
		$username = $this->input->post('username', true);
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$user = $this->db->get_where('tbl_user', ['username' => $username])->row_array();

		$this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim', [
			'required' => 'Pasword harus di isi'
		]);
		$this->form_validation->set_rules(
			'password_baru1',
			'Password Baru',
			'required|trim|min_length[6]|matches[password_baru2]',

			[
				'matches' => 'Password harus sama',
				'min_length' => 'Pasword harus 6 karakter',
				'required' => 'Pasword harus di isi'
			]
		);
		$this->form_validation->set_rules('password_baru2', 'Ketik Ulang', 'required|trim|min_length[6]|matches[password_baru1]', [

			'matches' => 'Password harus sama',
			'min_length' => 'Pasword harus 6 karakter',
			'required' => 'Pasword harus di isi'

		]);
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/ubah-pw', $data);
			$this->load->view('templates/footer');
		} else {
			$password_lama = $this->input->post('password_lama');
			$password_baru = $this->input->post('password_baru1');
			//cek password lama
			if (!password_verify($password_lama, $data['tbl_user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>Passowrd lama anda salah!</h4>
            </div>');
				redirect('admin/ubahpw');
			} else {
				//password baru tidak boleh sama dengan password lama
				if ($password_lama == $password_baru) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>Password baru tidak boleh sama!</h4>
            </div>');
					redirect('admin/ubahpw');
				} else {
					//passwordnya sudah bener
					$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
					$this->db->set('password', $password_hash);
					$this->db->where('username', $this->session->userdata('username'));
					$this->db->update('tbl_user');
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>Password baru berhasil disimpan!</h4>
            </div>');
					redirect('admin/ubahpw');
				}
			}
		}
	}

	public function role()
	{
		$data['title'] = 'Role';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
	}

	public function roleAkses($role_id)
	{
		$data['title'] = 'Role';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id_role' => $role_id])->row_array();

		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-akses', $data);
		$this->load->view('templates/footer');
	}

	public function editRole()
	{
		$data['title'] = 'Ubah Role';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('role', 'role', 'required', [
			'required' => 'Role Harus Di Isi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'role' => $this->input->post('role', true)
			];

			$this->role->ubahRole(['id_role' => $this->input->post('id_role')], $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Role berhasil diubah!</div>');
			redirect('admin/role');
		}
	}

	public function ubahAkses()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses DiUbah!</div>');
	}

	public function dataUser()
	{
		$data['title'] = 'Data User';
		$data['user'] = $this->Data_model->DataUser();
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$data['user'] = $this->Data_model->getDataUser();
		$data['role'] = $this->db->get('user_role')->result_array();


		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Nama Lengkap Harus Di Isi'
		]);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tbl_user.username]', [
			'required' => 'Username Harus Di Isi',
			'is_unique' => 'Username telah terdaftar'
		]);
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'required|trim|min_length[6]|matches[password2]'
		);
		$this->form_validation->set_rules(
			'password2',
			'Password',
			'required|trim|min_length[6]|matches[password1]',

			[
				'matches' => 'Password harus sama',
				'min_length' => 'Pasword harus 6 karakter',
				'required' => 'Pasword harus di isi'
			]
		);
		$this->form_validation->set_rules('role', 'Role', 'required|trim', [
			'required' => 'Role harus di isi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/data-user', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => $this->input->post('role'),
				'is_active' => 1,
				'date_created' => time()
			];
			$this->db->insert('tbl_user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User Berhasil Di tambahkan</div>');
			redirect('admin/datauser');
		}
	}

	public function dataMontap()
	{
		$data['title'] = 'Data Monitoring';
		$data['monitoring'] = $this->Data_model->DataMonitoring();
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/data-montap', $data);
		$this->load->view('templates/footer');
	}

	public function hapusUser($id)
	{
		$where = array('id' => $id);
		$this->Data_model->deleteuser($where, 'tbl_user');
		redirect('admin/datauser');
	}

	public function hapusRole($id)
	{
		$where = array('id_role' => $id);
		$this->Data_model->deleterole($where, 'user_role');
		redirect('admin/role');
	}

	public function suhu()
	{
		$data['title'] = 'Data Suhu';
		$data['monitoring'] = $this->Data_model->DataMonitoring();
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/suhu', $data);
		$this->load->view('templates/footer');
	}

	public function kelembaban()
	{
		$data['title'] = 'Data Kelembaban';
		$data['monitoring'] = $this->Data_model->DataMonitoring();
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/kelembaban', $data);
		$this->load->view('templates/footer');
	}

	public function berat()
	{
		$data['title'] = 'Data Berat';
		$data['monitoring'] = $this->Data_model->DataMonitoring();
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/berat', $data);
		$this->load->view('templates/footer');
	}

	public function alkohol()
	{
		$data['title'] = 'Data Alkohol';
		$data['monitoring'] = $this->Data_model->DataMonitoring();
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/alkohol', $data);
		$this->load->view('templates/footer');
	}

	public function info()
	{
		$data['title'] = 'Informasi Tape';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/info', $data);
		$this->load->view('templates/footer');
	}

	public function tape()
	{
		if ($this->session->userdata('role_id') != 1) {
			redirect('user');
		}

		$data['title'] = 'Tape';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/tape', $data);
		$this->load->view('templates/footer');
	}

	public function linimasa()
	{
		if ($this->session->userdata('role_id') != 1) {
			redirect('user');
		}

		$data['title'] = 'Langkah Pembuatan Tape';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/linimasa', $data);
		$this->load->view('templates/footer');
	}

	public function dokumentasi()
	{
		if ($this->session->userdata('role_id') != 1) {
			redirect('user');
		}

		$data['title'] = 'Dokumentasi';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/dokumentasi', $data);
		$this->load->view('templates/footer');
	}

	public function manfaat()
	{
		if ($this->session->userdata('role_id') != 1) {
			redirect('user');
		}

		$data['title'] = 'Kandungan dan Manfaat Gizi';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/manfaat', $data);
		$this->load->view('templates/footer');
	}

	public function cetak()
	{
		if ($this->session->userdata('role_id') != 1) {
			redirect('user');
		}

		$data['title'] = 'Cetak Laporan';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/cetak', $data);
		$this->load->view('templates/footer');
	}

	public function proses_cetak()
	{
		if ($this->session->userdata('role_id') != 1) {
			redirect('user');
		}

		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');

		if (!$awal || !$akhir) {
			redirect($_SERVER['HTTP_REFERER']);
		}

		if ($awal > $akhir) {
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->db->group_start();
		$this->db->where('DATE(dibuat) >=', $awal);
		$this->db->where('DATE(dibuat) <=', $akhir);
		$this->db->group_end();

		$this->db->order_by('id', 'desc');

		$data = $this->db->get('tbl_sensor')->result_array();

		$pdf = new FPDF('p', 'mm', 'F4');

		$pdf->AddPage();

		$pdf->SetAutoPageBreak(TRUE, 1);

		$pdf->SetFont('Times', 'B', 16);
		$pdf->Cell(30, 8, '', 0, 0);
		$pdf->Cell(130, 8, 'REPORT DATA SENSOR', 0, 1, 'C');
		$pdf->SetFont('Times', 'B', 14);
		$pdf->Cell(30, 8, '', 0, 0);
		$pdf->Cell(130, 8, 'Tanggal : ' . $awal . ' sampai ' . $akhir, 0, 1, 'C');

		$pdf->SetLineWidth(1);
		$pdf->Line(10, 30, 200, 30);
		$pdf->SetLineWidth(0);
		$pdf->Line(10, 31, 200, 31);

		$pdf->Ln(10);

		$pdf->SetFont('Times', 'B', 12);
		$pdf->Cell(15, 10, 'No', 1, 0, 'C');
		$pdf->Cell(20, 10, 'Suhu', 1, 0, 'C');
		$pdf->Cell(45, 10, 'Kelembaban Udara', 1, 0, 'C');
		$pdf->Cell(35, 10, 'Kadar Alkohol', 1, 0, 'C');
		$pdf->Cell(30, 10, 'Berat Tape', 1, 0, 'C');
		$pdf->Cell(45, 10, 'Tanggal', 1, 1, 'C');

		$pdf->SetFont('Times', '', 12);

		$no = 1;

		foreach ($data as $hasil) {
			$pdf->Cell(15, 6, $no++, 1, 0, 'C');
			$pdf->Cell(20, 6, $hasil['suhu'] . 'C', 1, 0, 'C');
			$pdf->Cell(45, 6, $hasil['udara'] . '%', 1, 0, 'C');
			$pdf->Cell(35, 6, $hasil['alkohol'] . '%', 1, 0, 'C');
			$pdf->Cell(30, 6, $hasil['berat'] . ' Gr', 1, 0, 'C');
			$pdf->Cell(45, 6, $hasil['dibuat'], 1, 1, 'C');
		}

		$pdf->Output('Report_monitoring.pdf', 'I');
	}

	public function proses_cetak_excel()
	{

		if ($this->session->userdata('role_id') != 1) {
			redirect('user');
		}

		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');

		if (!$awal || !$akhir) {
			redirect($_SERVER['HTTP_REFERER']);
		}

		if ($awal > $akhir) {
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->db->group_start();
		$this->db->where('DATE(dibuat) >=', $awal);
		$this->db->where('DATE(dibuat) <=', $akhir);
		$this->db->group_end();

		$this->db->order_by('id', 'desc');

		$data = $this->db->get('tbl_sensor')->result_array();
	}

	public function dibaca()
	{
		$this->Data_model->updatedata();
		redirect('admin/dataMontap');
	}
}
