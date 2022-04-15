<?php
//ini_set('memory_limit', '512M');
//ini_set('max_execution_time', 300);
        
class Filtroscombos extends CI_Controller
{
    public function __construct ()  
    {
        parent::__construct();
        $this->load->library('session'); 
        $this->load->model('MFiltroscombos');      
        $this->load->library('Autenticacion');
    }


    /*
     * Obtener listado de tipos de empresas.
     * Retorna al navegador un json con un arreglo de los tipos de empresas
     */
    public function getTipos_empresas ()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $data = $this->MFiltroscombos->getTipos_empresas();
                    echo json_encode($data);
                }
                else
                    echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos en esta propuesta'));
            }
            else
                $this->load->view('vlogin');
        }
        else
            show_404();
    }
    
    
    /*
     * Listado de nombres de actividades económicas.
     */
    public function getActividades ()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $data = $this->MFiltroscombos->getActividades();
                    echo json_encode($data);
                }
                else
                    echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos en esta propuesta'));
            }
            else
                $this->load->view('vlogin');
        }
        else
            show_404();
    }
    
    
    /*
     * Listado de codigos CIIU de las actividades económicas.
     */
    public function getCodigos_ciiu ()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $data = $this->MFiltroscombos->getCodigos_ciiu();
                    echo json_encode($data);
                }
                else
                    echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos en esta propuesta'));
            }
            else
                $this->load->view('vlogin');
        }
        else
            show_404();
    }
    
    
    /*
     * Listado de industrias o sectores economicos existentes.
     */
    public function getIndustrias ()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $data = $this->MFiltroscombos->getIndustrias();
                    echo json_encode($data);
                }
                else
                    echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos en esta propuesta'));
            }
            else
                $this->load->view('vlogin');
        }
        else
            show_404();
    }
    
    
    public function getLista_valores()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $campo = $this->input->post('campo', true);
                    $excluir = $this->input->post('excluir', true);
                    
                    $data = $this->MFiltroscombos->getLista_valores($this->session->userdata('usr_logged') ,$campo, $excluir);
                    echo json_encode($data);
                }
                else
                    echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos en esta propuesta'));
            }
            else
                $this->load->view('vlogin');
        }
        else
            show_404();
    }
    
}
?>