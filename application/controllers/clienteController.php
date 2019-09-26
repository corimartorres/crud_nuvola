<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clienteController extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('clienteModel');
    }
	public function index(){
		$this->load->view('inicio');
	}

	function guardar(){
		if ($_POST) {
			$this->clienteModel->guardar($_POST);
		}
		$this->load->view('inicio');
	}
	function borrar(){
		$this->clienteModel->borrar($_GET);
		$this->load->view('inicio');
	}

	public function getPersonas(){
		$result = $this->clienteModel->getPersonas();
		echo json_encode($result);
	}
}
