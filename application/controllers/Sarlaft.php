<?php
//ini_set('memory_limit', '512M');
//ini_set('max_execution_time', 300);
        
class Sarlaft extends CI_Controller
{
    public function __construct ()  
    {
        parent::__construct();
        $this->load->library('session'); 
        $this->load->model('MSarlaft');      
        $this->load->library('Autenticacion');
        $this->load->library('Helper_db');
    }
 
    
    public function getInfo()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    
                    $data = $this->MSarlaft->getInfo($this->session->userdata('usr_logged'));
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
    
    
    
    public function editInfo()
    {
        if ($this->autenticacion->_isloggedin()) {
            if ($this->autenticacion->servicios(1003)) {
                $tipo_persona = $this->input->post('tipo_persona', true);
                $nombre = $this->input->post('nombre', true);
                $tipo_empresa = $this->input->post('tip_empresa', true);
                $tipo_id = $this->input->post('tip_id', true);
                $nit = $this->input->post('nit', true);
                $dv = $this->input->post('dv', true);
                $direccion = $this->input->post('direccion', true);
                $telefono = $this->input->post('telefono', true);
                $fax = $this->input->post('fax', true);
                $email = $this->input->post('cli_email', true);
                $actividad_principal = $this->input->post('actividad');
                $industria = $this->input->post('industria', true);
                $cotiza = $this->input->post('cotiza_bolsa', true);
                $servicio = $this->input->post('tipo_servicio', true);
                if ($servicio == '' || $servicio == ' '){
                    $servicio = null;
                }
                /*      Persona de contacto        */
                $persona_contacto = $this->input->post('persona_contacto', true);
                $area_contacto = $this->input->post('area_contacto', true);
                $email_contacto = $this->input->post('email_contacto', true);
                $telefono_contacto = $this->input->post('tel_contacto', true);
                
                
                /*      Datos representante legal      */
                $rep_apellido1 = $this->input->post('representante_apellido', true);
                $rep_apellido2 = $this->input->post('representante_segapellido', true);
                $rep_nombre = $this->input->post('representante_nombre', true);
                $rep_tipo_id = $this->input->post('tip_documento', true);
                $rep_numero_id = $this->input->post('numero_documento', true);
                $rep_fec_expedicion = $this->input->post('fecha_documento', true);
                $rep_lugar_id = $this->input->post('lugar_documento', true);
                $rep_fec_nacimiento = $this->input->post('fecnacimiento_rep', true);
                $rep_lugar_nacimiento = $this->input->post('nacimiento_rep', true);
                $rep_nacionalidad = $this->input->post('nacionalidad_rep', true);
                $rep_telefono = $this->input->post('tel_rep', true);
                $rep_email = $this->input->post('email_rep', true);
                $rep_direccion = $this->input->post('direccion_rep', true);
                $rep_ciudad = $this->input->post('ciudad_rep', true);
                $rep_maneja_recursos = $this->input->post('recursos_publicos', true);
                $rep_poder_publico = $this->input->post('poder_publico', true);
                $rep_reconocimiento_publico = $this->input->post('reconocimiento_publico', true);
                $rep_participacion_mayoral5 = $this->input->post('posee_5', true);
                $rep_vinculo_publico = $this->input->post('vinculo_publico', true);
                $rep_tipo_vinculo = $this->input->post('tipo_vinculo', true);
                
                
                /*      Contactos principales      */
                $nombre_gerente = $this->input->post('nombre_gerente', true);
                $telefono_gerente = $this->input->post('telefono_gerente', true);
                $email_gerente = $this->input->post('email_gerente', true);
                
                $nombre_secretaria = $this->input->post('nombre_secretaria', true);
                $telefono_secretaria = $this->input->post('telefono_secretaria', true);
                $email_secretaria = $this->input->post('email_secretaria', true);
                
                $nombre_financiero = $this->input->post('nombre_financiero', true);
                $telefono_financiero = $this->input->post('telefono_financiero', true);
                $email_financiero = $this->input->post('email_financiero', true);
                
                $nombre_contador = $this->input->post('nombre_contador', true);
                $telefono_contador = $this->input->post('telefono_contador', true);
                $email_contador = $this->input->post('email_contador', true);
                
                $nombre_tributario = $this->input->post('nombre_tributario', true);
                $telefono_tributario = $this->input->post('telefono_tributario', true);
                $email_tributario = $this->input->post('email_tributario', true);
                
                $nombre_tesorero = $this->input->post('nombre_tesorero', true);
                $telefono_tesorero = $this->input->post('telefono_tesorero', true);
                $email_tesorero = $this->input->post('email_tesorero', true);
                
                $nombre_juridico = $this->input->post('nombre_juridico', true);
                $telefono_juridico = $this->input->post('telefono_juridico', true);
                $email_juridico = $this->input->post('email_juridico', true);
                
                
                /*      Información financiera      */
                $ingresos = $this->input->post('ingresos', true);
                $egresos = $this->input->post('egresos', true);
                $activos = $this->input->post('activos', true);
                $pasivos = $this->input->post('pasivos', true);
                $otros_ingresos = $this->input->post('otros_ingresos', true);
                $con_otros_ingresos = $this->input->post('concepto_otros_ingresos', true);
                if ($con_otros_ingresos == "" || $con_otros_ingresos == " ")
                    $con_otros_ingresos = null;
                $contribuyente = $this->input->post('contribuyente', true);
                $autoretenedor = $this->input->post('autoretenedor', true);
                $declarante = $this->input->post('declarante', true);
                $tarifa_ica = $this->input->post('tarifa_ica', true);
                $origen_fondos = $this->input->post('origen_fondos', true);
                if ($origen_fondos == "" || $origen_fondos == " ")
                    $origen_fondos = null;
                
                $nombre_autorizacion = $this->input->post('nombre_autorizacion', true);
                $tipoid_autorizacion = $this->input->post('tipoid_autorizacion', true);
                $numid_autorizacion = $this->input->post('numid_autorizacion', true);
                $lugarid_autorizacion = $this->input->post('lugarid_autorizacion', true);
                $sociedad_autorizacion = $this->input->post('sociedad_autorizacion', true);
                $nit_autorizacion = $this->input->post('nit_autorizacion', true);
                
                
                /*      Documentación requerida      */
                $this->load->library('File_helpers');
                $file_estados = null;
                $file_ccrep = null;
                $file_renta = null;
                $file_rut = null;
                $file_camara = null;
                
                $autorizo = $this->input->post('autorizo', true);
                        
                if ($_FILES['estados_financieros']['size'] > 0)
                {
                    $file_estados = $this->file_helpers->upload_file(dirname(dirname(FCPATH)) . '/Sarlaft/', 'estados_financieros', null, 'pdf|jpg|png|jpeg');
                    if (! $file_estados['success'])
                    {
                        $this->reversarArchivos($file_rut, $file_camara, $file_estados, $file_ccrep, $file_renta);
                        echo json_encode(array('success' => $file_estados['success'], 'msg' => $file_estados['msg']));
                        return;
                    }
                }
                
                if ($_FILES['cedula_representante']['size'] > 0)
                {
                    $file_ccrep = $this->file_helpers->upload_file(dirname(dirname(FCPATH)) . '/Sarlaft/', 'cedula_representante', null, 'pdf|jpg|png|jpeg');
                    if (! $file_ccrep['success'])
                    {
                        $this->reversarArchivos($file_rut, $file_camara, $file_estados, $file_ccrep, $file_renta);
                        echo json_encode(array('success' => $file_ccrep['success'], 'msg' => $file_ccrep['msg']));
                        return;
                    }
                }
                
                if ($_FILES['declaracion_renta']['size'] > 0)
                {
                    $file_renta = $this->file_helpers->upload_file(dirname(dirname(FCPATH)) . '/Sarlaft/', 'declaracion_renta', null, 'pdf|jpg|png|jpeg');
                    if (! $file_renta['success'])
                    {
                        $this->reversarArchivos($file_rut, $file_camara, $file_estados, $file_ccrep, $file_renta);
                        echo json_encode(array('success' => $file_renta['success'], 'msg' => $file_renta['msg']));
                        return;
                    }
                }
                
                if ($_FILES['rut']['size'] > 0)
                {
                    $file_rut = $this->file_helpers->upload_file(dirname(dirname(FCPATH)) . '/Sarlaft/', 'rut', null, 'pdf|jpg|png|jpeg');
                    if (! $file_rut['success'])
                    {
                        $this->reversarArchivos($file_rut, $file_camara, $file_estados, $file_ccrep, $file_renta);
                        echo json_encode(array('success' => $file_rut['success'], 'msg' => $file_rut['msg']));
                        return;
                    }
                }
                
                if ($_FILES['camara_comercio']['size'] > 0)
                {
                    $file_camara = $this->file_helpers->upload_file(dirname(dirname(FCPATH)) . '/Sarlaft/', 'camara_comercio', null, 'pdf|jpg|png|jpeg');
                    if (! $file_camara['success'])
                    {
                        $this->reversarArchivos($file_rut, $file_camara, $file_estados, $file_ccrep, $file_renta);
                        echo json_encode(array('success' => $file_camara['success'], 'msg' => $file_camara['msg']));
                        return;
                    }
                }

                $pdf_sarlaft = $this->generarPDF();
                
                if (! $pdf_sarlaft['success'])
                {
                    $this->reversarArchivos($file_rut, $file_camara, $file_estados, $file_ccrep, $file_renta);
                    echo json_encode($pdf_sarlaft);
                    return;
                }
                
                $data = $this->MSarlaft->editInfo($this->session->userdata('usr_logged'), $tipo_persona, $nombre, $tipo_empresa, $tipo_id, $nit, $dv, $direccion, $telefono, $fax, $email, $actividad_principal, $industria, $cotiza, $servicio, $persona_contacto, $area_contacto, $email_contacto, $telefono_contacto, $rep_apellido1, $rep_apellido2, $rep_nombre, $rep_tipo_id, $rep_numero_id, $rep_fec_expedicion, $rep_lugar_id, $rep_fec_nacimiento, $rep_lugar_nacimiento, $rep_nacionalidad, $rep_telefono, $rep_email, $rep_direccion, $rep_ciudad, $rep_maneja_recursos, $rep_poder_publico, $rep_reconocimiento_publico, $rep_participacion_mayoral5, $rep_vinculo_publico, $rep_tipo_vinculo, $ingresos, $egresos, $activos, $pasivos, $otros_ingresos, $con_otros_ingresos, $contribuyente, $autoretenedor, $declarante, $tarifa_ica, $origen_fondos, $nombre_gerente, $telefono_gerente, $email_gerente, $nombre_secretaria, $telefono_secretaria, $email_secretaria, $nombre_financiero, $telefono_financiero, $email_financiero, $nombre_contador, $telefono_contador, $email_contador, $nombre_tributario, $telefono_tributario, $email_tributario, $nombre_tesorero, $telefono_tesorero, $email_tesorero, $nombre_juridico, $telefono_juridico, $email_juridico, $nombre_autorizacion, $tipoid_autorizacion, $numid_autorizacion, $lugarid_autorizacion, $sociedad_autorizacion, $nit_autorizacion, $file_estados, $file_ccrep, $file_renta, $file_rut, $file_camara, $autorizo, $pdf_sarlaft['path']);
                echo json_encode($data);
            }
            else
                echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos en esta propuesta'));
        }
        else
            $this->load->view('vlogin');
    }
    
    
    private function reversarArchivos($rut, $camara, $estados, $cc, $renta)
    {
        if ($rut != null)
        {
            if ($rut['success'] && file_exists($rut['path']))
            {
                unlink($rut['path']);
            }
        }
        
        if ($camara != null)
        {
            if ($camara['success'] && file_exists($camara['path']))
            {
                unlink($camara['path']);
            }
        }
        
        if ($estados != null)
        {
            if ($estados['success'] && file_exists($estados['path']))
            {
                unlink($estados['path']);
            }
        }
        
        if ($cc != null)
        {
            if ($cc['success'] && file_exists($cc['path']))
            {
                unlink($cc['path']);
            }
        }
        
        if ($renta != null)
        {
            if ($renta['success'] && file_exists($renta['path']))
            {
                unlink($renta['path']);
            }
        }
    }
    
    
    function getArchivo()
    {
        if ($this->autenticacion->_isloggedin()) {
            if ($this->autenticacion->servicios(1003)) {
                $id_archivo = $this->input->post('id', true);

                $data = $this->MSarlaft->getUrl_archivo($this->session->userdata('usr_logged'), $id_archivo);

                if (!$data['success'] || ! file_exists($data['url']))
                    echo json_encode(array('success' => false, 'msj' => 'El archivo pdf no fue encontrado en el servidor.'));
                else
                {
                    echo json_encode(array('success' => true));
                }
            }
            else
                echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos'));
        }
        else
            $this->load->view('vlogin');
    }
    
