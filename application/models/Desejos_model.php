<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Desejos_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
    }

    function inserir($data) {
        return $this->db->insert('livros', $data);
    }

    function abrir($id) {
        $query = $this->db->query("SELECT * FROM livros WHERE id_livro = '{$id}' AND tipo = 2");
        return $query->result();
    }
 
	function listar($id) {
		$query = $this->db->query("SELECT id_livro, titulo, autor, foto FROM livros WHERE id_usuario = '{$id}' AND tipo = 2");
        return $query->result();
	}

    function editar($id, $data) {
        $this->db->where('id_livro',$id);
        return $this->db->update('livros', $data);
    }
}