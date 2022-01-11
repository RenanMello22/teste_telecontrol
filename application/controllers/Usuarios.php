<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('usuario');
		$this->data = $user;

		if (empty($user)){
			redirect("Login");
		}

        $this->load->model('Usuarios_model', 'usuario');
	}

	public function index()
	{
        $dados = array(
			'nome' => $this->data
		);
        $this->load->view('/admin/layout/topo', $dados);
		$this->load->view('admin/usuarios_view');
        $this->load->view('/admin/layout/footer');
	}

    public function CarregarUsuarios()
    {
        $result = $this->usuario->ListarUsuarios();

        $html = "";
        if(!empty($result)){
            foreach($result as $data){
                $html .= "<tr>";
                $html .= "<td>". $data->id_usuario   . "</td>";
                $html .= "<td>". $data->nome . "</td>";
                $html .= "<td>". $data->email . "</td>";
                $html .= "<td>   <a class='btn btn-warning btn-sm' href='usuarios/EditarUsuario/{$data->id_usuario}')><i class='fas fa-edit'></i></a>
                                 <a class='btn btn-danger btn-sm' href='javascript:ExcluirUsuario({$data->id_usuario});' )><i class='fas fa-trash'></i></a></td>";
                $html .= "</tr>";
            }
        }else{
            $html = "<td colspan='200' style='text-align: center;'>Nenhum registro encontrado!</td>";
        }
		
		echo $html;
    }

    public function CadastrarUsuario()
    {
        $this->load->helper('string');
        $nome = $this->input->post('nome');
        $email = $this->input->post('email');
        //$senha = random_string('alnum', 5);
        $senha = '123';
        
        $retorno = $this->usuario->VarificarDuplicidade($nome);

        if(empty($retorno)){
            $dados = [
                'nome' => $nome,
                'email' => $email,
                'senha' => md5($senha),
                'status' => 1
            ];
            $retorno =  $this->usuario->CadastrarUsuario($dados);
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Usuário já se encontra cadastrado!'
            ])); 
        }

        if($retorno == 1){

            die(json_encode([
                'error' => false,
                'msg' => 'Usuário salvo com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível cadastrar usuário!'
            ]));
        }
    }

    public function EditarUsuario($id)
    {
        $retorno = $this->usuario->buscarUsuarioID($id);

        $data = [
            'retorno' => $retorno
        ];

        $this->load->view('/admin/layout/topo');
		$this->load->view('admin/editarusuarios_view', $data);
        $this->load->view('/admin/layout/footer');
    }

    public function EditUser()
    {
        $nome = $this->input->post('nome');
        $email = $this->input->post('email');
        $NomeOri = $this->input->post('NomeOri');
        $id = $this->input->post('id');

       
            if($NomeOri != $nome){
                $retorno = $this->usuario->VarificarDuplicidade($nome);
            }else{
               $retorno = '';
            }
            

            if(empty($retorno)){
                $dados = [
                    'nome' => $nome,
                    'email' => $email
                ];

                $where = [
                    'id_usuario' => $id
                ];

                $retorno =  $this->usuario->EditarUsuario($dados,$where);
            }else{
                die(json_encode([
                    'error' => true,
                    'msg' => 'Usurio já se encontra cadastrado!'
                ])); 
            }
            

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Usuário atualizado com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível atualizar Usuário!'
            ]));
        } 
    }

    public function ExcluirUsuario()
    {
        $id = $this->input->post('id');

        $query = [
            'id_usuario' => $id
        ];

        
        $retorno = $this->usuario->Exclusao($query);

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Usuário excluido com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível excluir Usuário!'
            ]));
        }
    }
    
}