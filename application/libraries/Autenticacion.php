<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Clase auxiliar con toda la funcionalidad relacionada con sesiones y autenticacion que es usada por todos los controladores.
 */
class Autenticacion{
    private $CI;
    
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
    }
    
    //VERIFICAR SESION
    function _isloggedin()
    {
        $userdata = $this->CI->session->userdata('usr_logged');
        if (!isset($userdata) or !$userdata)
        {            
            $loggedin = false;
        }
        else
        {
            $loggedin = true;
        }
        return $loggedin;
    }
    
    
    //CERRAR SESION
    function logout()
    {
        $user_data = $this->CI->session->all_userdata();            
            foreach ($user_data as $key => $value)
            {
                if ($this->CI != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                    $this->session->unset_userdata($key);
                }
            }            
        $this->CI->session->sess_destroy();
        redirect(base_url().'index.php/login');
    }
    
    //VERIFICACIÓN DE SERVICIOS
    function servicios ($servicio = 0) {
        if ($this->CI->session->userdata('pwd_change') == '0')
        {
            return false;
        }
        $serv = $this->CI->session->userdata('cod_servic');
        if (count($serv) > 0){
            foreach ($serv as $value) {
                if (in_array($servicio, $value))
                    return true;
            }
        }
        return false;
    }
    
    
    function isAdmin() {
        if ($this->CI->session->userdata('usr_perfil') == '4')
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>