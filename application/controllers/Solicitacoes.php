<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitacoes extends CI_Controller {

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

			add_css('jquery.modal.css');
			add_js('jquery.modal.js');
			$data['title'] = "Solicitações";

			$this->load->model('solicitacao_model');
			$data['sol_rec'] = $this->solicitacao_model->listar_rec($session_data['id']);
			$data['sol_env'] = $this->solicitacao_model->listar_env($session_data['id']);
			
			$this->load->view('master/header', $data);
			$this->load->view('solicitacoes');
			$this->load->view('master/footer');
		} else {
			redirect('inicial', 'refresh');
		}
	}

	function abrir_recebida() {
		$this->load->model('solicitacao_model');

		$id = $_POST['id'];

		$book = $this->solicitacao_model->abrir_recebida($id);
		echo json_encode($book);
	}

	function abrir_enviada() {
		$this->load->model('solicitacao_model');

		$id = $_POST['id'];

		$book = $this->solicitacao_model->abrir_enviada($id);
		echo json_encode($book);
	}

}