    /*  Funcion para descargar el archivo que ya se verifico que existe (respuesta a un get)*/
    public function getArchivo_download($id_archivo)
    {
        if ($this->autenticacion->_isloggedin()) {
            if ($this->autenticacion->servicios(1003)) {
                $data = $this->MSarlaft->getUrl_archivo($this->session->userdata('usr_logged'), $id_archivo);

                if ($data['success'] && file_exists($data['url']))      // Por si acaso vuelvo a comprobar que si exista el archivo
                {
                    header('Content-Type: ' . $data['extension']);
                    header('Content-Disposition: attachment; filename="' . $data['descripcion'] . " " . $data['nombre_cliente'] . "." . PATHINFO($data['url'], PATHINFO_EXTENSION));
                    readfile($data['url']);
                }
            }
            else
                echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos'));
        }
        else
            $this->load->view('vlogin');    
    }
    
    
    public function getPDF()
    {
        if ($this->autenticacion->_isloggedin()) {
            if ($this->autenticacion->servicios(1003)) {
                $data = $this->MSarlaft->getUrl_pdf($this->session->userdata('usr_logged'));

                if (!$data['success'] || ! file_exists($data['url']))
                    echo json_encode(array('success' => false, 'msg' => 'El archivo pdf no fue encontrado en el servidor.'));
                else
                {
                    echo json_encode(array('success' => true));
                }
            }
            else
                echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos'));
        }
        else
            $this->load->view('vlogin');
    }
    
    
    public function getPDF_download()
    {
        if ($this->autenticacion->_isloggedin()) {
            if ($this->autenticacion->servicios(1003)) {
                $data = $this->MSarlaft->getUrl_pdf($this->session->userdata('usr_logged'));

                if ($data['success'] && file_exists($data['url']))      // Por si acaso vuelvo a comprobar que si exista el archivo
                {
                    header('Content-Type: ' . $data['extension']);
                    header('Content-Disposition: attachment; filename="Conocimiento de ' . $data['nombre_cliente'] . "." . PATHINFO($data['url'], PATHINFO_EXTENSION));
                    readfile($data['url']);
                }
            }
            else
                echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos'));
        }
        else
            $this->load->view('vlogin'); 
    }
    
    
    
