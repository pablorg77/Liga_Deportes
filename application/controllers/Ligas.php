<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ligas extends CI_Controller {


    function index(){

        if($this->Leagues->checkIfAnyLeagues() && ($this->Usuario->isGestor() || $this->Usuario->isAdmin())){

            redirect('Ligas/getLigas');
        }

        else if($this->Usuario->isGestor() || $this->Usuario->isAdmin()){
            
            $this->load->view('template', 
                ['body'=>$this->load->view('addLeague',[], true)]);
        }

        else if($this->Usuario->isLogged()){

            $this->load->view('template', 
                ['body'=>$this->load->view('isLogged',[], true)]);
        }

        else if(! $this->Usuario->isLogged()){
            
            $this->load->view('template', 
                ['body'=>$this->load->view('notLogged',[], true)]);
        }

        else{

            $this->load->view('template', 
                ['body'=>$this->load->view('index',[], true)]);
        }

    }

    function addLiga(){

        $deportes = $this->Deportes->getDeportes();

        $this->load->view('template',
                ['body'=>$this->load->view('liga',['deportes'=>$deportes],true)]);
        
    }

    function setLiga(){

        $deportes = $this->Deportes->getDeportes();

        $this->form_validation->set_rules('deporte', 'Deporte', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');

        $this->form_validation->set_rules('deporte', 'Deporte', 'required',
                array('required' => 'Campo requerido'));
        $this->form_validation->set_rules('nombre', 'Nombre', 'required',
                array('required' => 'Campo requerido'));

        if ($this->form_validation->run() == FALSE){
            $this->load->view('template', 
                ['body'=>$this->load->view('liga',[], true)]);
        }
        else{
            
            $this->Leagues->setLiga($this->input->post());
            
            $this->load->view('template',
                    ['body'=>$this->load->view('completed',[],true)]);
        }
    }

    function getLigas(){

        $deportes = $this->Deportes->getDeportes();
        $ligas = [];
        $encuentros = [];

        //Acceso a todo
        if($this->Usuario->isAdmin()){

            if($this->input->post('selectDeporte')!=null){
                $ligas = $this->Leagues->getLigasAdmin($this->input->post('selectDeporte'));

                if($this->input->post('selectLiga')!=null){
                    $encuentros = $this->Deportes->getEncuentrosByLigaId($this->input->post('selectLiga'));
                }
            }
            else{
                $ligas = $this->Leagues->getAllLigas();
            }

            $this->load->view('template', 
                ['body'=>$this->load->view('ligasUsuario',[
                    'deportes' => $deportes,'ligas' => $ligas, 'encuentros' => $encuentros], true)]);
        }

        //Mismo que usuario pero puede crear, modificar y borrar ligas
        else if($this->Usuario->isGestor()){

            $ligas = $this->Leagues->getLigasGestor();
            if($ligas != null){
                $this->load->view('template', 
                    ['body'=>$this->load->view('ligasByLogged',['ligas' => $ligas], true)]);
            }
            else{
                $ligas = $this->Leagues->getLigasFromUserId();

                if($ligas != null){
                    $this->load->view('template', 
                        ['body'=>$this->load->view('ligasByLogged',['ligas' => $ligas], true)]);
                }
                else{
                    $ligas = $this->Leagues->getLigasPublicas();

                    $this->load->view('template', 
                        ['body'=>$this->load->view('ligaspublicas',['ligas' => $ligas], true)]);
                }
                
            }
            
            $ligas = $this->Leagues->getLigasPublicas();

            $this->load->view('template', 
                ['body'=>$this->load->view('ligaspublicas',['ligas' => $ligas], true)]);

        }

        //Mostrar Ligas que puede gestionar este usuario
        else if($this->Usuario->isLogged()){

            $ligas = $this->Leagues->getLigasFromUserId();

            $this->load->view('template', 
                ['body'=>$this->load->view('ligasByLogged',['ligas' => $ligas], true)]);
        }

        //Mostrar ligas públicas
        else{
            $ligas = $this->Leagues->getLigasPublicas();

            $this->load->view('template', 
                ['body'=>$this->load->view('ligaspublicas',['ligas' => $ligas], true)]);
        }
    }

    function getLigasPublicas(){

        $ligas = $this->Leagues->getLigasPublicas();

            $this->load->view('template', 
                ['body'=>$this->load->view('ligaspublicas',['ligas' => $ligas], true)]);
    }


}
