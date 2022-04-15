<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Clase auxiliar con toda la funcionalidad relacionada con sesiones y autenticacion que es usada por todos los controladores.
 */
class File_helpers{
    private $CI;
    
    function __construct() {
        $this->CI =& get_instance();
    }

    /**
     * Realizar la carga del archivo. Se recibe el archivo por post (en el arreglo $_FILES) y se realiza el almacenamiento en el servidor
     * aparte de realizar el proceso con la libreria de codeigniter para seguridad y para asignar un nombre aleatorio al archivo.
     * @param string $file_element_name Nombre del campo que contiene el archivo (Indice del arreglo $_FILES)
     * @return array Informacion del upload. Success que indica si fue exitoso (true) o no. msg que tiene cualquier mensaje en caso de error, path tiene la ruta donde quedo almacenado el archivo local en el servidor y extension con la extension del archivo.
     */
    public function upload_file($dir_path, $file_element_name, $nombreArchivo = null, $tipos_permitidos = null)
    {
        $success = false;
        $msg = "";
        
        $config['upload_path'] = $dir_path;
        if ($tipos_permitidos == null)
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|txt|csv|jpg|png|jpeg|zip';
        else
            $config['allowed_types'] = $tipos_permitidos;
        $config['remove_spaces'] = TRUE;
        if ($nombreArchivo == null)
        {
            $config['overwrite'] = FALSE;
            $config['max_filename_increment'] = 1000;       // Si se repiten los nombres puede poner hasta el 1000
            $config['encrypt_name'] = TRUE;                 // Generar nombre aleatorio
        }
        else{
            $config['overwrite'] = FALSE;
            $config['max_filename_increment'] = 1000;       // Si se repiten los nombres puede poner hasta el 1000
            $config['file_name'] = $nombreArchivo;
        }
        
        $path = "";
        $extension = "";

        $this->CI->load->library('upload');
        $this->CI->upload->initialize($config);

        if (!$this->CI->upload->do_upload($file_element_name))
        {
            $success = false;
            $msg = $this->CI->upload->display_errors('', '');
        }
        else
        {
            $data = $this->CI->upload->data();
            $path = $data['full_path'];
            chmod($path, 0600);
            $extension = $data['file_type'];
            $success = true;
            $msg = "El archivo se ha subido con éxito";
        }
        @unlink($_FILES[$file_element_name]);
        
        return array('success' => $success, 'msg' => $msg, 'path' => $path, 'extension' => $extension);
    }
}

?>