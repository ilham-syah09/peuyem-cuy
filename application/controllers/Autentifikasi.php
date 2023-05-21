<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autentifikasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('username')) {
			redirect('user');
		}
		$this->form_validation->set_rules('username', 'Username', 'required|trim', [
			'required' => 'Username Harus Di Isi'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', [
			'required' => 'Password Harus Di Isi'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'L O G I N';
			$this->load->view('templates/autentifikasi_header', $data);
			$this->load->view('autentifikasi/login');
			$this->load->view('templates/autentifikasi_footer');
		} else {
			//validasi berhasil
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$tbl_user = $this->db->get_where('tbl_user', ['username' => $username])->row_array();

		//usernya ada
		if ($tbl_user) {
			//user aktif
			if ($tbl_user['is_active'] == 1) {
				if (password_verify($password, $tbl_user['password'])) {
					$data = [
						'username' => $tbl_user['username'],
						'role_id' => $tbl_user['role_id']
					];
					$this->session->set_userdata($data);
					if ($tbl_user['role_id'] == 1) {
						redirect('admin');
					} else {
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah</div>');
					redirect('autentifikasi');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username Belum Di Aktivasi</div>');
				redirect('autentifikasi');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username Belum Terdaftar</div>');
			redirect('autentifikasi');
		}
	}

	public function register()
	{
		if ($this->session->userdata('username')) {
			redirect('user');
		}
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Nama Lengkap Harus Di Isi'
		]);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tbl_user.username]', [
			'required' => 'Username Harus Di Isi',
			'is_unique' => 'Username telah terdaftar'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
			'required' => 'Password Harus Di Isi',
			'matches' => 'Password Tidak Sama!',
			'min_length' => 'Password Terlalu Pendek'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'R E G I S T E R';
			$this->load->view('templates/autentifikasi_header', $data);
			$this->load->view('autentifikasi/register');
			$this->load->view('templates/autentifikasi_footer');
		} else {
			$data = [
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];

			$this->db->insert('tbl_user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun Berhasil Di Buat, Silahkan Login</div>');
			redirect('autentifikasi');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda Berhasil Logout!</div>');
		redirect('autentifikasi');
	}

	public function blok()
	{
		$this->load->view('autentifikasi/blok');
	}
}
