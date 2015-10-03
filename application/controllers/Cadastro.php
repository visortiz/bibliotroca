<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/cadastro
	 *	- or -
	 * 		http://example.com/index.php/cadastro/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/cadastro/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['title'] = "Cadastro";
		$this->load->view('master/header', $data);
		$this->load->view('cadastro');		
		$this->load->view('master/footer');
	}

	function inserir() {
 
		/* Carrega a biblioteca do CodeIgniter responsável pela validação dos formulários */
		// $this->load->library('form_validation');
	 
		/* Define as tags onde a mensagem de erro será exibida na página */
		// $this->form_validation->set_error_delimiters('<div id="message">', '</div>');
	 
		/* Define as regras para validação */
		// $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[40]');
		// $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[100]');
	 
		/* Executa a validação e caso houver erro... */
		// if ($this->form_validation->run() === FALSE) {
			/* Chama a função index do controlador */
			// $this->index();
		/* Senão, caso sucesso na validação... */	
		// } else {
			/* Recebe os dados do formulário (visão) */
			$date = explode('/', $this->input->post('dt_nasc'));
			$dt_nasc = $date[2].'-'.$date[1].'-'.$date[0];

			$data['email'] = $this->input->post('email');
			$data['senha'] = $this->input->post('senha');
			$data['nome'] = $this->input->post('nome');
			$data['cep'] = $this->input->post('cep');
			$data['endereco'] = $this->input->post('endereco');
			$data['numero'] = $this->input->post('numero');
			$data['bairro'] = $this->input->post('bairro');
			$data['cidade'] = $this->input->post('cidade');
			$data['estado'] = $this->input->post('estado');
			$data['dt_nasc'] = $dt_nasc;
	 
	 		/* Carrega o modelo */
			$this->load->model('cadastro_model');
	 
			/* Chama a função inserir do modelo */
			if ($this->cadastro_model->inserir($data)) {
				redirect('cadastro');
			} else {
				log_message('error', 'Erro ao inserir a pessoa.');
			}
		// }
	}

	
}