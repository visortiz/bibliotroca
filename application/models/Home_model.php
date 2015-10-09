<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	function listar_desejados() {
		$query = $this->db->query("SELECT titulo, autor, foto FROM livros WHERE tipo = 2 ORDER BY id_livro DESC LIMIT 10");
        return $query->result();
	}

	function listar_cadastrados() {
		$query = $this->db->query("SELECT titulo, autor, foto FROM livros WHERE tipo = 1 ORDER BY id_livro DESC LIMIT 10");
        return $query->result();
	}

	function listar_trocados() {
		$query = $this->db->query("SELECT l.titulo, l.autor, l.foto
								   FROM livros AS l, solicitacao AS s
								   WHERE s.id_livro = l.id_livro ORDER BY s.id_solicitacao DESC LIMIT 5");
        return $query->result();
	}

}
