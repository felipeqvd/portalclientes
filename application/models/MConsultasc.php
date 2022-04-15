<?php

class MConsultasc extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }

    function getCatego_consul()
    {
        $data = array();
        $data1 = array();
        
        $this->db->distinct();
        $this->db->select('cod_subtem');
        $this->db->from('dat_mixxxx_temasx');
        
        $Q1 = $this->db->get();

         if ($Q1->num_rows() > 0){
            foreach ($Q1->result_array() as $row){
                $data1[] = $row['cod_subtem'];
            }
        }

        $Q1->free_result();     
        
        $this->db->distinct();
        $this->db->select('a.cod_temaxx as cod_catego, a.nom_temaxx as nom_catego');
        $this->db->from('dat_inform_temasx a');
        $this->db->where_not_in('a.cod_temaxx', $data1);

        $this->db->order_by('nom_temaxx', 'asc');

        $Q = $this->db->get();

        if ($Q->num_rows() > 0)
            $data = $Q->result_array();

        $Q->free_result();

        return $data;
    }    

    function insConsulta_client($cliente, $titulo, $categoria, $concepto, $tipo, $email)
    {
        if (empty($titulo) || $titulo == " ")
            return "El asunto de la consulta es inválido";

        if (empty($concepto) || $concepto == " ")
            return "El contenido de la consulta es inválido";
        
        $usuari = array();
        $this->db->select('cod_usuari');
        $this->db->from('dat_client_acceso');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();

        if ($Q->num_rows() > 0)
            $usuari = $Q->row_array();
        else
            return "Usuario inválido";
        
        $usuari = $usuari['cod_usuari'];    
        
        $Q->free_result();

        $this->db->trans_start();

        $params = $this->db->escape($cliente);
        $params .= ", " . $this->db->escape($categoria); 
        $params .= ", " . $this->db->escape($titulo); 
        $params .= ", " . $this->db->escape($concepto); 
        $params .= ", " . $this->db->escape($tipo);
        if ($email != null && $email != '')
            $params .= ", " . $this->db->escape($email);
        else
            $params .= ", NULL";
        $params .= ", @codigo"; 

        if (! $this->db->query("CALL insertarConsulta({$params})"))
        {
            $this->db->trans_complete();
            return $this->err_db($this->db->error());
        }

        $Q1 = $this->db->query('SELECT @codigo as codigo');
        $id_consul = $Q1->row();
        $Q1->free_result();
        $id_consul = $id_consul->codigo;

        //$now = new DateTime();

        //$this->db->set('fec_modifi', $now->format('Y-m-d H:i:s'));
        $this->db->set('fec_modifi', date("Y-m-d H:i:s"));
        $this->db->where('idx_consul', $id_consul);
        if (! $this->db->update('dat_inform_consul'))
        {
            $this->db->trans_complete();
            return $this->err_db($this->db->error());
        }

        $this->db->select('cod_solici');
        $this->db->from('dat_inform_consul');
        $this->db->where('idx_consul', $id_consul);

        $Q = $this->db->get();

        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return $this->err_db($this->db->error());
        }

        $cod_solici = $Q->row()->cod_solici;
        $Q->free_result();

        //$this->db->set('sol_fechax', $now->format('Y-m-d H:i:s'));
        //$this->db->set('fec_modifi', $now->format('Y-m-d H:i:s'));
        $this->db->set('sol_fechax', date("Y-m-d H:i:s"));
        $this->db->set('fec_modifi', date("Y-m-d H:i:s"));
        $this->db->where('cod_solici', $cod_solici);
        if (! $this->db->update('dat_inform_solici'))
        {
            $this->db->trans_complete();
            return $this->err_db($this->db->error());
        }

        if (! $this->db->insert('dat_inform_acttri', array('idx_consul' => $id_consul, 'cod_client' => $cliente, 'act_estado' => 2, 'act_aproba' => 2, 'cod_tipact' => 1, 'fec_asigna' => date('Y-m-d H:i:s'), 'fec_limite' => date('Y-m-d H:i:s'), 'act_pagosx' => 1, 'act_honora' => 0)))
        {
            $this->db->trans_complete();
            return $this->err_db($this->db->error());
        }
        
        $Q2 = $this->db->query('SELECT LAST_INSERT_ID() as id');

        $id_acttri = $Q2->row_array();       
        $id_acttri = $id_acttri['id'];
        
        if (! $this->db->insert('dat_usuari_acttri', array('cod_acttri' => $id_acttri, 'cod_usuari' => $usuari, 'usr_rolxxx' => 2, 'tar_estado' => 0, 'fec_asigna' => date('Y-m-d H:i:s'))))
        {
            $this->db->trans_complete();
            return $this->err_db($this->db->error());
        }

        $this->db->select('us.usr_emailx, us.nom_usuari, cl.nom_client, cn.cod_consul');
        $this->db->from('dat_inform_usuari us, dat_inform_consul cn, dat_inform_client cl');
        $this->db->where('cn.cod_client = cl.cod_client');
        $this->db->where('cl.cod_encarg = us.cod_usuari');
        $this->db->where('cn.idx_consul', $id_consul);

        $Q = $this->db->get();

        $this->db->trans_complete();

        if ($Q->num_rows() > 0)
        {
            $encargado = $Q->row();

            try
            {    
                $this->load->library('My_phpmailer');
                $mail = new PHPMailer(true);
                 $mail->SMTPAuth   = true;
                $mail->SMTPSecure = "ssl";
                $mail->CharSet    = "UTF-8";
                $mail->Encoding   = "quoted-printable";
                $mail->Host       = "cloud100.hostgator.com";
                $mail->Port       = 465;
                $mail->Username   = "desarrollo@exionreport.com";
                $mail->Password   = "w1w8)VnOxvHL";
                $mail->IsHTML(true);
                $mail->SetFrom("desarrollo@exionreport.com", "Exion desarrollo");
                $mail->Timeout    = 30;
                $mail->ClearAllRecipients();
                $mail->ClearAttachments();
                $mail->Subject    = "Nueva consulta - Sistema de consultas tributarias - Crowe Howarth";
                $mail->Body       = "El cliente " . $encargado->nom_client . " acaba de realizar una consulta a través del sistema de consultas tributarias<br /><br />"
                                    ."Dirijase al sistema de consultas tributarias para revisar la consulta con el código de identificación " . $encargado->cod_consul 
                                    ."<br /><br /><span style=\"font-style:italic;\">Crowe Howarth<br />"
                                    ."Por favor no responder a este mensaje. El correo se ha generado automáticamente por el sistema.<br /></span>";
                $mail->AltBody    = "El cliente " . $encargado->nom_client . " acaba de realizar una consulta a través del sistema de consultas tributarias<br /><br />"
                                    ."Dirijase al sistema de consultas tributarias para revisar la consulta con el código de identificación " . $encargado->cod_consul 
                                    ."<br /><br /><span style=\"font-style:italic;\">Crowe Howarth<br />"
                                    ."Por favor no responder a este mensaje. El correo se ha generado automáticamente por el sistema.<br /></span>";

                $mail->AddAddress($encargado->usr_emailx, $encargado->nom_usuari);
                $mail->Send();
                /*if(!$mail->Send())
                    echo $mail->ErrorInfo;
                else
                    $success = "S";
                    */
            }
            catch (Exception $e)
            {   
                //echo $e->getMessage();
            }
        }

        
        return array('status' => 'success', 'codiog'=> 0, 'msj' => 'Consulta generada satisfactoriamente');
    }

    function editarConsulta($cliente, $id, $concepto)
    {
        $this->db->select('a.cod_solici, b.sol_titulo, b.sol_textox, a.con_estado');
        $this->db->from('dat_inform_consul a, dat_inform_solici b');
        $this->db->where('a.cod_solici = b.cod_solici');
        $this->db->where('idx_consul', $id);
        $this->db->where('cod_client', $cliente);

        $Q = $this->db->get();

        if ($Q->num_rows() == 0)
        {
            return array('status' => 'error', 'msj' => 'La consulta no fue encontrada en el sistema');
        }

        $solici = $Q->row();
        $Q->free_result();

        if ($solici->con_estado != '2')
            return array('status' => 'error', 'msj' => 'La consulta ya fue cerrada, no se puede seguir editando.');

        if ($concepto != null && $concepto != '' && $concepto != ' ')
            $this->db->set('sol_textox', $solici->sol_textox . "<br />" . $concepto);
        $this->db->where('cod_solici', $solici->cod_solici);
        if (! $this->db->update('dat_inform_solici'))
        {
            return $this->err_db($this->db->error());
        }

        $count = $this->db->affected_rows();

        if ($count == 0)
        {
            return array('status' => 'error', 'msj' => 'No fue posible editar la solicitud');
        }
        else
        {
            return array('status' => 'success', 'msj' => 'La solicitud fue editada de forma satisfactoria');
        }

    }

    function getIds_consultasSolicitadas ($cliente, $fec_desde, $fec_hasta, $id, $categoria, $estado)
    {
        $data = array();

        $this->db->distinct();
        $this->db->select('cn.idx_consul as cod_solici, SUBSTR(cn.cod_consul, 3) as idx_solici');
        $this->db->from('dat_inform_solici s, dat_inform_consul cn');
        $this->db->where('s.cod_solici = cn.cod_solici');
        $this->db->where('cn.cod_client', $cliente);
        $this->db->where('cn.con_estado <>', '0');

        if ($id != null && $id != '')
            $this->db->where('cn.idx_consul', $id);

        if ($categoria != null && $categoria != '')
            $this->db->where('s.cod_catego', $categoria);

        if ($estado != null && $estado != '')
            $this->db->where('cn.con_estado', $estado);

        if ($fec_desde != null || $fec_hasta != null)
        {
            if ($fec_desde != null && $fec_desde != '') 
            {
                try{
                    $fechaInicio = new DateTime($fec_desde);
                }
                catch(Exception $e)
                {
                    $fechaInicio = new DateTime('0000-00-00');
                }
            }
            else
                $fechaInicio = '0000-00-00'; 

            if ($fec_hasta != null && $fec_hasta != '')
            {
                try{
                    $fechaFinal = new DateTime($fec_hasta);
                }
                catch(Exception $e)
                {
                    $fechaFinal = new DateTime();
                }
            }
            else
                $fechaFinal = new DateTime();

            $fechaFinal->modify('+1 day');

            $this->db->where('sol_fechax >=', $fechaInicio->format('Y-m-d') . ' 00:00:00');
            $this->db->where('sol_fechax <', $fechaFinal->format('Y-m-d') . ' 00:00:00');
        }

        $this->db->order_by('cod_consul', 'desc');

        $Q = $this->db->get();

        if ($Q->num_rows() > 0)
            $data = $Q->result_array();

        $Q->free_result();

        return $data;

    }

    function getCatego_consultasSolicitadas ($cliente, $fec_desde, $fec_hasta, $id, $categoria, $estado)
    {
        $data = array();

        $this->db->distinct();
        $this->db->select('t.cod_temaxx as cod_catego, t.nom_temaxx as nom_catego');
        $this->db->from('dat_inform_temasx t, dat_inform_solici s, dat_inform_consul cn');
        $this->db->where('s.cod_solici = cn.cod_solici');
        $this->db->where('s.cod_catego = t.cod_temaxx');
        $this->db->where('cn.cod_client', $cliente);
        $this->db->where('cn.con_estado <>', '0');

        if ($id != null && $id != '')
            $this->db->where('cn.idx_consul', $id);

        if ($categoria != null && $categoria != '')
            $this->db->where('s.cod_catego', $categoria);

        if ($estado != null && $estado != '')
            $this->db->where('cn.con_estado', $estado);

        if ($fec_desde != null || $fec_hasta != null)
        {
            if ($fec_desde != null && $fec_desde != '') 
            {
                try{
                    $fechaInicio = new DateTime($fec_desde);
                }
                catch(Exception $e)
                {
                    $fechaInicio = new DateTime('0000-00-00');
                }
            }
            else
                $fechaInicio = '0000-00-00'; 

            if ($fec_hasta != null && $fec_hasta != '')
            {
                try{
                    $fechaFinal = new DateTime($fec_hasta);
                }
                catch(Exception $e)
                {
                    $fechaFinal = new DateTime();
                }
            }
            else
                $fechaFinal = new DateTime();

            $fechaFinal->modify('+1 day');

            $this->db->where('s.sol_fechax >=', $fechaInicio->format('Y-m-d') . ' 00:00:00');
            $this->db->where('s.sol_fechax <', $fechaFinal->format('Y-m-d') . ' 00:00:00');
        }

        $this->db->order_by('t.nom_temaxx', 'asc');

        $Q = $this->db->get();

        if ($Q->num_rows() > 0)
            $data = $Q->result_array();

        $Q->free_result();

        return $data;
    }

    function getConsultas_solicitadas ($cliente, $fec_desde, $fec_hasta, $offset = null, $rows = null, $filterRules = null)
    {
        $data = array();

        $this->db->select('SQL_CALC_FOUND_ROWS null as num_rows, cn.idx_consul as id_consul, SUBSTR(cn.cod_consul, 3) as id, s.sol_titulo as titulo, t.nom_temaxx as catego, s.sol_fechax as fechax, cn.con_estado as estado, s.sol_emailx as email, cn.pdf_estado as archivo', false);
        $this->db->from('dat_inform_solici s, dat_inform_temasx t, dat_inform_consul cn');
        $this->db->where('s.cod_catego = t.cod_temaxx');
        $this->db->where('s.cod_solici = cn.cod_solici');
        $this->db->where('cn.cod_client', $cliente);
        $this->db->where('cn.con_estado <>', '0');

        if ($fec_desde != null || $fec_hasta != null)
        {
            if ($fec_desde != null && $fec_desde != '') 
            {
                try{
                    $fechaInicio = new DateTime($fec_desde);
                }
                catch(Exception $e)
                {
                    $fechaInicio = new DateTime('0000-00-00');
                }
            }
            else
                $fechaInicio = '0000-00-00'; 

            if ($fec_hasta != null && $fec_hasta != '')
            {
                try{
                    $fechaFinal = new DateTime($fec_hasta);
                }
                catch(Exception $e)
                {
                    $fechaFinal = new DateTime();
                }
            }
            else
                $fechaFinal = new DateTime();

            $fechaFinal->modify('+1 day');

            $this->db->where('s.sol_fechax >=', $fechaInicio->format('Y-m-d') . ' 00:00:00');
            $this->db->where('s.sol_fechax <', $fechaFinal->format('Y-m-d') . ' 00:00:00');
        }

        $alias = array('id' => 'cn.idx_consul', 'catego' => 's.cod_catego', 'estado' => 'cn.con_estado');
        if ($filterRules !== null)
        {
            $filterRulesJS = json_decode($filterRules);
            foreach($filterRulesJS as $rule) {
                $rule = get_object_vars($rule);
                if ($rule['op'] == 'equal' && $rule['value'] != '') {
                    $this->db->where( $alias[ $rule['field'] ], $rule['value']);
                }
            }
        }
        
        if ($offset !== null && $rows !== null)
            $this->db->limit($rows, $offset);
        $this->db->order_by('s.sol_fechax', 'desc');
        $Q = $this->db->get();
        if ($Q->num_rows() > 0)
            $data['rows'] = $Q->result_array();
        else
            $data['rows'] = array();

        $data['total'] = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count;

        $Q->free_result();

        return $data;
    }

    function getDetalles_consulta($cliente, $id)
    {
        $data= "No encontrado";
        $this->db->select('s.sol_textox');
        $this->db->from('dat_inform_solici s, dat_inform_consul cn');
        $this->db->where('s.cod_solici = cn.cod_solici');
        $this->db->where('cn.cod_client', $cliente); 
        $this->db->where('cn.idx_consul', $id);
        $this->db->where('cn.con_estado <>', '0');

        $Q = $this->db->get();

        if ($Q->num_rows() > 0)
        {
            $data = $Q->row_array();
            $data = array('status' => 'success', 'concepto' => $data['sol_textox']);
        }
        else
            $data = array('status' => 'error', 'msj' => "La consulta no fue encontrada");

        $Q->free_result();

        return $data;
    }

    function getUrl_archivoCliente($cliente, $id)
    {
        $data = null;

        $this->db->select('url_pdfxxx as url, cod_consul as codigo');
        $this->db->from('dat_inform_consul');
        $this->db->where('idx_consul', $id);
        $this->db->where('cod_client', $cliente);

        $Q = $this->db->get();

        if ($Q->num_rows() > 0)
        {
            $data = $Q->row_array();
        }

        return $data;
    }

    function err_db($error)
    {
        $result = array();
        if(strpos($error['message'], "'") !== false)
            $msg_elements = explode("'", $error['message']);
        else
            $msg_elements = explode("`", $error['message']);

        $result['status'] = 'error';
        switch($error['code'])
        {
            case 1062:
                // Valor duplicado - Message: Duplicate entry '%s' for key %d
                $result['codigo'] = 101;
                $valor_error = isset($msg_elements[1]) ? $msg_elements[1] : "-";
                $result['msj'] = 'Error 101: El valor ' . $valor_error . ' ya existe en el sistema y no es posible insertar el duplicado.'; 
                break;

            case 1452:
                // Llave foranea invalida - Message: Cannot add or update a child row: a foreign key constraint fails (%s) 
                $result['codigo'] = 102;
                $campo_error = isset($msg_elements[7]) ? $msg_elements[7] : "-";
                $result['msj'] = 'Error 102: ' . $this->traducirCampo($campo_error) . ' es inválido';
                break;

            case 1264:
                // Valor fuera del rango - Message: Out of range value for column '%s' at row %ld 
                $result['codigo'] = 103;
                $campo_error = isset($msg_elements[1]) ? $msg_elements[1] : "-";
                $result['msj'] = 'Error 103: ' . $this->traducirCampo($campo_error) . ' está por fuera del rango válido de valores';
                break;

            case 1366:
                // Valor invalido (p. ej letra en valor numerico) - Message: Incorrect %s value: '%s' for column '%s' at row %ld 
                $result['codigo'] = 104;
                $campo_error = isset($msg_elements[3]) ? $msg_elements[3] : "-";      // Columna
                $valor_error = isset($msg_elements[1]) ? $msg_elements[1] : "-";
                $result['msj'] = 'Error 104: ' . $this->traducirCampo($campo_error) . ' es inválido';
                break;

            case 1265:
                // Entero invalido - Message: Data truncated for column '%s' at row %ld
                $result['codigo'] = 105;
                $campo_error = isset($msg_elements[1]) ? $msg_elements[1] : "-";
                $result['msj'] = 'Error 105: ' . $this->traducirCampo($campo_error) . ' es inválido';
                break;

            case 1048:
                // no puedes ser nulo - Message: Column '%s' cannot be null
                $result['codigo'] = 106;
                $campo_error = isset($msg_elements[1]) ? $msg_elements[1] : "-";
                $result['msj'] = 'Error 106: ' . $this->traducirCampo($campo_error) . ' está vacío o generó un valor nulo';
                break;

            default:
                $result['codigo'] = 100;
                $result['msj'] = 'Error 100: No fue posible actualizar la base de datos - ' . $this->traducirCampo($campo_error) . ' es inválido';
        }

        return $result;
    }

    function traducirCampo ($codigo)
    {
        $elemento = 'El (campo no encontrado)';
        switch($codigo)
        {
            case 'cod_solici':
                $elemento = 'El código de la solicitud de consulta';
                break;

            case 'cod_client':
                $elemento = 'El identificador del cliente';
                break;

            case 'sol_titulo':
                $elemento = 'El titulo de la solicitud de consulta';
                break;

            case 'cod_catego':
                $elemento = 'La categoria de la consulta';
                break;

            case 'sol_textox':
                $elemento = 'El concepto de la consulta';
                break;

            case 'sol_fechax':
                $elemento = 'La fecha de la solicitud';
                break;

            case 'cod_subtem':
                $elemento = 'El sub tema de la consulta';
                break;

            case 'cod_temaxx':
                $elemento = 'El c´dogio del tema';
                break;

            case 'nom_temaxx':
                $elemento = 'El c´dogio del tema';
                break;

            case 'cod_usuari':
                $elemento = 'El usuario ';
                break;

            case 'cod_consul':
                $elemento = "El codigo de la consulta";
                break;

            case 'con_estado':
                $elemento = "El estado de la consulta";
                break;

            case 'pdf_estado':
                $elemento = "La ruta del archivo";
                break;

            case 'idx_consul':
                $elemento = "El identificador de la consulta";
                break;

            case 'act_estado':
                $elemento = "El estado de la actividad";
                break;

            case 'act_aproba':
                $elemento = "El aprobador de la actividad";
                break;

            case 'cod_tipact':
                $elemento = "El tipo de la actividad";
                break;

            case 'fec_asigna':
                $elemento = "La fecha de asignación de la actividad";
                break;

            case 'fec_limite':
                $elemento = "La fecha límite de la actividad";
                break;

            case 'act_pagosx':
                $elemento = "Los pagos de la actividad";
                break;

            case 'act_honora':
                $elemento = "Los honorarios de la actividad";
                break;

            case 'cod_acttri':
                $elemento = "El código de la actividad tributaria";
                break;

            case 'usr_rolxxx':
                $elemento = "El rol del usuario";
                break;

            case 'tar_estado':
                $elemento = "El estado de la actividad";
                break;
        }

        return $elemento;
    }
}

?>