    public function cargarPDF_firmado()
    {
        if ($this->autenticacion->_isloggedin()) {
            if ($this->autenticacion->servicios(1003)) {
                $info_cliente = $this->MSarlaft->getInfo_cliente($this->session->userdata('usr_logged'));

                if (!$info_cliente['success'])
                {
                    echo json_encode($info_cliente);
                    return;
                }
                
                if ($_FILES['form_firmado']['size'] > 0)
                {
                    $this->load->library('File_helpers');
                    $file = $this->file_helpers->upload_file(dirname(dirname(FCPATH)) . '/Sarlaft/', 'form_firmado', 'sarlaft ' . $info_cliente['nombre'], 'pdf');
                    if (! $file['success'])
                    {
                        if (file_exists($file['path']))
                            unlink($file['path']);
                        echo json_encode(array('success' => $file['success'], 'msg' => $file['msg']));
                        return;
                    }
                    
                    if (file_exists($file['path']))
                    {
                        $data = $this->MSarlaft->setPDF_firmado($this->session->userdata('usr_logged'), $file);
                        echo json_encode($data);
                    }
                    else
                    {
                        echo json_encode(array('success' => false, 'msg' => 'Se produjo un error al cargar el archivo. Por favor intentelo nuevamente.'));
                    }
                }
                else
                {
                    echo json_encode(array('success' => false, 'msg' => 'No se cargó ningún archivo'));
                }
            }
            else
                echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos'));
        }
        else
            $this->load->view('vlogin'); 
        
    }
    
