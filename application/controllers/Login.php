<?php

class Login extends CI_Controller
{
    public function __construct () {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('Autenticacion');
        $this->load->model('MSeguri');
    }
    //INICIO
    public function index($corp = 'crowe') {
        $data = array();
        if ($corp == 'crowe'){
            $data['logo'] = 'logo.png';
        }elseif ($corp == 'consulting'){
            $data['logo'] = 'LOGO-CONSULTING.png';
        }

        if ($this->_isloggedin()) {
            $data = array();            
            $data['item_menu'] = 0;
            $data['nom_client'] = $this->session->userdata('nom_client');  
            $data['nit_client'] = $this->session->userdata('nit_client');
            
            if ($this->session->userdata['pwd_change'] == '0')
            {
                $data['item_menu'] = 9;
                $this->load->vars($data);
                $this->load->view('vheader');
                $this->load->view('vmenu');
                $this->load->view('vpasswo');
            }
            else
            {
                $data['item_menu'] = 1003;
                $this->load->vars($data);
                $this->load->view('vheader');
                $this->load->view('vmenu');
                $this->load->view('vform_sarlaft');
            }
            
        }
        else {            
            $this->load->vars($data);
            $this->load->view('vlogin');
        }
    }

    public function consulting(){
        $this->index('consulting');
    }


    //VERIFICAR SESION
    function _isloggedin() {
        $userdata = $this->session->userdata('usr_logged');
        if (!isset($userdata) or !$userdata)
        {
            $loggedin = false;
            //$loggedin = true;
        }
        else
        {
            $loggedin = true;
        }
        return $loggedin;
    }



    //CERRAR SESION
    function logout() {
        $user_data = $this->session->all_userdata();
            foreach ($user_data as $key => $value)
            {
                if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                    $this->session->unset_userdata($key);
                }
            }
        $this->session->sess_destroy();
        redirect(base_url().'index.php/login');
    }



    //VERIFICACIÓN DE SERVICIOS
    function servicios ($servicio = 0) {
        $serv = $this->session->userdata('cod_servic');
        foreach ($serv as $value) {
            if (in_array($servicio, $value))
                return true;
        }
        return false;
    }



    //VALIDAR CREDENCIALES
    public function validate()
    {
        if ($this->input->is_ajax_request() && $this->input->post('username'))
        {
            $u  = $this->input->post('username');
            $pw = $this->input->post('password');
            $this->load->model('MSeguri');
            $this->MSeguri->verifiUsuari($u,$pw);

            if ($this->_isloggedin())
            {
                $type = 'loggedin';
                $msg = 'Entrando al panel...';
                echo json_encode(array('type' => $type, 'msg' => $msg));
            }
            else
            {
                $type = 'danger';
                $msg = 'El nombre de usuario o la contrase&ntilde;a son incorrectos';
                echo json_encode(array('type' => $type, 'msg' => $msg));
            }
        }
        else
            show_404();
    }
    //CAMBIAR CONTRASEÑA
    public function cambiar_password()
    {
        if ($this->_isloggedin() && $this->input->is_ajax_request() && $this->input->post('oldpassw')) {
            $u  = $this->session->userdata('usr_logged');
            $pw = $this->input->post('oldpassw');
            $this->load->model('MSeguri');            
            if ($this->MSeguri->verifiUsuari_cambio($u,$pw)){
                $pw1 = $this->input->post('newpassw1');
                $pw2 = $this->input->post('newpassw2');
                if ($pw1 === $pw2){
                    if ($pw != $pw1){
                        $data = $this->MSeguri->cambioPasswo($u,$pw1);
                    }
                    else{
                        $data = array ('type' => 'danger',
                                       'msg' => 'La nueva contraseña debe ser diferente a la anterior'
                                      );
                    }
                }
                else{
                    $data = array ('type' => 'danger',
                                   'msg' => 'Las contraseñas no coinciden'
                                  );
                }
            }
            else{
                $data = array ('type' => 'danger',
                               'msg' => 'La contraseña actual es incorrecta'
                              );
            }
            echo json_encode($data);
        }
        else
            show_404();
    }
    
    public function passwords() {
        show_404();         // Por seguridad no dejar que se ejecute
        return;
        $this->load->model('MSeguri');
        $this->MSeguri->hashall();
    }
    
    function recuperarcontrasena ($cod_camclv = '')
    {
        if ($this->input->post('usr_emailx'))
        {
            $success = $this->MSeguri->restorPasswo();
            if ($success == "S")
            {
                echo "<span style=\"font-weight: normal; color:#000000\">Se ha enviado un enlace de confirmación para restaurar su contraseña al correo electrónico </span><span style=\"font-weight: bold; color:#000000\">".$_POST['usr_emailx']." </span>";
            }
            else if ($success == "N")
            {
                echo "<span style=\"font-weight: bold; color:#000000\">El correo electrónico que ha ingresado no está registrado</span>";
            }
        }
        else if ($cod_camclv == '' && ! $this->input->post('cod_camclv'))
        {
            $this->load->view('vrestore_pass');
        }
        else if ($cod_camclv != '')
        {
            $data = array();
            $data['cod_camclv'] = $cod_camclv;
            $data['inf_datusr'] = $this->MSeguri->traerxDatusr($cod_camclv);
            if (!empty($data['inf_datusr']))
            {
                $this->load->vars($data);
                $this->load->view('vpass_cambiar');
            }
            else
            {
                $this->load->view('vpass_error');
            }
        }
        else if ($this->input->post('cod_camclv'))
        {
            $mensaje = $this->MSeguri->cambiaPasswo();
            echo "<span style=\"font-weight: bold; color:#000000\">".$mensaje."</span>";
        }
        
    }
    function restore ($cod_camclv = '')
    {
        if ($this->input->post('usr_emailx'))
        {
            $success = $this->MSeguri->restorPasswo();
            if ($success == "S")
            {
                echo "<span style=\"font-weight: normal; color:#000000\">Se ha enviado un enlace de confirmación para restaurar su contraseña al correo electrónico </span><span style=\"font-weight: bold; color:#000000\">".$_POST['usr_emailx']." </span>";
            }
            else if ($success == "N")
            {
                echo "<span style=\"font-weight: bold; color:#000000\">El correo electrónico que ha ingresado no está registrado</span>";
                echo "<br /><br />";
                echo "<input type=\"button\" name=\"volver\" id=\"button\" value=\"Volver\" onClick=\"$('#ex1').jqmHide(); $('#ex1').jqm({ajax: '".base_url()."index.php/service/restore/', ajaxText: 'Por favor espere...'}).jqmShow(); return false;\" />";
            }
        }
        else if ($cod_camclv == '' && ! $this->input->post('cod_camclv'))
        {
            $this->load->view('vrestore_pass');
        }
        else if ($cod_camclv != '')
        {
            $data = array();
            $data['cod_camclv'] = $cod_camclv;
            $data['inf_datusr'] = $this->MSeguri->traerxDatusr($cod_camclv);
            if (!empty($data['inf_datusr']))
            {
                $this->load->vars($data);
                $this->load->view('vpass_cambiar');
            }
            else
            {   
                echo "Este enlace ya no es funcional.  Si ya cambió su contraseña a través del enlace enviado por correo electrónico, debe volver a solicitar el cambio de contraseña en la página inicial del sistema para que se habilite nuevamente el enlace.";
                //$this->load->view('vpass_error');
            }
        }
        else if ($this->input->post('cod_camclv'))
        {
            $this->load->model('MSeguri');
            $mensaje = $this->MSeguri->cambiaPasswo();
            echo "<p>".$mensaje."</p>";
        }
        
    }
}

?>