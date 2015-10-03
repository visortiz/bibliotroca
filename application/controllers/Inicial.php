<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicial extends CI_Controller {

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

		}

		add_js(array('jquery.cycle.min.js','jquery.cycle.carousel.min.js'));

		$this->load->model('inicial_model');
		$data['books'] = $this->inicial_model->listar();

		$this->load->view('master/header', $data);
		$this->load->view('inicial');
		$this->load->view('master/footer');
	}

}
