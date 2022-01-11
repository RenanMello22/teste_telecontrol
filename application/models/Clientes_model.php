<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Clientes_model extends CI_Model{
	
    public function ListarClientes(){
		
        $sql = "SELECT * FROM clientes ORDER BY nome ASC";
        return $this->db->query($sql)->result();
            
    }

    public function VarificarDuplicidade($cnpj)
    {
        $sql = "SELECT * FROM clientes WHERE cpf = ?";

        return $this->db->query($sql, [$cnpj])->row();
    }

    public function CadastrarClienteJuridica($dados)
    {
        return $this->db->insert('clientes', $dados);
    }

    public function CadastrarClienteFisica($dados)
    {
        return $this->db->insert('clientes', $dados);
    }

    public function buscarClienteID($id)
    {
        $sql = "SELECT * FROM clientes WHERE id_cliente = ?";

        return $this->db->query($sql, [$id])->row();
    }

    public function EditarClienteJuridica($dados, $id)
    {
        return $this->db->update('clientes', $dados, $id);
    }

    public function EditarClienteFisica($dados, $id)
    {
        return $this->db->update('clientes', $dados, $id);
    }

    public function Exclusao($id)
    {
        return $this->db->delete('clientes', $id);
    }

}