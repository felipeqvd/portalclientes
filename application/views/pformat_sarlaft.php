<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <style type="text/css">
        body {
            font-family: Helvetica, Verdana;
            font-size: 7pt;
            background-color: #fff;
            color: #000; 
        }
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }        
        
        th{
            /*height: 20px;
            line-height:20px;*/
        }
        
        .label{
            border-top: 2px solid white;
            border-left: 2px solid white;
            border-bottom: 2px solid white;
            border-right: 2px solid white;
            background-color: #BFBEBE;
            font-weight: bold;
        }
        
        .label-centro{
            border-top: 2px solid white;
            border-left: 1px solid black;
            border-bottom: 2px solid white;
            border-right: 1px solid black;
        }
        
        .valor{
            border: 2px solid white;
        }
        
        .titulo-tabla{
            border: 1px solid black;
            background-color: #002D62;
            color: white;
            font-weight: bold;
        }
        
        .valor-tabla{
            border: 1px solid black;
        }
        
        .campo_autorizacion{
            font-weight: bold;
            font-size: 1.1em;
        }
        
        .titulo{
            font-size: 1.3em;
            background-color: #FDB913;
            font-weight: bold;
            width: 100%;
            text-align: center;
        }
        
        .sobre-celda{
            border-top: 2px solid white;
            border-left: 2px solid white;
            border-bottom: 1px solid black;
            border-right: 2px solid white;
        }
        
        .sin-borde{
            border: 1px solid white;
        }
    </style>
  </head>
    <body>
        <p style="text-align: center; width: 100%; font-size: 1.4em; font-weight: bold;">FORMULARIO CONOCIMIENTO DEL CLIENTE</p>
        <p>&nbsp;</p>
        <table cellpadding="2">
            <tr>
                <th align="right" width="19%" class="label"><p>Fecha de diligenciamiento</p></th>
                <th align="center" width="4%" class="valor"><p>%dia_diligenciamiento%</p></th>
                <th align="center" width="4%" class="valor"><p>%mes_diligenciamiento%</p></th>
                <th align="center" width="7%" class="valor"><p>%anio_diligenciamiento%</p></th>
                <th align="left" width="23%" class="valor"><p></p></th>
                <th align="right" width="15%" class="label"><p>Tipo de solicitud</p></th>
                <th align="center" width="10%" class="label"><p>Vinculación</p></th>
                <th align="center" width="4%" class="valor"><p>%vinculacion% </p></th>
                <th align="center" width="10%" class="label"><p>Renovación</p></th>
                <th align="center" width="4%" class="valor"><p>%renovacion% </p></th>
            </tr>
            <tr>
                <th align="right" width="8%" class="label"><p>Ciudad</p></th>
                <th align="left" width="24%" class="valor"><p>%ciudad%</p></th>
                <th align="right" width="12%" class="label"><p>Departamento</p></th>
                <th align="left" width="24%" class="valor"><p>%departamento%</p></th>
                <th align="right" width="6%" class="label"><p>País</p></th>
                <th align="left" width="26%" class="valor"><p>%pais%</p></th>
            </tr>
        </table>
        <p>&nbsp;</p>
        <p class="titulo">INFORMACIÓN BÁSICA</p>
        <p>&nbsp;</p>
        <table cellpadding="2">
            <tr>
                <th align="right" width="15%" class="label"><p>Persona natural</p></th>
                <th align="center" width="3%" class="valor"><p>%presona_natural%</p></th>
                <th width="10%" class="valor"><p></p></th>
                <th align="right" width="%15" class="label"><p>Persona juridica</p></th>
                <th align="center" width="3%" class="valor"><p>%persona_juridica%</p></th>
                <th width="54%" class="valor"><p></p></th>
            </tr>
            <tr>
                <th align="right" width="20%" class="label"><p>Tipo de identificacion</p></th>
                <th align="left" width="25%" class="valor"><p>%tipo_id%</p></th>
                <th align="right" width="8%" class="label"><p>No.</p></th>
                <th align="left" width="25%" class="valor"><p>%numero_id%</p></th>
                <th align="right" width="7%" class="label"><p>DV</p></th>
                <th align="left" width="15%" class="valor"><p></p></th>
            </tr>
            <tr>
                <th align="right" width="17%" class="label"><p>Nombre o razón social</p></th>
                <th align="center" width="35%" class="valor"><p>%nombre%</p></th>
                <th align="right" width="12%" class="label"><p>Tipo de empresa</p></th>
                <th align="left" width="36%" class="valor"><p>%tipo_empresa%</p></th>
            </tr>
            <tr>
                <th align="right" width="20%" class="label"><p>Dirección oficina principal</p></th>
                <th align="center" width="50%" class="valor"><p>%direccion%</p></th>
                <th align="right" width="10%" class="label"><p>Telefono</p></th>
                <th align="left" width="20%" class="valor"><p>%telefono%</p></th>
            </tr>
            <tr>
                <th align="right" width="20%" class="label"><p>e-mail</p></th>
                <th align="left" width="50%" class="valor"><p>%email%</p></th>
                <th align="right" width="10%" class="label"><p>Fax</p></th>
                <th align="left" width="20%" class="valor"><p>%fax%</p></th>
            </tr>
            <tr>
                <th align="right" width="17%" class="label"><p>Sector</p></th>
                <th align="left" width="83%" class="valor"><p>%industria%</p></th>
            </tr>
            <tr>
                <th align="right" width="17%" class="label"><p>Actividad principal</p></th>
                <th align="left" width="53%" class="valor"><p>%actividad_principal%</p></th>
                <th align="right" width="10%" class="label"><p>Código CIIU</p></th>
                <th align="left" width="20%" class="valor"><p>%ciiu%</p></th>
            </tr>
            <tr>
                <th align="right" width="30%" class="label"><p>¿Cotiza en la bolsa de valores de Colombia?</p></th>
                <th align="center" width="4%" class="label"><p>Si</p></th>
                <th align="center" width="4%" class="valor"><p>%si_cotiza%</p></th>
                <th align="center" width="4%" class="label"><p>No</p></th>
                <th align="center" width="4%" class="valor"><p>%no_cotiza%</p></th>
                <th align="right" width="19%" class="label"><p>Tipo de servicio contratado</p></th>
                <th align="left" width="35%" class="valor"><p>%servicio%</p></th>
            </tr>
            <tr>
                <th align="right" width="17%" class="label"><p>Persona de contacto</p></th>
                <th align="left" width="47%" class="valor"><p>%persona_contacto%</p></th>
                <th align="right" width="6%" class="label"><p>Área</p></th>
                <th align="left" width="30%" class="valor"><p>%area%</p></th>
            </tr>
            <tr>
                <th align="right" width="17%" class="label"><p>E-mail contacto</p></th>
                <th align="left" width="47%" class="valor"><p>%email_contacto%</p></th>
                <th align="right" width="16%" class="label"><p>Telefono contacto</p></th>
                <th align="left" width="20%" class="valor"><p>%tel_con%</p></th>
            </tr>
        </table>
        <p>&nbsp;</p>
        <p class="titulo">REPRESENTANTE LEGAL</p>
        <p>&nbsp;</p>
        <table cellpadding="2">
            <tr>
                <th align="right" width="15%" class="label"><p>Primer apellido</p></th>
                <th align="center" width="15%" class="valor"><p>%apellido1_rep%</p></th>
                <th align="right" width="%15" class="label"><p>Segundo apellido</p></th>
                <th align="center" width="15%" class="valor"><p>%apellido2_rep%</p></th>
                <th align="right" width="%10" class="label"><p>Nombres</p></th>
                <th align="center" width="30%" class="valor"><p>%nombres_rep%</p></th>
            </tr>
            <tr>
                <th align="right" width="17%" class="label"><p>Tipo de documento</p></th>
                <th align="center" width="28%" class="valor"><p>%tipo_id_rep%</p></th>
                <th align="right" width="4%" class="label"><p>No.</p></th>
                <th align="center" width="20%" class="valor"><p>%num_id_rep%</p></th>
                <th align="right" width="17%" class="label"><p>Fecha de expedición</p></th>
                <th align="center" width="14%" class="valor"><p>%expedicion_id_rep%</p></th>
            </tr>
            <tr>
                <th align="right" width="15%" class="label"><p>Lugar de expedición</p></th>
                <th align="left" width="22%" class="valor"><p>%lugar_expedicion%</p></th>
                <th align="right" width="15%" class="label"><p>Fecha de nacimiento</p></th>
                <th align="center" width="11%" class="valor"><p>%fecha_nac_rep%</p></th>
                <th align="right" width="15%" class="label"><p>Lugar de nacimiento</p></th>
                <th align="left" width="22%" class="valor"><p>%lug_nac_rep%</p></th>
            </tr>
            <tr>
                <th align="right" width="10%" class="label"><p>Nacionalidad</p></th>
                <th align="left" width="22%" class="valor"><p>%nacion_rep%</p></th>
                <th align="right" width="9%" class="label"><p>Telefono</p></th>
                <th align="left" width="15%" class="valor"><p>%tel_rep%</p></th>
                <th align="right" width="7%" class="label"><p>E-mail</p></th>
                <th align="center" width="37%" class="valor"><p>%email_rep%</p></th>
            </tr>
            <tr>
                <th align="right" width="10%" class="label"><p>Dirección</p></th>
                <th align="left" width="26%" class="valor"><p>%direccion_rep%</p></th>
                <th align="right" width="8%" class="label"><p>Ciudad</p></th>
                <th align="left" width="22%" class="valor"><p>%ciudad_rep%</p></th>
                <th align="right" width="12%" class="label"><p>Departamento</p></th>
                <th align="left" width="22%" class="valor"><p>%deparamento_rep%</p></th>
            </tr>
            <tr>
                <th align="right" width="34%" class="label"><p>¿Por su cargo o actividad maneja recursos públicos?</p></th>
                <th align="center" width="3%" class="label"><p>Si</p></th>
                <th align="center" width="3%" class="valor"><p>%si_recpub%</p></th>
                <th align="center" width="3%" class="label"><p>No</p></th>
                <th align="center" width="3%" class="valor"><p>%no_recpub%</p></th>
                <th align="right" width="42%" class="label"><p>¿Por su cargo o actividad ejerce algún grado de poder público?</p></th>
                <th align="center" width="3%" class="label"><p>Si</p></th>
                <th align="center" width="3%" class="valor"><p>%si_podpub%</p></th>
                <th align="center" width="3%" class="label"><p>No</p></th>
                <th align="center" width="3%" class="valor"><p>%no_podpub%</p></th>
            </tr>
            <tr>
                <th align="right" width="51%" class="label"><p>¿Por su actividad u oficio, goza de reconocimiento público en general?</p></th>
                <th align="center" width="3%" class="label"><p>Si</p></th>
                <th align="center" width="3%" class="valor"><p>%si_renpub%</p></th>
                <th align="center" width="3%" class="label"><p>No</p></th>
                <th align="center" width="3%" class="valor"><p>%no_renpub%</p></th>
                <th align="right" width="25%" class="label"><p>¿Posee participación superior al 5%?</p></th>
                <th align="center" width="3%" class="label"><p>Si</p></th>
                <th align="center" width="3%" class="valor"><p>%si_parsup5%</p></th>
                <th align="center" width="3%" class="label"><p>No</p></th>
                <th align="center" width="3%" class="valor"><p>%no_parsup5%</p></th>
            </tr>
            <tr>
                <th align="right" width="55%" class="label"><p>¿Existe algún vinculo entre usted y una persona considerada públicamente expuesta?</p></th>
                <th align="center" width="3%" class="label"><p>Si</p></th>
                <th align="center" width="3%" class="valor"><p>%si_vinpub%</p></th>
                <th align="center" width="3%" class="label"><p>No</p></th>
                <th align="center" width="3%" class="valor"><p>%no_vinpub%</p></th>
                <th align="right" width="15%" class="label"><p>Indique tipo de vínculo</p></th>
                <th align="center" width="18%" class="valor"><p>%tipo_vinculo%</p></th>
            </tr>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p class="titulo">CONTACTOS PRINCIPALES</p>
        <p>&nbsp;</p>
        <table cellpadding="2">
            <tr>
                <th align="right" width="23%" class="label"><p>Presidente / Gerente General</p></th>
                <th align="center" width="28%" class="valor"><p>%nombre_gerente%</p></th>
                <th align="right" width="%7" class="label"><p>Telefono</p></th>
                <th align="center" width="11%" class="valor"><p>%telefono_gerente%</p></th>
                <th align="right" width="%6" class="label"><p>E-mail</p></th>
                <th align="center" width="25%" class="valor"><p>%email_gerente%</p></th>
            </tr>
            <tr>
                <th align="right" width="23%" class="label"><p>Secretaria del Presidente / Gerente</p></th>
                <th align="center" width="28%" class="valor"><p>%nombre_secretaria%</p></th>
                <th align="right" width="%7" class="label"><p>Telefono</p></th>
                <th align="center" width="11%" class="valor"><p>%telefono_secretaria%</p></th>
                <th align="right" width="%6" class="label"><p>E-mail</p></th>
                <th align="center" width="25%" class="valor"><p>%email_secretaria%</p></th>
            </tr>
            <tr>
                <th align="right" width="23%" class="label"><p>Gerente Financiero</p></th>
                <th align="center" width="28%" class="valor"><p>%nombre_financiero%</p></th>
                <th align="right" width="%7" class="label"><p>Telefono</p></th>
                <th align="center" width="11%" class="valor"><p>%telefono_financiero%</p></th>
                <th align="right" width="%6" class="label"><p>E-mail</p></th>
                <th align="center" width="25%" class="valor"><p>%email_financiero%</p></th>
            </tr>
            <tr>
                <th align="right" width="23%" class="label"><p>Director de Contabilidad</p></th>
                <th align="center" width="28%" class="valor"><p>%nombre_contador%</p></th>
                <th align="right" width="%7" class="label"><p>Telefono</p></th>
                <th align="center" width="11%" class="valor"><p>%telefono_contador%</p></th>
                <th align="right" width="%6" class="label"><p>E-mail</p></th>
                <th align="center" width="25%" class="valor"><p>%email_contador%</p></th>
            </tr>
            <tr>
                <th align="right" width="23%" class="label"><p>Director Tributario</p></th>
                <th align="center" width="28%" class="valor"><p>%nombre_tributario%</p></th>
                <th align="right" width="%7" class="label"><p>Telefono</p></th>
                <th align="center" width="11%" class="valor"><p>%telefono_tributario%</p></th>
                <th align="right" width="%6" class="label"><p>E-mail</p></th>
                <th align="center" width="25%" class="valor"><p>%email_tributario%</p></th>
            </tr>
            <tr>
                <th align="right" width="23%" class="label"><p>Tesorero</p></th>
                <th align="center" width="28%" class="valor"><p>%nombre_tesorero%</p></th>
                <th align="right" width="%7" class="label"><p>Telefono</p></th>
                <th align="center" width="11%" class="valor"><p>%telefono_tesorero%</p></th>
                <th align="right" width="%6" class="label"><p>E-mail</p></th>
                <th align="center" width="25%" class="valor"><p>%email_tesorero%</p></th>
            </tr>
            <tr>
                <th align="right" width="23%" class="label"><p>Secretario o Director Jurídico</p></th>
                <th align="center" width="28%" class="valor"><p>%nombre_juridico%</p></th>
                <th align="right" width="%7" class="label"><p>Telefono</p></th>
                <th align="center" width="11%" class="valor"><p>%telefono_juridico%</p></th>
                <th align="right" width="%6" class="label"><p>E-mail</p></th>
                <th align="center" width="25%" class="valor"><p>%email_juridico%</p></th>
            </tr>
        </table>
        
        <p>&nbsp;</p>
        <p class="titulo">INFORMACIÓN FINANCIERA</p>
        <p>&nbsp;</p>
        <table cellpadding="2">
            <tr>
                <th align="right" width="23%" class="label"><p>Ingresos mensuales (Pesos)</p></th>
                <th align="center" width="22%" class="valor"><p>%ingresos%</p></th>
                <th align="right" width="%22" class="label"><p>Egresos mensuales (pesos)</p></th>
                <th align="center" width="23%" class="valor"><p>%egresos%</p></th>
            </tr>
            <tr>
                <th align="right" width="%23" class="label"><p>Activos (pesos)</p></th>
                <th align="center" width="22%" class="valor"><p>%activos%</p></th>
                <th align="right" width="22%" class="label"><p>Pasivos (Pesos)</p></th>
                <th align="center" width="23%" class="valor"><p>%pasivos%</p></th>
            </tr>
            <tr>
                <th align="right" width="%23" class="label"><p>Otros ingresos mensuales</p></th>
                <th align="center" width="22%" class="valor"><p>%otros_ingresos%</p></th>
                <th align="right" width="%22" class="label"><p>Concepto</p></th>
                <th align="center" width="23%" class="valor"><p>%concepto_ingresos%</p></th>
            </tr>
            <tr>
                <th align="right" width="16%" class="label"><p>Tipo de contribuyente</p></th>
                <th align="center" width="18%" class="valor"><p>%tipo_contribuyente%</p></th>
                <th align="right" width="%10" class="label"><p>Autoretenedor</p></th>
                <th align="center" width="3%" class="label"><p>Si</p></th>
                <th align="center" width="3%" class="valor"><p>%si_autoretenedor%</p></th>
                <th align="center" width="3%" class="label"><p>No</p></th>
                <th align="center" width="3%" class="valor"><p>%no_autoretenedor%</p></th>
                <th align="right" width="%14" class="label"><p>Declarante de renta</p></th>
                <th align="center" width="3%" class="label"><p>Si</p></th>
                <th align="center" width="3%" class="valor"><p>%si_declarante%</p></th>
                <th align="center" width="3%" class="label"><p>No</p></th>
                <th align="center" width="3%" class="valor"><p>%no_declarante%</p></th>
                <th align="right" width="%8" class="label"><p>Tarifa ICA</p></th>
                <th align="center" width="10%" class="valor"><p>%ica%</p></th>
            </tr>
        </table>
        
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p class="titulo">ORIGEN DE FONDOS</p>
        <p>&nbsp;</p>
        <table cellpadding="2">
            <tr>
                <th align="left" width="48%" class="valor"><p>1. Declaro expresamente que la actividad, profesión u oficio de la compañía es lícita y se ejerce dentro del marco legal y los recursos de la misma no provienen de actividades ilícitas de las contempladas en el Código Penal Colombiano. </p><p>2. Los recursos que posee la compañía provienen de la(s) actividad(es) anteriormente descritas.</p></th>
                <th align="left" width="4%" class="valor"><p></p></th>
                <th align="left" width="48%" class="valor"><p>3. La información suministrada en la solicitud y en este documento es veraz y verificable y la sociedad se compromete a actualizarla anualmente.</p><p>4. Los recursos que se deriven del desarrollo de este contrato no se destinarán a la financiación del terrorismo, grupos terroristas o actividades terroristas.</p></th>
            </tr>
            <tr>
                <th align="right" width="20%" class="label"><p>Origen de fondos</p></th>
                <th align="left" width="80%" class="valor"><p>%origen_fondos%</p></th>
            </tr>
        </table>
        
        <br pagebreak="true">
        
        <p class="titulo">ACCIONISTAS</p>
        <p>&nbsp;</p>
        <p>Por favor relacione los accionistas o asociados  que tengan directa o indirectamente mas del 5% del capital social, aporte o participación. (En caso de requerir mas espacio, anexar certificación)</p>
        <p>&nbsp;</p>
        <table cellpadding="2">
            <tr>
                <th align="center" width="10%" class="titulo-tabla"><p>&nbsp;</p><p>&nbsp;</p>TIPO ID</th>
                <th align="center" width="10%" class="titulo-tabla"><p>&nbsp;</p><p>&nbsp;</p>NUMERO ID</th>
                <th align="center" width="20%" class="titulo-tabla"><p>&nbsp;</p><p>&nbsp;</p>NOMBRE</th>
                <th align="center" width="10%" class="titulo-tabla"><p>&nbsp;</p>% Participación</th>
                <th align="center" width="12%" class="titulo-tabla">¿Por su cargo o actividad, maneja recursos públicos?</th>
                <th align="center" width="12%" class="titulo-tabla">¿Por su cargo o actividad ejerce algún grado de poder público?</th>
                <th align="center" width="13%" class="titulo-tabla">¿Por su actividad u oficio, goza de reconocimiento público en general?</th>
                <th align="center" width="13%" class="titulo-tabla">¿Está obligado a declaración tributaria en otro país? Indique cual</th>
            </tr>
            %accionistas%
        </table>
        
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p class="titulo">REFERENCIAS COMERCIALES</p>
        <p>&nbsp;</p>
        <table cellpadding="2">
            <tr>
                <th align="center" width="20%" class="titulo-tabla">EMPRESA</th>
                <th align="center" width="25%" class="titulo-tabla">DIRECCION</th>
                <th align="center" width="20%" class="titulo-tabla">CONTACTO</th>
                <th align="center" width="23%" class="titulo-tabla">EMAIL</th>
                <th align="center" width="12%" class="titulo-tabla">TELEFONO</th>
            </tr>
            %referencias_comerciales%
        </table>
        
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p class="titulo">REFERENCIAS BANCARIAS</p>
        <p>&nbsp;</p>
        <table cellpadding="2">
            <tr>
                <th align="center" width="23%" class="titulo-tabla">BANCO</th>
                <th align="center" width="20%" class="titulo-tabla">TIPO DE CUENTA</th>
                <th align="center" width="20%" class="titulo-tabla">No. DE CUENTA</th>
                <th align="center" width="25%" class="titulo-tabla">SUCURSAL</th>
                <th align="center" width="12%" class="titulo-tabla">TELEFONO</th>
            </tr>
            %referencias_bancarias%
        </table>
        
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p class="titulo">DOCUMENTACIÓN REQUERIDA</p>
        <p>&nbsp;</p>
        <p>1. Estados financieros comparativos del ultimo periodo contable. &nbsp;&nbsp;&nbsp;<span>%estados_financieros%</span></p>
        <p>2. Fotocopia de la cedula del representante legal. &nbsp;&nbsp;&nbsp;<span>%cedula_representante%</span></p>
        <p>3. Declaracion de renta del ultimo periodo gravable. &nbsp;&nbsp;&nbsp;<span>%declaracion_renta%</span></p>
        <p>4. Copia del Rut actualizado. &nbsp;&nbsp;&nbsp;<span>%rut%</span></p>
        <p>5. Certificado camara de comercio no mayor a 30 dias. &nbsp;&nbsp;&nbsp;<span>%camara_comercio%</span></p>
        
        
        <br pagebreak="true">
        <p class="titulo">AUTORIZACIÓN</p>
        <p>&nbsp;</p>
        <p>Yo <span class="campo_autorizacion">%nombre_autorizacion%</span>, identificado con <span class="campo_autorizacion">%tipo_id_autorizacion%</span> No. <span class="campo_autorizacion">%numero_id_autorizacion%</span> de <span class="campo_autorizacion">%lugar_id_autorizacion%</span>, actuando en nombre propio y/o en representación legal de la sociedad <span class="campo_autorizacion">%sociedad_autorizacion%</span>, identificada con Nit No. <span class="campo_autorizacion">%nit_autorizacion%</span>, autorizo para que se consulte en cualquier momento en las centrales de riesgo y/o cualquier fuente, toda la informacion relevante para conocer mi desempeño y el de dicha sociedad como deudor, capacidad de pago, viabilidad para entablar o mantener una relacion contractual, o para cualquier otra finalidad.</p>
        <p>&nbsp;</p>
        <p>En cumplimiento de lo establecido en el Articulo 10 del Decreto 1377 de 2013 que reglamentó la Ley 1581 de 2012 "Por la cual se dictan disposiciones sobre el manejo de informacion personal y bases de datos"; se autoriza a Crowe Co S.A. a procesar, almacenar, y mantener actualizada la información referente a nuestra razón social de conformidad con las politicas de Crowe Co S.A. publicadas en la pagina web www.crowehorwath.net/co/.</p>
        
        
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p class="titulo">FIRMA Y HUELLA</p>
        <p>&nbsp;</p>
        <p>En constancia de haber leido, diligenciado y aceptado lo anterior, declaro que la información que he suministrado es veraz, firmo el presente documento a los <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> días del mes de <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> del dosmil <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> en la ciudad de <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>.</p>
        <table cellpadding="2">
            <tr>
                <th align="center" width="10%" class="valor"><p></p></th>
                <th align="center" width="45%" class="valor"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>__________________________________________________________</p><p>Firma de la persona natural y/o representante legal</p></th>
                <th align="center" width="35%" class="valor"><p>&nbsp;</p><p>&nbsp;</p><p><img src="<?=dirname(FCPATH) . '/img/Rectangulo_huella.png'?>" alt="" width="64" border="0" /></p><p>Huella dactilar</p></th>
                <th align="center" width="10%" class="valor"><p></p></th>
            </tr>
        </table>
    </body>
</html>