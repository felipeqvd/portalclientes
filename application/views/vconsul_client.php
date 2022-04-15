        <div id="page-content-wrapper" class="main">
              <h4 class="page-header">Consultas tributarias</h4>
              <div style="clear: both;"><div style="width: 150px; float:left; font-weight: bold;">Cliente</div><div style="width: 300px; float:left;"><?=$nom_client?></div></div>
              <div style="clear: both;">
                <div style="width: 150px; float:left; font-weight: bold;">Fecha de consulta </div>
                <div style="width: 300px; float:left;">
                    <script type="text/javascript">
                        var d = new Date();
                        document.write(d.getFullYear()+' / '+parseFloat(d.getMonth()+1)+' / '+d.getDate());
                    </script>
                </div>
              </div>
            <div class="easyui-tabs" data-options="justified:true" style="width:100%;height:auto;clear: both; padding-top: 10px;">
                <div title="Consultas realizadas" style="padding:10px">
                    <div class="table-responsive">
                        <div id="tb" style="padding:3px">
                            <div>
                            <form id="ff1" method="post">
                                <span style="padding-left: 15px;">Desde:</span>
                                <input id="dd" type="text" name="fec_desde" class="easyui-datebox">
                                <span style="padding-left: 25px;">Hasta:</span>
                                <input id="dh" type="text" name="fec_hasta" class="easyui-datebox">
                            </form>    
                            </div>
                        </div>

                        <table id="dg" class="easyui-datagrid" style="width:100%; height:auto;" pageSize="20" toolbar="#tb" singleSelect="true">
                            <thead>
                                <tr>
                                    <th data-options="field:'id',resizable:true" width="10%">Identificador</th>
                                    <th data-options="field:'titulo',resizable:true" width="30%">Título</th>
                                    <th data-options="field:'catego',resizable:true" width="20%">Categoria</th>
                                    <th data-options="field:'email',resizable:true" width="14%">Email</th>
                                    <th data-options="field:'fechax',resizable:true, align:'center'" width="12%">Fecha solicitud</th>
                                    <th data-options="field:'estado',resizable:true, align:'center', formatter: formatEstado" width="8%">Estado</th>
                                    <th data-options="field:'archivo',resizable:true, align:'center', formatter: formatoArchivo" width="6%">Archivo</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div title="Generar consulta" style="padding:10px">
                    <div class="table-responsive">
                        <div id="sc" style="width: 95%">
                            <div id="dialog_solicitar" class="easyui-dialog" title="Solicitud de consulta" style="width:400px;height:130px;padding:10px;">
                                <p id='dialog_text' style='text-align: center;'></p>
                                <div style="padding-top: 10px; margin: auto; width: 120px">
                                    <a href="javascript:void(0)" style="width: 100%" class="easyui-linkbutton" onclick="$('#dialog_solicitar').dialog('close')">Aceptar</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                                    <form id="ff_solicitar" method="post">
                                        <div style="padding-top: 20px; margin: auto;">
                                            <input id="titulo" class="easyui-textbox" name="titulo" style="width: 100%;"/>
                                        </div>
                                        <div style="padding-top: 20px; margin: auto;">
                                            <input id="tipo" class="easyui-combobox" name="tipo" style="width: 100%;" />
                                        </div>
                                        <div style="padding-top: 20px; margin: auto;">
                                            <input id="categoria" class="easyui-combobox" name="categoria" style="width: 100%;" />
                                        </div>
                                        <div style="padding-top: 20px; margin: auto;">
                                            <input id="email" class="easyui-textbox" name="email" style="width: 100%;" />
                                        </div>
                                        <div style="padding-top: 20px; margin: auto;">
                                            <input id="concepto" class="easyui-textbox" name="concepto" style="width: 100%;"/>
                                        </div>
                                        <div style="padding-top: 20px; padding-bottom: 20px; margin: auto; width: 150px">
                                            <a id="solicitar" href="#" class="easyui-linkbutton" style="width: 100%" onclick="doSolicitar()">Solicitar</a>
                                        </div>
                                    </form> 
                                </div>   
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="dlg-consulta" class="easyui-dialog" title= "Editar la consulta" style="width:700px; height: 700px; padding:10px 20px" closed="true" buttons="#dlg-buttons">
        <div style="width: 93%; margin: auto;">
            <h5 style="padding-right: 5px; font-weight: bold;">Identificador:</h5>
            <p id="dlg-id"></p>
            <hr>
            <h5 style="padding-right: 5px; font-weight: bold;">Fecha solicitud:</h5>
            <p id="dlg-fecha"></p>
            <hr>
            <h5 style="padding-right: 5px; font-weight: bold;">Cateogria:</h5>
            <p id="dlg-categoria"></p>
            <hr>
            <h5 style="padding-right: 5px; font-weight: bold;">Correo electrónico:</h5>
            <p id="dlg-email"></p>
            <hr>
            <h5 style="padding-right: 5px; font-weight: bold;">Titulo:</h5>
            <p id="dlg-titulo-db"></p>
            <hr>
            <!--
            <h5 style="padding-right: 5px; font-weight: bold;">Concepto:</h5>
            <p id="dlg-concepto"></p>-->
            <form id="form-solicitud" method="post">
                <!--<div class="form-group">
                    <label class="control-label" style="padding-right: 5px; font-weight: bold;">Titulo:</label>
                    <p id="dlg-titulo-db"></p>
                    <div>
                        <input id="dlg-titulo" name="dlg-titulo" class="easyui-textbox" style="width:100%">
                    </div>
                </div>
                <hr>-->
                <div class="form-group" style="padding-bottom: 20px;">
                    <label class="control-label"><h5 style="padding-right: 5px; font-weight: bold;">Consulta:</h5></label>
                    <p id="dlg-concepto-db"></p>
                    <div>
                        <input id="dlg-concepto" name="dlg-concepto" class="easyui-textbox" style="width:100%">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="dlg-buttons">
        <a id="butGuardar" href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="guardar()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-consulta').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script type="text/javascript" src="<?=dirname(base_url())?>/js/jquery-easy-ui/datagrid-filter.js"></script>
    <script type="text/javascript" src="<?=dirname(base_url())?>/js/jquery-easy-ui/datagrid-detailview.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#dialog_solicitar').dialog('close');
            $("#titulo").textbox({
                label: 'Titulo',
                labelPosition: 'top',
                required: true,
                type: 'text',
                validateOnCreate: false,
                missingMessage: 'Este campo no puede estar vacío',
                novalidate: true
            });
            
            $("#tipo").combobox({
                url: '<?=dirname(base_url())?>/json/tipo.json',
                valueField: 'cod_tipo',
                textField: 'nom_tipo',
                label: 'Tipo',
                labelPosition: 'top',
                required: true,
                validateOnCreate: false,
                missingMessage: 'Es necesario seleccionar un valor',
                novalidate: true
            });

            $("#categoria").combobox({
                url: '<?=base_url()?>index.php/consultasc/catego_consultas',
                valueField: 'cod_catego',
                textField: 'nom_catego',
                label: 'Categoria',
                labelPosition: 'top',
                required: true,
                validateOnCreate: false,
                missingMessage: 'Es necesario seleccionar un valor',
                novalidate: true
            });

            $("#email").textbox({
                label: 'Correo electrónico para notificaciones',
                labelPosition: 'top',
                required: true,
                type: 'text',
                validateOnCreate: false,
                missingMessage: 'Este campo no puede estar vacío',
                novalidate: true,
                validType:'email'
            });

            $("#concepto").textbox({
                label: 'Consulta',
                labelPosition: 'top',
                required: true,
                type: 'text',
                multiline: true,
                height: 300,
                validateOnCreate: false,
                missingMessage: 'Este campo no puede estar vacío',
                novalidate: true
            });

            $("#ff_solicitar").form({
                url: '<?=base_url()?>index.php/consultasc/genera_consulta',
                onSubmit: function(){
                    return $(this).form('enableValidation').form('validate');
                },
                success: function(data){
                    data = jQuery.parseJSON(data);
                    $(this).form('disableValidation');
                    if (data.status == 'success')
                    {
                        //alert('titulo: '+data.titulo+'\nCategoria: '+data.categoria);
                        $('#dialog_solicitar').dialog({
                            iconCls: 'icon-ok'
                        });
                        $('#dialog_text').text(''+data.msj);
                        $('#ff_solicitar').form('reset');

                        $("#tipo").combobox('reload');
                        $("#categoria").combobox('reload');
                    }
                    else if (data.status == 'error')
                    {
                        $('#dialog_solicitar').dialog({
                            iconCls: 'icon-no'
                        });
                        $('#dialog_text').text('Se produjo un error al generar la consulta<br />Error '+data.codigo+': '+data.msj);
                    }
                    else
                    {
                        $('#dialog_solicitar').dialog({
                            iconCls: 'icon-more'
                        });
                        $('#dialog_text').text('Se obtuvo una respuesta inesperada');
                    }

                    $('#dialog_solicitar').dialog('open');
                }
            });

            $("#form-solicitud").form({
                url: '<?=base_url()?>index.php/consultasc/editarConsulta',
                /*onSubmit: function(){
                    return $(this).form('validate');
                },*/
                success: function(data){
                    data = jQuery.parseJSON(data);
                    if (data.status == 'success')
                    {
                        $.messager.alert({    // show error message
                            title: 'Éxito',
                            msg: data.msj
                        });
                    }
                    else
                    {
                        $.messager.alert({    // show error message
                            title: 'Error',
                            msg: data.msj
                        });
                    }
                    //alert(data.status + ":\n" + data.msj);
                }
            });

        	var dg = $('#dg');
        	//dg.datagrid('loadData',[]);
        	//dg.datagrid({pagePosition : 'bottom'});
            dg.datagrid({pagePosition : 'bottom', 
                         pagination:true, 
                         remoteFilter : true,
                         clientPaging: false, 
                         showFooter : true, 
                         url: "<?=base_url()?>index.php/consultasc/getConsultas_pendientes",
                         onBeforeLoad: function(params){
                            if ( $('input[name=fec_desde]').val() != '')
                                params.fec_desde = $('input[name=fec_desde]').val();

                            if ( $('input[name=fec_hasta]').val() != '')
                                params.fec_hasta = $('input[name=fec_hasta]').val();
                         },
                         /*view: detailview,
                         detailFormatter: function(index,row){
                            return '<div class="detalle" style="width: 90%; padding-top: 10px; padding-bottom: 8px;"></div>'
                         },
                         onExpandRow: function(index, row){
                            var detalle = $(this).datagrid('getRowDetail', index).find('div.detalle');
                            detalle.panel({
                                height: 'auto',
                                border: false,
                                cache: false,
                                method: "post",
                                queryParams: {
                                    id: row.id_consul,
                                },
                                href: "<?=base_url()?>index.php/consultasc/getDetalle_consulta",
                                onload: function(){
                                    $('#dg').datagrid('fixDetailRowHeight', index);
                                    detalle.panel('resize', {
                                        height: 'auto'
                                    });
                                }
                            });
                            $('#dg').datagrid('fixDetailRowHeight', index);
                         },*/
                         onDblClickRow: function(index, row){
                            $("#dlg-consulta").dialog({
                                title: "Editar consulta " + row.id,
                                modal: true
                            });
                            /*
                            $("#dlg-titulo").textbox({
                                type: 'text',
                                validateOnCreate: false,
                                missingMessage: 'Este campo no puede estar vacío',
                                novalidate: true,
                                value: '',
                                icons: [{
                                    iconCls: 'icon-clear',
                                    handler: function(e){
                                        $(e.data.target).textbox('clear');
                                    }
                                }]
                            });
                            */

                            $("#dlg-concepto").textbox({
                                type: 'text',
                                validateOnCreate: false,
                                missingMessage: 'Este campo no puede estar vacío',
                                novalidate: true,
                                multiline: true,
                                height: 55,
                                value: '',
                                icons: [{
                                    iconCls: 'icon-clear',
                                    handler: function(e){
                                        $(e.data.target).textbox('clear');
                                    }
                                }]
                            });
                            
                            // REVISAR AQUI POR EL TEMA DE FILTRADO DEL PARAMETRO DEL GET

                            //$("#form-solicitud").form('load', '<?=base_url()?>index.php/consultasc/getConcepto_consulta/' + row.id_consul);
                            $.post('<?=base_url()?>index.php/consultasc/getConcepto_consulta', 
                                {id: row.id_consul}, 
                                function(result){
                                    data = jQuery.parseJSON(result);
                                    if (data.status == 'success'){
                                        $("#dlg-concepto-db").html(data.concepto);

                                    } else {
                                        $.messager.alert({    // show error message
                                            title: 'Error',
                                            msg: data.msj
                                        });
                                    }
                                });
                            $("#dlg-titulo-db").html(row.titulo);
                            $("#dlg-id").html(row.id);
                            $("#dlg-fecha").html(row.fechax);
                            $("#dlg-categoria").html(row.catego);
                            $("#dlg-email").html(row.email);

                            $("#dlg-consulta").dialog('open').dialog('center');
                         }
                     });
            /*
        	$('#dg').datagrid({
    			rowStyler:function(index,row){
        			if (row.socior != '<?php echo$usr_sociox;?>' && row.diaxxx != "TOTALES"){
            			return 'color:#cc0000;';
        			}
                    if (row.diaxxx == "TOTALES"){
            			return 'color:#030bcb;';
        			}
    			}
			});    
            */
            dg.datagrid('enableFilter', [{
                field:'id',
                type:'combobox',
                options:{
                    panelHeight:'200px',
                    valueField: 'cod_solici',
                    textField: 'idx_solici',
                    url:'<?=base_url()?>index.php/consultasc/ids_consultasSolicitadas',
                    onChange:function(value){
                        if (value == ''){
                            dg.datagrid('removeFilterRule', 'id');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'id',
                                op: 'equal',
                                value: $(this).combobox('getValue')
                            });
                        }
                        dg.datagrid('doFilter');
                        actualizarFiltrosDg();
                    }
                }
            }, {
                field: 'titulo',
                type: 'label'
            }, {
                field:'catego',
                type:'combobox',
                options:{
                    panelHeight:'200px',
                    valueField: 'cod_catego',
                    textField: 'nom_catego',
                    url:'<?=base_url()?>index.php/consultasc/catego_consultasSolicitadas',
                    onChange:function(value){
                        if (value == ''){
                            dg.datagrid('removeFilterRule', 'catego');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'catego',
                                op: 'equal',
                                value: $(this).combobox('getValue')
                            });
                        }
                        dg.datagrid('doFilter');
                        actualizarFiltrosDg();
                    }
                }
            }, {
                field:'email',
                type:'label',
            }, {
                field:'fechax',
                type:'label'
            }, {
                field:'estado',
                type:'combobox',
                options: {
                    panelHeight:'200px',
                    valueField: 'id_estado',
                    textField: 'nom_estado',
                    url:'<?=dirname(base_url())?>/json/estadosConsultas.json',
                    onChange:function(value){
                        if (value == ''){
                            dg.datagrid('removeFilterRule', 'estado');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'estado',
                                op: 'equal',
                                value: $(this).combobox('getValue')
                            });
                        }
                        dg.datagrid('doFilter');
                        actualizarFiltrosDg();
                    }
                }

            }, {
                field:'archivo',
                type:'label',
            }]);

            cb_id = dg.datagrid('getFilterComponent', 'id');
            cb_catego = dg.datagrid('getFilterComponent', 'catego');
            cb_estado = dg.datagrid('getFilterComponent', 'estado');

            $('#dd, #dh').datebox({
                onSelect: function(){
                    doSearch();
                }
            });

        });

        function formatoArchivo(val, row){
            if (val == 1)
                return "<a href='#' onclick='doDownload(\""+row.id_consul+"\")'><img src='<?=dirname(base_url())?>/img/pdf-icon.svg' style='width: 20px; margin: 2px;'></a>";
        }

        function doDownload (val)
        {
            $.ajax({
                type: "POST",
                data: {
                    id: val
                },
                url: '<?=base_url()?>index.php/consultasc/getArchivo_consultaCliente',
                success: function(data){
                    response = jQuery.parseJSON(data);
                    if (response.status == "success")
                        window.location.assign('<?=base_url()?>index.php/consultasc/getArchivo_downloadCliente/' + val); 
                    else
                    {
                        $.messager.alert({    // show error message
                            title: 'Error',
                            msg: response.msj
                        });
                        //alert("Error:\n" + response.msj);
                    }
                }
            });  
            
        }

        function guardar()
        {
            row = $('#dg').datagrid('getSelected');
            $("#form-solicitud").form({
                queryParams: {id: row.id_consul}
            }).form('submit');
            $("#dlg-consulta").dialog('close');
        }

        function doSolicitar()
        {
            $('#ff_solicitar').submit();
        }
        
        function doSearch(){

            params = {};

            if ( $('input[name=fec_desde]').val() != '')
                params.fec_desde = $('input[name=fec_desde]').val();

            if ( $('input[name=fec_hasta]').val() != '')
                params.fec_hasta = $('input[name=fec_hasta]').val();

            if (cb_id.combobox('getValue') == '' && cb_catego.combobox('getValue') == '' && cb_estado.combobox('getValue') == '')
            {
                $('#dg').datagrid('load');
                cb_id.combobox({queryParams: params});
                cb_catego.combobox({queryParams: params});
                cb_estado.combobox({queryParams: params});
            }
            else
            {
                $('#dg').datagrid('removeFilterRule');
            }
        }

        function actualizarFiltrosDg()
        {
            valor_id = cb_id.combobox('getValue');
            valor_catego = cb_catego.combobox('getValue');
            valor_estado = cb_estado.combobox('getValue');

            params = {};

            if ( $('input[name=fec_desde]').val() != '')
                params.fec_desde = $('input[name=fec_desde]').val();
            if ( $('input[name=fec_hasta]').val() != '')
                params.fec_hasta = $('input[name=fec_hasta]').val();
            if (valor_id != '')
                params.id_dg = valor_id;
            if (valor_catego != '')
                params.catego_dg = valor_catego;
            if (valor_estado != '')
                params.estado_dg = valor_estado;

            if (valor_id == '')
                cb_id.combobox({queryParams: params});

            if (valor_catego == '')
                cb_catego.combobox({queryParams: params});

            if (valor_estado == '')
                cb_estado .combobox({queryParams: params});
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
    </script>
  </body>
</html>