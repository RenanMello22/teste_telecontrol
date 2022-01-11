<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('usuario');
		$this->data = $user;

		if (empty($user)){
			redirect("Login");
		}

        $this->load->model('Produtos_model', 'produtos');
	}

	public function index()
	{
        $dados = array(
			'nome' => $this->data
		);
        $this->load->view('/admin/layout/topo', $dados);
		$this->load->view('admin/produtos_view');
        $this->load->view('/admin/layout/footer');
	}

    public function CarregarProdutos()
    {
        $result = $this->produtos->ListarProdutos();

        $html = "";
        if(!empty($result)){
            foreach($result as $data){
                $html .= "<tr>";
                $html .= "<td>". $data->id_produto  . "</td>";
                $html .= "<td>". $data->produto . "</td>";
                $html .= "<td>". $data->fornecedor . "</td>";
                $html .= "<td>". $data->estoque . "</td>";
                $html .= "<td>". $data->venda . "</td>";
                $html .= "<td>   <a class='btn btn-warning btn-sm' href='produtos/EditarProdutos/{$data->id_produto}')><i class='fas fa-edit'></i></a>
                                 <a class='btn btn-danger btn-sm' href='javascript:ExcluirProduto({$data->id_produto});' )><i class='fas fa-trash'></i></a></td>";
                $html .= "</tr>";
            }
        }else{
            $html = "<td colspan='200' style='text-align: center;'>Nenhum registro encontrado!</td>";
        }
		
		echo $html;
    }

    public function CarregarFornecedores()
	{


		$result = $this->produtos->BuscarFornecedores();

		$html = "";

		foreach($result as $opcao){
			$html .= "<option value=". $opcao->id_fornecedor .">".$opcao->fornecedor."</option>";
		}

		echo $html;
	}

    public function CadastrarProduto()
    {
        $prod = $this->input->post('prod');
        $fornecedor = $this->input->post('fornecedor');
        $custo = $this->input->post('custo');
        $venda = $this->input->post('venda');

        
        $retorno = $this->produtos->VarificarDuplicidade($prod);

        if(empty($retorno)){
            $dados = [
                'produto' => $prod,
                'fornecedor' => $fornecedor,
                'custo' => $custo,
                'venda' => $venda
            ];
            $retorno =  $this->produtos->CadastrarProduto($dados);
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Produto já se encontra cadastrado!'
            ])); 
        }

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Produto salvo com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível cadastrar produto!'
            ]));
        }
    }

    public function EditarProdutos($id)
    {
        $retorno = $this->produtos->buscarProdutoID($id);

        $data = [
            'retorno' => $retorno
        ];

        $this->load->view('/admin/layout/topo');
		$this->load->view('admin/editarproduto_view', $data);
        $this->load->view('/admin/layout/footer');
    }

    public function EditProd()
    {
        $prod = $this->input->post('prod');
        $custo = $this->input->post('custo');
        $venda = $this->input->post('venda');
        $id = $this->input->post('id');

            
                $dados = [
                    'produto' => $prod,
                    'custo' => $custo,
                    'venda' => $venda
                ];

                $where = [
                    'id_produto ' => $id
                ];

                $retorno =  $this->produtos->EditarProduto($dados,$where);            

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Produto atualizado com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível atualizar Produto!'
            ]));
        } 
    }

    public function ExcluirProduto()
    {
        $id = $this->input->post('id');

        $query = [
            'id_produto' => $id
        ];

        
        $retorno = $this->produtos->Exclusao($query);

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Produto excluido com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível excluir Produto!'
            ]));
        }
    }

    
}