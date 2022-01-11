<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Entrada_model extends CI_Model{
	
    public function ListarEntrada($datade, $dataate){
		
        $sql = "SELECT P.produto, E.* FROM entrada E INNER JOIN produtos P ON E.id_produto = P.id_produto WHERE E.data BETWEEN ? AND ?";
        return $this->db->query($sql, [$datade, $dataate])->result();
            
    }

    public function BuscarProdutos()
    {
        $sql = "SELECT * FROM produtos ORDER BY produto ASC";
        return $this->db->query($sql)->result();
    }

    public function VarificarDuplicidade($nota)
    {
        $sql = "SELECT * FROM entrada WHERE nro_nota = ?";

        return $this->db->query($sql, [$nota])->row();
    }

    public function CadastrarEntrada($dados)
    {
        return $this->db->insert('entrada', $dados);
    }

    public function AtualizarProduto($qtd, $id)
    {
        $sql = "UPDATE produtos SET estoque=estoque + {$qtd} WHERE id_produto = {$id}";

        return $this->db->query($sql);
    }

    public function buscarEntradaID($id)
    {
        $sql = "SELECT E.*, P.produto FROM entrada E INNER JOIN produtos P ON E.id_produto = P.id_produto WHERE id_entrada = ?";

        return $this->db->query($sql, [$id])->row();
    }

}