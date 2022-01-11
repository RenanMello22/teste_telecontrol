<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordem extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('usuario');
		$this->data = $user;
        date_default_timezone_set('America/Bahia'); 
		if (empty($user)){
			redirect("Login");
		}

        $this->load->model('Ordem_model', 'ordem');
	}

	public function index()
	{
        $dados = array(
			'nome' => $this->data
		);
        $this->load->view('/admin/layout/topo', $dados);
		$this->load->view('admin/ordem_view');
        $this->load->view('/admin/layout/footer');
	}

    public function CarregarOrdens()
    {
        $datade = date('Y-m-d');
        $dataate = date('Y-m-d');

        $result = $this->ordem->ListarOrdens($datade, $dataate);

        $html = "";
        if(!empty($result)){
            foreach($result as $data){
                if($data->status == 1){
                    $status = 'Aberto';
                }else{
                    if($data->status == 2){
                        $status = 'Atrasado';
                    }else{
                        $status = 'Resolvido';
                    }
                }
                $html .= "<tr>";
                $html .= "<td>". $data->id_ordem   . "</td>";
                $html .= "<td>". date('d/m/Y', strtotime($data->data)) . "</td>";
                $html .= "<td>". $data->cliente . "</td>";
                $html .= "<td>". $data->usuario . "</td>";
                $html .= "<td>". $status . "</td>";
                $html .= "<td>". 'R$ '.number_format($data->preco_total, 2, ',', '.') . "</td>";
                $html .= "<td>   <a class='btn btn-info btn-sm' href='javascript:ShowDetalhe({$data->id_ordem})')><i class='fas fa-eye'></i></a>
                                 <a class='btn btn-success btn-sm' href='javascript:ShowListagem({$data->id_ordem})')><i class='fas fa-eye'></i></a>
                                 <a class='btn btn-danger btn-sm' href='javascript:Fechar({$data->id_ordem})')><i class='fas fa-eye'></i></a></td>";
                $html .= "</tr>";
            }
        }else{
            $html = "<td colspan='200' style='text-align: center;'>Nenhum registro encontrado!</td>";
        }
		
		echo $html;
    }

    public function BuscarOrdem()
    {
        $datade = $this->input->post('datade');
        $dataate = $this->input->post('dataate');
        
        $result = $this->ordem->ListarOrdens($datade, $dataate);

        $html = "";
        if(!empty($result)){
            foreach($result as $data){
                if($data->status == 1){
                    $status = 'Aberto';
                }else{
                    if($data->status == 2){
                        $status = 'Atrasado';
                    }else{
                        $status = 'Resolvido';
                    }
                }
                $html .= "<tr>";
                $html .= "<td>". $data->id_ordem   . "</td>";
                $html .= "<td>". date('d/m/Y', strtotime($data->data)) . "</td>";
                $html .= "<td>". $data->cliente . "</td>";
                $html .= "<td>". $status . "</td>";
                $html .= "<td>   <a class='btn btn-info btn-sm' href='javascript:ShowDetalhe({$data->id_ordem})')><i class='fas fa-eye'></i></a>
                                 <a class='btn btn-success btn-sm' href='javascript:ShowListagem({$data->id_ordem})')><i class='fas fa-eye'></i></a>
                                 <a class='btn btn-danger btn-sm' href='javascript:Fechar({$data->id_ordem})')><i class='fas fa-eye'></i></a></td>";
                $html .= "</tr>";
            }
        }else{
            $html = "<td colspan='200' style='text-align: center;'>Nenhum registro encontrado!</td>";
        }
		
		echo $html;
    }

    public function CarregarClientes()
	{

		$result = $this->ordem->BuscarClientes();

		$html = "";

		foreach($result as $opcao){
			$html .= "<option value=". $opcao->id_cliente .">".$opcao->nome."</option>";
		}

		echo $html;
	}

    public function CarregarUsuarios()
	{

		$result = $this->ordem->BuscarUsuarios();

		$html = "";

		foreach($result as $opcao){
			$html .= "<option value=". $opcao->id_usuario .">".$opcao->nome."</option>";
		}

		echo $html;
	}

    public function CadastrarOrdem()
    {
        $cliente = $this->input->post('cliente');
        $usuario = $this->input->post('usuario');
        $problema = $this->input->post('problema');

    
            $dados = [
                'id_cliente' => $cliente,
                'id_usuario' => $usuario,
                'problema' => $problema,
                'preco_total' => 0.00,
                'data' => date('Y-m-d'),
                'status' => 1
            ];
            $retorno =  $this->ordem->CadastrarOrdem($dados);

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Ordem salvo com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível cadastrar essa ordem!'
            ]));
        }
    }

    public function BuscarDetalheOrdem()
    {
        $id = $this->input->post('id');

        $retorno = $this->ordem->buscarOrdemID($id);

        echo json_encode($retorno);
    }

    public function BuscarListagemOrdem()
    {
        $id = $this->input->post('id');

        $retorno = $this->ordem->buscarListagemID($id);

        $html = "";
        if(!empty($retorno)){
            foreach($retorno as $data){
                print_r($retorno);
                $html .= "<tr>";
                $html .= "<td>". $data->produto   . "</td>";
                $html .= "<td>". 'R$ '.number_format($data->preco_unit, 2, ',', '.') .  "</td>";
                $html .= "<td>". $data->qtd . "</td>";
                $html .= "<td>". 'R$ '.number_format($data->preco_total, 2, ',', '.') .  "</td>";
                $html .= "</tr>";
            }
        }else{
            $html = "<td colspan='200' style='text-align: center;'>Nenhum registro encontrado!</td>";
        }
		
		echo $html;
    }

    public function CarregarProdutos()
	{

		$result = $this->ordem->BuscarProdutos();

		$html = "";

		foreach($result as $opcao){
			$html .= "<option value=". $opcao->id_produto .">".$opcao->produto."</option>";
		}

		echo $html;
	}

    public function consultaProduto()
    {
        $id = $this->input->post('id');

        $resultado = $this->ordem->consultaProduto($id);

        echo json_encode($resultado);
    }

    public function SomarValores()
    {
        $qtd = $this->input->post('qtd');
        $valor = $this->input->post('valor');

       var_dump($valor);
    }

    public function CadastrarListagem()
    {
        $prod = $this->input->post('prod');
        $precoUni = $this->input->post('precoUni');
        $qtd = $this->input->post('qtd');
        $total = $this->input->post('total');
        $id = $this->input->post('id');

    
            $dados = [
                'id_ordem' => $id,
                'id_produto' => $prod,
                'qtd' => $qtd,
                'preco_unit' => $precoUni,
                'preco_total' => $total
            ];
            $retorno =  $this->ordem->CadastrarLista($dados);

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Serviço salvo com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível cadastrar esse serviço!'
            ]));
        }
    }

    public function FecharOrdem()
    {
        $id = $this->input->post('id');
        $dados = [
            'status' =>0
        ];
        $where = [
            'id_ordem' => $id
        ];

        $retorno = $this->ordem->fecharOrdem($dados, $where);

        if($retorno == 1){
            die(json_encode([
                'error' => false,
                'msg' => 'Ordem fechada com sucesso!'
            ]));
        }else{
            die(json_encode([
                'error' => true,
                'msg' => 'Não foi possível fechar ordem!'
            ]));
        } 
    }
}