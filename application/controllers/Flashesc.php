<?php
//ini_set('memory_limit', '512M');
//ini_set('max_execution_time', 300);
        
class Flashesc extends CI_Controller
{
    public function __construct ()  
    {
        parent::__construct();
        $this->load->library('session'); 
        $this->load->model('MFlashesc');     
        $this->load->library('Autenticacion');
    }

    function _isloggedin() {
        $userdata = $this->session->userdata('usr_logged');
        if (!isset($userdata) or !$userdata) {
            $loggedin = false;
        }
        else {
            $loggedin = true;
        }
        return $loggedin;
    }


    public function getCodigos_flashes()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1002) && ($this->session->userdata('pwd_change') == '1')) {    
                $codigo = $this->input->post('codigo', true);
                $fec_desde = $this->input->post('fec_desde', true);
                $fec_hasta = $this->input->post('fec_hasta', true);
                $texto = $this->input->post('texto', true);
                //$temas = json_decode($this->input->post('temas', true));

                $data = $this->MFlashesc->getCodigos_flashes($this->session->userdata('usr_logged'), $codigo, $fec_desde, $fec_hasta, $texto);  //, $temas);

                echo json_encode($data);
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }

    public function getFlashes_lista()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1002) && ($this->session->userdata('pwd_change') == '1')) {
                $data = array();

                $codigo = $this->input->post('codigo', true);
                $fec_desde = $this->input->post('fec_desde', true);
                $fec_hasta = $this->input->post('fec_hasta', true);
                $texto = $this->input->post('texto', true);
                //$temas = json_decode($this->input->post('temas', true));

                $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
                $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
                $offset = ($page-1)*$rows;

                $data = $this->MFlashesc->getFlashes_lista($this->session->userdata('usr_logged'), $codigo, $fec_desde, $fec_hasta, $texto, $offset, $rows); //$temas, $offset, $rows);

                echo json_encode($data);
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }

    /*  Funcion para verificar si un archivo existe o no (respuesta a un request ajax por post)*/
    public function getArchivo_flash()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1002) && ($this->session->userdata('pwd_change') == '1')) {
                $id_archivo = $this->input->post('id', true);

                $url = $this->MFlashesc->getUrl_archivo_flash($id_archivo);

                if (! file_exists($url))
                    echo json_encode(array('status' => 'error', 'msj' => 'El archivo pdf no fue encontrado en el servidor.'));
                else
                {
                    echo json_encode(array('status' => 'success'));
                }
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }

    /*  Funcion para descargar el archivo que ya se verifico que existe (respuesta a un get)*/
    public function getFlash_download($id_archivo)
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1002) && ($this->session->userdata('pwd_change') == '1')) {
                $url = $this->MFlashesc->getUrl_archivo_flash($id_archivo);

                if (file_exists($url))      // Por si acaso vuelvo a comprobar que si exista el archivo
                {
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="Flash' . $id_archivo . '.pdf"');
                    readfile($url);
                }
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }
}
?>