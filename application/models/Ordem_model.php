<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Ordem_model extends CI_Model{
	
    public function ListarOrdens($datade, $dataate){
		
        $sql = "SELECT O.*, C.nome AS cliente, U.nome AS usuario FROM ordem O INNER JOIN clientes C ON O.id_cliente = C.id_cliente INNER JOIN usuarios U ON O.id_usuario = U.id_usuario WHERE O.data BETWEEN ? AND ?";
        return $this->db->query($sql, [$datade, $dataate])->result();
            
    }

    public function BuscarClientes()
    {
        $sql = "SELECT * FROM clientes ORDER BY nome ASC";
        return $this->db->query($sql)->result();
    }

    public function BuscarUsuarios()
    {
        $sql = "SELECT * FROM usuarios ORDER BY nome ASC";
        return $this->db->query($sql)->result();
    }

    public function CadastrarOrdem($dados)
    {
        return $this->db->insert('ordem', $dados);
    }

    public function buscarOrdemID($id)
    {
        $sql = "SELECT O.*, C.nome AS cliente, U.nome AS usuario FROM ordem O INNER JOIN clientes C ON O.id_cliente = C.id_cliente INNER JOIN usuarios U ON O.id_usuario = U.id_usuario WHERE O.id_ordem  = ?";

        return $this->db->query($sql, [$id])->row();
    }

    public function buscarListagemID($id)
    {
        $sql = "SELECT L.*, P.produto as produto FROM lista_ordem L INNER JOIN produtos P ON L.id_produto = P.id_produto WHERE L.id_ordem = ?";
        return $this->db->query($sql, [$id])->result();
    }

    public function BuscarProdutos()
    {
        $sql = "SELECT * FROM produtos ORDER BY produto ASC";
        return $this->db->query($sql)->result();
    }

    public function consultaProduto($id)
    {
        $sql = "SELECT venda as valor FROM produtos WHERE id_produto = ?";
        return $this->db->query($sql, [$id])->row();
    }

    public function CadastrarLista($dados)
    {
        return $this->db->insert('lista_ordem', $dados);
    }

    public function FecharOrdem($dados, $id)
    {
        return $this->db->update('ordem', $dados, $id);
    }

}