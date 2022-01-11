<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sair extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('usuario');
		$this->data = $user;
        date_default_timezone_set('America/Bahia'); 
		if (empty($user)){
			redirect("Login");
		}

        $this->load->model('Entrada_model', 'entrada');
	}

	public function index()
	{
        $this->load->view('/admin/layout/topo');
		$this->load->view('admin/sair_view');
        $this->load->view('/admin/layout/footer');
	}

    public function Sair()
    {
        $this->session->unset_userdata('usuario');
        redirect("Login");
    }
    
}