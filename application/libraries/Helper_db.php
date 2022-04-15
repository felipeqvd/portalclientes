<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Clase auxiliar con toda la funcionalidad relacionada con sesiones y autenticacion que es usada por todos los controladores.
 */
class Helper_db{
    private $CI;
    
    function __construct() {
        $this->CI =& get_instance();
    }
    
    /**
     * Interpretar el error MySQL obtenido y generar un mensaje mas amigable para el usuario.
     * @param array $error Información del error obtenido de la libreria de base de datos
     * @return array Con el error, bandera Success en false y msg con el mensaje de error interpretado
     */
    function err_db($error)
    {
        $result = array();
        $mensaje = $error['message'];
        if(strpos($error['message'], "'") !== false)
            $msg_elements = explode("'", $error['message']);
        else
            $msg_elements = explode("`", $error['message']);

        $result['success'] = false;                 // Diferencia en este modelo, no retorna un estado (status) de error sino un success negativo
        switch($error['code'])
        {
            case 1062:
                // Valor duplicado - Message: Duplicate entry '%s' for key %d
                $result['codigo'] = 101;
                $valor_error = isset($msg_elements[1]) ? $msg_elements[1] : "-";
                $result['msg'] = 'Error 101: El valor ' . $valor_error . ' ya existe en el sistema y no es posible insertar el duplicado.'; 
                break;

            case 1452:
                // Llave foranea invalida - Message: Cannot add or update a child row: a foreign key constraint fails (%s) 
                $result['codigo'] = 102;
                $campo_error = isset($msg_elements[7]) ? $msg_elements[7] : "-";
                $result['msg'] = 'Error 102: ' . $this->traducirCampo($campo_error) . ' es inválido';
                break;

            case 1264:
                // Valor fuera del rango - Message: Out of range value for column '%s' at row %ld 
                $result['codigo'] = 103;
                $campo_error = isset($msg_elements[1]) ? $msg_elements[1] : "-";
                $result['msg'] = 'Error 103: ' . $this->traducirCampo($campo_error) . ' está por fuera del rango válido de valores';
                break;

            case 1366:
                // Valor invalido (p. ej letra en valor numerico) - Message: Incorrect %s value: '%s' for column '%s' at row %ld 
                $result['codigo'] = 104;
                $campo_error = isset($msg_elements[3]) ? $msg_elements[3] : "-";      // Columna
                $valor_error = isset($msg_elements[1]) ? $msg_elements[1] : "-";
                $result['msg'] = 'Error 104: ' . $this->traducirCampo($campo_error) . ' es inválido';
                break;

            case 1265:
                // Entero invalido - Message: Data truncated for column '%s' at row %ld
                $result['codigo'] = 105;
                $campo_error = isset($msg_elements[1]) ? $msg_elements[1] : "-";
                $result['msg'] = 'Error 105: ' . $this->traducirCampo($campo_error) . ' es inválido';
                break;

            case 1048:
                // no puedes ser nulo - Message: Column '%s' cannot be null
                $result['codigo'] = 106;
                $campo_error = isset($msg_elements[1]) ? $msg_elements[1] : "-";
                $result['msg'] = 'Error 106: ' . $this->traducirCampo($campo_error) . ' está vacío o generó un valor nulo';
                break;

            default:
                $result['codigo'] = 100;
                $result['msg'] = 'Error 100: No fue posible actualizar la base de datos - ' . $mensaje;
        }

        return $result;
    }

