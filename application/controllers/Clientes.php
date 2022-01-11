<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('usuario');
		$this->data = $user;

		if (empty($user)){
			redirect("Login");
		}

        $this->load->model('Clientes_model', 'cliente');
	}

	public function index()
	{
        $dados = array(
			'nome' => $this->data
		);
        $this->load->view('/admin/layout/topo', $dados);
		$this->load->view('admin/clientes_view');
        $this->load->view('/admin/layout/footer');
	}

    public function CarregarClientes()
    {
        $result = $this->cliente->ListarClientes();

        $html = "";
        if(!empty($result)){
            foreach($result as $data){
                $html .= "<tr>";
                $html .= "<td>". $data->id_cliente  . "</td>";
                $html .= "<td>". $data->nome . "</td>";
                $html .= "<td>". $data->telefone . "</td>";
                $html .= "<td>". $data->email . "</td>";
                $html .= "<td>   <a class='btn btn-warning btn-sm' href='clientes/EditarCliente/{$data->id_cliente}')><i class='fas fa-edit'></i></a>
                                 <a class='btn btn-danger btn-sm' href='javascript:ExcluirCliente({$data->id_cliente});' )><i class='fas fa-trash'></i></a></td>";
                $html .= "</tr>";
            }
        }else{
            $html = "<td colspan='200' style='text-align: center;'>Nenhum registro encontrado!</td>";
        }
		
		echo $html;
    }

    public function consultaCEP()
    {
        $this->load->library('curl');
        $cep = $this->input->post('cep');

		$cep = str_replace('.', '', $cep);

		echo $this->curl->consulta($cep);
    }

    public function CadastrarCliente()
    {
        $tipo = $this->input->post('tipo');
        $nome = $this->input->post('nome');
        $cep = $this->input->post('cep');
        $end = $this->input->post('end');
        $nro = $this->input->post('nro');
        $bairro = $this->input->post('bairro');
        $cidade = $this->input->post('cidade');
        $uf = $this->input->post('uf');
        $telefone = $this->input->post('telefone');
        $sexo = $this->input->post('sexo');
        $civil = $this->input->post('civil');
        $cpf = $this->input->post('cpf');
        $rg = $this->input->post('rg');
        $cnpj = $this->input->post('cnpj');
        $IE = $this->input->post('IE');
        $celular = $this->input->post('celular');
        $email = $this->input->post('email');


        if($tipo == 'juridica'){
            $retorno = $this->cliente->VarificarDuplicidade($cnpj);

            if(empty($retorno)){
                $dados = [
                    'tipo' => $tipo,
                    'nome' => $nome,
                    'cpf' => $cnpj,
                    'rg' => $IE,
                    'cep' => $cep,
                    'endereco' => $end,
                    'nro' => $nro,
                    'bairro' => $bairro,
                    'cidade' => $cidade,
                    'uf' => $uf,
                    'telefone' => $telefone,
                    'cadastro' => date('Y-m-d H:i:s'),
                    'email' => $email,
                    'status' => 1
                ];
                $retorno =  $this->cliente->CadastrarClienteJuridica($dados);
            }else{
                die(json_encode([
                    'error' => true,
                    'msg' => 'Cliente já se encontra cadastrado!'
                ])); 
            }
            
        }else{

            $retorno = $this->cliente->VarificarDuplicidade($cpf);

            if(empty($retorno)){
                $dados = [
                    'tipo' => $tipo,
                    'nome' => $nome,
                    'sexo' => $sexo,
                    'civil' => $civil,
                    'cpf' => $cpf,
                    'rg' => $rg,
                    'cep' => $cep,
                    'endereco' => $end,
                    'nro' => $nro,
                    'bairro' => $bairro,
                    'cidade' => $cidade,
                    'uf' => $uf,
                    'telefone' => $telefone,
                    'cadastro' => date('Y-m-d H:i:s'),
                    'email' => $email,
                    'status' => 1
                ];
                    $retorno =  $this->cliente->CadastrarClienteFisica($dados);
            }else{
                die(json_encode([
                    'error' => true,
                    'msg' => 'Cliente já se encontra cadastrado!'
                ])); 
            }
            
        }

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Cliente salvo com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível cadastrar cliente!'
            ]));
        }
    }

    public function EditarCliente($id)
    {
        $retorno = $this->cliente->buscarClienteID($id);

        $data = [
            'retorno' => $retorno
        ];

        $this->load->view('/admin/layout/topo');
		$this->load->view('admin/editarclientes_view', $data);
        $this->load->view('/admin/layout/footer');
    }

    public function EditCliente()
    {
        $tipo = $this->input->post('tipo');
        $id = $this->input->post('id');
        $nome = $this->input->post('nome');
        $cep = $this->input->post('cep');
        $end = $this->input->post('end');
        $nro = $this->input->post('nro');
        $bairro = $this->input->post('bairro');
        $cidade = $this->input->post('cidade');
        $uf = $this->input->post('uf');
        $telefone = $this->input->post('telefone');
        $sexo = $this->input->post('sexo');
        $civil = $this->input->post('civil');
        $cpf = $this->input->post('cpf');
        $rg = $this->input->post('rg');
        $cnpj = $this->input->post('cnpj');
        $IE = $this->input->post('IE');
        $celular = $this->input->post('celular');
        $email = $this->input->post('email');
        $cnpjOri = $this->input->post('cnpjori');
        $cpfOri = $this->input->post('cpfori');

        if($tipo == 'juridica'){
            if($cnpjOri != $cnpj){
                $retorno = $this->cliente->VarificarDuplicidade($cnpj);
            }else{
               $retorno = '';
            }
            

            if(empty($retorno)){
                $dados = [
                    'nome' => $nome,
                    'cpf' => $cnpj,
                    'rg' => $IE,
                    'cep' => $cep,
                    'endereco' => $end,
                    'nro' => $nro,
                    'bairro' => $bairro,
                    'cidade' => $cidade,
                    'uf' => $uf,
                    'telefone' => $telefone,
                    'email' => $email,
                    'status' => 1
                ];

                $where = [
                    'id_cliente' => $id
                ];

                $retorno =  $this->cliente->EditarClienteJuridica($dados,$where);
            }else{
                die(json_encode([
                    'error' => true,
                    'msg' => 'Cliente já se encontra cadastrado!'
                ])); 
            }
            
        }else{

            if($cpfOri != $cpf){
                $retorno = $this->cliente->VarificarDuplicidade($cpf);
            }else{
                $retorno = '';
            }
            

            if(empty($retorno)){
                $dados = [
                    'nome' => $nome,
                    'sexo' => $sexo,
                    'civil' => $civil,
                    'cpf' => $cpf,
                    'rg' => $rg,
                    'cep' => $cep,
                    'endereco' => $end,
                    'nro' => $nro,
                    'bairro' => $bairro,
                    'cidade' => $cidade,
                    'uf' => $uf,
                    'telefone' => $telefone,
                    'email' => $email,
                    'status' => 1
                ];
                $where = [
                    'id_cliente' => $id
                ];
                    $retorno =  $this->cliente->EditarClienteFisica($dados, $where);
            }else{
                die(json_encode([
                    'error' => true,
                    'msg' => 'Cliente já se encontra cadastrado!'
                ])); 
            }
            
        }

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Cliente atualizado com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível atualizar cliente!'
            ]));
        } 
    }

    public function ExcluirCliente()
    {
        $id = $this->input->post('id');

        $query = [
            'id_cliente' => $id
        ];

        
        $retorno = $this->cliente->Exclusao($query);

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Cliente excluido com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível excluir cliente!'
            ]));
        }
    }
}