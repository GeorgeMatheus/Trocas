<?php
class User_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function logar($usuario, $senha){
		$this->db->select('nome, idUsuario');
		$this->db->where('usuario', $usuario);
		$this->db->where('senha', $senha);
		$this->db->from("Usuario");
		
		$estado = $this->db->get();
		
		if($estado->num_rows() == 1){
			$result = $estado->result()[0];
		}
		
		$dados = null;

		if(isset($result)){
			$dados['nome'] = $result->nome;
			$dados['id'] = $result->idUsuario;	
		}
		return $dados;
	}

	public function inserirUsuario($dados){
		var_dump($dados);
		$dados['contatos'] = $this->_inserirContatos($dados); 
		$dados['endereco'] = $this->_inserirEndereco();

		unset($dados['email']);

		return $this->db->insert('Usuario', $dados);
	}

	private function _inserirContatos($dados=null){
		$email = '';
		if(!empty($dados['email']) && !is_null($dados['email']))
			$email = $dados['email'];
		
		$dados = [
			'email'=>$email,
			'telefone1'=>'',
			'telefone2'=>'',
			'telefone3'=>'',
			'redes_sociais'=>$this->_inserirRedesSociais()
		];
		
		$this->db->insert("Contatos", $dados);
		
		return $this->db->insert_id("Contatos");
	}

	private function _inserirRedesSociais($dados=null){
		if(is_null($dados)){
			$dados = [
				'facebook'=>'',
				'instagram'=>'',
				'outras1'=>'',
				'outras2'=>'',
				'outras3'=>''
			];
		}
		$this->db->insert("RedesSociais", $dados);
		
		return $this->db->insert_id("RedesSociais");
	}

	private function _inserirEndereco($dados=null){
		if(is_null($dados)){
			$dados = [
				'estado'=>'',
				'cidade'=>'',
				'bairro'=>'',
				'rua'=>'',
				'complemento'=>''
			];
		}
		$this->db->insert("Endereco", $dados);
		
		return $this->db->insert_id("Endereco");
	}

	public function obter($id){
		if ($id == null) {
			return $id;
		}
		$this->db->select('*');
		$this->db->where('idUsuario', $id);
		$this->db->from('Usuario');

		$result = $this->db->get()->result_array()[0];
		
		$this->db->reset_query();

		$result['endereco'] = $this->_obterEndereco($result['endereco']);

		$result['contatos'] = $this->_obterContatos($result['contatos']);

		return $result;
	}

	public function _obterEndereco($id){
		if ($id == null) {
			return $id;
		}
		$this->db->select('*');
		$this->db->where('idEndereco',$id);
		$this->db->from('Endereco');

		$result = $this->db->get()->result_array()[0];

		$this->db->reset_query();

		return $result;
	}

	public function _obterContatos($id){
		if ($id == null) {
			return $id;
		}
		$this->db->select('*');
		$this->db->where('idContatos', $id);
		$this->db->from('Contatos');

		$result = $this->db->get()->result_array()[0];

		$this->db->reset_query();
		
		$result['redes_sociais'] = $this->_obterRedesSociais($result['redes_sociais']);

		return $result;
	}

	public function _obterRedesSociais($id){
		if ($id == null) {
			return $id;
		}
		$this->db->select('*');
		$this->db->where('idRedesSociais', $id);
		$this->db->from('RedesSociais');

		$result = $this->db->get()->result_array()[0];

		$this->db->reset_query();

		return $result;
	}

	public function _alterUsuario($id, $dados){
		$this->db->where('idUsuario', $id);
		if($this->db->update('Usuario', $dados)){
			//Sucesso
		}
		$this->db->reset_query();
	}

	public function _alterEndereco($id, $dados){
		$this->db->where('idEndereco', $id);
		if($this->db->update('Endereco', $dados)){
			//Sucesso
		}	
		$this->db->reset_query();
	}

	public function _alterContatos($id, $dados){
		$this->db->where('idContatos', $id);
		if($this->db->update('Contatos', $dados)){
			//Sucesso
		}	
		$this->db->reset_query();
	}

	public function _alterRedesSociais($id, $dados){
		$this->db->where('idRedesSociais', $id);
		if($this->db->update('RedesSociais', $dados)){
			//Sucesso
		}
		$this->db->reset_query();
	}

	public function _removerUser($chaves){
		//No banco está definida a função 'OnExclude: Cascade'na tabela Usuario
		//Isso faz com que, caso um registro for excluido, exclua todos os que
		//ele aponta, ou seja, dependentes dele
		$this->db->where('idUsuario', $chaves['usuario']);
		$this->db->delete('Usuario');

		$this->db->reset_query();
	}
}