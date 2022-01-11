<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('usuario');
		$this->data = $user;

		if (empty($user)){
			redirect("Login");
		}
	}

	public function index()
	{
		$dados = array(
			'nome' => $this->data
		);
        $this->load->view('/admin/layout/topo', $dados);
		$this->load->view('admin/painel_view');
        $this->load->view('/admin/layout/footer');
	}
}
