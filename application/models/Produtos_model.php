<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Produtos_model extends CI_Model{

	public function ListarProdutos(){
		
        $sql = "SELECT P.*, F.fornecedor FROM produtos P INNER JOIN fornecedores F ON P.fornecedor = F.id_fornecedor ORDER BY P.produto ASC";
        return $this->db->query($sql)->result();
            
    } 

    public function BuscarFornecedores()
    {
        $sql = "SELECT * FROM fornecedores ORDER BY fornecedor ASC";
        return $this->db->query($sql)->result();
    }

    public function VarificarDuplicidade($prod)
    {
        $sql = "SELECT * FROM produtos WHERE produto = ?";

        return $this->db->query($sql, [$prod])->row();
    }

    public function CadastrarProduto($dados)
    {
        return $this->db->insert('produtos', $dados);
    }

    public function buscarProdutoID($id)
    {
        $sql = "SELECT P.*, F.fornecedor FROM produtos P INNER JOIN fornecedores F ON P.fornecedor = F.id_fornecedor WHERE P.id_produto = ?";

        return $this->db->query($sql, [$id])->row();
    }

    public function EditarProduto($dados, $id)
    {
        return $this->db->update('produtos', $dados, $id);
    }

    public function Exclusao($id)
    {
        return $this->db->delete('produtos', $id);
    }

}