    public function getPDF_firmado()
    {
        if ($this->autenticacion->_isloggedin()) {
            if ($this->autenticacion->servicios(1003)) {
                $data = $this->MSarlaft->getUrl_pdfFirmado($this->session->userdata('usr_logged'));

                if (!$data['success'] || ! file_exists($data['url']))
                    echo json_encode(array('success' => false, 'msg' => 'El archivo pdf no fue encontrado en el servidor.'));
                else
                {
                    echo json_encode(array('success' => true));
                }
            }
            else
                echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos'));
        }
        else
            $this->load->view('vlogin');
    }
    
    
    public function getPDFfirmado_download()
    {
        if ($this->autenticacion->_isloggedin()) {
            if ($this->autenticacion->servicios(1003)) {
                $data = $this->MSarlaft->getUrl_pdfFirmado($this->session->userdata('usr_logged'));

                if ($data['success'] && file_exists($data['url']))      // Por si acaso vuelvo a comprobar que si exista el archivo
                {
                    header('Content-Type: ' . $data['extension']);
                    header('Content-Disposition: attachment; filename="Conocimiento de ' . $data['nombre_cliente'] . " firmado." . PATHINFO($data['url'], PATHINFO_EXTENSION));
                    readfile($data['url']);
                }
            }
            else
                echo json_encode(array('success' => false, 'msg' => 'Usted no tiene permisos'));
        }
        else
            $this->load->view('vlogin'); 
    }
    
    
    /****************************************************************
     *      FUNCIONES ASOCIADAS A DATAGRID DE ACCIONISTAS           *
     ****************************************************************/
    
    
    public function getAccionistas()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $data = $this->MSarlaft->getAccionista($this->session->userdata('usr_logged'));
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
    
    
    public function guardarAccionista()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $new_row = $this->input->post('isNewRecord', true);
                    $tipo_id = $this->input->post('tipo_id', true);
                    $numero_id = $this->input->post('numero_id', true);
                    $nombre = $this->input->post('nombre', true);
                    $participacion = $this->input->post('participacion', true);
                    $recursos_publicos = $this->input->post('recursos_publicos_socio', true);
                    $poder_publico = $this->input->post('poder_publico_socio', true);
                    $reconocimiento_publico = $this->input->post('reconocimiento_publico_socio', true);
                    $declara_otropais = $this->input->post('declara_otropais_socio', true);
                    $pais_declaracion = $this->input->post('pais_declaracion', true);
                    $data = $this->MSarlaft->agrearAccionista($this->session->userdata('usr_logged'), $new_row, $tipo_id, $numero_id, $nombre, $participacion, $recursos_publicos, $poder_publico, $reconocimiento_publico, $declara_otropais, $pais_declaracion);
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
    
    
    public function editarAccionista()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $id_accionista = $this->input->post('id', true);
                    $tipo_id = $this->input->post('tipo_id', true);
                    $numero_id = $this->input->post('numero_id', true);
                    $nombre = $this->input->post('nombre', true);
                    $participacion = $this->input->post('participacion', true);
                    $recursos_publicos = $this->input->post('recursos_publicos_socio', true);
                    $poder_publico = $this->input->post('poder_publico_socio', true);
                    $reconocimiento_publico = $this->input->post('reconocimiento_publico_socio', true);
                    $declara_otropais = $this->input->post('declara_otropais_socio', true);
                    $pais_declaracion = $this->input->post('pais_declaracion', true);
                    
