<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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

			$this->load->model('home_model');
			$data['livros_desejados'] = $this->home_model->listar_desejados($data);
			$data['livros_cadastrados'] = $this->home_model->listar_cadastrados($data);
			$data['livros_trocados'] = $this->home_model->listar_trocados($data);

			$this->load->view('master/header', $data);
			$this->load->view('home');
			$this->load->view('master/footer');
		} else {
			redirect('inicial', 'refresh');
		}
	}

	function logout() {
   		$this->session->unset_userdata('logged_in');
   		session_destroy();
   		redirect('inicial', 'refresh');
 	}

}
