<?php

class MFiltroscombos extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }

    /*
     * Obtener listado de tipos de clientes, tipos de empresas posibles.
     */
    function getTipos_empresas()
    {
        $data = array();
        
        $this->db->select('cod_tipcli as cod_tipemp, nom_tipcli as nom_tipemp');
        $this->db->from('dat_inform_tipcli');
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() > 0)
            $data = $Q->result_array();
        
        $Q->free_result();
        
        return $data;
    }
    
    
    /*
     * Obtener listado de actividades económicas
     */
    function getActividades()
    {
        $data = array();
        
        $this->db->select('cod_actpri as cod_actividad, nom_actpri as nom_actividad');
        $this->db->from('dat_inform_actpri');
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() > 0)
            $data = $Q->result_array();
        
        $Q->free_result();
        
        return $data;
    }
    
    
    /*
     * Obtener listado de codigos CIIU de las actividades económicas
     */
    function getCodigos_ciiu()
    {
        $data = array();
        
        $this->db->select('cod_actpri as cod_ciiu, cod_ciiuxx as nom_ciiu');
        $this->db->from('dat_inform_actpri');
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() > 0)
            $data = $Q->result_array();
        
        $Q->free_result();
        
        return $data;
    }
    
    
    /*
     * Obtener listado de industrias o sectores económicos
     */
    function getIndustrias()
    {
        $data = array();
        
        $this->db->select('cod_indust as cod_industria, nom_indust as nom_industria');
        $this->db->from('dat_inform_indust');
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() > 0)
            $data = $Q->result_array();
        
        $Q->free_result();
        
        return $data;
    }
    
    
    
    function getLista_valores($cliente, $campo, $excluir)
    {
        $data = array();
        
        switch ($campo)
        {
            case 'tipos_empresas':
                $this->db->select('cod_tipcli as cod_tipemp, nom_tipcli as nom_tipemp');
                $this->db->from('dat_inform_tipcli');
                $this->db->order_by('nom_tipemp');
                break;
            
            case 'actividades':
                $this->db->select('cod_actpri as cod_actividad, nom_actpri as nom_actividad');
                $this->db->from('dat_inform_actpri');
                $this->db->order_by('nom_actividad');
                break;
            
            case 'ciiu':
                $this->db->select('cod_actpri as cod_ciiu, cod_ciiuxx as nom_ciiu');
                $this->db->from('dat_inform_actpri');
                break;
            
            case 'industrias':
                $this->db->select('cod_indust as cod_industria, nom_indust as nom_industria');
                $this->db->from('dat_inform_indust');
                $this->db->order_by('nom_industria');
                break;
            
            case 'ciudades':
                $this->db->distinct();
                $this->db->select('a.cod_ciudad, CONCAT(a.nom_ciudad,", ",b.nom_paisxx) as nom_ciudad, a.cod_paisxx as cod_pais');
                $this->db->from('dat_inform_ciudad a');
                $this->db->join('dat_inform_paises b','b.cod_paisxx = a.cod_paisxx');
                $this->db->order_by('nom_ciudad');
                break;
            
            case 'paises':
                $this->db->distinct();
                $this->db->select('cod_paisxx as cod_pais, nom_paisxx as nom_pais');
                $this->db->from('dat_inform_paises');
                if ($excluir != null && $excluir = 1)
                {
                    $this->db->where('nom_paisxx <>', 'COLOMBIA');
                }
                $this->db->order_by('nom_pais');
                break;
            
            case 'departamentos':
                $this->db->distinct();
                $this->db->select('nom_depart as cod_departamento, nom_depart as nom_departamento');
                $this->db->from('dat_inform_ciudad');
                $this->db->order_by('nom_departamento');
                break;
            
            case 'tipos_ids':
                $this->db->select('cod_tipoid, nom_tipoid');
                $this->db->from('dat_inform_tipoid');
                $this->db->order_by('nom_tipoid');
                break;
            
            case 'ciudades_departamentos':
                $this->db->distinct();
                $this->db->select('cod_ciudad, nom_ciudad, nom_depart as departamento');
                $this->db->from('dat_inform_ciudad');
                $this->db->order_by('nom_ciudad');
                break;
            
            
            case 'bancos':
                $this->db->select('cod_bancox as cod_banco, nom_bancox as nom_banco');
                $this->db->from('dat_inform_bancos');
                $this->db->order_by('nom_banco');
                break;
            
            case 'servicio':
                $this->db->select('a.cod_divisi as cod_servicio, a.nom_divisi as nom_servicio');
                $this->db->from('dat_inform_divisi a');
                $this->db->join('dat_inform_contra b', 'a.cod_divisi = b.cod_divisi');
                $this->db->where('b.cod_client', $cliente);
                $this->db->order_by('nom_servicio');
                break;
            
            case 'tipodoc':
                $this->db->select('cod_tipdoc as cod_tipodoc, sig_tipdoc as nom_tipodoc');
                $this->db->from('dat_inform_tipdoc');
                $this->db->order_by('nom_tipodoc');
                break;
        }
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() > 0)
            $data = $Q->result_array();
        
        $Q->free_result();
        
        return $data;
    }
    
    
    function getInfo_empresa()
    {
        $this->db->select('img_pdfxxx as imagen, txt_header as header, txt_footer as footer, null as img_footer', false);
        $this->db->from('dat_inform_empres');
        $this->db->where('cod_empres', 1);
        
        $Q = $this->db->get();
        
        if ($Q->num_rows() == 0)
            $data = array('imagen' => null, 'header' => '', 'txt_footer' => '', 'img_footer' => null);
        else
            $data = $Q->row_array();
        
        return $data;
    }
}

?>