                    $data = $this->MSarlaft->editarAccionista($this->session->userdata('usr_logged'), $id_accionista, $tipo_id, $numero_id, $nombre, $participacion, $recursos_publicos, $poder_publico, $reconocimiento_publico, $declara_otropais, $pais_declaracion);
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
    
    
    
    public function eliminarAccionista()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $id_accionista = $this->input->post('id', true);
                    
                    $data = $this->MSarlaft->eliminarAccionista($this->session->userdata('usr_logged'), $id_accionista);
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
    
    
    /********************************************************************
     *      FUNCIONES ASOCIADAS A DATAGRID DE REFERNEICAS BANCARIAS     *
     ********************************************************************/
    
    
    public function getReferencias_bancarias()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $data = $this->MSarlaft->getReferencias_bancarias($this->session->userdata('usr_logged'));
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
    
    
    
    public function guardarReferencia_bancaria()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $new_row = $this->input->post('isNewRecord', true);
                    $banco = $this->input->post('banco', true);
                    $tipo_cuenta = $this->input->post('tipo_cuenta', true);
                    $numero_cuenta = $this->input->post('numero_cuenta', true);
                    $sucursal = $this->input->post('sucursal', true);
                    $telefono = $this->input->post('telefono', true);
                    
                    $data = $this->MSarlaft->guardarReferencia_bancaria($this->session->userdata('usr_logged'), $new_row, $banco, $tipo_cuenta, $numero_cuenta, $sucursal, $telefono);
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
    
    
    
