<?php

class MSarlaft extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    
    function getInfo($id)
    {
        $data = array();
        
        $this->db->select('IFNULL(a.cod_ciudad, "") as ciudad_general, 
                            IFNULL(a.cod_paisxx, "") as pais_general, 
                            IFNULL(b.nom_depart, "") as departamento_general, 
                            IFNULL(a.cli_tipper, "") as tipo_persona, 
                            IFNULL(a.nom_client, "") as nombre, 
                            IFNULL(a.cod_tipcli, "") as tip_empresa, 
                            IFNULL(a.cli_tipoid, "") as tip_id, 
                            IFNULL(a.nit_client, "") as nit, 
                            IFNULL(a.dir_client, "") as direccion, 
                            IFNULL(a.tel_client, "") as telefono, 
                            IFNULL(a.fax_client, "") as fax, 
                            IFNULL(a.cli_emailx, "") as cli_email, 
                            IFNULL(a.cod_actpri, "") as actividad, 
                            IFNULL(a.cod_indust, "") as industria, 
                            IFNULL(a.cli_cotiza, "") as cotiza_bolsa, 
                            IFNULL(a.cod_servic, "") as tipo_servicio,
                            IFNULL(a.per_contac, "") as persona_contacto,
                            IFNULL(a.are_contac, "") as area_contacto,
                            IFNULL(a.ema_contac, "") as email_contacto,
                            IFNULL(a.tel_contac, "") as tel_contacto,
                            IFNULL(c.pri_apelli, "") as representante_apellido, 
                            IFNULL(c.seg_apelli, "") as representante_segapellido, 
                            IFNULL(c.rep_nombre, "") as representante_nombre, 
                            IFNULL(c.cod_tipoid, "") as tip_documento, 
                            IFNULL(c.num_idxxxx, "") as numero_documento, 
                            IFNULL(c.fec_expedi, "") as fecha_documento, 
                            IFNULL(c.ciu_expedi, "") as lugar_documento, 
                            IFNULL(c.fec_nacimi, "") as fecnacimiento_rep, 
                            IFNULL(c.lug_nacimi, "") as nacimiento_rep, 
                            IFNULL(c.rep_nacion, "") as nacionalidad_rep, 
                            IFNULL(c.rep_telefo, "") as tel_rep, 
                            IFNULL(c.rep_emailx, "") as email_rep, 
                            IFNULL(c.rep_direcc, "") as direccion_rep, 
                            IFNULL(c.rep_ciudad, "") as ciudad_rep, 
                            IFNULL(d.nom_depart, "") as departamento_rep, 
                            IFNULL(c.rec_public, "") as recursos_publicos, 
                            IFNULL(c.pod_public, "") as poder_publico, 
                            IFNULL(c.ren_public, "") as reconocimiento_publico, 
                            IFNULL(c.par_supal5, "") as posee_5, 
                            IFNULL(c.vin_public, "") as vinculo_publico,
                            IFNULL(c.tip_vincul, "") as tipo_vinculo,
                            IFNULL(a.mes_ingres, "") as ingresos, 
                            IFNULL(a.mes_egreso, "") as egresos, 
                            IFNULL(a.cli_activs, "") as activos, 
                            IFNULL(a.cli_pasivs, "") as pasivos, 
                            IFNULL(a.otr_ingres, "") as otros_ingresos, 
                            IFNULL(a.con_ingres, "") as concepto_otros_ingresos, 
                            IFNULL(a.gra_contri, "") as contribuyente, 
                            IFNULL(a.aut_retene, "") as autoretenedor, 
                            IFNULL(a.dec_rentax, "") as declarante, 
                            IFNULL(a.ica_tarifa, "") as tarifa_ica, 
                            IFNULL(a.ori_fondos, "") as origen_fondos, 
                            IF(pdf_sarlaf IS NULL, 0, 1) as pdf, 
                            IF(a.sar_firmad IS NULL, 0, 1) as pdf_firmado,
                            IFNULL(a.aut_nombre, "") as nombre_autorizacion, 
                            IFNULL(a.aut_tipdoc, "") as tipoid_autorizacion, 
                            IFNULL(a.aut_numidx, "") as numid_autorizacion, 
                            IFNULL(a.aut_lugaid, "") as lugarid_autorizacion, 
                            IFNULL(a.aut_socied, "") as sociedad_autorizacion, 
                            IFNULL(a.aut_numnit, "") as nit_autorizacion,
                            IFNULL(a.act_sarlaf, "") as formulario_activo,
                            IF(a.uso_autori = 1, "on", "off") as autorizo');
        $this->db->from('dat_inform_client a');
        $this->db->join('dat_inform_ciudad b', 'a.cod_ciudad = b.cod_ciudad', 'left');
        $this->db->join('dat_client_repres c', 'a.cod_client = c.cod_client', 'left');
        $this->db->join('dat_inform_ciudad d', 'c.rep_ciudad = d.cod_ciudad', 'left');
        $this->db->where('a.cod_client', $id);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() > 0)
        {
            $data = $Q->row_array() + array('success' => true);
        
            $this->db->select('nom_funcli as nombre, fun_emailx as email, cod_carcli as cargo, fun_telefo as telefono');
            $this->db->from('dat_inform_funcli');
            $this->db->where('cod_client', $id);
            $this->db->where('reg_anulad', 0);
            $Q2 = $this->db->get();
            
            if ($Q2->num_rows() > 0)
            {
                $funcionarios = $Q2->result_array();
                
                foreach ($funcionarios as $funcionario)
                {
                    switch($funcionario['cargo'])
                    {
                        case '2':
                            $datos_funcionario = array('nombre_gerente' => $funcionario['nombre'], 'telefono_gerente' => $funcionario['telefono'], 'email_gerente' => $funcionario['email']);
                            break;
                            
                        case '3':
                            $datos_funcionario = array('nombre_gerente' => $funcionario['nombre'], 'telefono_gerente' => $funcionario['telefono'], 'email_gerente' => $funcionario['email']);
                            break;
                        
                        case '8':
                            $datos_funcionario = array('nombre_secretaria' => $funcionario['nombre'], 'telefono_secretaria' => $funcionario['telefono'], 'email_secretaria' => $funcionario['email']);
                            break;
                        
                        case '4':
                            $datos_funcionario = array('nombre_financiero' => $funcionario['nombre'], 'telefono_financiero' => $funcionario['telefono'], 'email_financiero' => $funcionario['email']);
                            break;
                        
                        case '5':
                            $datos_funcionario = array('nombre_contador' => $funcionario['nombre'], 'telefono_contador' => $funcionario['telefono'], 'email_contador' => $funcionario['email']);
                            break;
                        
                        case '6':
                            $datos_funcionario = array('nombre_tributario' => $funcionario['nombre'], 'telefono_tributario' => $funcionario['telefono'], 'email_tributario' => $funcionario['email']);
                            break;
                        
                        case '7':
                            $datos_funcionario = array('nombre_tesorero' => $funcionario['nombre'], 'telefono_tesorero' => $funcionario['telefono'], 'email_tesorero' => $funcionario['email']);
                            break;
                        
                        case '10':
                            $datos_funcionario = array('nombre_juridico' => $funcionario['nombre'], 'telefono_juridico' => $funcionario['telefono'], 'email_juridico' => $funcionario['email']);
                            break;
                        default:                            
                    }
                    if (isset($datos_funcionario)){
                        $data = $data + $datos_funcionario;
                    }                    
                }
            }
            
            $Q2->free_result();
            
            $data['id_rut'] = null;
            $data['id_camara'] = null;
            $data['id_estados'] = null;
            $data['id_ccrepresentante'] = null;
            $data['id_renta'] = null;
            
            $this->db->select('cod_clidoc as id_archivo');
            $this->db->from('dat_client_docume');
            $this->db->where('cod_client', $id);
            
            $Q3 = $this->db->get();
            
            if ($Q3->num_rows() > 0)
            {
                $documentos = $Q3->result_array();
                
                foreach ($documentos as $documento)
                {
                    switch($documento['id_archivo'])
                    {
                        case '1':
                            $data['id_rut'] = $documento['id_archivo'];
                            break;
                        
                        case '2':
                            $data['id_camara'] = $documento['id_archivo'];
                            break;
                        
                        case '1000':
                            $data['id_estados'] = $documento['id_archivo'];
                            break;
                        
                        case '1001':
                            $data['id_ccrepresentante'] = $documento['id_archivo'];
                            break;
                        
                        case '1003':
                            $data['id_renta'] = $documento['id_archivo'];
                            break;
                    }
                }
            }
            
            $Q3->free_result();
        }
        else
            $data = array('success' => false, 'msg' => 'Su información no fue encontrada en el sistema');
        
        $Q->free_result();
        
        return $data;
    }
    
    
    function getInfo_pdf($id)
    {
        $data = array();
        
        $fecha = new DateTime();
        $this->db->select('b.nom_ciudad as ciudad, 
                            q.nom_paisxx as pais, 
                            b.nom_depart as departamento,
                            IF(a.cod_servic IS NULL, "X", "") as vinculacion,
                            IF(a.cod_servic IS NOT NULL, "X", "") as renovacion,
                            IF(a.cli_tipper = 1, "X", "") as presona_natural,
                            IF(a.cli_tipper = 2, "X", "") as persona_juridica,
                            a.nom_client as nombre,
                            e.nom_tipoid as tipo_id,
                            a.nit_client as numero_id,
                            f.nom_tipcli as tipo_empresa,
                            a.dir_client as direccion,
                            a.tel_client as telefono,
                            a.fax_client as fax,
                            a.cli_emailx as email,
                            g.nom_actpri as actividad_principal,
                            g.cod_ciiuxx as ciiu,
                            h.nom_indust as industria,
                            a.per_contac as persona_contacto,
                            a.are_contac as area,
                            a.ema_contac as email_contacto,
                            a.tel_contac as tel_con,
                            IF (a.cli_cotiza = 1, "X", "") as si_cotiza,
                            IF (a.cli_cotiza = 0, "X", "") as no_cotiza,
                            i.nom_divisi as servicio,
                            c.pri_apelli as apellido1_rep,
                            c.seg_apelli as apellido2_rep,
                            c.rep_nombre as nombres_rep,
                            j.nom_tipoid as tipo_id_rep,
                            c.num_idxxxx as num_id_rep,
                            c.fec_expedi as expedicion_id_rep,
                            k.nom_ciudad as lugar_expedicion,
                            c.fec_nacimi as fecha_nac_rep,
                            l.nom_ciudad as lug_nac_rep,
                            m.nom_fnacio as nacion_rep,
                            c.rep_telefo as tel_rep,
                            c.rep_emailx as email_rep,
                            c.rep_direcc as direccion_rep,
                            n.nom_ciudad as ciudad_rep,
                            n.nom_depart as deparamento_rep,
                            IF(c.rec_public = 1, "X", "") as si_recpub,
                            IF(c.rec_public = 0, "X", "") as no_recpub,
                            IF(c.pod_public = 1, "X", "") as si_podpub,
                            IF(c.pod_public = 0, "X", "") as no_podpub,
                            IF(c.ren_public = 1, "X", "") as si_renpub,
                            IF(c.ren_public = 0, "X", "") as no_renpub,
                            IF(c.par_supal5 = 1, "X", "") as si_parsup5,
                            IF(c.par_supal5 = 0, "X", "") as no_parsup5,
                            IF(c.vin_public = 1, "X", "") as si_vinpub,
                            IF(c.vin_public = 0, "X", "") as no_vinpub,
                            IF(c.vin_public = 1, c.tip_vincul, "") as tipo_vinculo,
                            a.mes_ingres as ingresos,
                            a.mes_egreso as egresos,
                            a.cli_activs as activos,
                            a.cli_pasivs as pasivos,
                            a.otr_ingres as otros_ingresos,
                            IF(a.otr_ingres > 0, a.con_ingres, "") as concepto_ingresos,
                            IF(a.gra_contri = 1, "Gran contribuyente", "No es gran contribuyente") as tipo_contribuyente,
                            IF(a.aut_retene = 1, "X", "") as si_autoretenedor,
                            IF(a.aut_retene = 0, "X", "") as no_autoretenedor,
                            IF(a.dec_rentax = 1, "X", "") as si_declarante,
                            IF(a.dec_rentax = 0, "X", "") as no_declarante,
                            a.ica_tarifa as ica,
                            a.ori_fondos as origen_fondos,
                            a.aut_nombre as nombre_autorizacion,
                            o.sig_tipdoc as tipo_id_autorizacion,
                            a.aut_numidx as numero_id_autorizacion,
                            p.nom_ciudad as lugar_id_autorizacion,
                            a.aut_socied as sociedad_autorizacion,
                            a.aut_numnit as nit_autorizacion,
                            a.pdf_sarlaf as url_pdf
                            ', false);
        $this->db->from('dat_inform_client a');
        $this->db->join('dat_inform_ciudad b', 'a.cod_ciudad = b.cod_ciudad');
        $this->db->join('dat_inform_tipoid e', 'a.cli_tipoid = e.cod_tipoid');
        $this->db->join('dat_inform_tipcli f', 'a.cod_tipcli = f.cod_tipcli');
        $this->db->join('dat_inform_paises q', 'a.cod_paisxx = q.cod_paisxx');
        $this->db->join('dat_client_repres c', 'a.cod_client = c.cod_client', 'left');
        $this->db->join('dat_inform_ciudad d', 'c.rep_ciudad = d.cod_ciudad', 'left');
        $this->db->join('dat_inform_actpri g', 'a.cod_actpri = g.cod_actpri', 'left');
        $this->db->join('dat_inform_indust h', 'a.cod_indust = h.cod_indust', 'left');
        $this->db->join('dat_inform_divisi i', 'a.cod_servic = i.cod_divisi', 'left');
        $this->db->join('dat_inform_tipoid j', 'c.cod_tipoid = j.cod_tipoid', 'left');
        $this->db->join('dat_inform_ciudad k', 'c.ciu_expedi = k.cod_ciudad', 'left');
        $this->db->join('dat_inform_ciudad l', 'c.lug_nacimi = l.cod_ciudad', 'left');
        $this->db->join('dat_inform_paises m', 'c.rep_nacion = m.cod_paisxx', 'left');
        $this->db->join('dat_inform_ciudad n', 'c.rep_ciudad = n.cod_ciudad', 'left');
        $this->db->join('dat_inform_tipdoc o', 'a.aut_tipdoc = o.cod_tipdoc', 'left');
        $this->db->join('dat_inform_ciudad p', 'a.aut_lugaid = p.cod_ciudad', 'left');
        
        $this->db->where('a.cod_client', $id);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() > 0)
        {
            $data = $Q->row_array() + array('success' => true);
            
            $this->db->select('nom_funcli as nombre, fun_emailx as email, cod_carcli as cargo, fun_telefo as telefono');
            $this->db->from('dat_inform_funcli');
            $this->db->where('cod_client', $id);
            $this->db->where('reg_anulad', 0);
            $Q2 = $this->db->get();
            
            $data['nombre_gerente'] = '';
            $data['telefono_gerente'] = '';
            $data['email_gerente'] = '';
            $data['nombre_secretaria'] = '';
            $data['telefono_secretaria'] = '';
            $data['email_secretaria'] = '';
            $data['nombre_financiero'] = '';
            $data['telefono_financiero'] = '';
            $data['email_financiero'] = '';
            $data['nombre_contador'] = '';
            $data['telefono_contador'] = '';
            $data['email_contador'] = '';
            $data['nombre_tributario'] = '';
            $data['telefono_tributario'] = '';
            $data['email_tributario'] = '';
            $data['nombre_tesorero'] = '';
            $data['telefono_tesorero'] = '';
            $data['email_tesorero'] = '';
            $data['nombre_juridico'] = '';
            $data['telefono_juridico'] = '';
            $data['email_juridico'] = '';
            
            if ($Q2->num_rows() > 0)
            {
                $funcionarios = $Q2->result_array();
                
                foreach ($funcionarios as $funcionario)
                {
                    switch($funcionario['cargo'])
                    {
                        case '3':
                            $data['nombre_gerente'] = $funcionario['nombre'];
                            $data['telefono_gerente'] = $funcionario['telefono'];
                            $data['email_gerente'] = $funcionario['email'];
                            break;
                        
                        case '8':
                            $data['nombre_secretaria'] = $funcionario['nombre'];
                            $data['telefono_secretaria'] = $funcionario['telefono'];
                            $data['email_secretaria'] = $funcionario['email'];
                            break;
                        
                        case '4':
                            $data['nombre_financiero'] = $funcionario['nombre'];
                            $data['telefono_financiero'] = $funcionario['telefono'];
                            $data['email_financiero'] = $funcionario['email'];
                            break;
                        
                        case '5':
                            $data['nombre_contador'] = $funcionario['nombre'];
                            $data['telefono_contador'] = $funcionario['telefono'];
                            $data['email_contador'] = $funcionario['email'];
                            break;
                        
                        case '6':
                            $data['nombre_tributario'] = $funcionario['nombre'];
                            $data['telefono_tributario'] = $funcionario['telefono'];
                            $data['email_tributario'] = $funcionario['email'];
                            break;
                        
                        case '7':
                            $data['nombre_tesorero'] = $funcionario['nombre'];
                            $data['telefono_tesorero'] = $funcionario['telefono'];
                            $data['email_tesorero'] = $funcionario['email'];
                            break;
                        
                        case '10':
                            $data['nombre_juridico'] = $funcionario['nombre'];
                            $data['telefono_juridico'] = $funcionario['telefono'];
                            $data['email_juridico'] = $funcionario['email'];
                            break;
                    }
                }
            }
            
            $Q2->free_result();
            
            /*  Accionistas  */
            $this->db->select(' b.nom_tipoid as tipo_id, idx_accion as numero_id, nom_accion as nombre, prc_partic as participacion, IF(a.rec_public = 1, "Si", "No") as recursos_publicos_socio, IF(a.pod_public = 1, "Si", "No") as poder_publico_socio, IF(a.ren_public = 1, "Si", "No") as reconocimiento_publico_socio, IF(a.dec_otrpai = 1, IFNULL(c.nom_paisxx, "Si"), "No") as declara_otropais_socio');
            $this->db->from('dat_client_accion a');
            $this->db->join('dat_inform_tipoid b', 'a.cod_tipoid = b.cod_tipoid');
            $this->db->join('dat_inform_paises c', 'a.pai_declar = c.cod_paisxx', 'left');
            $this->db->where('cod_client', $id);
            $this->db->order_by('nombre');

            $Q = $this->db->get();
            
            $data['accionistas'] = '';

            if ($Q->num_rows() > 0)
            {
               $accionistas = $Q->result_array();
               
               foreach ($accionistas as $accionista)
               {
                   $data['accionistas'] .= '<tr>
                                                <th align="center" width="10%" class="valor-tabla">' . $accionista['tipo_id'] . '</th>
                                                <th align="center" width="10%" class="valor-tabla">' . $accionista['numero_id'] . '</th>
                                                <th align="center" width="20%" class="valor-tabla">' . $accionista['nombre'] . '</th>
                                                <th align="center" width="10%" class="valor-tabla">' . $accionista['participacion'] . '</th>
                                                <th align="center" width="12%" class="valor-tabla">' . $accionista['recursos_publicos_socio'] . '</th>
                                                <th align="center" width="12%" class="valor-tabla">' . $accionista['poder_publico_socio'] . '</th>
                                                <th align="center" width="13%" class="valor-tabla">' . $accionista['reconocimiento_publico_socio'] . '</th>
                                                <th align="center" width="13%" class="valor-tabla">' . $accionista['declara_otropais_socio'] . '</th>
                                            </tr>';
               }
            }
            
            $Q->free_result();
            
            /*  Referencias comerciales  */
            $this->db->select('ref_empres as empresa, ref_direcc as direccion, ref_contac as contacto, ref_emailx as email, ref_telefo as telefono');
            $this->db->from('dat_client_refcom a');
            $this->db->where('a.cod_client', $id);

            $Q = $this->db->get();
            
            $data['referencias_comerciales'] = '';

            if ($Q->num_rows() > 0)
            {
                $comerciales = $Q->result_array();
                
                foreach($comerciales as $comercial)
                {
                    $data['referencias_comerciales'] .= '<tr>
                                                            <th align="center" width="20%" class="valor-tabla">' . $comercial['empresa'] . '</th>
                                                            <th align="center" width="25%" class="valor-tabla">' . $comercial['direccion'] . '</th>
                                                            <th align="center" width="20%" class="valor-tabla">' . $comercial['contacto'] . '</th>
                                                            <th align="center" width="23%" class="valor-tabla">' . $comercial['email'] . '</th>
                                                            <th align="center" width="12%" class="valor-tabla">' . $comercial['telefono'] . '</th>
                                                        </tr>';
                }
            }
            
            $Q->free_result();

            
            /*  Referencias bancarias  */
            $this->db->select('b.nom_bancox as banco, a.tip_cuenta as tipo_cuenta, a.num_cuenta as numero_cuenta, a.suc_cuenta as sucursal, a.suc_telefo as telefono');
            $this->db->from('dat_client_refban a');
            $this->db->join('dat_inform_bancos b', 'a.cod_bancox = b.cod_bancox');
            $this->db->where('a.cod_client', $id);

            $Q = $this->db->get();

            $data['referencias_bancarias'] = '';
            if ($Q->num_rows() > 0)
            {
                $bancarias = $Q->result_array();
                
                foreach ($bancarias as $bancaria)
                {
                    $data['referencias_bancarias'] .='<tr>
                                                        <th align="center" width="23%" class="valor-tabla">' . $bancaria['banco'] . '</th>
                                                        <th align="center" width="20%" class="valor-tabla">' . $bancaria['tipo_cuenta'] . '</th>
                                                        <th align="center" width="20%" class="valor-tabla">' . $bancaria['numero_cuenta'] . '</th>
                                                        <th align="center" width="25%" class="valor-tabla">' . $bancaria['sucursal'] . '</th>
                                                        <th align="center" width="12%" class="valor-tabla">' . $bancaria['telefono'] . '</th>
                                                    </tr>';
                }
            }
            
            $Q->free_result();
            
            $data['dia_diligenciamiento'] = $fecha->format('d');
            $data['mes_diligenciamiento'] = $fecha->format('m');
            $data['anio_diligenciamiento'] = $fecha->format('Y');
            
            $data['ingresos'] = "$ " . number_format ($data['ingresos'] , 2 , "," , ".");
            $data['egresos'] = "$ " . number_format ($data['egresos'] , 2 , "," , ".");
            $data['activos'] = "$ " . number_format ($data['activos'] , 2 , "," , ".");
            $data['pasivos'] = "$ " . number_format ($data['pasivos'] , 2 , "," , ".");
            $data['otros_ingresos'] = "$ " . number_format ($data['otros_ingresos'] , 2 , "," , ".");
            $data['ica'] .= " %";
            
            $data['rut'] = null;
            $data['camara_comercio'] = null;
            $data['estados_financieros'] = null;
            $data['cedula_representante'] = null;
            $data['declaracion_renta'] = null;
            
            $this->db->select('cod_clidoc as id_archivo');
            $this->db->from('dat_client_docume');
            $this->db->where('cod_client', $id);
            
            $Q3 = $this->db->get();
            
            if ($Q3->num_rows() > 0)
            {
                $documentos = $Q3->result_array();
                
                foreach ($documentos as $documento)
                {
                    switch($documento['id_archivo'])
                    {
                        case '1':
                            $data['rut'] = '<img src="' . dirname(FCPATH) . '/img/Check.png" alt="OK" width="8" border="0" /> ';
                            break;
                        
                        case '2':
                            $data['camara_comercio'] = '<img src="' . dirname(FCPATH) . '/img/Check.png" alt="OK" width="8" border="0" /> ';
                            break;
                        
                        case '1000':
                            $data['estados_financieros'] = '<img src="' . dirname(FCPATH) . '/img/Check.png" alt="OK" width="8" border="0" /> ';
                            break;
                        
                        case '1001':
                            $data['cedula_representante'] = '<img src="' . dirname(FCPATH) . '/img/Check.png" alt="OK" width="8" border="0" /> ';
                            break;
                        
                        case '1003':
                            $data['declaracion_renta'] = '<img src="' . dirname(FCPATH) . '/img/Check.png" alt="OK" width="8" border="0" /> ';
                            break;
                    }
                }
            }
            
            $Q3->free_result();
        }
        else
            $data = array('success' => false, 'msg' => 'Su información no fue encontrada en el sistema');
        
        $Q->free_result();
        
        return $data;
    }
    
    
    function editInfo($cliente, $tipo_persona, $nombre, $tipo_empresa, $tipo_id, $nit, $dv, $direccion, $telefono, $fax, $email, $actividad_principal, $industria, $cotiza, $servicio, $persona_contacto, $area_contacto, $email_contacto, $telefono_contacto, $rep_apellido1, $rep_apellido2, $rep_nombre, $rep_tipo_id, $rep_numero_id, $rep_fec_expedicion, $rep_lugar_id, $rep_fec_nacimiento, $rep_lugar_nacimiento, $rep_nacionalidad, $rep_telefono, $rep_email, $rep_direccion, $rep_ciudad, $rep_maneja_recursos, $rep_poder_publico, $rep_reconocimiento_publico, $rep_participacion_mayoral5, $rep_vinculo_publico, $rep_tipo_vinculo, $ingresos, $egresos, $activos, $pasivos, $otros_ingresos, $con_otros_ingresos, $contribuyente, $autoretenedor, $declarante, $tarifa_ica, $origen_fondos, $nombre_gerente, $telefono_gerente, $email_gerente, $nombre_secretaria, $telefono_secretaria, $email_secretaria, $nombre_financiero, $telefono_financiero, $email_financiero, $nombre_contador, $telefono_contador, $email_contador, $nombre_tributario, $telefono_tributario, $email_tributario, $nombre_tesorero, $telefono_tesorero, $email_tesorero, $nombre_juridico, $telefono_juridico, $email_juridico,$nombre_autorizacion, $tipoid_autorizacion, $numid_autorizacion, $lugarid_autorizacion, $sociedad_autorizacion, $nit_autorizacion, $file_estados, $file_ccrep, $file_renta, $file_rut, $file_camara, $autorizo, $pdf_sarlaft)
    {
        if ($autorizo == 'off')
        {
            return array('success' => false, 'msg' => 'Debe autorizar el uso de sus datos a Crowe');
        }
        
        $this->db->select('cli_estado');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            return array('success' => false, 'msg' => 'Cliente inválido');
        }
        
        $estado_cliente = $Q->row_array();
        $Q->free_result();
        
        if ($estado_cliente['cli_estado'] != '1')
        {
            return array('success' => false, 'msg' => 'Cliente inactivo');
        }
        
        $this->db->trans_start();
        
        $this->db->set('cli_tipper', $tipo_persona);
        $this->db->set('nom_client', $nombre);
        $this->db->set('cli_tipoid', $tipo_id);
        $this->db->set('nit_client', $nit);
        //$this->db->set('cli_tipper', $dv);
        $this->db->set('cod_tipcli', $tipo_empresa);
        $this->db->set('dir_client', $direccion);
        $this->db->set('tel_client', $telefono);
        $this->db->set('fax_client', $fax);
        $this->db->set('cli_emailx', $email);
        $this->db->set('cod_actpri', $actividad_principal);
        $this->db->set('cod_indust', $industria);
        $this->db->set('cli_cotiza', $cotiza);
        $this->db->set('cod_servic', $servicio);
        
        /*  Persona de contacto  */
        $this->db->set('per_contac', $persona_contacto);
        $this->db->set('are_contac', $area_contacto);
        $this->db->set('ema_contac', $email_contacto);
        $this->db->set('tel_contac', $telefono_contacto);
        
        /*  Informacion financiera  */
        $this->db->set('mes_ingres', $ingresos);
        $this->db->set('mes_egreso', $egresos);
        $this->db->set('cli_activs', $activos);
        $this->db->set('cli_pasivs', $pasivos);
        $this->db->set('otr_ingres', $otros_ingresos);
        $this->db->set('con_ingres', $con_otros_ingresos);
        $this->db->set('gra_contri', $contribuyente);
        $this->db->set('aut_retene', $autoretenedor);
        $this->db->set('dec_rentax', $declarante);
        $this->db->set('ica_tarifa', $tarifa_ica);
        $this->db->set('ori_fondos', $origen_fondos);
        
        /*  Informacion de autorizacion  */
        $this->db->set('aut_nombre', $nombre_autorizacion);
        $this->db->set('aut_tipdoc', $tipoid_autorizacion);
        $this->db->set('aut_numidx', $numid_autorizacion);
        $this->db->set('aut_lugaid', $lugarid_autorizacion);
        $this->db->set('aut_socied', $sociedad_autorizacion);
        $this->db->set('aut_numnit', $nit_autorizacion);
        
        /*  Autorizacion de uso de datos  */
        $this->db->set('uso_autori', 1);
        
        /*  Archivo PDF generado  */
        $this->db->set('pdf_sarlaf', $pdf_sarlaft);
        
        $this->db->where('cod_client', $cliente);
        if (!$this->db->update('dat_inform_client'))
        {
            $this->db->trans_complete();
            return $this->helper_db->err_db($this->db->error());
        }
        
        $this->db->select('1');
        $this->db->from('dat_client_repres');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        $representante = false;
        if ($Q->num_rows() > 0)
        {
            $representante = true;
        }
        $Q->free_result();
        
        $datos_representante = array(
            'pri_apelli' => $rep_apellido1,
            'seg_apelli' => $rep_apellido2,
            'rep_nombre' => $rep_nombre,
            'cod_tipoid' => $rep_tipo_id,
            'num_idxxxx' => $rep_numero_id,
            'fec_expedi' => $rep_fec_expedicion,
            'ciu_expedi' => $rep_lugar_id,
            'fec_nacimi' => $rep_fec_nacimiento,
            'lug_nacimi' => $rep_lugar_nacimiento,
            'rep_nacion' => $rep_nacionalidad,
            'rep_telefo' => $rep_telefono,
            'rep_emailx' => $rep_email,
            'rep_direcc' => $rep_direccion,
            'rep_ciudad' => $rep_ciudad,
            'rec_public' => $rep_maneja_recursos,
            'pod_public' => $rep_poder_publico,
            'ren_public' => $rep_reconocimiento_publico,
            'par_supal5' => $rep_participacion_mayoral5,
            'vin_public' => $rep_vinculo_publico,
            'tip_vincul' => $rep_tipo_vinculo
        );
        
        if ($representante)
        {
            if (! $this->db->update('dat_client_repres', $datos_representante, array('cod_client' => $cliente)))
            {
                $this->db->trans_complete();
                return $this->helper_db->err_db($this->db->error());
            }
        }
        else
        {
            $datos_representante = $datos_representante + array('cod_client' => $cliente);
            if (! $this->db->insert('dat_client_repres', $datos_representante))
            {
                $this->db->trans_complete();
                return $this->helper_db->err_db($this->db->error());
            }
        }
        
        $this->db->select('cod_funcli as id_funcionario, cod_carcli as cargo');
        $this->db->from('dat_inform_funcli');
        $this->db->where('cod_client', $cliente);
        $this->db->where('reg_anulad', 0);
        $Q2 = $this->db->get();
        
        $funcionarios = null;
        if ($Q2->num_rows() > 0)
        {
            $funcionarios = $Q2->result_array();
        }
        
        $Q2->free_result();
        
        $r = $this->agregarFuncionario($nombre_gerente, $telefono_gerente, $email_gerente, $funcionarios, '2', $cliente);
        if (! $r['success'])
            return $r;
        $r = $this->agregarFuncionario($nombre_gerente, $telefono_gerente, $email_gerente, $funcionarios, '3', $cliente);
        if (! $r['success'])
            return $r;
        $r = $this->agregarFuncionario($nombre_secretaria, $telefono_secretaria, $email_secretaria, $funcionarios, '8', $cliente);
        if (! $r['success'])
            return $r;
        $r = $this->agregarFuncionario($nombre_financiero, $telefono_financiero, $email_financiero, $funcionarios, '4', $cliente);
        if (! $r['success'])
            return $r;
        $r = $this->agregarFuncionario($nombre_contador, $telefono_contador, $email_contador, $funcionarios, '5', $cliente);
        if (! $r['success'])
            return $r;
        $r = $this->agregarFuncionario($nombre_tributario, $telefono_tributario, $email_tributario, $funcionarios, '6', $cliente);
        if (! $r['success'])
            return $r;
        $r = $this->agregarFuncionario($nombre_tesorero, $telefono_tesorero, $email_tesorero, $funcionarios, '7', $cliente);
        if (! $r['success'])
            return $r;
        $r = $this->agregarFuncionario($nombre_juridico, $telefono_juridico, $email_juridico, $funcionarios, '10', $cliente);
        if (! $r['success'])
            return $r;
        
        /*      Archivos documentación      */
        /*
         * Tipos de archivos:
         * 1. RUT
         * 2. Cámara de comercio
         * 1000. Estados financieros
         * 1001. Cédula representante legal
         * 1003. Declaración de renta
         */
        $archivos_cargados = array(
            'rut' => false,
            'camara' => false,
            'estados' => false,
            'cedula' => false,
            'declaracion' => false
        );
        
        $agregar_archivo = $this->agregarArchivo('1', $file_rut, $cliente, 'RUT', $archivos_cargados);
        if (! $agregar_archivo['success'])
            return $agregar_archivo;
        
        $agregar_archivo = $this->agregarArchivo('2', $file_camara, $cliente, 'Cámara de comercio', $archivos_cargados);
        if (! $agregar_archivo['success'])
            return $agregar_archivo;
        
        $agregar_archivo = $this->agregarArchivo('1000', $file_estados, $cliente, 'Estados financieros', $archivos_cargados);
        if (! $agregar_archivo['success'])
            return $agregar_archivo;
        
        $agregar_archivo = $this->agregarArchivo('1001', $file_ccrep, $cliente, 'Cédula representante legal', $archivos_cargados);
        if (! $agregar_archivo['success'])
            return $agregar_archivo;
        
        $agregar_archivo = $this->agregarArchivo('1003', $file_renta, $cliente, 'Declaración de renta', $archivos_cargados);
        if (! $agregar_archivo['success'])
            return $agregar_archivo;
        
        
        $this->db->trans_complete();
        
        return array('success' => true) + $archivos_cargados;
    }
    
    
    private function agregarFuncionario($nombre, $telefono, $email, $funcionarios, $cargo, $cliente)
    {
        
        if (!empty($funcionarios))
        {
            for ($i = 0 ; $i < count($funcionarios) ; $i ++)
            {
                if ($funcionarios[$i]['cargo'] == $cargo)
                {
                    $this->db->set('nom_funcli', $nombre);
                    $this->db->set('fun_telefo', $telefono);
                    $this->db->set('fun_emailx', $email);
                    
                    $this->db->where('cod_funcli', $funcionarios[$i]['id_funcionario']);
                    if (! $this->db->update('dat_inform_funcli'))
                    {
                        $this->db->trans_complete();
                        return $this->helper_db->err_db($this->db->error());
                    }
                    
                    unset ($funcionarios[$i]);
                    return array('success' => true);
                }
            }
        }
        
        $this->db->set('nom_funcli', $nombre);
        $this->db->set('fun_telefo', $telefono);
        $this->db->set('fun_emailx', $email);
        $this->db->set('cod_client', $cliente);
        $this->db->set('cod_carcli', $cargo);
        
        if (! $this->db->insert('dat_inform_funcli'))
        {
            $this->db->trans_complete();
            return $this->helper_db->err_db($this->db->error());
        }
        
        return array('success' => true);
        
        
        
    }
    
    
    private function agregarArchivo($cod_documento, $file, $cliente, $descripcion, $archivos_cargados)
    {
        if ($file != null && $file['success'] && file_exists($file['path']))
        {
            $file_nuevo = array('cod_clidoc' => $cod_documento, 'cod_client' => $cliente, 'url_docume' => $file['path'], 'ext_docume' => $file['extension'], 'doc_descri' => $descripcion, 'fec_modifi' => (new DateTime())->format('Y-m-d H:i:s'), 'cod_modifi' => $cliente, 'tip_modifi' => '2');
            
            $this->db->select('url_docume as url');
            $this->db->from('dat_client_docume');
            $this->db->where('cod_client', $cliente);
            $this->db->where('cod_clidoc', $cod_documento);
            
            $Q3 = $this->db->get();
            if ($Q3->num_rows() > 0)
            {
                $file_anterior = $Q3->row();
                if (file_exists($file_anterior->url))
                    unlink($file_anterior->url);
                
                if (! $this->db->update('dat_client_docume', $file_nuevo, array('cod_client' => $cliente, 'cod_clidoc' => $cod_documento)))
                {
                    $this->db->trans_complete();
                    return $this->helper_db->err_db($this->db->error());
                }
            }
            else
            {
                if (! $this->db->insert('dat_client_docume', $file_nuevo + array('fec_creaci' => (new DateTime())->format('Y-m-d H:i:s'))))
                {
                    $this->db->trans_complete();
                    return $this->helper_db->err_db($this->db->error());
                }
            }
            $Q3->free_result();
            
            switch($cod_documento)
            {
                case '1':
                    $archivos_cargados['rut'] = true;
                    break;
                
                case '2':
                    $archivos_cargados['camara'] = true;
                    break;
                
                case '1000':
                    $archivos_cargados['estados'] = true;
                    break;
                
                case '1001':
                    $archivos_cargados['cedula'] = true;
                    break;
                
                case '1003':
                    $archivos_cargados['declaracion'] = true;
                    break;
            }
        }
        
        return array('success' => true);
    }
    
    
    function getUrl_archivo($cliente, $tipo_archivo)
    {
        switch($tipo_archivo)
        {
            case 'est':
                $tipo = 1000;
                break;
            
            case 'ccr':
                $tipo = 1001;
                break;
            
            case 'ren':
                $tipo = 1003;
                break;
            
            case 'rut':
                $tipo = 1;
                break;
            
            case 'cam':
                $tipo = 2;
                break;
        }
        
        $this->db->select('a.url_docume as url, a.ext_docume as extension, a.doc_descri as descripcion, b.nom_client as nombre_cliente');
        $this->db->from('dat_client_docume a');
        $this->db->join('dat_inform_client b', 'a.cod_client = b.cod_client');
        $this->db->where('a.cod_clidoc', $tipo);
        $this->db->where('a.cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            return array ('success' => false, 'path' => '');
        }
        else
        {
            $file = $Q->row_array();
            $Q->free_result();
            return $file + array ('success' => true);
        }
    }
    
    
    function getUrl_pdf($cliente)
    {
        $this->db->select('a.pdf_sarlaf as url, "application/pdf" as extension, a.nom_client as nombre_cliente', false);
        $this->db->from('dat_inform_client a');
        $this->db->where('a.cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            return array ('success' => false, 'url' => '');
        }
        else
        {
            $file = $Q->row_array();
            $Q->free_result();
            if ($file['url'] == null)
                return array ('success' => false, 'url' => '');
            
            return $file + array ('success' => true);
        }
    }
    
    
    
    function getInfo_cliente($cliente)
    {
        $this->db->select('cli_estado as estado, nom_client as nombre, sar_firmad as archivo');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            return array('success' => false, 'msg' => 'El cliente no fue encontrado en el sistema');
        }
        
        $info = $Q->row_array();
        
        if ($info['estado'] != '1')
        {
            return array('success' => false, 'msg' => 'El cliente se encuentra inactivo');
        }
        
        return $info + array('success' => true);
    }
    
    
    function setPDF_firmado($cliente, $file)
    {
        $this->db->select('cli_estado as estado, sar_firmad as archivo');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            return array('success' => false, 'msg' => 'El cliente no fue encontrado en el sistema');
        }
        
        $info = $Q->row_array();
        
        if ($info['estado'] != '1')
        {
            return array('success' => false, 'msg' => 'El cliente se encuentra inactivo');
        }
        
        if (file_exists($info['archivo']))
        {
            unlink($info['archivo']);
        }
        
        $this->db->set('sar_firmad', $file['path']);
        $this->db->where('cod_client', $cliente);
        
        if (! $this->db->update('dat_inform_client'))
        {
            return $this->helper_db->err_db($this->db->error());
        }
        
        return array('success' => true);
    }
    
    
    function getUrl_pdfFirmado($cliente)
    {
        $this->db->select('a.sar_firmad as url, "application/pdf" as extension, a.nom_client as nombre_cliente', false);
        $this->db->from('dat_inform_client a');
        $this->db->where('a.cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            return array ('success' => false, 'url' => '');
        }
        else
        {
            $file = $Q->row_array();
            $Q->free_result();
            if ($file['url'] == null)
                return array ('success' => false, 'url' => '');
            
            return $file + array ('success' => true);
        }
    }
            
    
    
    
    function getAccionista($cliente)
    {
        $this->db->select('cod_accion as id, b.nom_tipoid as tipo_id, b.cod_tipoid as cod_tipoid, idx_accion as numero_id, nom_accion as nombre, prc_partic as participacion, IF(a.rec_public = 1, "Si", "No") as recursos_publicos_socio, IF(a.pod_public = 1, "Si", "No") as poder_publico_socio, IF(a.ren_public = 1, "Si", "No") as reconocimiento_publico_socio, IF(a.dec_otrpai = 1, "Si", "No") as declara_otropais_socio, IF(a.dec_otrpai = 1 AND c.nom_paisxx IS NOT NULL, c.nom_paisxx, "") as pais_declaracion, IF(a.dec_otrpai = 1 AND c.nom_paisxx IS NOT NULL, c.cod_paisxx, "") as cod_pais');
        $this->db->from('dat_client_accion a');
        $this->db->join('dat_inform_tipoid b', 'a.cod_tipoid = b.cod_tipoid');
        $this->db->join('dat_inform_paises c', 'a.pai_declar = c.cod_paisxx', 'left');
        $this->db->where('cod_client', $cliente);
        $this->db->order_by('nombre');
        
        $Q = $this->db->get();
        
        $data = null;
        if ($Q->num_rows() == 0)
        {
            $data = array();
        }
        else
        {
           $data = $Q->result_array(); 
        }
        
        $Q->free_result();
        
        return $data;
    }
    
    
    
    function agrearAccionista($cliente, $new_row, $tipo_id, $numero_id, $nombre, $participacion, $recursos_publicos, $poder_publico, $reconocimiento_publico, $declara_otropais, $pais_declaracion)
    {
        $this->db->trans_start();
        
        $this->db->select('cli_estado');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente invalido');
        }
        
        $estado_cliente = $Q->row();
        $Q->free_result();
        
        if ($estado_cliente->cli_estado != '1')
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente inactivo');
        }
        
        $this->db->select('nom_tipoid');
        $this->db->from('dat_inform_tipoid');
        $this->db->where('cod_tipoid', $tipo_id);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Tipo de identificación inválida');
        }
        
        $nombre_tipoid = $Q->row()->nom_tipoid;
        
        $Q->free_result();
        
        $pais_declara = array();
        
        if ($declara_otropais == 'Si')
        {
            $this->db->select('nom_paisxx as pais_declaracion, cod_paisxx as cod_pais');
            $this->db->from('dat_inform_paises');
            $this->db->where('cod_paisxx', $pais_declaracion);

            $Q = $this->db->get();
            
            if ($Q->num_rows() == 0)
            {
                $this->db->trans_complete();
                return array('isError' => true, 'msg' => 'Pais invalido, debe seleccionar el país donde está obligado a declarar');
            }
            
            $pais_declara = $Q->row_array();
            
            $Q->free_result();
            
            $this->db->set('pai_declar', $pais_declaracion);
        }
        else
        {
            $this->db->set('pai_declar', null);
        }
        
        $this->db->set('cod_client', $cliente);
        $this->db->set('cod_tipoid', $tipo_id);
        $this->db->set('idx_accion', $numero_id);
        $this->db->set('nom_accion', $nombre);
        $this->db->set('prc_partic', $participacion);
        $this->db->set('rec_public', ($recursos_publicos == 'Si') ? 1 : 0);
        $this->db->set('pod_public', ($poder_publico == 'Si') ? 1 : 0);
        $this->db->set('ren_public', ($reconocimiento_publico == 'Si') ? 1 : 0);
        $this->db->set('dec_otrpai', ($declara_otropais == 'Si') ? 1 : 0);
        
        if (! $this->db->insert('dat_client_accion'))
        {
            $this->db->trans_complete();
            return array('isError' => true) + $this->helper_db->err_db($this->db->error());
        }
        
        $id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return array('isError' => false, 'id' => $id, 'cod_tipoid' => $tipo_id, 'tipo_id' => $nombre_tipoid) + $pais_declara;
    }
    
    
    
    function editarAccionista($cliente, $id_accionista, $tipo_id, $numero_id, $nombre, $participacion, $recursos_publicos, $poder_publico, $reconocimiento_publico, $declara_otropais, $pais_declaracion)
    {
        $this->db->trans_start();
        
        $this->db->select('cli_estado');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente invalido');
        }
        
        $estado_cliente = $Q->row();
        $Q->free_result();
        
        if ($estado_cliente->cli_estado != '1')
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente inactivo');
        }
        
        $this->db->select('nom_tipoid');
        $this->db->from('dat_inform_tipoid');
        $this->db->where('cod_tipoid', $tipo_id);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Tipo de identificación inválida');
        }
        
        $nombre_tipoid = $Q->row()->nom_tipoid;
        
        $Q->free_result();
        
        $pais_declara = array();
        
        if ($declara_otropais == 'Si')
        {
            $this->db->select('nom_paisxx as pais_declaracion, cod_paisxx as cod_pais');
            $this->db->from('dat_inform_paises');
            $this->db->where('cod_paisxx', $pais_declaracion);

            $Q = $this->db->get();
            
            if ($Q->num_rows() == 0)
            {
                $this->db->trans_complete();
                return array('isError' => true, 'msg' => 'Pais invalido, debe seleccionar el país donde está obligado a declarar');
            }
            
            $pais_declara = $Q->row_array();
            
            $Q->free_result();
            
            $this->db->set('pai_declar', $pais_declaracion);
        }
        else
        {
            $this->db->set('pai_declar', null);
            $pais_declara = array('pais_declaracion' => "");
        }
        
        $this->db->set('cod_tipoid', $tipo_id);
        $this->db->set('idx_accion', $numero_id);
        $this->db->set('nom_accion', $nombre);
        $this->db->set('prc_partic', $participacion);
        $this->db->set('rec_public', ($recursos_publicos == 'Si') ? 1 : 0);
        $this->db->set('pod_public', ($poder_publico == 'Si') ? 1 : 0);
        $this->db->set('ren_public', ($reconocimiento_publico == 'Si') ? 1 : 0);
        $this->db->set('dec_otrpai', ($declara_otropais == 'Si') ? 1 : 0);
        $this->db->where('cod_client', $cliente);
        $this->db->where('cod_accion', $id_accionista);
        
        if (! $this->db->update('dat_client_accion'))
        {
            $this->db->trans_complete();
            return array('isError' => true) + $this->helper_db->err_db($this->db->error());
        }
        
        $this->db->trans_complete();
        
        return array('isError' => false, 'cod_tipoid' => $tipo_id, 'tipo_id' => $nombre_tipoid) + $pais_declara;
    }
    
    
    
    function eliminarAccionista($cliente, $id_accionista)
    {
        $this->db->trans_start();
        
        $this->db->select('cli_estado');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente invalido');
        }
        
        $estado_cliente = $Q->row();
        $Q->free_result();
        
        if ($estado_cliente->cli_estado != '1')
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente inactivo');
        }
        
        $this->db->select('1');
        $this->db->from('dat_client_accion');
        $this->db->where('cod_client', $cliente);
        $this->db->where('cod_accion', $id_accionista);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Accionista no encontrado');
        }
        
        $Q->free_result();
        
        $this->db->where('cod_client', $cliente);
        $this->db->where('cod_accion', $id_accionista);
        
        if (! $this->db->delete('dat_client_accion'))
        {
            $this->db->trans_complete();
            return array('isError' => true) + $this->helper_db->err_db($this->db->error());
        }
        
        $this->db->trans_complete();
        
        return array('isError' => false);
    }
    
    
    /************************************************
     *      FUNCIONES DE REFERENCIAS BANCARIAS      *
     ************************************************/
    
    
    function getReferencias_bancarias($cliente)
    {
        $this->db->select('cod_refban as id, b.nom_bancox as banco, b.cod_bancox as cod_banco, a.tip_cuenta as tipo_cuenta, a.num_cuenta as numero_cuenta, a.suc_cuenta as sucursal, a.suc_telefo as telefono');
        $this->db->from('dat_client_refban a');
        $this->db->join('dat_inform_bancos b', 'a.cod_bancox = b.cod_bancox');
        $this->db->where('a.cod_client', $cliente);
        
        $Q = $this->db->get();
        
        $data = null;
        if ($Q->num_rows() == 0)
        {
            $data = array();
        }
        else
        {
           $data = $Q->result_array(); 
        }
        
        $Q->free_result();
        
        return $data;
    }
    
    
    
    function guardarReferencia_bancaria($cliente, $new_row, $banco, $tipo_cuenta, $numero_cuenta, $sucursal, $telefono)
    {
        $this->db->trans_start();
        
        $this->db->select('cli_estado');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente invalido');
        }
        
        $estado_cliente = $Q->row();
        $Q->free_result();
        
        if ($estado_cliente->cli_estado != '1')
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente inactivo');
        }
        
        $this->db->select('nom_bancox');
        $this->db->from('dat_inform_bancos');
        $this->db->where('cod_bancox', $banco);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Banco inválido');
        }
        
        $nombre_banco = $Q->row()->nom_bancox;
        
        $Q->free_result();
        
        $this->db->set('cod_client', $cliente);
        $this->db->set('cod_bancox', $banco);
        $this->db->set('tip_cuenta', $tipo_cuenta);
        $this->db->set('num_cuenta', $numero_cuenta);
        $this->db->set('suc_cuenta', $sucursal);
        $this->db->set('suc_telefo', $telefono);
        
        if (! $this->db->insert('dat_client_refban'))
        {
            $this->db->trans_complete();
            return array('isError' => true) + $this->helper_db->err_db($this->db->error());
        }
        
        $id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return array('isError' => false, 'id' => $id, 'banco' => $nombre_banco, 'cod_banco' => $banco);
    }
    
    
    
    function editarReferencia_bancaria($cliente, $id_referencia, $banco, $tipo_cuenta, $numero_cuenta, $sucursal, $telefono)
    {
        $this->db->trans_start();
        
        $this->db->select('cli_estado');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente invalido');
        }
        
        $estado_cliente = $Q->row();
        $Q->free_result();
        
        if ($estado_cliente->cli_estado != '1')
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente inactivo');
        }
        
        $this->db->select('nom_bancox');
        $this->db->from('dat_inform_bancos');
        $this->db->where('cod_bancox', $banco);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Banco inválido');
        }
        
        $nombre_banco = $Q->row()->nom_bancox;
        
        $Q->free_result();
        
        $this->db->set('cod_bancox', $banco);
        $this->db->set('tip_cuenta', $tipo_cuenta);
        $this->db->set('num_cuenta', $numero_cuenta);
        $this->db->set('suc_cuenta', $sucursal);
        $this->db->set('suc_telefo', $telefono);
        $this->db->where('cod_client', $cliente);
        $this->db->where('cod_refban', $id_referencia);
        
        if (! $this->db->update('dat_client_refban'))
        {
            $this->db->trans_complete();
            return array('isError' => true) + $this->helper_db->err_db($this->db->error());
        }
        
        $this->db->trans_complete();
        
        return array('isError' => false, 'cod_banco' => $banco, 'banco' => $nombre_banco);
    }
    
    
    function eliminarReferencia_bancaria($cliente, $id_referencia)
    {
        $this->db->trans_start();
        
        $this->db->select('cli_estado');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente invalido');
        }
        
        $estado_cliente = $Q->row();
        $Q->free_result();
        
        if ($estado_cliente->cli_estado != '1')
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente inactivo');
        }
        
        $this->db->select('1');
        $this->db->from('dat_client_refban');
        $this->db->where('cod_client', $cliente);
        $this->db->where('cod_refban', $id_referencia);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Referencia bancaria no encontrada');
        }
        
        $Q->free_result();
        
        $this->db->where('cod_client', $cliente);
        $this->db->where('cod_refban', $id_referencia);
        
        if (! $this->db->delete('dat_client_refban'))
        {
            $this->db->trans_complete();
            return array('isError' => true) + $this->helper_db->err_db($this->db->error());
        }
        
        $this->db->trans_complete();
        
        return array('isError' => false);
    }
    
    
    
    /****************************************************
     *      FUNCIONES DE REFERENCIAS COMERCIALES        *
     ****************************************************/
    
    function getReferencias_comerciales($cliente)
    {
        $this->db->select('cod_refcom as id, ref_empres as empresa, ref_direcc as direccion, ref_contac as contacto, ref_emailx as email, ref_telefo as telefono');
        $this->db->from('dat_client_refcom a');
        $this->db->where('a.cod_client', $cliente);
        
        $Q = $this->db->get();
        
        $data = null;
        if ($Q->num_rows() == 0)
        {
            $data = array();
        }
        else
        {
           $data = $Q->result_array(); 
        }
        
        $Q->free_result();
        
        return $data;
    }
    
    
    
    function guardarReferencia_comercial($cliente, $new_row, $empresa, $direccion, $contacto, $email, $telefono)
    {
        $this->db->trans_start();
        
        $this->db->select('cli_estado');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente invalido');
        }
        
        $estado_cliente = $Q->row();
        $Q->free_result();
        
        if ($estado_cliente->cli_estado != '1')
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente inactivo');
        }
        
        $this->db->set('cod_client', $cliente);
        $this->db->set('ref_empres', $empresa);
        $this->db->set('ref_direcc', $direccion);
        $this->db->set('ref_contac', $contacto);
        $this->db->set('ref_emailx', $email);
        $this->db->set('ref_telefo', $telefono);
        
        if (! $this->db->insert('dat_client_refcom'))
        {
            $this->db->trans_complete();
            return array('isError' => true) + $this->helper_db->err_db($this->db->error());
        }
        
        $id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return array('isError' => false, 'id' => $id);
    }
    
    
    
    function editarReferencia_comercial($cliente, $id_referencia, $empresa, $direccion, $contacto, $email, $telefono)
    {
        $this->db->trans_start();
        
        $this->db->select('cli_estado');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente invalido');
        }
        
        $estado_cliente = $Q->row();
        $Q->free_result();
        
        if ($estado_cliente->cli_estado != '1')
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente inactivo');
        }
        
        $this->db->set('ref_empres', $empresa);
        $this->db->set('ref_direcc', $direccion);
        $this->db->set('ref_contac', $contacto);
        $this->db->set('ref_emailx', $email);
        $this->db->set('ref_telefo', $telefono);
        $this->db->where('cod_client', $cliente);
        $this->db->where('cod_refcom', $id_referencia);
        
        if (! $this->db->update('dat_client_refcom'))
        {
            $this->db->trans_complete();
            return array('isError' => true) + $this->helper_db->err_db($this->db->error());
        }
        
        $this->db->trans_complete();
        
        return array('isError' => false);
    }
    
    
    function eliminarReferencia_comercial($cliente, $id_referencia)
    {
        $this->db->trans_start();
        
        $this->db->select('cli_estado');
        $this->db->from('dat_inform_client');
        $this->db->where('cod_client', $cliente);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente invalido');
        }
        
        $estado_cliente = $Q->row();
        $Q->free_result();
        
        if ($estado_cliente->cli_estado != '1')
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Cliente inactivo');
        }
        
        $this->db->select('1');
        $this->db->from('dat_client_refcom');
        $this->db->where('cod_client', $cliente);
        $this->db->where('cod_refcom', $id_referencia);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
        {
            $this->db->trans_complete();
            return array('isError' => true, 'msg' => 'Referencia comercial no encontrada');
        }
        
        $Q->free_result();
        
        $this->db->where('cod_client', $cliente);
        $this->db->where('cod_refcom', $id_referencia);
        
        if (! $this->db->delete('dat_client_refcom'))
        {
            $this->db->trans_complete();
            return array('isError' => true) + $this->helper_db->err_db($this->db->error());
        }
        
        $this->db->trans_complete();
        
        return array('isError' => false);
    }
}

?>