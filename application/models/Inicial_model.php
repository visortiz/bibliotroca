<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Inicial_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
    }
 
	function listar() {
		$query = $this->db->query("SELECT foto FROM livros WHERE tipo = 1");
        return $query->result();
	}

}