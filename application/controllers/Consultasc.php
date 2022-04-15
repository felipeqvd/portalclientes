<?php
//ini_set('memory_limit', '512M');
//ini_set('max_execution_time', 300);
        
class Consultasc extends CI_Controller
{
    public function __construct ()  
    {
        parent::__construct();
        $this->load->library('session');   
        $this->load->model('MConsultasc');
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


    /*-------------------------------------------------------------------
        Funciones para solicitar consultas (vista vconsul_client)
    ---------------------------------------------------------------------*/
    public function catego_consultas()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1001) && ($this->session->userdata('pwd_change') == '1')) { 
                $data = $this->MConsultasc->getCatego_consul();

                echo json_encode($data);
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }

    public function genera_consulta()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1001) && ($this->session->userdata('pwd_change') == '1')) { 
                $result = $this->MConsultasc->insConsulta_client($this->session->userdata('usr_logged'), $this->input->post('titulo', true), $this->input->post('categoria', true), $this->input->post('concepto', true), $this->input->post('tipo', true), $this->input->post('email', true));

                echo json_encode($result);
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }

    /*-------------------------------------------------------------------
        Funciones para consultas pendientes (vista vconsul_client)
    ---------------------------------------------------------------------*/
    public function ids_consultasSolicitadas()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1001) && ($this->session->userdata('pwd_change') == '1')) { 
                $fec_desde = $this->input->post('fec_desde', true);
                $fec_hasta = $this->input->post('fec_hasta', true);
                $id_dg = $this->input->post('id_dg', true);
                $catego_dg = $this->input->post('catego_dg', true);
                $estado_dg = $this->input->post('estado_dg', true);

                $data = $this->MConsultasc->getIds_consultasSolicitadas($this->session->userdata('usr_logged'), $fec_desde, $fec_hasta, $id_dg, $catego_dg, $estado_dg);

                array_unshift($data, ['cod_solici'=>'', 'idx_solici'=>'Todos']);

                echo json_encode($data);
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }

    public function catego_consultasSolicitadas()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1001) && ($this->session->userdata('pwd_change') == '1')) { 
                $fec_desde = $this->input->post('fec_desde', true);
                $fec_hasta = $this->input->post('fec_hasta', true);
                $id_dg = $this->input->post('id_dg', true);
                $catego_dg = $this->input->post('catego_dg', true);
                $estado_dg = $this->input->post('estado_dg', true);

                $data = $this->MConsultasc->getCatego_consultasSolicitadas($this->session->userdata('usr_logged'), $fec_desde, $fec_hasta, $id_dg, $catego_dg, $estado_dg);

                array_unshift($data, ['cod_catego'=>'', 'nom_catego'=>'Todos']);

                echo json_encode($data);
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }


    public function getConsultas_pendientes()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1001) && ($this->session->userdata('pwd_change') == '1')) { 
                $data = array();

                $fec_desde = $this->input->post('fec_desde', true);
                $fec_hasta = $this->input->post('fec_hasta', true);

                $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
                $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
                $offset = ($page-1)*$rows;

                $filterRules = $this->input->post('filterRules', true);

                $data = $this->MConsultasc->getConsultas_solicitadas($this->session->userdata('usr_logged'), $fec_desde, $fec_hasta, $offset, $rows, $filterRules);

                echo json_encode($data);
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }


    public function getDetalle_consulta()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1001) && ($this->session->userdata('pwd_change') == '1')) {         
                $data = $this->MConsultasc->getDetalles_consulta($this->session->userdata('usr_logged'), $this->input->post('id', true));  

                $result = "<b>Concepto:</b><br />".$data;

                echo $result;
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }

    public function getConcepto_consulta()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1001) && ($this->session->userdata('pwd_change') == '1')) { 
                $id = $this->input->post('id', true);

                $data = $this->MConsultasc->getDetalles_consulta($this->session->userdata('usr_logged'), $id); 

                echo json_encode($data);
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }


    public function editarConsulta()
    {
        
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1001) && ($this->session->userdata('pwd_change') == '1')) { 
                $id = $this->input->post('id', true);
                //$titulo = $this->input->post('dlg-titulo', true);
                $concepto = $this->input->post('dlg-concepto', true);

                $data = $this->MConsultasc->editarConsulta($this->session->userdata('usr_logged'), $id, $concepto);

                echo json_encode($data);
            }
            else
                echo "Usted no tiene permisos en esta sección.";
        } 
        else
            $this->load->view('vlogin');
    }


    public function getArchivo_consultaCliente()
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1001) && ($this->session->userdata('pwd_change') == '1')) { 
                $id_archivo = $this->input->post('id', true);

                $data = $this->MConsultasc->getUrl_archivoCliente($this->session->userdata('usr_logged'), $id_archivo);

                if ($data == null || ! file_exists($data['url']))
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
    public function getArchivo_downloadCliente($id_archivo)
    {
        if ($this->_isloggedin()) {
            if ($this->autenticacion->servicios(1001) && ($this->session->userdata('pwd_change') == '1')) { 
                $data = $this->MConsultasc->getUrl_archivoCliente($this->session->userdata('usr_logged'), $id_archivo);

                if ($data != null && file_exists($data['url']))      // Por si acaso vuelvo a comprobar que si exista el archivo
                {
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="Consulta ' . substr($data['codigo'], 2) . '.pdf"');
                    readfile($data['url']);
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