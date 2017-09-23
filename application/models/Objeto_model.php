<?php
class Objeto_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function inserir($dados){
		return $this->db->insert("Objeto",$dados);
	}
}