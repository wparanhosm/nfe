<?php
	defined('BASEPATH') or exit ('Não foi possivel acessar a camada de Controle');


	class ControllerMenu extends CI_Controller{
		public function index(){

			$this->load->helper('url');
			$this->load->library('session');
			
			$dados['s'] = 'key';
			if($this->session->userdata('usuario_logado')){
				$this->load->view('menu',$dados);
			} else {
				$this->load->view('login');
			}
		}
	}

?>