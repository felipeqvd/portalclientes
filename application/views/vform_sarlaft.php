        <div id="page-content-wrapper" class="main">
            <h4 class="page-header">Formulario Conocimiento del Cliente</h4>
            <div style="clear: both;"><div style="width: 150px; float:left; font-weight: bold;">Cliente</div><div style="width: 300px; float:left;"><?=$nom_client?></div></div>
            <div style="clear: both;">
              <div style="width: 150px; float:left; font-weight: bold;">Fecha </div>
              <div style="width: 300px; float:left;">
                  <script type="text/javascript">
                      var d = new Date();
                      document.write(d.getFullYear()+' / '+parseFloat(d.getMonth()+1)+' / '+d.getDate());
                  </script>
              </div>
            </div>
            <div class="container" style="width: 100%; margin-top: 50px; clear: both;">
                <form id="fm-sarlaft" class="form-horizontal" role="form" method="post" enctype="multipart/form-data" novalidate>
                    <div class="form-group">
                        <label class="control-label col-sm-1">Ciudad:</label>
                        <div class="col-sm-3">
                            <input name="ciudad_general" class="easyui-combobox" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_ciudad',
                                textField: 'nom_ciudad',
                                queryParams:{campo: 'ciudades'}
                                ">
                        </div>
                        <label class="control-label col-sm-1">Departamento:</label>
                        <div class="col-sm-3">
                            <input name="departamento_general" class="easyui-combobox" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_departamento',
                                textField: 'nom_departamento',
                                queryParams:{campo: 'departamentos'}
                                ">
                        </div>
                        <label class="control-label col-sm-1">Pais:</label>
                        <div class="col-sm-3">
                            <input name="pais_general" class="easyui-combobox" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_pais',
                                textField: 'nom_pais',
                                queryParams:{campo: 'paises'}
                                ">
                        </div>
                    </div>
                    
                    
                    <div class="titulo_formulario">Información básica</div>
                    <div class="form-group" style="padding-top: 20px;">
                        <label class="control-label col-sm-2">Tipo de persona:</label>
                        <div class="col-sm-4">
                            <div class="col-sm-9" style="display:inline">
                                <input type="radio" name="tipo_persona" id="radio_natural" value="1" checked> Natural
                                <input type="radio" name="tipo_persona" id="radio_juridica" style="margin-left:10px" value="2">Juridica<br>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nombre o razón social:</label>
                        <div class="col-sm-5">
                            <input name="nombre" id="nombre" class="easyui-textbox read_only" required="true"  style="width:100%">
                        </div>
                        <label class="control-label col-sm-2">Tipo de empresa:</label>
                        <div class="col-sm-3">
                            <input name="tip_empresa" id="tip_empresa" class="easyui-combobox read_only" required="true"  style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_tipemp',
                                textField: 'nom_tipemp',
                                queryParams:{campo: 'tipos_empresas'}
                                ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tipo de identificación:</label>
                        <div class="col-sm-3">
                            <input name="tip_id" id="tip_id" class="easyui-combobox" required="true" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_tipoid',
                                textField: 'nom_tipoid',
                                queryParams:{campo: 'tipos_ids'}
                                " >
                        </div>
                        <label class="control-label col-sm-2">Número:</label>
                        <div class="col-sm-3">
                            <input name="nit" id="nit" class="easyui-numberbox" required="true" style="width:100%" data-options="
                                min: 100000000,
                                max: 999999999
                                ">
                        </div>
                        <label class="control-label col-sm-1">DV:</label>
                        <div class="col-sm-1">
                            <input name="dv" id="dv" class="easyui-textbox" style="width:100%" data-options="
                                min: 0,
                                max: 9
                                ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Dirección oficina principal:</label>
                        <div class="col-sm-10">
                            <input name="direccion" id="direccion" class="easyui-textbox" required="true"  style="width:100%">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Teléfono:</label>
                        <div class="col-sm-4">
                            <input name="telefono" id="telefono" class="easyui-textbox" required="true"  style="width:100%">
                        </div>
                        <label class="control-label col-sm-2">Fax:</label>
                        <div class="col-sm-4">
                            <input name="fax" id="fax" class="easyui-textbox" style="width:100%">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Email:</label>
                        <div class="col-sm-10">
                            <input name="cli_email" id="cli_email" type="email" class="easyui-textbox" required="true"  style="width:100%">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Actividad principal:</label>
                        <div class="col-sm-6">
                            <input id="actividad" name="actividad" class="easyui-combobox" required="true" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_actividad',
                                textField: 'nom_actividad',
                                onChange: function (newValue, oldValue){
                                    $('#ciiu').combobox('setValue', newValue);
                                },
                                queryParams:{campo: 'actividades'}
                                ">
                        </div>
                        <label class="control-label col-sm-2">Código CIIU:</label>
                        <div class="col-sm-2">
                            <input id="ciiu" name="ciiu" class="easyui-combobox" required="true" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_ciiu',
                                textField: 'nom_ciiu',
                                onChange: function (newValue, oldValue){
                                    $('#actividad').combobox('setValue', newValue);
                                },
                                queryParams:{campo: 'ciiu'}
                                ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Sector:</label>
                        <div class="col-sm-10">
                            <input name="industria" class="easyui-combobox" required="true" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_industria',
                                textField: 'nom_industria',
                                queryParams:{campo: 'industrias'}
                                ">
                        </div>
                    </div>
                    <div class="form-group" style="padding-top: 15px;">
                        <label class="control-label col-sm-2">Persona de contacto:</label>
                        <div class="col-sm-4">
                            <input name="persona_contacto" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-2">Área:</label>
                        <div class="col-sm-4">
                            <input name="area_contacto" class="easyui-textbox" style="width:100%">
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="control-label col-sm-2">Teléfono:</label>
                        <div class="col-sm-4">
                            <input name="tel_contacto" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-2">Email:</label>
                        <div class="col-sm-4">
                            <input name="email_contacto" type="email" class="easyui-textbox" style="width:100%" data-options="validType: 'email'">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">¿Cotiza en la bolsa de valores de Colombia?</label>
                        <div class="col-sm-3">
                            <div style="display:inline">
                                <input type="radio" name="cotiza_bolsa" id="radio_si_cotiza" value="1"> Sí
                                <input type="radio" name="cotiza_bolsa" id="radio_no_cotiza" style="margin-left:10px" value="0" checked>No<br>
                            </div>
                        </div>
                        <label class="control-label col-sm-2">Tipo de servicio contratado:</label>
                        <div class="col-sm-4">
                            <input name="tipo_servicio" class="easyui-combobox" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_servicio',
                                textField: 'nom_servicio',
                                queryParams:{campo: 'servicio'}
                                ">
                        </div>
                    </div>
                    
                    
                    <div class="titulo_formulario" style="margin-top: 30px;">Representante legal</div>
                    <div class="form-group" style="padding-top: 15px;">
                        <label class="control-label col-sm-2">Primer apellido:</label>
                        <div class="col-sm-4">
                            <input name="representante_apellido" class="easyui-textbox" required="true" style="width:100%">
                        </div>
                        <label class="control-label col-sm-2">Segundo apellido:</label>
                        <div class="col-sm-4">
                            <input name="representante_segapellido" class="easyui-textbox" required="true" style="width:100%">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nombres:</label>
                        <div class="col-sm-10">
                            <input name="representante_nombre" class="easyui-textbox" required="true" style="width:100%">
                        </div>
                    </div>
                    <div class="form-group" style="padding-top: 15px;">
                        <label class="control-label col-sm-2">Tipo de documento:</label>
                        <div class="col-sm-4">
                            <input name="tip_documento" class="easyui-combobox" required="true" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_tipoid',
                                textField: 'nom_tipoid',
                                queryParams:{campo: 'tipos_ids'}
                                ">
                        </div>
                        <label class="control-label col-sm-2">Número:</label>
                        <div class="col-sm-4">
                            <input name="numero_documento" class="easyui-numberbox" required="true" style="width:100%">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Fecha de expedición:</label>
                        <div class="col-sm-4">
                            <input name="fecha_documento" class="easyui-datebox" required="true" style="width:100%" data-options="formatter:formattersql,parser:parsersql">
                        </div>
                        <label class="control-label col-sm-2">Lugar de expedición:</label>
                        <div class="col-sm-4">
                            <input name="lugar_documento" class="easyui-combobox" required="true" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_ciudad',
                                textField: 'nom_ciudad',
                                queryParams:{campo: 'ciudades'}
                                ">
                        </div>
                    </div>
                    <div class="form-group" style="padding-top: 15px;">
                        <label class="control-label col-sm-2">Fecha de nacimiento:</label>
                        <div class="col-sm-4">
                            <input name="fecnacimiento_rep" class="easyui-datebox" required="true" style="width:100%" data-options="formatter:formattersql,parser:parsersql">
                        </div>
                        <label class="control-label col-sm-2">Lugar de nacimiento:</label>
                        <div class="col-sm-4">
                            <input name="nacimiento_rep" class="easyui-combobox" required="true" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_ciudad',
                                textField: 'nom_ciudad',
                                queryParams:{campo: 'ciudades'}
                                ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nacionalidad:</label>
                        <div class="col-sm-4">
                            <input name="nacionalidad_rep" class="easyui-combobox" required="true" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_pais',
                                textField: 'nom_pais',
                                queryParams:{campo: 'paises'}
                                ">
                        </div>
                        <label class="control-label col-sm-2">Teléfono:</label>
                        <div class="col-sm-4">
                            <input name="tel_rep" class="easyui-numberbox" required="true" style="width:100%">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Email:</label>
                        <div class="col-sm-8">
                            <input name="email_rep" class="easyui-textbox" required="true" style="width:100%" data-options="validType: 'email'">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Dirección:</label>
                        <div class="col-sm-8">
                            <input name="direccion_rep" class="easyui-textbox" required="true" style="width:100%">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Departamento:</label>
                        <div class="col-sm-4">
                            <input id="departamento_rep" name="departamento_rep" class="easyui-textbox not-editable" style="width:100%" data-options="
                                disabled: true
                                ">
                        </div>
                        <label class="control-label col-sm-2">Ciudad:</label>
                        <div class="col-sm-4">
                            <input name="ciudad_rep" class="easyui-combobox" required="true" style="width:100%" data-options="
                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                valueField: 'cod_ciudad',
                                textField: 'nom_ciudad',
                                queryParams:{campo: 'ciudades_departamentos'},
                                onSelect: function (record){
                                    if (record != null)
                                    {
                                        if (record.departamento != null)
                                            $('#departamento_rep').textbox('setText', record.departamento);
                                        else
                                            $('#departamento_rep').textbox('setText', '');
                                    }
                                },
                                ">
                        </div>
                    </div>
                    <div class="form-group" style="padding-top: 10px;">
                        <label class="control-label col-sm-6">¿Por su cargo o actividad maneja recursos públicos? </label>
                        <div class="col-sm-2">
                            <div style="display:inline">
                                <input type="radio" name="recursos_publicos" id="radio_si_recpub" value="1"> Sí
                                <input type="radio" name="recursos_publicos" id="radio_no_recpub" style="margin-left:10px" value="0" checked>No<br>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6">¿Por su cargo o actividad ejerce algún grado de poder público?  </label>
                        <div class="col-sm-2">
                            <div style="display:inline">
                                <input type="radio" name="poder_publico" id="radio_si_podpub" value="1"> Sí
                                <input type="radio" name="poder_publico" id="radio_no_podpub" style="margin-left:10px" value="0" checked>No<br>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6">¿Por su actividad u oficio, goza de reconocimiento público en general? </label>
                        <div class="col-sm-2">
                            <div style="display:inline">
                                <input type="radio" name="reconocimiento_publico" id="radio_si_recono" value="1"> Sí
                                <input type="radio" name="reconocimiento_publico" id="radio_no_recono" style="margin-left:10px" value="0" checked>No<br>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6">¿Posee participación superior al 5%? </label>
                        <div class="col-sm-2">
                            <div style="display:inline">
                                <input type="radio" name="posee_5" id="radio_si_pos5" value="1"> Sí
                                <input type="radio" name="posee_5" id="radio_no_pos5" style="margin-left:10px" value="0" checked>No<br>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6">¿Existe algún vinculo entre usted y una persona considerada públicamente expuesta? </label>
                        <div class="col-sm-2">
                            <div style="display:inline">
                                <input type="radio" name="vinculo_publico" id="radio_si_vinpub" value="1"> Sí
                                <input type="radio" name="vinculo_publico" id="radio_no_vinpub" style="margin-left:10px" value="0" checked>No<br>
                            </div>
                        </div>
                        <label class="control-label col-sm-2 tipo_vinculo" style="display: none;">Indique tipo de vínculo </label>
                        <div class="col-sm-2  tipo_vinculo" style="display: none;">
                            <input id="tipo_vinculo" name="tipo_vinculo" class="easyui-textbox not-editable" style="width:100%;" data-options="required: true, disabled: true">
                        </div>
                    </div>
                    
                    
                    <div class="titulo_formulario" style="margin-top: 30px;">Contactos principales</div>
                    <div class="form-group" style="padding-top: 15px;">
                        <label class="control-label col-sm-2">Presidente / Gerente general:</label>
                        <div class="col-sm-3">
                            <input name="nombre_gerente" class="easyui-textbox" style="width:100%" required="true">
                        </div>
                        <label class="control-label col-sm-1">Teléfono:</label>
                        <div class="col-sm-2">
                            <input name="telefono_gerente" class="easyui-textbox" style="width:100%" required="true">
                        </div>
                        <label class="control-label col-sm-1">Email:</label>
                        <div class="col-sm-3">
                            <input name="email_gerente" class="easyui-textbox" style="width:100%" data-options="required: true, validType: 'email'">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Secretaria del Presidente / Gerente general:</label>
                        <div class="col-sm-3">
                            <input name="nombre_secretaria" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Teléfono:</label>
                        <div class="col-sm-2">
                            <input name="telefono_secretaria" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Email:</label>
                        <div class="col-sm-3">
                            <input name="email_secretaria" type="email" class="easyui-textbox" style="width:100%" data-options="validType: 'email'">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Gerente Financiero:</label>
                        <div class="col-sm-3">
                            <input name="nombre_financiero" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Teléfono:</label>
                        <div class="col-sm-2">
                            <input name="telefono_financiero" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Email:</label>
                        <div class="col-sm-3">
                            <input name="email_financiero" type="email" class="easyui-textbox" style="width:100%" data-options="validType: 'email'">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Director de Contabilidad:</label>
                        <div class="col-sm-3">
                            <input name="nombre_contador" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Teléfono:</label>
                        <div class="col-sm-2">
                            <input name="telefono_contador" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Email:</label>
                        <div class="col-sm-3">
                            <input name="email_contador" type="email" class="easyui-textbox" style="width:100%" data-options="validType: 'email'">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Director Tributario:</label>
                        <div class="col-sm-3">
                            <input name="nombre_tributario" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Teléfono:</label>
                        <div class="col-sm-2">
                            <input name="telefono_tributario" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Email:</label>
                        <div class="col-sm-3">
                            <input name="email_tributario" type="email" class="easyui-textbox" style="width:100%" data-options="validType: 'email'">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tesorero:</label>
                        <div class="col-sm-3">
                            <input name="nombre_tesorero" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Teléfono:</label>
                        <div class="col-sm-2">
                            <input name="telefono_tesorero" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Email:</label>
                        <div class="col-sm-3">
                            <input name="email_tesorero" type="email" class="easyui-textbox" style="width:100%" data-options="validType: 'email'">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Secretario o Director Jurídico:</label>
                        <div class="col-sm-3">
                            <input name="nombre_juridico" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Teléfono:</label>
                        <div class="col-sm-2">
                            <input name="telefono_juridico" class="easyui-textbox" style="width:100%">
                        </div>
                        <label class="control-label col-sm-1">Email:</label>
                        <div class="col-sm-3">
                            <input name="email_juridico" type="email" class="easyui-textbox" style="width:100%" data-options="validType: 'email'">
                        </div>
                    </div>
                    
                    
                    <div class="titulo_formulario" style="margin-top: 30px; margin-bottom: 15px;">Accionistas</div>
                    <div class="alert alert-info">
                        Por favor relacione los accionistas o asociados  que tengan directa o indirectamente mas del 5% del capital social, aporte o participación
                    </div>
                    <div class="table-responsive">
                        <table id="dg-accionistas" class="easyui-datagrid" title="Accionistas" footer="#ft-accionistas" style="width:100%;height:auto;" toolbar="#tb-accionistas" fitColumns="true" singleSelect="true" idField="id">
                            <thead>
                                <tr>
                                    <th data-options="field:'tipo_id',resizable:true, align:'center',
                                        editor:{
                                            type:'combobox',
                                            options:{
                                                valueField:'cod_tipoid',
                                                textField:'nom_tipoid',
                                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                                required:true,
                                                queryParams: {campo: 'tipos_ids'}
                                            }
                                        }" width="10%">Tipo ID</th> 
                                    <th data-options="field:'numero_id',resizable:true, align:'center',
                                        editor:{
                                            type:'textbox',
                                            options:{
                                                required:true
                                            }
                                        }" width="12%">Número ID</th>
                                    <th data-options="field:'nombre',resizable:true, align:'center',
                                        editor:{
                                            type:'textbox',
                                            options:{
                                                required:true
                                            }
                                        }" width="20%">Nombre</th>
                                    <th data-options="field:'participacion',resizable:true, align:'center',
                                        editor:{
                                            type:'numberbox',
                                            options:{
                                                required:true,
                                                min: 0,
                                                max: 100,
                                                precision: 2
                                            }
                                        }" width="7%">%<br />Participación</th>
                                    <th data-options="field:'recursos_publicos_socio',resizable:true, align:'center',editor:{type:'checkbox',options:{on:'Si',off:'No'}}" width="8%">¿Por su cargo<br />o actividad,<br />maneja<br />recursos<br /> públicos?</th>
                                    <th data-options="field:'poder_publico_socio',resizable:true, align:'center',editor:{type:'checkbox',options:{on:'Si',off:'No'}}" width="10%">¿Por su cargo<br />o actividad<br />ejerce algún grado<br /> de poder público?</th>
                                    <th data-options="field:'reconocimiento_publico_socio',resizable:true, align:'center',editor:{type:'checkbox',options:{on:'Si',off:'No'}}" width="10%">¿Por su<br /> actividad u oficio,<br /> goza de<br />reconocimiento<br /> público en general?</th>
                                    <th data-options="field:'declara_otropais_socio',resizable:true, align:'center',editor:{type:'checkbox',options:{on:'Si',off:'No'}}" width="10%">¿Está obligado a<br />declaración<br /> tributaria<br />en otro país?<br />Indique cual</th>
                                    <th data-options="field:'pais_declaracion',resizable:true, align:'center',
                                        editor:{
                                            type:'combobox',
                                            options:{
                                                valueField:'cod_pais',
                                                textField:'nom_pais',
                                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                                required:true,
                                                queryParams: {campo: 'paises', excluir: 1},
                                                disabled: true
                                            }
                                        }" width="14%">País donde<br />está obligado a<br />declaración tributaria</th> 
                                </tr>
                            </thead>
                        </table>    
                        <div id="tb-accionistas">
                            <button type="button" class="btn btn-xs btn-default easyui-tooltip" title="Haga click aquí </br>para insertar un accionista" onclick="javascript:$('#dg-accionistas').edatagrid('addRow')">Agregar <span class="glyphicon glyphicon-plus"></span></button>
                            <button type="button" class="btn btn-xs btn-default easyui-tooltip" title="Seleccione el registro que desea eliminar" onclick="javascript:$('#dg-accionistas').edatagrid('destroyRow')">Eliminar <span class="glyphicon glyphicon-minus"></span></button>
                        </div>
                        <div id="ft-accionistas">
                            <div style="text-align: center;">
                                <button type="button" class="btn btn-primary btn-xs" onclick="javascript:$('#dg-accionistas').edatagrid('saveRow')">Aceptar</button>
                                <button type="button" class="btn btn-default btn-xs" onclick="javascript:$('#dg-accionistas').edatagrid('cancelRow')">Cancelar</button>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="titulo_formulario" style="margin-top: 30px;">Información Financiera</div>
                    <div class="form-group" style="padding-top: 15px;">
                        <label class="control-label col-sm-3">Ingresos mensuales (Pesos):</label>
                        <div class="col-sm-3">
                            <input name="ingresos" class="easyui-numberbox" style="width:100%" data-options="
                                   min: 0,
                                   precision: 2,
                                   prefix: '$ ',
                                   groupSeparator: ','">
                        </div>
                        <label class="control-label col-sm-3">Egresos mensuales (Pesos):</label>
                        <div class="col-sm-3">
                            <input name="egresos" class="easyui-numberbox" style="width:100%" data-options="
                                   min: 0,
                                   precision: 2,
                                   prefix: '$ ',
                                   groupSeparator: ','">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Activos (Pesos):</label>
                        <div class="col-sm-3">
                            <input name="activos" class="easyui-numberbox" style="width:100%" data-options="
                                   min: 0,
                                   precision: 2,
                                   prefix: '$ ',
                                   groupSeparator: ','">
                        </div>
                        <label class="control-label col-sm-3">Pasivos (Pesos):</label>
                        <div class="col-sm-3">
                            <input name="pasivos" class="easyui-numberbox" style="width:100%" data-options="
                                   min: 0,
                                   precision: 2,
                                   prefix: '$ ',
                                   groupSeparator: ','">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Otros ingresos mensuales:</label>
                        <div class="col-sm-3">
                            <input name="otros_ingresos" class="easyui-numberbox" style="width:100%" data-options="
                                   min: 0,
                                   precision: 2,
                                   prefix: '$ ',
                                   groupSeparator: ','">
                        </div>
                        <label class="control-label col-sm-3">Concepto:</label>
                        <div class="col-sm-3">
                            <input name="concepto_otros_ingresos" class="easyui-textbox" style="width:100%">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">¿Es gran contribuyente?</label>
                        <div class="col-sm-3">
                            <div style="display:inline">
                                <input type="radio" name="contribuyente" id="radio_gran_contribuyente" value="1"> Sí
                                <input type="radio" name="contribuyente" id="radio_no_contribuyente" style="margin-left:10px" value="0" checked>No<br>
                            </div>
                        </div>
                        <label class="control-label col-sm-3">Autoretenedor:</label>
                        <div class="col-sm-2">
                            <div style="display:inline">
                                <input type="radio" name="autoretenedor" id="radio_si_retiene" value="1"> Sí
                                <input type="radio" name="autoretenedor" id="radio_no_retiene" style="margin-left:10px" value="0" checked>No<br>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Declarante de renta:</label>
                        <div class="col-sm-3">
                            <div style="display:inline">
                                <input type="radio" name="declarante" id="radio_si_declara" value="1"> Sí
                                <input type="radio" name="declarante" id="radio_no_declara" style="margin-left:10px" value="0" checked>No<br>
                            </div>
                        </div>
                        <label class="control-label col-sm-3">Tarifa ICA:</label>
                        <div class="col-sm-2">
                            <input name="tarifa_ica" class="easyui-numberbox" style="width:100%" data-options="
                                   min: 0,
                                   max: 100,
                                   precision: 2,
                                   suffix: ' %'">
                        </div>
                    </div>
                    
                    
                    <div class="titulo_formulario" style="margin-top: 30px; margin-bottom: 10px;">Origen de fondos</div>
                    <div class="col-sm-6">
                        <p>1. Declaro expresamente que la actividad, profesión u oficio de la compañía es lícita y se ejerce dentro del marco legal y los recursos de la misma no provienen de actividades ilícitas de las contempladas en el Código Penal Colombiano. </p>
                        <p>2. Los recursos que posee la compañía provienen de la(s) actividad(es) anteriormente descritas.</p>
                    </div>
                    <div class="col-sm-6">
                        <p>3. La información suministrada en la solicitud y en este documento es veraz y verificable y la sociedad se compromete a actualizarla anualmente.</p>
                        <p>4. Los recursos que se deriven del desarrollo de este contrato no se destinarán a la financiación del terrorismo, grupos terroristas o actividades terroristas.</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Origen fondos:</label>
                        <div class="col-sm-10">
                            <input name="origen_fondos" class="easyui-textbox" style="width:100%">
                        </div>
                    </div>
                    
                    
                    <div class="titulo_formulario" style="margin-top: 30px; margin-bottom: 15px;">Referencias comerciales</div>
                    <div class="table-responsive">
                        <table id="dg-comerciales" class="easyui-datagrid" title="Referencias comerciales" footer="#ft-comerciales" style="width:100%;height:auto;" toolbar="#tb-comerciales" fitColumns="true" singleSelect="true" idField="id">
                            <thead>
                                <tr>
                                    <th data-options="field:'empresa',resizable:true,            
                                        editor:{
                                            type:'textbox',
                                            options:{
                                                required:true
                                            }
                                        }" width="22%">Empresa</th> 
                                    <th data-options="field:'direccion',resizable:true,
                                        editor:{
                                            type:'textbox',
                                            options:{
                                                required:true
                                            }
                                        }" width="22%">Dirección</th>
                                    <th data-options="field:'contacto',resizable:true,
                                        editor:{
                                            type:'textbox',
                                            options:{
                                                required:true
                                            }
                                        }" width="22%">Contacto</th>
                                    <th data-options="field:'email',resizable:true,
                                        editor:{
                                            type:'textbox',
                                            options:{
                                                required:true,
                                                validType: 'email'
                                            }
                                        }" width="22%">Email</th>
                                    <th data-options="field:'telefono',resizable:true,
                                        editor:{
                                            type:'textbox',
                                            options:{
                                                required:true
                                            }
                                        }" width="12%">Teléfono</th>
                                </tr>
                            </thead>
                        </table>    
                        <div id="tb-comerciales">
                            <button type="button" class="btn btn-xs btn-default easyui-tooltip" title="Haga click aquí </br>para insertar un referencia" onclick="javascript:$('#dg-comerciales').edatagrid('addRow')">Agregar <span class="glyphicon glyphicon-plus"></span></button>
                            <button type="button" class="btn btn-xs btn-default easyui-tooltip" title="Seleccione el registro que desea eliminar" onclick="javascript:$('#dg-comerciales').edatagrid('destroyRow')">Eliminar <span class="glyphicon glyphicon-minus"></span></button>
                        </div>
                        <div id="ft-comerciales">
                            <div style="text-align: center;">
                                <button type="button" class="btn btn-primary btn-xs" onclick="javascript:$('#dg-comerciales').edatagrid('saveRow')">Aceptar</button>
                                <button type="button" class="btn btn-default btn-xs" onclick="javascript:$('#dg-comerciales').edatagrid('cancelRow')">Cancelar</button>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="titulo_formulario" style="margin-top: 30px;; margin-bottom: 15px;">Referencias bancarias</div>
                    <div class="table-responsive">
                        <table id="dg-bancarias" class="easyui-datagrid" title="Referencias bancarias" footer="#ft-refbancarias" style="width:100%;height:auto;" toolbar="#tb-refbancarias" fitColumns="true" singleSelect="true" idField="id">
                            <thead>
                                <tr>
                                    <th data-options="field:'banco',resizable:true,
                                        editor:{
                                            type:'combobox',
                                            options:{
                                                valueField:'cod_banco',
                                                textField:'nom_banco',
                                                url:'<?=base_url()?>index.php/filtroscombos/getLista_valores',
                                                required:true,
                                                queryParams: {campo: 'bancos'}
                                            }
                                        }" width="22%">Banco</th> 
                                    <th data-options="field:'tipo_cuenta',resizable:true,
                                        editor:{
                                            type:'textbox',
                                            options:{
                                                required:true
                                            }
                                        }" width="22%">Tipo de cuenta</th>
                                    <th data-options="field:'numero_cuenta',resizable:true,
                                        editor:{
                                            type:'textbox',
                                            options:{
                                                required:true
                                            }
                                        }" width="22%">No. de cuenta</th>
                                    <th data-options="field:'sucursal',resizable:true,
                                        editor:{
                                            type:'textbox',
                                            options:{
                                                required:true
                                            }
                                        }" width="22%">Sucursal</th>
                                    <th data-options="field:'telefono',resizable:true,
                                        editor:{
                                            type:'textbox',
                                            options:{
                                                required:true
                                            }
                                        }" width="12%">Teléfono</th>
                                </tr>
                            </thead>
                        </table>
                        <div id="tb-refbancarias">
                            <button type="button" class="btn btn-xs btn-default easyui-tooltip" title="Haga click aquí </br>para insertar un referencia" onclick="javascript:$('#dg-bancarias').edatagrid('addRow')">Agregar <span class="glyphicon glyphicon-plus"></span></button>
                            <button type="button" class="btn btn-xs btn-default easyui-tooltip" title="Seleccione el registro que desea eliminar" onclick="javascript:$('#dg-bancarias').edatagrid('destroyRow')">Eliminar <span class="glyphicon glyphicon-minus"></span></button>
                        </div>
                        <div id="ft-refbancarias">
                            <div style="text-align: center;">
                                <button type="button" class="btn btn-primary btn-xs" onclick="javascript:$('#dg-bancarias').edatagrid('saveRow')">Aceptar</button>
                                <button type="button" class="btn btn-default btn-xs" onclick="javascript:$('#dg-bancarias').edatagrid('cancelRow')">Cancelar</button>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="titulo_formulario" style="margin-top: 30px; margin-bottom: 15px;">Documentación requerida</div>
                    <div class="alert alert-info">
                        Por favor adjunte la documentación en archivos PDF.
                    </div>
                    <div class="form-group" id="estados_financieros_container">
                        <label class="control-label col-sm-5">1. Estados financieros comparativos del ultimo periodo contable:</label>
                        <div class="col-sm-5">
                            <input type="file" name="estados_financieros" id="estados_financieros" required="true" style="width:100%;" />
                        </div>
                        <div class="col-sm-2">
                            <a id="btn_descargar_estados_financieros" class="easyui-linkbutton"  href="javascript:void(0)" style="display: none;" data-options="onClick(){descargarArchivo('est');}">Descargar</a>
                        </div>
                    </div>
                    <div class="form-group" id="cedula_representante_container">
                        <label class="control-label col-sm-5">2. Fotocopia de la cedula del representante legal:</label>
                        <div class="col-sm-5">
                            <input type="file" name="cedula_representante" id="cedula_representante" required="true" style="width:100%;" />
                        </div>
                        <div class="col-sm-2">
                            <a id="btn_descargar_cedula_representante" class="easyui-linkbutton"  href="javascript:void(0)" style="display: none;" data-options="onClick(){descargarArchivo('ccr');}">Descargar</a>
                        </div>
                    </div>
                    <div class="form-group" id="declaracion_renta_container">
                        <label class="control-label col-sm-5">3. Declaracion de renta del ultimo periodo gravable:</label>
                        <div class="col-sm-5">
                            <input type="file" name="declaracion_renta" id="declaracion_renta" required="true" style="width:100%;" />
                        </div>
                        <div class="col-sm-2">
                            <a id="btn_descargar_declaracion_renta" class="easyui-linkbutton"  href="javascript:void(0)" style="display: none;" data-options="onClick(){descargarArchivo('ren');}">Descargar</a>
                        </div>
                    </div>
                    <div class="form-group" id="rut_container">
                        <label class="control-label col-sm-5">4. Copia del Rut actualizado:</label>
                        <div class="col-sm-5">
                            <input type="file" name="rut" id="rut" required="true" style="width:100%;" />
                        </div>
                        <div class="col-sm-2">
                            <a id="btn_descargar_rut" class="easyui-linkbutton"  href="javascript:void(0)"  style="display: none;" data-options="onClick(){descargarArchivo('rut');}">Descargar</a>
                        </div>
                    </div>
                    <div class="form-group" id="camara_comercio_container">
                        <label class="control-label col-sm-5">5. Certificado camara de comercio no mayor a 30 dias:</label>
                        <div class="col-sm-5">
                            <input type="file" name="camara_comercio" id="camara_comercio" required="true" style="width:100%;" />
                        </div>
                        <div class="col-sm-2">
                            <a id="btn_descargar_camara_comercio" class="easyui-linkbutton"  href="javascript:void(0)" style="display: none;" data-options="onClick(){descargarArchivo('cam');}">Descargar</a>
                        </div>
                    </div>
                    
                    
                    <div class="titulo_formulario" style="margin-top: 30px; margin-bottom: 15px;">Autorización</div>
                    <p style="text-align: justify;">Yo <input name="nombre_autorizacion" class="easyui-textbox" style="width:250px" required="true">, identificado con <input name="tipoid_autorizacion" class="easyui-combobox" style="width:80px" required="true" data-options="url:'<?=base_url()?>index.php/filtroscombos/getLista_valores', valueField: 'cod_tipodoc', textField: 'nom_tipodoc', queryParams:{campo: 'tipodoc'}, limitToList:true"> No. <input name="numid_autorizacion" class="easyui-textbox" style="width:130px" required="true" > de <input name="lugarid_autorizacion" class="easyui-combobox" style="width:130px" required="true" data-options="url:'<?=base_url()?>index.php/filtroscombos/getLista_valores', valueField: 'cod_ciudad', textField: 'nom_ciudad', queryParams:{campo: 'ciudades'}, limitToList:true">, actuando en nombre propio y/o en representación legal de la sociedad <input name="sociedad_autorizacion" class="easyui-textbox" style="width:250px" required="true">, identificada con Nit No. <input name="nit_autorizacion" class="easyui-textbox" style="width:130px" required="true">, autorizo para que se consulte en cualquier momento en las centrales de riesgo y/o cualquier fuente, toda la informacion relevante para conocer mi desempeño y el de dicha sociedad como deudor, capacidad de pago, viabilidad para entablar o mantener una relacion contractual, o para cualquier otra finalidad.</p>
                    <p style="text-align: justify;">
                        En cumplimiento de lo establecido en el Articulo 10 del Decreto 1377 de 2013 que reglamentó la Ley 1581 de 2012 "Por la cual se dictan disposiciones sobre el manejo de informacion personal y bases de datos"; se autoriza a Crowe Co S.A. a procesar, almacenar, y mantener actualizada la información referente a nuestra razón social de conformidad con las politicas de Crowe Co S.A. publicadas en la pagina web www.crowehorwath.net/co/.
                    </p>
                    <div class="form-group" style="padding-top: 20px;">
                        <label class="control-label col-sm-5">Autorizo el uso de la información a Crowe Co S.A.</label>
                        <div class="col-sm-1">
                                <input type="checkbox" name="autorizo" id="autorizo">
                        </div>
                    </div>
                </form>
                <div style="width: 100%; margin: auto;" class="row">
                    <div class="col-sm-3 col-sm-offset-2 col-lg-3 col-lg-offset-3" style="padding-top: 15px;">
                        <div style="width: 150px; margin: auto;">
                            <a id="butGuardar-sarlaft" href="javascript:void(0)" onclick="guardarSarlaft()" class="easyui-linkbutton" iconCls="icon-save" style="width:100%">Guardar</a>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-2 col-lg-3 col-lg-offset-0" style="padding-top: 15px;">
                        <div style="width: 180px; margin: auto; display: none;" class="container-descargar-sarlaft">
                            <a id="butDescargar-sarlaft" href="javascript:void(0)" onclick="descargarSarlaft()" class="easyui-linkbutton" iconCls="icon-print" style="width:100%;">Descargar formulario</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="container-carga-sarlaft" style="width: 100%; margin-top: 50px; margin-bottom: 30px;">
                <div class="panel panel-primary" style="width: 85%; margin: auto; clear: both;">
                    <div class="panel-heading">Carga del documento firmado</div>
                    <div class="panel-body" style="padding-bottom: 20px;">
                        <div class="alert alert-warning" style="margin: 10px 10px 20px 10px;">
                            Por favor descargue el PDF, imprimalo y firmelo para posteriormente enviar el archivo escaneado.
                        </div>
                        <!-- <div class="alert alert-warning" style="margin: 10px 10px 20px 10px;">
                            Por favor descargue el PDF, imprimalo y firmelo para posteriormente cargar el archivo escaneado.
                        </div> -->
                        <div class="form-group" hidden>
                            <label class="control-label col-sm-4 col-md-3" style="text-align: right;">Formulario firmado:</label>
                            <div class="col-sm-5 col-md-7">
                                <input type="file" name="form_firmado" id="form_firmado" required="true" style="width:100%;" />
                            </div>
                            <div class="col-sm-3 col-md-2">
                                <a id="btn_cargar_form_firmado" class="easyui-linkbutton" iconCls="icon-ok" href="javascript:void(0)" style="width: 100px;" data-options="onClick(){cargarPDF_firmado();}, disabled: true">Cargar</a>
                            </div>
                        </div>
                        <div hidden id="container-descarga-firmado" style="width: 100%; margin: auto; padding-top: 20px; display: none;">
                            <div style="width: 150px; margin: auto;">
                                <a id="btn_descargar_form_firmado" class="easyui-linkbutton" iconCls="icon-more" href="javascript:void(0)" style="width: 100%;" data-options="onClick(){descargarPDF_firmado();}, disabled: true">Descargar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="dlg-datospersonales-sarlaft" class="easyui-dialog" style="width:500px;height:500px;padding:10px 20px" closed="false" title="Tratamiento de datos personales" buttons="#dlg-datospersonales-sarlaft-buttons">
        <div class="ftitle" style="margin-top:10px">AUTORIZACIÓN PARA EL TRATAMIENTO DE DATOS PERSONALES</div>
        <div style="clear: both; padding-top: 10px;">
            <p>Crowe Co S.A. en cumplimiento a lo establecido en la Ley 1581 de 2012, reglamentada por el decreto 1377 de 2013, y la política para el manejo y protección de datos personales de sus clientes, proveedores y empleados, así como de aquellas personas con las cuales constituya relaciones comerciales en el ejercicio de su actividad, requiere que usted por medio de la aceptación, autorice de manera voluntaria a esta compañía para que conozca, actualice y rectifique con fines estadísticos, de control, cumplimiento normativo en prevención de riesgos de lavado de activos, y los demás fines relacionados con su objeto social, los datos que han sido suministrados y que se han incorporado en distintas bases de datos con que cuenta la compañía.</p><br>
            <p>Leído lo anterior, autorizo a Crowe Co S.A. de manera expresa e inequívoca para el tratamiento de mis datos personales de conformidad con las finalidades legales, contractuales, comerciales y las aquí contempladas. Confirmo que la información del siguiente formulario, la he suministrado de forma voluntaria y es verídica.</p>
        </div> 
    </div>
    <div id="dlg-datospersonales-sarlaft-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="cerrarDatosPersonalesSarlaft()" style="width:90px">Aceptar</a>
    </div>
    <style type='text/css'>
        #dg-accionistas th {
            background-color: #002D62;
            color: white;
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
    <script type="text/javascript" src="<?=dirname(base_url())?>/js/jquery-easy-ui/datagrid-filter.js"></script>
    <script type="text/javascript" src="<?=dirname(base_url())?>/js/jquery-easy-ui/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="<?=dirname(base_url())?>/js/ajaxfileupload.js"></script>
    <script type="text/javascript">
        $(function(){
            $('input[type=radio][name=vinculo_publico]').change(function() {
                if (this.value == 0) {
                    $(".tipo_vinculo").hide();
                    $("#tipo_vinculo").textbox('disable');
                }
                else if (this.value == 1) {
                    $(".tipo_vinculo").show();
                    $("#tipo_vinculo").textbox('enable');
                }
            });
            
            
            $("#fm-sarlaft").form({
                url: '<?=base_url()?>index.php/sarlaft/editInfo',
                onSubmit: function(){
                    if (! $("#autorizo").is(":checked"))
                    {
                        $.messager.alert({
                            title: 'Error',
                            msg: 'Debe autorizar a Crowe a utilizar su información.'
                        });
                        
                        return false;
                    }
                    return $(this).form('enableValidation').form('validate');
                },
                success: function(data){
                    var data = eval('(' + data + ')');
                    $(this).form('disableValidation');
                    if (data.success)
                    {
                        $.messager.alert({
                            title: 'Operación exitosa',
                            msg: 'La información fue guardada.'
                        });
                        
                        $('#butDescargar-sarlaft').linkbutton('enable');
                        $('.container-descargar-sarlaft').show();
                        $('#container-carga-sarlaft').show();
                        
                        if (data.rut)
                        {
                            $('#btn_descargar_rut').linkbutton('enable');
                            $('#btn_descargar_rut').show();
                        }
                        
                        if (data.camara)
                        {
                            $('#btn_descargar_camara_comercio').linkbutton('enable');
                            $('#btn_descargar_camara_comercio').show();
                        }
                        
                        if (data.estados)
                        {
                            $('#btn_descargar_estados_financieros').linkbutton('enable');
                            $('#btn_descargar_estados_financieros').show();
                        }
                        
                        if (data.cedula)
                        {
                            $('#btn_descargar_cedula_representante').linkbutton('enable');
                            $('#btn_descargar_cedula_representante').show();
                        }
                        
                        if (data.declaracion)
                        {
                            $('#btn_descargar_declaracion_renta').linkbutton('enable');
                            $('#btn_descargar_declaracion_renta').show();
                        }
                    }
                    else
                    {
                        $.messager.alert({    // show error message
                            title: 'Error',
                            msg: 'No fue posible guardar su información ' + data.msg
                        });
                    }
                },
                onLoadSuccess: function(data){
                    //data = jQuery.parseJSON(data);
                    if (data.success)
                    {
                        if (data.formulario_activo != '1')
                        {
                            $('#fm-sarlaft .easyui-datebox').datebox('disable');
                            $('#fm-sarlaft .easyui-combobox').combobox('disable');
                            $('#fm-sarlaft .easyui-numberbox').numberbox('disable');
                            $('#fm-sarlaft .easyui-textbox:not(.not-editable)').textbox('disable');
                            $('#fm-sarlaft .easyui-linkbutton').linkbutton('disable');
                            $('#fm-sarlaft button').prop('disabled', true);
                            $('#fm-sarlaft input[type=file]').prop('disabled', true);
                            $('#fm-sarlaft input[type=radio]').prop('disabled', true);
                            $('#fm-sarlaft input[type=checkbox]').prop('disabled', true);
                            $('#butGuardar-sarlaft').linkbutton('disable');
                            $('#container-carga-sarlaft input').prop('disabled', true);
                        }
                        else
                        {
                            $('#fm-sarlaft .easyui-datebox').datebox('enable');
                            $('#fm-sarlaft .easyui-combobox').combobox('enable');
                            $('#fm-sarlaft .easyui-numberbox').numberbox('enable');
                            $('#fm-sarlaft .easyui-textbox:not(.not-editable)').textbox('enable');
                            $('#fm-sarlaft .easyui-linkbutton').linkbutton('enable');
                            $('#fm-sarlaft button').prop('disabled', false);
                            $('#fm-sarlaft input[type=file]').prop('disabled', false);
                            $('#fm-sarlaft input[type=radio]').prop('disabled', false);
                            $('#fm-sarlaft input[type=checkbox]').prop('disabled', false);
                            $('#butGuardar-sarlaft').linkbutton('enable');
                            $('#container-carga-sarlaft input').prop('disabled', false);
                        }
                        
                        if (data.id_rut != null)
                        {
                            $('#btn_descargar_rut').linkbutton('enable');
                            $('#btn_descargar_rut').show();
                        }
                        else
                        {
                            $('#btn_descargar_rut').linkbutton('disable');
                            $('#btn_descargar_rut').hide();
                        }
                        
                        if (data.id_camara != null)
                        {
                            $('#btn_descargar_camara_comercio').linkbutton('enable');
                            $('#btn_descargar_camara_comercio').show();
                        }
                        else
                        {
                            $('#btn_descargar_camara_comercio').linkbutton('disable');
                            $('#btn_descargar_camara_comercio').hide();
                        }
                        
                        if (data.id_estados != null)
                        {
                            $('#btn_descargar_estados_financieros').linkbutton('enable');
                            $('#btn_descargar_estados_financieros').show();
                        }
                        else
                        {
                            $('#btn_descargar_estados_financieros').linkbutton('disable');
                            $('#btn_descargar_estados_financieros').hide();
                        }
                        
                        if (data.id_ccrepresentante != null)
                        {
                            $('#btn_descargar_cedula_representante').linkbutton('enable');
                            $('#btn_descargar_cedula_representante').show();
                        }
                        else
                        {
                            $('#btn_descargar_cedula_representante').linkbutton('disable');
                            $('#btn_descargar_cedula_representante').hide();
                        }
                        
                        if (data.id_renta != null)
                        {
                            $('#btn_descargar_declaracion_renta').linkbutton('enable');
                            $('#btn_descargar_declaracion_renta').show();
                        }
                        else
                        {
                            $('#btn_descargar_declaracion_renta').linkbutton('disable');
                            $('#btn_descargar_declaracion_renta').hide();
                        }
                        
                        if (data.pdf == '1')
                        {
                            $('#butDescargar-sarlaft').linkbutton('enable');
                            $('.container-descargar-sarlaft').show();
                            $('#container-carga-sarlaft').show();
                        }
                        else
                        {
                            $('#butDescargar-sarlaft').linkbutton('disable');
                            $('.container-descargar-sarlaft').hide();
                            $('#container-carga-sarlaft').hide();
                        }
                        
                        if (data.pdf_firmado == '1')
                        {
                            $('#btn_descargar_form_firmado').linkbutton('enable');
                            $('#container-descarga-firmado').show();
                        }
                        else
                        {
                            $('#btn_descargar_form_firmado').linkbutton('disable');
                            $('#container-descarga-firmado').hide();
                        }
                        
                        if (data.vinculo_publico == "1")
                        {
                            $("#tipo_vinculo").textbox('enable');
                            $(".tipo_vinculo").show();
                        }
                        else
                        {
                            $("#tipo_vinculo").textbox('disable');
                            $(".tipo_vinculo").show();
                        }
                    }
                    else
                    {
                        $.messager.alert({    // show error message
                            title: 'Error',
                            msg: 'No fue posible cargar su información ' + data.msj
                        });
                    }
                }
            });
            
            $("#fm-sarlaft").form('load', '<?=base_url()?>index.php/sarlaft/getInfo');
            

            $("#dg-accionistas").edatagrid({
                url: '<?=base_url()?>index.php/sarlaft/getAccionistas',
                saveUrl: '<?=base_url()?>index.php/sarlaft/guardarAccionista',
                updateUrl: '<?=base_url()?>index.php/sarlaft/editarAccionista',
                destroyUrl: '<?=base_url()?>index.php/sarlaft/eliminarAccionista',
                
                destroyMsg:{
                    norecord:{  // when no record is selected
                        title:'Advertencia',
                        msg:'No hay ningún registro seleccionado'
                    },
                    confirm:{   // when select a row
                        title:'Confirmación',
                        msg:'¿Está seguro de eliminar el registro?'
                    }
                },
                onError: function(index, row){
                    $.messager.alert('Error',row.msg,'error');
                    //alert(row.msg);
                },
                onBeginEdit: function(index, row){
                    var editor_id = $('#dg-accionistas').edatagrid('getEditor', {
                            index: index,
                            field: 'tipo_id'
                    });
                    
                    $(editor_id.target).combobox('setValue', row.cod_tipoid);
                    
                    var editor_declara = $('#dg-accionistas').edatagrid('getEditor', {
                            index: index,
                            field: 'declara_otropais_socio'
                    });
                    
                    var editor_pais = $('#dg-accionistas').edatagrid('getEditor', {
                            index: index,
                            field: 'pais_declaracion'
                    });
                    
                    if ($(editor_declara.target).is(':checked'))
                    {
                        $(editor_pais.target).combobox('enable');
                        $(editor_pais.target).combobox('setValue', row.cod_pais);
                    }
                    else
                    {
                        $(editor_pais.target).combobox('disable');
                        $(editor_pais.target).combobox('clear');
                    }
                    
                    $(editor_declara.target).change(function(){
                        if (this.checked)
                        {
                            $(editor_pais.target).combobox('enable');
                        }
                        else
                        {
                            $(editor_pais.target).combobox('disable');
                        }
                    });
                }
            });
            
            
            $("#dg-comerciales").edatagrid({
                url: '<?=base_url()?>index.php/sarlaft/getReferencias_comerciales',
                saveUrl: '<?=base_url()?>index.php/sarlaft/guardarReferencia_comercial',
                updateUrl: '<?=base_url()?>index.php/sarlaft/editarReferencia_comercial',
                destroyUrl: '<?=base_url()?>index.php/sarlaft/eliminarReferencia_comercial',
                
                destroyMsg:{
                    norecord:{  // when no record is selected
                        title:'Advertencia',
                        msg:'No hay ningún registro seleccionado'
                    },
                    confirm:{   // when select a row
                        title:'Confirmación',
                        msg:'¿Está seguro de eliminar el registro?'
                    }
                },
                onError: function(index, row){
                    $.messager.alert('Error',row.msg,'error');
                    //alert(row.msg);
                }
            });
            
            
            $("#dg-bancarias").edatagrid({
                url: '<?=base_url()?>index.php/sarlaft/getReferencias_bancarias',
                saveUrl: '<?=base_url()?>index.php/sarlaft/guardarReferencia_bancaria',
                updateUrl: '<?=base_url()?>index.php/sarlaft/editarReferencia_bancaria',
                destroyUrl: '<?=base_url()?>index.php/sarlaft/eliminarReferencia_bancaria',
                
                destroyMsg:{
                    norecord:{  // when no record is selected
                        title:'Advertencia',
                        msg:'No hay ningún registro seleccionado'
                    },
                    confirm:{   // when select a row
                        title:'Confirmación',
                        msg:'¿Está seguro de eliminar el registro?'
                    }
                },
                onError: function(index, row){
                    $.messager.alert('Error',row.msg,'error');
                    //alert(row.msg);
                },
                onBeginEdit: function(index, row){
                    var editor_id = $('#dg-bancarias').edatagrid('getEditor', {
                            index: index,
                            field: 'banco'
                    });
                    
                    $(editor_id.target).combobox('setValue', row.cod_banco);
                }
            });

            $("#form_firmado").change(function(){
                $("#btn_cargar_form_firmado").linkbutton('enable');
            });
        });
        
        
        function guardarSarlaft(){
            $('#fm-sarlaft').form('submit');
        }


        function guardar()
        {
            row = $('#dg').datagrid('getSelected');
            $("#form-solicitud").form({
                queryParams: {id: row.id_consul}
            }).form('submit');
            $("#dlg-consulta").dialog('close');
        }
        
        function descargarArchivo(archivo)
        {
            $.ajax({
                type: "POST",
                data: {
                    id: archivo
                },
                url: '<?=base_url()?>index.php/sarlaft/getArchivo',
                success: function(data){
                    response = jQuery.parseJSON(data);
                    if (response.success)
                        window.location.assign('<?=base_url()?>index.php/sarlaft/getArchivo_download/' + archivo); 
                    else
                    {
                        $.messager.alert({    // show error message
                            title: 'Error',
                            msg: response.msg
                        });
                        //alert("Error:\n" + response.msj);
                    }
                }
            });
        }
        
        function cerrarDatosPersonalesSarlaft(){
            $('#dlg-datospersonales-sarlaft').dialog('close');            
        }
        
        
        function descargarSarlaft(){
            $.ajax({
                type: "POST",
                url: '<?=base_url()?>index.php/sarlaft/getPDF',
                success: function(data){
                    response = jQuery.parseJSON(data);
                    if (response.success)
                        window.location.assign('<?=base_url()?>index.php/sarlaft/getPDF_download'); 
                    else
                    {
                        $.messager.alert({    // show error message
                            title: 'Error',
                            msg: response.msg
                        });
                        //alert("Error:\n" + response.msj);
                    }
                }
            });
        }
        
        function cargarPDF_firmado()
        {
            $.ajaxFileUpload({
                url            : '<?= base_url();?>index.php/sarlaft/cargarPDF_firmado',
                secureuri      : false,
                fileElementId  : 'form_firmado',
                dataType       : 'json',
                success        : function (data, status){
                   if(data.success)
                   {
                        $.messager.alert({
                            title: 'Carga exitosa',
                            msg: "El archivo fue cargado de forma exitosa.\nMuchas gracias."
                        });
                   }
                   else
                   {
                        $.messager.alert({
                            title: 'Error',
                            msg: data.msg
                        });
                   }
                }
            });
        }

        function descargarPDF_firmado()
        {
            $.ajax({
                type: "POST",
                url: '<?=base_url()?>index.php/sarlaft/getPDF_firmado',
                success: function(data){
                    response = jQuery.parseJSON(data);
                    if (response.success)
                        window.location.assign('<?=base_url()?>index.php/sarlaft/getPDFfirmado_download'); 
                    else
                    {
                        $.messager.alert({    // show error message
                            title: 'Error',
                            msg: response.msg
                        });
                        //alert("Error:\n" + response.msj);
                    }
                }
            });
        }
        
        function formatEstado(val,row){
            if (val == 0)
                return 'Cancelada';
            if (val == 1)
                return 'Solucionada';
            else
                return 'Pendiente';
        }

        function formatoFecha(value, row)
        {
            return value.substring(0, 10);
        }

        function cellRight(value,row,index){
            return 'text-align:right;'
        }

        function formatHorasx(val,row){
            return formatMillar(Math.floor(val).toString())+","+(Math.round((val % 1)*10).toString());
        }
        function formatMillar(number){
            var result = '';
            while( number.length > 3 ){
                result = '.' + number.substr(number.length - 3) + result;
                number = number.substring(0, number.length - 3);
            }
            result = number + result;
            return result;
        }
        
        function formattersql(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
        }
        function parsersql(s){
            if (!s) return new Date();
            var ss = (s.split('-'));
            var y = parseInt(ss[0],10);
            var m = parseInt(ss[1],10);
            var d = parseInt(ss[2],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }
    </script>
    
    
  </body>
</html>