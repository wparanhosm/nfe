<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLogin extends CI_Model{
    public function retornaLogin($usuario,$senha){
        $this->db->where('user',$usuario);
        $this->db->where('senha',$senha);
        
        return $this->db->get('tbl_login')->result();
    }
}