<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fornecedores extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('usuario');
		$this->data = $user;

		if (empty($user)){
			redirect("Login");
		}

        $this->load->model('Fornecedores_model', 'fornecedor');
	}

	public function index()
	{
        $dados = array(
			'nome' => $this->data
		);
        $this->load->view('/admin/layout/topo', $dados);
		$this->load->view('admin/fornecedores_view');
        $this->load->view('/admin/layout/footer');
	}

    public function CarregarFornecedores()
    {
        $result = $this->fornecedor->ListarFornecedores();

        $html = "";
        if(!empty($result)){
            foreach($result as $data){
                $html .= "<tr>";
                $html .= "<td>". $data->id_fornecedor   . "</td>";
                $html .= "<td>". $data->fornecedor . "</td>";
                $html .= "<td>". $data->telefone . "</td>";
                $html .= "<td>". $data->email . "</td>";
                $html .= "<td>   <a class='btn btn-warning btn-sm' href='fornecedores/EditarFornecedor/{$data->id_fornecedor}')><i class='fas fa-edit'></i></a>
                                 <a class='btn btn-danger btn-sm' href='javascript:ExcluirFornecedor({$data->id_fornecedor});' )><i class='fas fa-trash'></i></a></td>";
                $html .= "</tr>";
            }
        }else{
            $html = "<td colspan='200' style='text-align: center;'>Nenhum registro encontrado!</td>";
        }
		
		echo $html;
    }

    public function CadastrarFornecedor()
    {
        $this->load->helper('string');
        $forn = $this->input->post('forn');
        $cnpj = $this->input->post('cnpj');
        $telefone = $this->input->post('telefone');
        $email = $this->input->post('email');
        $login = $this->input->post('login');
        //$senha = random_string('alnum', 5);
        $senha = '123';

        
        $retorno = $this->fornecedor->VarificarDuplicidade($cnpj);

        if(empty($retorno)){
            $dados = [
                'fornecedor' => $forn,
                'cnpj' => $cnpj,
                'telefone' => $telefone,
                'email' => $email,
                'login' => $login,
                'senha' => md5($senha),
            ];
            $retorno =  $this->fornecedor->CadastrarFornecedor($dados);
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Fornecedor já se encontra cadastrado!'
            ])); 
        }

        if($retorno == 1){

            die(json_encode([
                'error' => false,
                'msg' => 'Fornecedor salvo com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível cadastrar fornecedor!'
            ]));
        }
    }

    public function EditarFornecedor($id)
    {
        $retorno = $this->fornecedor->buscarFornecedorID($id);

        $data = [
            'retorno' => $retorno
        ];

        $this->load->view('/admin/layout/topo');
		$this->load->view('admin/editarfornecedor_view', $data);
        $this->load->view('/admin/layout/footer');
    }

    public function EditForn()
    {
        $forn = $this->input->post('forn');
        $cnpj = $this->input->post('cnpj');
        $telefone = $this->input->post('telefone');
        $email = $this->input->post('email');
        $login = $this->input->post('login');
        $cnpjOri = $this->input->post('cnpjOri');
        $id = $this->input->post('id');

       
            if($cnpjOri != $cnpj){
                $retorno = $this->fornecedor->VarificarDuplicidade($cnpj);
            }else{
               $retorno = '';
            }
            

            if(empty($retorno)){
                $dados = [
                    'fornecedor' => $forn,
                    'cnpj' => $cnpj,
                    'telefone' => $telefone,
                    'email' => $email,
                    'login' => $login
                ];

                $where = [
                    'id_fornecedor' => $id
                ];

                $retorno =  $this->fornecedor->EditarFornecedor($dados,$where);
            }else{
                die(json_encode([
                    'error' => true,
                    'msg' => 'Fornecedor já se encontra cadastrado!'
                ])); 
            }
            

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Fornecedor atualizado com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível atualizar Fornecedor!'
            ]));
        } 
    }

    public function ExcluirFornecedor()
    {
        $id = $this->input->post('id');

        $query = [
            'id_fornecedor' => $id
        ];

        
        $retorno = $this->fornecedor->Exclusao($query);

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Fornecedor excluido com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível excluir Fornecedor!'
            ]));
        }
    }

    
}