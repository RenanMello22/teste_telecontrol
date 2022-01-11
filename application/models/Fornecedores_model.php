<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Fornecedores_model extends CI_Model{
	
    public function ListarFornecedores(){
		
        $sql = "SELECT * FROM fornecedores ORDER BY fornecedor ASC";
        return $this->db->query($sql)->result();
            
    }

    public function VarificarDuplicidade($cnpj)
    {
        $sql = "SELECT * FROM fornecedores WHERE cnpj = ?";

        return $this->db->query($sql, [$cnpj])->row();
    }

    public function CadastrarFornecedor($dados)
    {
        return $this->db->insert('fornecedores', $dados);
    }

    public function buscarFornecedorID($id)
    {
        $sql = "SELECT * FROM fornecedores WHERE id_fornecedor = ?";

        return $this->db->query($sql, [$id])->row();
    }

    public function EditarFornecedor($dados, $id)
    {
        return $this->db->update('fornecedores', $dados, $id);
    }

    public function Exclusao($id)
    {
        return $this->db->delete('fornecedores', $id);
    }

}