    public function editarReferencia_bancaria()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $id_referencia = $this->input->post('id', true);
                    $banco = $this->input->post('banco', true);
                    $tipo_cuenta = $this->input->post('tipo_cuenta', true);
                    $numero_cuenta = $this->input->post('numero_cuenta', true);
                    $sucursal = $this->input->post('sucursal', true);
                    $telefono = $this->input->post('telefono', true);
                    
                    $data = $this->MSarlaft->editarReferencia_bancaria($this->session->userdata('usr_logged'), $id_referencia, $banco, $tipo_cuenta, $numero_cuenta, $sucursal, $telefono);
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
    
    
    
    public function eliminarReferencia_bancaria()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $id_referencia = $this->input->post('id', true);
                    
                    $data = $this->MSarlaft->eliminarReferencia_bancaria($this->session->userdata('usr_logged'), $id_referencia);
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
    
    
    /************************************************************
     *      FUNCIONES ASOCIADAS A REFERENCIAS COMERCIALES       *
     ************************************************************/
    
    public function getReferencias_comerciales()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $data = $this->MSarlaft->getReferencias_comerciales($this->session->userdata('usr_logged'));
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
    
    
    
    public function guardarReferencia_comercial()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $new_row = $this->input->post('isNewRecord', true);
                    $empresa = $this->input->post('empresa', true);
                    $direccion = $this->input->post('direccion', true);
                    $contacto = $this->input->post('contacto', true);
                    $email = $this->input->post('email', true);
                    $telefono = $this->input->post('telefono', true);
                    
                    $data = $this->MSarlaft->guardarReferencia_comercial($this->session->userdata('usr_logged'), $new_row, $empresa, $direccion, $contacto, $email, $telefono);
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
    
    
    
    public function editarReferencia_comercial()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $id_referencia = $this->input->post('id', true);
                    $empresa = $this->input->post('empresa', true);
                    $direccion = $this->input->post('direccion', true);
                    $contacto = $this->input->post('contacto', true);
                    $email = $this->input->post('email', true);
                    $telefono = $this->input->post('telefono', true);
                    
                    $data = $this->MSarlaft->editarReferencia_comercial($this->session->userdata('usr_logged'), $id_referencia, $empresa, $direccion, $contacto, $email, $telefono);
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
    
    
    
    public function eliminarReferencia_comercial()
    {
        if ($this->input->is_ajax_request())
        {
            if ($this->autenticacion->_isloggedin()) {
                if ($this->autenticacion->servicios(1003)) {
                    $id_referencia = $this->input->post('id', true);
                    
                    $data = $this->MSarlaft->eliminarReferencia_comercial($this->session->userdata('usr_logged'), $id_referencia);
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
    
    
    
    private function generarPDF()
    {
        if ($this->autenticacion->_isloggedin()) {
            
            if ($this->autenticacion->servicios(1003)) {
                $data = $this->MSarlaft->getInfo_pdf($this->session->userdata('usr_logged', true));

                if (! $data['success'])
                {
                    return $data;
                }

                $this->load->model('MFiltroscombos');
                $info_empresa = $this->MFiltroscombos->getInfo_empresa();
                $info_empresa['tipo'] = 1;

                if (file_exists($data['url_pdf'])){
                    unlink($data['url_pdf']);
                }
                
                $this->load->library('Pdf', $info_empresa);

                $this->pdf->setUpPDF('prueba');
                $this->pdf->AddPage();
                $html = $this->load->view('pformat_sarlaft', '', true);

                foreach ($data as $key => $value) {
                    $html = str_replace('%' . $key . '%', $value, $html);
                }

                $this->pdf->writeHTML($html, true, false, false, false, 'L');

                $path = dirname(dirname(FCPATH)) . '/Sarlaft/Sarlaft_' . $data['nombre'] . '.pdf';

                $this->pdf->Output($path, 'F');

                //return array('status' => 'success', 'path' => $path); 
                return array('success' => true, 'path' => $path);
            }
            else
                    echo 'Usted no tiene permisos en esta seccion';
        } 
        else
            $this->load->view('vlogin');
    }
    
    
    
    
}
?>