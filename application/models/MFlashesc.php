<?php

class MFlashesc extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }

    function getCodigos_flashes($funcionario, $codigo, $fec_desde, $fec_hasta, $texto)	//, $temas)
    {
        $data = array();

        $this->db->select('fl.idx_flashx as id_flash, fl.cod_flashx as cod_flash');
        $this->db->from('dat_inform_flashx fl');
        $this->db->where('fl.fls_estado', '1');
        /*$this->db->join('dat_flashx_temasx ft', 'fl.idx_flashx = ft.idx_flashx', 'left');
        $this->db->group_start();
        $this->db->where('ft.flg_activo', 1);
        $this->db->or_where('ft.flg_activo', null);
        $this->db->group_end();
        */

        if ($codigo != null)
            $this->db->where('fl.idx_flashx', $codigo);

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

            $this->db->where('fl.fec_flashx >=', $fechaInicio->format('Y-m-d') . ' 00:00:00');
            $this->db->where('fl.fec_flashx <', $fechaFinal->format('Y-m-d') . ' 00:00:00');
        }

        if ($texto != null)
            $this->db->where("MATCH (fls_concep) AGAINST ('{$texto}' IN NATURAL LANGUAGE MODE)");
        /*
        if(count($temas) > 0)
        {
            $this->db->group_start();
            $this->db->where('ft.cod_temaxx', $temas[0]);       // Para el primer tema
            for($i=1 ; $i<count($temas) ; $i++)
            {
                $this->db->or_where('ft.cod_temaxx', $temas[$i]);
            }
            $this->db->group_end();
            $this->db->having('count(*)', count($temas) );
        }
        $this->db->group_by('fl.idx_flashx');
		*/
        $Q = $this->db->get();

        if ($Q->num_rows() > 0)
            $data = $Q->result_array();

        $Q->free_result();

        return $data;
    }


    function getFlashes_lista($funcionario, $codigo, $fec_desde, $fec_hasta, $texto, $offset, $rows)	// $temas, $offset, $rows)
    {
        $data = array();

        $this->db->select('SQL_CALC_FOUND_ROWS null as num_rows, fl.cod_flashx as codigo, fl.fls_titulo as titulo, fl.fec_flashx as fecha, fl.pdf_estado as archivo', false);
        //$this->db->select('s.sol_titulo as titulo, s.sol_fechax as fechax, c.nom_catego as catego, s.sol_textox as textox', false);
        $this->db->from('dat_inform_flashx fl');
        $this->db->where('fl.fls_estado', '1');
        /*$this->db->join('dat_flashx_temasx ft', 'fl.idx_flashx = ft.idx_flashx', 'left');
        $this->db->group_start();
        $this->db->where('ft.flg_activo', 1);
        $this->db->or_where('ft.flg_activo', null);
        $this->db->group_end();*/

        //$this->db->where("s.sol_fechax BETWEEN '$fechaInicio' AND '$fechaFinal'", null, false);
        if ($codigo != null)
            $this->db->where('fl.idx_flashx', $codigo);

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

            $this->db->where('fl.fec_flashx >=', $fechaInicio->format('Y-m-d') . ' 00:00:00');
            $this->db->where('fl.fec_flashx <', $fechaFinal->format('Y-m-d') . ' 00:00:00');
        }

        if ($texto != null)
            $this->db->where("MATCH (fls_concep) AGAINST ('{$texto}' IN NATURAL LANGUAGE MODE)");
        /*
        if(count($temas) > 0)
        {
            $this->db->group_start();
            $this->db->where('ft.cod_temaxx', $temas[0]);       // Para el primer tema
            for($i=1 ; $i<count($temas) ; $i++)
            {
                $this->db->or_where('ft.cod_temaxx', $temas[$i]);
            }
            $this->db->group_end();
            $this->db->having('count(*)', count($temas) );
        }

        $this->db->group_by('fl.idx_flashx');
        */
        if ($offset !== null && $rows !== null)
            $this->db->limit($rows, $offset);
        $this->db->order_by('fl.fec_flashx', 'desc');
        $Q = $this->db->get();
        /*$Q = $this->db->get_compiled_select();
        return $Q;*/
        if ($Q->num_rows() > 0)
            $data['rows'] = $Q->result_array();
        else
            $data['rows'] = array();

        $data['total'] = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count;
        //$data['total'] = 2;
        $Q->free_result();

        return $data;
    }


    function getUrl_archivo_flash($id)
    {
        $data = "";

        $this->db->select('url_pdfxxx');
        $this->db->from('dat_inform_flashx');
        $this->db->where('fls_estado', '1');
        $this->db->where('cod_flashx', $id);

        $Q = $this->db->get();

        if ($Q->num_rows() > 0)
        {
            $data = $Q->row_array();
            $data = $data['url_pdfxxx'];
        }

        return $data;
    }
}

?>