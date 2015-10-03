<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	function login($username, $password) {
		$this -> db -> select('id_usuario, email, senha, nome, creditos');
		$this -> db -> from('usuario');
		$this -> db -> where('email', $username);
		$this -> db -> where('senha', $password);
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}

}
?>