<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busca extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		if($this->session->userdata('logged_in')) {

			$session_data = $this->session->userdata('logged_in');
			$data['nome'] = $session_data['nome'];
			$data['creditos'] = $session_data['creditos'];
			$data['id'] = $session_data['id'];

			add_css('jquery.modal.css');
			add_js('jquery.modal.js');

			$data['title'] = "Resultado da Busca";

			$busca = $this->input->post('search');

			$this->load->model('busca_model');
			$data['books'] = $this->busca_model->listar($busca, $session_data['id']);
			$data['busca'] = $busca;

			$this->load->view('master/header', $data);
			$this->load->view('busca');		
			$this->load->view('master/footer');
		} else {
			add_css('jquery.modal.css');
			add_js('jquery.modal.js');

			$data['title'] = "Resultado da Busca";

			$busca = $this->input->post('search');

			$this->load->model('busca_model');
			$data['books'] = $this->busca_model->listar($busca);
			$data['busca'] = $busca;

			$this->load->view('master/header', $data);
			$this->load->view('busca');		
			$this->load->view('master/footer');
		}
	}

	function abrir() {
		$this->load->model('busca_model');

		$id = $_POST['id'];

		$book = $this->busca_model->abrir($id);
		echo json_encode($book);
	}

	function busca_endereco() {
		$this->load->model('busca_model');

		$id = $_POST['id'];
		$endereco = $this->busca_model->busca_endereco($id);

		echo json_encode($endereco);
	}

	function solicita() {
		$this->load->helper('string');

		$data['id_livro'] = $this->input->post('idl');
		$data['id_usuario_o'] = $this->input->post('iduo');
		$data['id_usuario_s'] = $this->input->post('idus');
		$data['id_status'] = "1";
		$data['numero_solicitacao'] = rand(1,1000000);;
		$data['cep_entrega'] = $this->input->post('cep');
		$data['endereco_entrega'] = $this->input->post('endereco');
		$data['numero_entrega'] = $this->input->post('numero');
		$data['bairro_entrega'] = "Centro";
		$data['cidade_entrega'] = $this->input->post('cidade');
		$data['estado'] = $this->input->post('estado');

		$this->load->model('busca_model');
	 
		if ($this->busca_model->inserir($data)) {
			$arr = array('msg' => 'Solicitação realizada com sucesso!');
    		echo json_encode( $arr );
		} else {
			log_message('error', 'Erro ao solicitar livro.');
		}
	}
}
