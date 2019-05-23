<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {


	public function index()
	{

		$categorias = $this->Deportes->getCategorias();
		$deportes = $this->Deportes->getDeportes();

		$this->load->view('template', 
			['body'=>$this->load->view('index',[], true)]);
		
	}

	public function register(){

		$this->load->view('template', 
			['body'=>$this->load->view('register',[], true)]);

	}



}
