<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plays extends CI_Controller {

    public function index()
	{
        $encuentros = $this->Encuentros->getAllEncuentros();
    }

    public function getEncuentroPorDeporteId($id){

        $encuentros = $this->Encuentros->getEncuentrosPorDeporteId($id);
    }

    public function getEncuentrosPorEquipo($idEquipo){

        $encuentros = $this->Encuentros->getEncuentrosPorEquipo($idEquipo);
        $equipo = $this->Deportes->getEquipoByid($idEquipo);

        $this->load->view('template', 
			['body'=>$this->load->view('encuentrosPorEquipo',['encuentros'=>$encuentros, 'equipo' => $equipo, 'liga' => null], true)]);
    }

    public function getEncuentrosPorLiga($idliga){

        $encuentros = $this->Encuentros->getEncuentrosPorLiga($idliga);
        $liga = $this->Leagues->getLigaFromId($idliga);

        $this->load->view('template', 
			['body'=>$this->load->view('encuentrosPorEquipo',['encuentros'=>$encuentros, 'liga' => $liga], true)]);
    }


}