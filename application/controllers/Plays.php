<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plays extends CI_Controller {

    public function index()
	{

        $this->load->model('Encuentros');
        $encuentros = $this->Encuentros->getAllEncuentros();

    }

    public function getEncuentroPorDeporteId($id){

        $this->load->model('Encuentros');
        $encuentros = $this->Encuentros->getEncuentrosPorDeporteId($id);

    }

    public function getEncuentrosPorEquipo($nombre){

        $this->load->model('Encuentros');
        $encuentros = $this->Encuentros->getEncuentrosPorEquipo($nombre);

        $this->load->view('template', 
			['body'=>$this->load->view('encuentrosPorEquipo',['encuentros'=>$encuentros], true)]);
    }

    public function getEncuentrosRecientes(){

        $this->load->model('Encuentros');
        $encuentros = $this->Encuentros->getEncuentrosRecientes();

    }

    public function getEncuentrosActuales(){

        $this->load->model('Encuentros');
        $encuentros = $this->Encuentros->getEncuentrosActuales();

    }

    public function getEncuentrosProximos(){

        $this->load->model('Encuentros');
        $encuentros = $this->Encuentros->getEncuentrosProximos();

    }

}