<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entrada extends CI_Controller {

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
        $dados = array(
			'nome' => $this->data
		);
        $this->load->view('/admin/layout/topo', $dados);
		$this->load->view('admin/entrada_view');
        $this->load->view('/admin/layout/footer');
	}

    public function CarregarEntrada()
    {
        $datade = date('Y-m-d');
        $dataate = date('Y-m-d');

        $result = $this->entrada->ListarEntrada($datade, $dataate);

        $html = "";
        if(!empty($result)){
            foreach($result as $data){
                $html .= "<tr>";
                $html .= "<td>". $data->id_entrada   . "</td>";
                $html .= "<td>". date('d/m/Y', strtotime($data->data)) . "</td>";
                $html .= "<td>". $data->produto . "</td>";
                $html .= "<td>". $data->qtd . "</td>";
                $html .= "<td>   <a class='btn btn-info btn-sm' href='javascript:ShowRelatorio({$data->id_entrada})')><i class='fas fa-eye'></i></a></td>";
                $html .= "</tr>";
            }
        }else{
            $html = "<td colspan='200' style='text-align: center;'>Nenhum registro encontrado!</td>";
        }
		
		echo $html;
    }

    public function BuscarEntrada()
    {
        $datade = $this->input->post('datade');
        $dataate = $this->input->post('dataate');
        
        $result = $this->entrada->ListarEntrada($datade, $dataate);

        $html = "";
        if(!empty($result)){
            foreach($result as $data){
                $html .= "<tr>";
                $html .= "<td>". $data->id_entrada   . "</td>";
                $html .= "<td>". date('d/m/Y', strtotime($data->data)) . "</td>";
                $html .= "<td>". $data->produto . "</td>";
                $html .= "<td>". $data->qtd . "</td>";
                $html .= "<td>   <a class='btn btn-info btn-sm' href='javascript:ShowRelatorio({$data->id_entrada})')><i class='fas fa-eye'></i></a></td>";
                $html .= "</tr>";
            }
        }else{
            $html = "<td colspan='200' style='text-align: center;'>Nenhum registro encontrado!</td>";
        }
		
		echo $html;
    }

    public function CarregarProdutos()
	{

		$result = $this->entrada->BuscarProdutos();

		$html = "";

		foreach($result as $opcao){
			$html .= "<option value=". $opcao->id_produto .">".$opcao->produto."</option>";
		}

		echo $html;
	}

    public function CadastrarEntrada()
    {
        $prod = $this->input->post('prod');
        $qtd = $this->input->post('qtd');
        $nota = $this->input->post('nota');

        
        $retorno = $this->entrada->VarificarDuplicidade($nota);

        if(empty($retorno)){
            $dados = [
                'id_produto' => $prod,
                'qtd' => $qtd,
                'data' => date('Y-m-d'),
                'nro_nota' => $nota
            ];
            $retorno =  $this->entrada->CadastrarEntrada($dados);
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Entrada já se encontra cadastrado!'
            ])); 
        }

        if($retorno == 1){

            $retorno = $this->entrada->AtualizarProduto($qtd, $prod);
            die(json_encode([
                'error' => false,
                'msg' => 'Entrada salvo com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível cadastrar essa entrada!'
            ]));
        }
    }

    public function BuscarEntradaRelatorio()
    {
        $id = $this->input->post('id');

        $retorno = $this->entrada->buscarEntradaID($id);

        echo json_encode($retorno);
    }
    
}