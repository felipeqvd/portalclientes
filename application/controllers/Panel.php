<?php

class Panel extends CI_Controller
{
    public function __construct () {
        parent::__construct();
        //$this->load->library('session');
        $this->load->library('Autenticacion');
    }



    //INICIO
    public function index() {
        if ($this->_isloggedin()) {
            $data = array();
            //$horas = array();
            //$horas = $this->CReport->getHorasx_notifi($this->session->userdata('usr_logged'));
            $data['item_menu'] = 0;
            $data['nom_client'] = $this->session->userdata('nom_client');  
            $this->load->vars($data);
            $this->load->view('vheader');
            $this->load->view('vmenu');
            $this->load->view('vpanel');
        }
        else {
            $data = array();
            $this->load->vars($data);
            $this->load->view('vlogin');
        }
    }



    //VERIFICAR SESION
    function _isloggedin() {
        $userdata = $this->session->userdata('usr_logged');
        if (!isset($userdata) or !$userdata) {
            //$loggedin = true;
            $loggedin = false;
        }
        else {
            $loggedin = true;
        }
        return $loggedin;
    }



    //CERRAR SESION
    function logout() {
        $user_data = $this->session->all_userdata();
            foreach ($user_data as $key => $value) {
                if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                    $this->session->unset_userdata($key);
                }
            }
        $this->session->sess_destroy();
        redirect(base_url().'index.php/login');
    }

    
    
    public function form_sarlaft()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1003)) { 
                $data = array();
                $data['item_menu'] = 1003;
                $data['nom_client'] = $this->session->userdata('nom_client');
                $this->load->vars($data);

                $this->load->view('vheader');
                $this->load->view('vmenu');
                $this->load->view('vform_sarlaft');
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }


    //CONSULTAS TRIBUTARIAS PARA CLIENTES
    public function consultribuclient()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1001)) { 
                $data = array();
                $data['item_menu'] = 1001;
                $data['nom_client'] = $this->session->userdata('nom_client');
                $this->load->vars($data);

                $this->load->view('vheader');
                $this->load->view('vmenu');
                $this->load->view('vconsul_client');
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
                
    }

    //FLASHES TRIBUTARIOS
    public function flashestribu()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1002)) { 
                $data = array();
                $data['item_menu'] = 1002;
                $data['nom_client'] = $this->session->userdata('nom_client');
                $this->load->vars($data);
                $this->load->view('vheader');
                $this->load->view('vmenu');
                $this->load->view('vflashe_tribut');
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }
    
    //CAMBIAR CONSTRASEÑA
    public function contrasena()
    {
        if ($this->_isloggedin()) {
            $data = array();
            $data['item_menu'] = 9;
            $data['nom_client'] = $this->session->userdata('nom_client');
            $this->load->vars($data);
            $this->load->view('vheader');
            $this->load->view('vmenu');
            $this->load->view('vpasswo');
        } 
        else
            $this->load->view('vlogin');

    }



}

?>