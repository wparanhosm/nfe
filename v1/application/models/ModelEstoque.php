<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelEstoque extends CI_Model{

	public function retornaEntrada(){
		return $this->db->get("entradas")->result();
	}

	public function retornaExisteProduto($cod){
		$query = $this->db->query("call retornaExiste($cod,@valor)");
		$valor = $this->db->query("select @valor as valor")->result();
		return $valor[0];
	}

	public function retornaQuantidadeProduto($cod){
		$quantidade = $this->db->query("call retornaQtd($cod)");
		$qtd = $quantidade->result()[0];
		mysqli_next_result( $this->db->conn_id );
		return $qtd;
	}

	public function alteraQuantidade($cod,$qtd){
		$quantidade = array("qCom"=> $qtd);
		$this->db->where('cProd',$cod);
		$this->db->update('tbl_estoque',$quantidade);
	}

	public function iniciaTransacao(){
		$this->db->trans_begin();
	}

	public function verificaTransacao($status){
		$situation = '';	
		if ($status > 0){
        	$situation = false;
        	$this->db->trans_rollback();
    	} else {
        	$this->db->trans_commit();
        	$situation = true;
        }

        return $situation;
	}


	public function entradaEstoque($array){
		unset($array['tipo']);
		unset($array['num_nota']);
		return $this->db->insert('tbl_estoque',$array);
	}

	public function entradaProduto($array){
		$this->db->insert('tbl_produto',$array);
		if($array['tipo'] == 'e'){
			unset($array['tipo']);
			$this->db->insert('tbl_entradas',$array);
		}
	}

	public function retornaPendentes($cod){
		$pendente = $this->db->query("call retornaNotasPendentes($cod)");
		$resultado = $pendente->result();

		$pendente->free_result();
		$pendente->next_result();
		return $resultado;
	}

	public function alteraPendencia($id,$qtd){
		$quantidade = array("qCom" => $qtd);
		$this->db->where('id_entrada',$id);
		$this->db->update('tbl_entradas',$quantidade);
	}

	public function retornaEstoque(){
		return $this->db->get('tbl_estoque')->result();
	}
	
	//select * from tbl_entradas where qCom > 0 
	
	public function retornaPendencias(){
		return $this->db->query("select * from tbl_entradas where qCom > 0 ")->result();
	}

	public function retornaUltimasEntradas(){
		return $this->db->query("select * from tbl_produto where tipo = 'e'")->result();
	}

	public function retornaUltimasSaidas(){
		return $this->db->query("select * from tbl_produto where tipo = 's'")->result();
	}

}