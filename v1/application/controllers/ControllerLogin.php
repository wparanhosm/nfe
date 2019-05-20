<?php
    defined('BASEPATH') or exit ('Não foi possivel acessar a camada de Controle');
    
    
        class ControllerLogin extends CI_Controller{
            
            public function __construct(){
                parent::__construct();
                $this->load->database();
                $this->load->Model('ModelLogin','objModel');
                $this->load->helper('url');
                $this->load->library('session');    
            }
            
            public function index(){
                $this->verificaLogin();
            }    
            
            public function verificaLogin(){

                if($this->session->userdata('usuario_logado')){
                    $this->load->view('menu');
                } else {
                    $this->load->view('login');
                }
            }

            public function recebeLogin(){
                
                $valor = isset($_POST['lembrar_senha']) ? $_POST['lembrar_senha'] : "off";

                $dados['mensagem'] = "";
            
                $login = isset($_POST['txt_user'])? $_POST['txt_user'] : "";
                $senha = isset($_POST['txt_senha']) ? $_POST['txt_senha'] : "";

                $aut['s'] = "yes";

                $value = count($this->objModel->retornaLogin($login,$senha));

                if($value){
                    $this->session->set_userdata('usuario_logado',$login);

                    $this->load->view('menu',$aut);

                    if($value == "on"){
                        setcookie("user",$login);
                        setcookie("senha",$senha);
                    }
                } else {
                    $dados['mensagem'] = "Login ou senha incorretos!";
                    $this->load->view('login',$dados);
                }
                
            }

            public function logOut(){
                $this->session->sess_destroy();
                $this->load->view('login');
            }
        }
?>