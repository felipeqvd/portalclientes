<?php
$CI =& get_instance();
?>
<div>
      <div id="wrapper">
        <div class="sidebar" id="sidebar-wrapper">
          <ul class="nav nav-sidebar">
            <?php
            if ($CI->autenticacion->servicios(1003) && ($this->session->userdata('pwd_change') == '1')) {
                $clase = ($item_menu == 1003) ? ' class="active" ': '';
                echo '<li'.$clase.'><a href="'.base_url().'index.php/panel/form_sarlaft"><span class="fa fa-wpforms fa-fw"></span>&nbsp;&nbsp;&nbsp; Formulario SARLAFT<span class="sr-only"></span></a></li>';
            }
            ?>
            <?php
            if ($CI->autenticacion->servicios(1001) && ($this->session->userdata('pwd_change') == '1')) {
                $clase = ($item_menu == 1001) ? ' class="active" ': '';
                echo '<li'.$clase.'><a href="'.base_url().'index.php/panel/consultribuclient"><span class="fa fa-tasks fa-fw"></span>&nbsp;&nbsp;&nbsp; Consultas tributarias<span class="sr-only"></span></a></li>';
            }
            ?>
            <?php
            if ($CI->autenticacion->servicios(1002) && ($this->session->userdata('pwd_change') == '1')) {
                $clase = ($item_menu == 1002) ? ' class="active" ': '';
                echo '<li'.$clase.'><a href="'.base_url().'index.php/panel/flashestribu"><span class="fa fa-line-chart fa-fw"></span>&nbsp;&nbsp;&nbsp; Flashes tributarios<span class="sr-only"></span></a></li>';
            }
            ?>
            <?php
                $clase = ($item_menu == 9) ? ' class="active" ': '';
                echo '<li'.$clase.'><a href="'.base_url().'index.php/panel/contrasena"><span class="fa fa-unlock-alt fa-fw"></span>&nbsp;&nbsp;&nbsp; Cambiar contraseña<span class="sr-only"></span></a></li>';
            ?>
            <?php
                $clase = ($item_menu == 10) ? ' class="active" ': '';
                echo '<li'.$clase.'><a href="'.base_url().'index.php/login/logout"><span class="fa fa-times fa-fw"></span>&nbsp;&nbsp;&nbsp; Cerrar sesión<span class="sr-only"></span></a></li>';
            ?>
              
          </ul>
        </div>