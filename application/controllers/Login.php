<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model', 'usuarios');
    }

	public function index()
	{
		$this->load->view('login_view');
	}

	public function ValidarLogin()
    {
        $login = $this->input->post('login');
        $senha = $this->input->post('senha');

		$this->load->library('session');
       
        $retorno = $this->usuarios->Login($login,  md5($senha));
        
        
        if(empty($retorno)){
            die(json_encode([
                'error' => true,
		'msg' => 'Login ou senha inválidos!'
            ]));
        }else{
            $data = [
				'nome' => $retorno->nome,
				'id' => $retorno->id_usuario,
				'cpf' => $retorno->email
			];
			$this->session->set_userdata('usuario', $data);
            die(json_encode([
                'error' => false,
                'msg' => $retorno
            ]));
        }
        
        
    }
}
