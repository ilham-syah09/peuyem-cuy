<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_model', 'menu');
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Manajemen Menu';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required', [
			'required' => 'Tambah Menu Harus Di Isi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu Berhasil Di tambahkan</div>');
			redirect('menu');
		}
	}

	public function submenu()
	{
		$data['title'] = 'Manajemen SubMenu';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->model('Menu_model', 'menu');

		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'SubMenu', 'required', [
			'required' => 'Kolom SubMenu Harus Di Isi'
		]);
		$this->form_validation->set_rules('menu_id', 'Menu', 'required', [
			'required' => 'Kolom Menu Harus Di Isi'
		]);
		$this->form_validation->set_rules('url', 'URL', 'required', [
			'required' => 'Kolom URL Harus Di Isi'
		]);
		$this->form_validation->set_rules('icon', 'Icon', 'required', [
			'required' => 'Kolom Icon Harus Di Isi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];
			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">SubMenu Berhasil Di tambahkan</div>');
			redirect('menu/submenu');
		}
	}

	public function editSubmenu()
	{
		$data['title'] = 'Ubah SubMenu';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['title'] = $this->db->get('user_sub_menu')->result_array();

		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'SubMenu', 'required', [
			'required' => 'Kolom SubMenu Harus Di Isi'
		]);
		$this->form_validation->set_rules('menu_id', 'Menu', 'required', [
			'required' => 'Kolom Menu Harus Di Isi'
		]);
		$this->form_validation->set_rules('url', 'URL', 'required', [
			'required' => 'Kolom URL Harus Di Isi'
		]);
		$this->form_validation->set_rules('icon', 'Icon', 'required', [
			'required' => 'Kolom Icon Harus Di Isi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];

			$this->menu->ubahSubmenu(['id' => $this->input->post('id')], $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            SubMenu berhasil diubah!</div>');
			redirect('menu/submenu');
		}
	}

	public function editMenu()
	{
		$data['title'] = 'Ubah Menu';
		$data['tbl_user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'menu', 'required', [
			'required' => 'Nama Menu Harus Di Isi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'menu' => $this->input->post('menu', true)
			];

			$this->menu->ubahMenu(['id' => $this->input->post('id')], $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu berhasil diubah!</div>');
			redirect('menu');
		}
	}

	public function hapusMenu($id)
	{
		$where = ['id' => $this->uri->segment(3)];
		$this->menu->deletemenu($where);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu Berhasil Di hapus</div>');
		redirect('menu');
	}

	public function hapusSubmenu($id)
	{
		$where = ['id' => $this->uri->segment(3)];
		$this->menu->deletesubmenu($where);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">SubMenu Berhasil Di hapus</div>');
		redirect('menu/submenu');
	}
}
