<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Cadastro_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
    }
 
    function inserir($data) {
        return $this->db->insert('usuario', $data);
    }
 
	function listar() {
		$query = $this->db->get('usuario');
		return $query->result();
	}
}