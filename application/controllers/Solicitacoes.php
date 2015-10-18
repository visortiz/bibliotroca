<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitacoes extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['nome'] = $session_data['nome'];
			$data['creditos'] = $session_data['creditos'];

			add_css('jquery.modal.css');
			add_js(array('jquery.modal.js','solicitacoes.js'));
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

	function aceitar_solicitacao() {
		$id = $_POST['ids'];
		$status_data['status_atual'] = 'Em trânsito';

		$this->load->model('solicitacao_model');

		if ($this->solicitacao_model->aceitar_solicitacao($id, $status_data)) {
			$result["success_message"] = "Solicitação aceita com sucesso";
		} else {
			$result["error_message"] = "Erro ao realizar operação.";
		}
		echo (json_encode($result));
	}

	function recusar_solicitacao() {
		$id = $_POST['ids'];
		$status_data['status_atual'] = 'Recusado';

		$this->load->model('solicitacao_model');

		if ($this->solicitacao_model->aceitar_solicitacao($id, $status_data)) {
			$result["success_message"] = "Solicitação recusada";
		} else {
			$result["error_message"] = "Erro ao realizar operação.";
		}
		echo (json_encode($result));
	}

	function cancela_solicitacao() {
		$id = $_POST['ids'];
		$status_data['status_atual'] = 'Cancelado';

		$this->load->model('solicitacao_model');

		if ($this->solicitacao_model->cancela_solicitacao($id, $status_data)) {
			$result["success_message"] = "Solicitação cancelada";
		} else {
			$result["error_message"] = "Erro ao realizar operação.";
		}
		echo (json_encode($result));
	}

}
