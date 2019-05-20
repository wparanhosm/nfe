<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerDados extends CI_Controller {

	public $valor = 0;
	public $secao;
	public $erros = array();
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->Model('ModelEstoque','objModel');
		$this->load->helper('url');
		$this->load->library('session');
		$this->estanciaSession();
	}

	public function estanciaSession(){
		if(!$this->session->userdata('usuario_logado')){
			redirect('/controllerLogin','refresh');
		}
	}

	public function entradaDados($array){

		$this->objModel->iniciaTransacao();

		foreach($array as $dados){
			$registro = $this->objModel->retornaExisteProduto($dados['cProd']);


			$value = $this->adicionaDados($dados,$registro->valor);
			
			if($value > 0){
				$this->valor++;
			}
		}

		$situation = $this->objModel->verificaTransacao($this->valor);

		if($situation){
			$dados['message'] = "dados inseridos com sucesso!";	
		} else {
			$mensagem = 'erro ao adicionar dados!\n';

			foreach($this->erros as $erros){
				$mensagem .= $erros.'\n';
			}

			$dados['message'] = $mensagem;

		} 

		$dados['s'] = "key";
		$this->load->view('menu',$dados);

	}

	public function printr(...$parameter){
		$tag = function($tg,$value){
			echo '<' . $tg . '>';

			if(is_array($value)){
				print_r($value);
			}else if(is_object($value) and count($value()) > 1){
				$aut = false;
				try{
					print_r($value());
				} catch(Exception $e){
					$aut = true;
				} 

				if($aut){
					print_r($value);
				}
			} else {
				$aut = false;
				try{
					echo strval($value());
				} catch(Exception $e){
					$aut = true;
				}

				if($aut){
					echo strval($value);
				}
			}

			echo '</'. $tg .'>';
		};

		$printr = function($array) use ($tag){
			$tag("pre",$array);
		};

		$printh1 = function ($value) use ($tag){
			$tag("h1",$value);
		};

		$dados = array();
		foreach($parameter as $value){
			$dados[] = $value;
		}

		if(count($dados) == 1){
			$printr($dados[0]);
		} else if (count($dados) == 2){
			$printh1($dados[0]);
			$printr($dados[1]);
		}
	}

	public function teste(){
		$this->valores("hello",array("walter","felipe"));
	}

	public function valores(...$parameter){
		if(count($parameter) == 1){
			echo "<pre>";
			print_r($parameter[0]);
			echo "</pre>";
		} else if (count($parameter) == 2){
			echo "<h1>";
			echo $parameter[0];
			echo "</h1>";
			echo "<pre>";
			print_r($parameter[1]);
			echo "</pre>";
		}

		
	}




	public function adicionaDados($dados,$valor){
		$value = 0;
		if(($valor == 0) && ($dados['tipo'] == 'e')){
			$this->objModel->entradaEstoque($dados);
			$this->objModel->entradaProduto($dados);
		} else if(($valor == 0) && ($dados['tipo'] == 's')){
			$value = 1;
			$this->erros[] = $dados['xProd'].': não consta no estoque!';
		} else if (($valor == 1) && ($dados['tipo'] == 'e')){
			$this->objModel->entradaProduto($dados);
			$quantidadeAntiga = $this->objModel->retornaQuantidadeProduto($dados['cProd']);
			$quantidadeEntrada = $dados['qCom'];
			$quantidadeFinal = $quantidadeEntrada + $quantidadeAntiga->quantidade;
			$this->objModel->alteraQuantidade($dados['cProd'],$quantidadeFinal);
		} else if(($valor == 1) && ($dados['tipo'] == 's')){
			$quantidadeAntiga = $this->objModel->retornaQuantidadeProduto($dados['cProd']);
			$quantidadeSaida = $dados['qCom'];

			if($quantidadeAntiga->quantidade >= $quantidadeSaida){
				$this->objModel->entradaProduto($dados);
				$quantidadeFinal = $quantidadeAntiga->quantidade - $quantidadeSaida;
				$this->objModel->alteraQuantidade($dados['cProd'],$quantidadeFinal);

				$pendentes = $this->objModel->retornaPendentes($dados['cProd']);
				$this->calculaPendencia($pendentes,$quantidadeSaida);
				$pendentes = $this->objModel->retornaPendentes($dados['cProd']);
			} else {
				$value = 1;
				$this->erros[] = $dados['xCom']. ": tem quantidade insuficiente para a saída desejada!";
			}
		}
		return $value;
	}

	public function calculaPendencia($dados,$quantidade){
		$i = 0;

		while($quantidade > 0){
			if($quantidade >= $dados[$i]->qCom){
				$quantidade = $quantidade - $dados[$i]->qCom;
				$dados[$i]->qCom = 0;
				$this->objModel->alteraPendencia($dados[$i]->id_entrada,$dados[$i]->qCom);
			} else if($dados[$i]->qCom > $quantidade){
				$dados[$i]->qCom = $dados[$i]->qCom - $quantidade;
				$quantidade = 0;
				$this->objModel->alteraPendencia($dados[$i]->id_entrada,$dados[$i]->qCom);
			}

			$i++;
		}
		
	}

	public function transacion($value){
		if($value == 1){
			return 1;
		} else {
			return 0;
		}
	}

	public function recebeXML(){
		$arquivo = $_FILES['arquivo'];
		$xml = simplexml_load_file($arquivo['tmp_name']);
		$numProdutos = count($xml->NFe->infNFe->det);
		$tipo = $_POST['txt_tipo'];
		
		if(strlen((string)$xml->NFe->infNFe[0]->attributes()[0]) > 10){
			$num_nota = $this->notaFiscal((string)$xml->NFe->infNFe[0]->attributes()[0]);
		}else {
			$num_nota = $this->notaFiscal((string)$xml->NFe->infNFe[0]->attributes()[1]);
		}

		$dados = array();

		for($i = 0; $i<$numProdutos; $i++){
			$produto = $xml->NFe->infNFe->det[$i]->prod;

			if((int)$produto->CFOP != '5124'){
				$dados[$i] = array(
					"cProd" => (string)$produto->cProd,
					"xProd" => (string)$produto->xProd,
					"ncm" => (string)$produto->NCM,
					"uCom" => (string)$produto->uCom,
					"qCom" => (float)$produto->qCom,
					"vUnCom" => (float)$produto->vUnCom,
					"vProd" => (float)$produto->vProd,
					"num_nota" => (int)$num_nota,
					"tipo" => $tipo
				);
			} 
		}
		
		$this->entradaDados($dados);
	}
	
	function notaFiscal($nota){
		$n = 28;
		$novo = '';
		for ($i = $n; $i < 37; $i++) {
			$novo .= $nota[$i];
		}	
		return (int)$novo;	
		
	}

	function retornaEstoque(){
		$dados['estoque'] = $this->objModel->retornaEstoque();
		$dados['propriedade'] = "Valor unitário";
		$dados['titulo'] = 'Estoque';
		date_default_timezone_set('America/Sao_Paulo');
		$dados['data']['dia'] = date('d/m/Y');
		$dados['data']['hora'] = date('H:i');
		foreach($dados['estoque'] as $valores){
			$dados['valorPropriedade'][] = $valores->vUnCom;
		}

		$this->load->view('menu',$dados);
	}

	function retornaPendencias(){
		$dados['estoque'] = $this->objModel->retornaPendencias();
		$dados['propriedade'] = "Numero da nota";
		$dados['titulo'] = 'Pendencias';	
		
		date_default_timezone_set('America/Sao_Paulo');
		$dados['data']['dia'] = date('d/m/Y');
		$dados['data']['hora'] = date('H:i');
		
		foreach($dados['estoque'] as $valores){
			$dados['valorPropriedade'][] = $valores->num_nota;
		}

		$this->load->view('menu',$dados);
	}
	
	function retornaUltimasEntradas(){
		$dados['estoque'] = $this->objModel->retornaUltimasEntradas();
		$dados['propriedade'] = "Numero da nota";
		$dados['titulo'] = 'Ultimas Entradas';	
		
		date_default_timezone_set('America/Sao_Paulo');
		$dados['data']['dia'] = date('d/m/Y');
		$dados['data']['hora'] = date('H:i');
		
		foreach($dados['estoque'] as $valores){
			$dados['valorPropriedade'][] = $valores->num_nota;
		}

		$this->load->view('menu',$dados);
	}

	function retornaUltimasSaidas(){
		$dados['estoque'] = $this->objModel->retornaUltimasSaidas();
		$dados['propriedade'] = "Numero da nota";
		$dados['titulo'] = 'Ultimas Saídas';	
		
		date_default_timezone_set('America/Sao_Paulo');
		$dados['data']['dia'] = date('d/m/Y');
		$dados['data']['hora'] = date('H:i');
		
		foreach($dados['estoque'] as $valores){
			$dados['valorPropriedade'][] = $valores->num_nota;
		}

		$this->load->view('menu',$dados);
	}

	public function visualizaXML(){
		$xml = simplexml_load_file($_FILES['arquivo']['tmp_name']);
		echo json_encode($xml);
	}
}