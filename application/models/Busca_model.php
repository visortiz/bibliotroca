<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Busca_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
    }
 
    // function inserir($data) {
    //     return $this->db->insert('livros', $data);
    // }

    function abrir($id) {
        $query = $this->db->query("SELECT l.id_livro, l.titulo, l.autor, l.editora, l.ano_pub, l.descricao, l.foto, u.id_usuario, u.nome, u.cidade, u.trocas_realizadas, u.reputacoes_pos, u.reputacoes_neg
                                   FROM livros AS l, usuario AS u
                                   WHERE l.id_usuario = u.id_usuario AND l.id_livro = '{$id}'");
        return $query->result();
    }
 
	function listar($busca, $id_usuario) {
		$query = $this->db->query("SELECT id_livro, titulo, autor, foto FROM livros WHERE CONCAT(titulo, autor, editora) LIKE '%$busca%' AND id_usuario != '{$id_usuario}'");
        return $query->result();
	}

    function busca_endereco($id) {
        $query = $this->db->query("SELECT cep, endereco, bairro, numero, cidade, estado, creditos FROM usuario WHERE id_usuario = '{$id}'");
        return $query->result();
    }

    function inserir($data) {
        return $this->db->insert('solicitacao', $data);
    }

}