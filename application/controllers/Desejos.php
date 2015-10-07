<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desejos extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in')) {

			$session_data = $this->session->userdata('logged_in');
			$data['nome'] = $session_data['nome'];
			$data['creditos'] = $session_data['creditos'];
			$data['id'] = $session_data['id'];

			add_css('jquery.modal.css');
			add_js(array('jquery.modal.js','estante_desejos.js'));

			$data['title'] = "Lista de Desejos";

			$this->load->model('desejos_model');
			$data['books'] = $this->desejos_model->listar($session_data['id']);

			$this->load->view('master/header', $data);
			$this->load->view('desejos');
			$this->load->view('master/footer');
		} else {
			redirect('inicial', 'refresh');
		}
	}

	function abrir() {
		$this->load->model('desejos_model');

		$id = $_POST['id'];

		$book = $this->desejos_model->abrir($id);

		$picture = get_object_vars($book[0])['foto'];

		echo json_encode($book);
	}

	function inserir() {
		$data['id_usuario'] = $this->input->post('idu');
		$data['tipo'] = 2;
		$data['titulo'] = $this->input->post('titulo');
		$data['autor'] = $this->input->post('autor');
		$data['editora'] = $this->input->post('editora');
		$data['ano_pub'] = $this->input->post('ano_pub');
		$data['descricao'] = $this->input->post('descricao');

 		//Gera nome unico + extensao para o arquivo
		$ext = substr(strrchr($_FILES['foto']['name'],'.'),1);
		$rand = md5(uniqid(rand(), true)) .'.'. $ext;

		//Salva arquivo na pasta
		$sourcePath = $_FILES['foto']['tmp_name'];
		$targetPath = "assets/imgs/book_covers/".$rand;
		move_uploaded_file($sourcePath,$targetPath);

		//Salva nome do arquivo no banco
		$data['foto'] = $rand;

		$this->load->model('desejos_model');

		if ($this->desejos_model->inserir($data)) {
			redirect('desejos');
		} else {
			log_message('error', 'Erro ao inserir o livro.');
		}
	}

	function editar() {
		$id = $this->input->post('id');

		$data['tipo'] = 2;
		$data['titulo'] = $this->input->post('titulo');
		$data['autor'] = $this->input->post('autor');
		$data['editora'] = $this->input->post('editora');
		$data['ano_pub'] = $this->input->post('ano_pub');
		$data['descricao'] = $this->input->post('descricao');

		if(!empty($_FILES['foto_edited']['name'])) {
			//Gera nome unico + extensao para o arquivo
			$ext = substr(strrchr($_FILES['foto_edited']['name'],'.'),1);
			$rand = md5(uniqid(rand(), true)) .'.'. $ext;

			//Salva arquivo na pasta e apaga foto antiga
			$sourcePath = $_FILES['foto_edited']['tmp_name'];
			$targetPath = "assets/imgs/book_covers/".$rand;
			move_uploaded_file($sourcePath,$targetPath);
			unlink("assets/imgs/book_covers/".$this->input->post('foto_old'));

			//Salva nome do arquivo no banco
			$data['foto'] = $rand;
		} else {
			$data['foto'] = $this->input->post('foto_old');
		}

		/* Carrega o modelo */
		$this->load->model('desejos_model');

		$crud->callback_before_delete(array($id,'crud_delete_file'));

		/* Chama a função inserir do modelo */
		if ($this->desejos_model->editar($id, $data)) {
			redirect('desejos');
		} else {
			log_message('error', 'Erro ao inserir o livro.');
		}
	}

}
