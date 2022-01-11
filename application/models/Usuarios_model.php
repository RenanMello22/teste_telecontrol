<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Usuarios_model extends CI_Model{
	
    public function ListarUsuarios(){
		
        $sql = "SELECT * FROM usuarios ORDER BY nome ASC";
        return $this->db->query($sql)->result();
            
    }

    public function VarificarDuplicidade($cnpj)
    {
        $sql = "SELECT * FROM usuarios WHERE nome = ?";

        return $this->db->query($sql, [$cnpj])->row();
    }

    public function CadastrarUsuario($dados)
    {
        return $this->db->insert('usuarios', $dados);
    }

    public function buscarUsuarioID($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";

        return $this->db->query($sql, [$id])->row();
    }

    public function EditarUsuario($dados, $id)
    {
        return $this->db->update('usuarios', $dados, $id);
    }

    public function Exclusao($id)
    {
        return $this->db->delete('usuarios', $id);
    }

}