<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class My_phpmailer {
    /**
     *  Lista de destinatarios con correo y nombre
     * Array de arrays asociativos donde cada elemento debe tener un campo 'email' y 'nombre' con la información de cada persona
     * @var array
     */
    private $destinatarios;
    /**
     * Mensaje html para enviar dentro del cuerpo del email.
     * @var string
     */
    private $mensaje;
    /**
     * Mensaje alterno en caso de tener errores con el html.
     * @var string
     */
    private $mensaje_alterno;
    /**
     * Lista de destinatarios para enviar con copia
     * Array de arrays asociativos donde cada elemento debe tener un campo 'email' y 'nombre' con la información de cada persona
     * @var array
     */
    private $destinatarios_CC;
    /**
     * Lista de destinatarios ocultos
     * Array de arrays asociativos donde cada elemento debe tener un campo 'email' y 'nombre' con la información de cada persona
     * @var array
     */
    private $destinatarios_BCC;
    
    /**
     * Inicializar clase mailer con los valores en null. Debe agregar al menos un destinatario y un mensaje antes de enviar un correo.
     */
    function __construct()
    {
        require_once('PHPMailer/class.phpmailer.php');
        $this->destinatarios = null;
        $this->mensaje = '';
        $this->mensaje_alterno = '';
        $this->destinatarios_CC = null;
        $this->destinatarios_BCC = null;
    }
    
    
    /*  Getters and setters  */
    function getDestinatarios() {
        return $this->destinatarios;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function getMensaje_alterno() {
        return $this->mensaje_alterno;
    }

    function getDestinatarios_CC() {
        return $this->destinatarios_CC;
    }

    function getDestinatarios_BCC() {
        return $this->destinatarios_BCC;
    }

    function setDestinatarios($destinatarios) {
        $this->destinatarios = $destinatarios;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    function setMensaje_alterno($mensaje_alterno) {
        $this->mensaje_alterno = $mensaje_alterno;
    }

    function setDestinatarios_CC($destinatarios_CC) {
        $this->destinatarios_CC = $destinatarios_CC;
    }

    function setDestinatarios_BCC($destinatarios_BCC) {
        $this->destinatarios_BCC = $destinatarios_BCC;
    }

    /**
     * Agregar un destinatario para el correo.
     * @param string $email Correo electrónico de la persona a quien se envía el correo
     * @param string $nombre Nombre de la persona a quien se envía el correo
     */
    public function agregarDestinatario($email, $nombre){
        if ($this->destinatarios == null)
            $this->destinatarios = array();
        
        $this->destinatarios[] = array('email' => $email, 'nombre' => $nombre);
    }
    
    /**
     * Agregar un destinatario a quien se le enviará el correo como una con copia
     * @param string $email Correo electrónico de la persona a quien se envía el correo con copia
     * @param string $nombre Nombre de la persona a quien se envía el correo con copia
     */
    public function agregarDestinatario_con_copia($email, $nombre){
        if ($this->destinatarios_CC == null)
            $this->destinatarios_CC = array();
        
        $this->destinatarios_CC[] = array('email' => $email, 'nombre' => $nombre);
    }
    
    /**
     * Agregar un destinatario a quien se le enviará el correo como una con copia oculta
     * @param string $email Correo electrónico de la persona a quien se envía el correo con copia oculta
     * @param string $nombre Nombre de la persona a quien se envía el correo con copia oculta
     */
    public function agregarDestinatario_con_copia_oculta($email, $nombre){
        if ($this->destinatarios_BCC == null)
            $this->destinatarios_BCC = array();
        
        $this->destinatarios_BCC[] = array('email' => $email, 'nombre' => $nombre);
    }
    
    /**
     * Enviar un correo utilizando la configuracion SMTP establecida en esta clase.
     * Antes de ejecutar este metodo debe haber seteado el mensaje y agregado al menos un destinatario.
     * @param string $titulo Titulo o tema del mensaje
     * @param array $parametros parámetros de configuración del correo de envio
     * @return array Resultado de la operación de envío y un mensaje en case de producirse un error en el proceso
     */
    public function enviar_email($titulo, $parametros){
        if (empty($this->destinatarios) || empty($this->mensaje)){
            return array('success' => false, 'msj' => 'Hay campos vacios.');
        }        
        try
        {
            $mail = new PHPMailer(true);
            if ($parametros['issmtp'] == 1){
                $mail->IsSMTP();
            }                    
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = $parametros['smtpsecure'];
            $mail->CharSet    = "UTF-8";
            $mail->Encoding   = "quoted-printable";
            $mail->Host       = $parametros['host'];
            $mail->Port       = $parametros['port'];
            $mail->Username   = $parametros['correo'];
            $mail->Password   = $parametros['password'];
            $mail->IsHTML(true);
            $mail->SetFrom($parametros['correo'], "Crowe");
            $mail->Timeout    = 30; 
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
            $mail->Subject    = $titulo;
            $mail->Body       = $this->mensaje;
            $mail->AltBody    = $this->mensaje_alterno;

            foreach($this->destinatarios as $destinatario){
                $mail->AddAddress($destinatario['email'], $destinatario['nombre']);
            }
            
            if (!empty($this->destinatarios_CC) && is_array($this->destinatarios_CC)){
                foreach ($this->destinatarios_CC as $copia){
                    $mail->AddCC($copia['email'], $copia['nombre']);
                }
            }
            
            if (!empty($this->destinatarios_BCC) && is_array($this->destinatarios_BCC)){
                foreach ($this->destinatarios_BCC as $oculto){
                    $mail->AddCC($oculto['email'], $oculto['nombre']);
                }
            }
            
            if(!$mail->Send())
            {
                return array('success' => false, 'msj' => 'No fue posible enviar el correo de notificación al cliente: ' . $mail->ErrorInfo);
            }
            else
                return array('success' => true);

        }
        catch (Exception $e)
        {
            return array('success' => false, 'msj' => 'No fue posible enviar el correo de notificación al cliente: ' . $$e->getMessage());
        }
    }
}

?>