<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Usuario_model extends CI_Model{
	
    public function Login($email, $senha){
		
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ? AND status = 1";
        return $this->db->query($sql, [$email, $senha])->row();
            
    }

}