    /**
     * Traducir el campo del nombre de la columna en la base de datos a una cadena legible.
     * @param string $codigo nombre de la columna de la tabla
     * @return string Descripción legible del nombre de la columna.
     */
    function traducirCampo ($codigo)
    {
        $elemento = 'El (campo no encontrado)';
        switch($codigo)
        {
            case 'nom_gruemp':
                $elemento = 'El nombre del grupo económico';
                break;

            case 'cod_gruemp':
                $elemento = 'El codigo del grupo económico';
                break;
            /*  Para el modelo de propuestas     */
            case 'cod_usuari':
                $elemento = 'El código del usuario';
                break;
            
            case 'fec_creaci':
                $elemento = 'La fecha de creación';
                break;
            
            case 'cod_moneda':
                $elemento = 'El código de la moneda';
                break;
            
            case 'cod_estado':
                $elemento = 'El estado';
                break;
            
            case 'cod_tipoxx':
                $elemento = 'El tipo de la propuesta';
                break;
            
            case 'cod_divisi':
                $elemento = 'El código de la división';
                break;
            
            case 'cod_client':
                $elemento = 'El código del cliente';
                break;
            
            case 'cod_sociox':
                $elemento = 'El código del socio';
                break;
            
            case 'cod_gerent':
                $elemento = 'El código del gerente';
                break;
            
            case 'cod_senior':
                $elemento = 'El código del senior';
                break;
            
            case 'cod_semsen':
                $elemento = 'El código del semi senior';
                break;
            
            case 'cod_contac':
                $elemento = 'El código del contacto';
                break;
            
            case 'fec_presen':
                $elemento = 'La fecha de presentación';
                break;
            
            case 'nom_destin':
                $elemento = 'El nombre del destinatario';
                break;
            
            case 'car_destin':
                $elemento = 'El cargo del destinatario';
                break;
            
            case 'tit_destin':
                $elemento = 'El título del destinatario';
                break;
            
            case 'pro_honora':
                $elemento = 'Los honorarios de la propuesta';
                break;
            
            case 'nom_honora':
                $elemento = 'La descripción de los honorarios';
                break;
            
            case 'pro_observ':
                $elemento = 'Las observaciones de la propuesta';
                break;
            
            case 'pro_honor2':
                $elemento = 'Los honorarios 2 de la propuesta';
                break;
            
            case 'nom_honor2':
                $elemento = 'La descripción de los honorarios 2';
                break;
            
            // Campos de la tabla de empresas
            case 'cod_empres':
                $elemento = 'El código de la empresa';
                break;
            
            case 'pre_empres':
                $elemento = 'El prefijo de la empresa';
                break;
            
            case 'img_pdfxxx':
                $elemento = 'El logo de la empresa';
                break;
            
            case 'cod_repres':
                $elemento = 'El identificador del representante legal';
                break;
            
            case 'cod_client':
                $elemento = 'El identificador del cliente';
                break;
            
            case 'pri_apelli':
                $elemento = 'El primer apellido del representante legal';
                break;
            
            case 'seg_apelli':
                $elemento = 'El segundo apellido del representante legal';
                break;
            
            case 'rep_nombre':
                $elemento = 'El nombre del representante legal';
                break;
            
            case 'cod_tipoid':
                $elemento = 'El tipo de documento';
                break;
            
            case 'num_idxxxx':
                $elemento = 'El número de documento';
                break;
            
            case 'fec_expedi':
                $elemento = 'La fecha de expedición del documento';
                break;
            
            case 'ciu_expedi':
                $elemento = 'La ciudad de expedición del documento';
                break;
            
            case 'fec_nacimi':
                $elemento = 'La fecha de nacimiento del representante legal';
                break;
            
            case 'lug_nacimi':
                $elemento = 'El lugar de nacimiento del representante legal';
                break;
            
            case 'rep_nacion':
                $elemento = 'La nacionalidad del representante legal';
                break;
            
            case 'rep_telefo':
                $elemento = 'El teléfono del representante legal';
                break;
            
            case 'rep_emailx':
                $elemento = 'El email del representante legal';
                break;
            
            case 'rep_direcc':
                $elemento = 'La dirección del representante legal';
                break;
            
            case 'rep_ciudad':
                $elemento = 'La ciudad del representante legal';
                break;
            
            case 'rec_public':
                $elemento = 'El campo de manejo de recursos públicos del representante legal';
                break;
            
            case 'pod_public':
                $elemento = 'El campo de poder público del representante legal';
                break;
            
            case 'ren_public':
                $elemento = 'El campo de reconocimiento público del representante legal';
                break;
            
            case 'par_supal5':
                $elemento = 'El campo de participación superior al 5 % del representante legal';
                break;
            
            case 'vin_public':
                $elemento = 'El campo de vínculo con persona publicamente expuesta del representante legal';
                break;
            
            case 'tip_vincul':
                $elemento = 'El tipo de vínculo con persona publicamente expuesta  del representante legal';
                break;
        }

        return $elemento;
    }
}

?>