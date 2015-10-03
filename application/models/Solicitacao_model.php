<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Solicitacao_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
    }

    function listar_rec($id) {
		$query = $this->db->query("SELECT l.id_livro, l.titulo, l.autor, l.foto
								   FROM livros AS l, solicitacao AS s
								   WHERE s.id_usuario_o = '{$id}' AND s.id_livro = l.id_livro");
        return $query->result();
	}

	function listar_env($id) {
		$query = $this->db->query("SELECT l.id_livro, l.titulo, l.autor, l.foto
							   	   FROM livros AS l, solicitacao AS s
							   	   WHERE s.id_usuario_s = '{$id}' AND s.id_livro = l.id_livro");
        return $query->result();
	}

	function abrir_recebida($id) {
        $query = $this->db->query("SELECT l.id_livro, l.titulo, l.autor, l.editora, l.ano_pub, l.descricao, l.foto, u.id_usuario, u.nome, u.endereco, u.numero, u.cep, u.cidade, u.estado, u.trocas_realizadas, u.reputacoes_pos, u.reputacoes_neg
                                   FROM livros AS l, usuario AS u
                                   WHERE l.id_usuario = u.id_usuario AND l.id_livro = '{$id}'");
        return $query->result();
    }

    function abrir_enviada($id) {
        $query = $this->db->query("SELECT l.id_livro, l.titulo, l.autor, l.editora, l.ano_pub, l.descricao, l.foto, u.id_usuario, u.nome, u.cidade, u.trocas_realizadas, u.reputacoes_pos, u.reputacoes_neg
                                   FROM livros AS l, usuario AS u
                                   WHERE l.id_usuario = u.id_usuario AND l.id_livro = '{$id}'");
        return $query->result();
    }

}