        <div id="page-content-wrapper" class="main">
          <h4 class="page-header">Flashes tributarios</h4>
          <div style="clear: both;"><div style="width: 150px; float:left; font-weight: bold;">Usuario</div><div style="width: 300px; float:left;"><?=$nom_client?></div></div>
          <div style="clear: both;">
            <div style="width: 150px; float:left; font-weight: bold;">Fecha de consulta </div>
            <div style="width: 300px; float:left;">
                <script type="text/javascript">
                    var d = new Date();
                    document.write(d.getFullYear()+'/ '+parseFloat(d.getMonth()+1)+'/ '+d.getDate());
                </script>
            </div>
          </div>
            <div data-options="justified:true" style="width:100%;height:auto;clear: both; padding-top: 10px;">
                <div class="table-responsive">
                    <div id="busqueda" class="row" style="width: 98%; margin: auto; padding-top: 10px;">
                        <div class= "col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form id="buscar">
                                        <div class="row" style="width: 98%; padding-top: 10px; padding-bottom: 10px; margin: auto;">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
                                                <div class="form-group row" style="padding-top: 10px;">
                                                    <label class="control-label col-xs-4 col-sm-4" style="text-align: right;">Código</label>
                                                    <div class="col-xs-8 col-sm-8">
                                                        <input id="codigo" class="easyui-combobox" name="codigo" style="width: 100%;"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="padding-top: 10px;">
                                                    <label class="control-label col-xs-4 col-sm-4" style="text-align: right;">Desde</label>
                                                    <div class="col-xs-8 col-sm-8">
                                                        <input id="fec_desde" type="text" class="easyui-datebox" name="fec_desde" style="width: 100%;"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="padding-top: 10px;">
                                                    <label class="control-label col-xs-4 col-sm-4" style="text-align: right;">Hasta</label>
                                                    <div class="col-xs-8 col-sm-8">
                                                        <input id="fec_hasta" type="text" class="easyui-datebox" name="fec_hasta" style="width: 100%;"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="padding-top: 10px;">
                                                    <label class="control-label col-xs-4 col-sm-4" style="text-align: right;">Texto</label>
                                                    <div class="col-xs-8 col-sm-8">
                                                        <input id="texto" class="easyui-textbox" name="texto" style="width: 100%;"/>
                                                    </div>
                                                </div>
                                                <div style="padding-top: 10px; margin: auto; width: 120px;">
                                                    <a id="butBuscar" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-search'" style="width: 100%" onClick="doSearch()">Buscar</a>
                                                </div>
                                                
                                                <!--<div style="padding-top: 20px; padding-bottom: 20px; margin: auto; width: 150px">
                                                    <a id="solicitar" href="#" class="easyui-linkbutton" style="width: 100%" onclick="doSolicitar()">Solicitar</a>
                                                </div> -->
                                            </div>
                                            <!--
                                            <div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-0 col-lg-3 col-lg-offset-0" style="padding-top: 10px;">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">Temas</h4>
                                                    </div>
                                                    <div class="panel-body" style="max-height: 120px; overflow-y: auto;">
                                                        <ul id="temas" class="easyui-tree">
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            -->
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="repositorio" class="row" style="width: 98%; margin: auto; padding-top: 40px; padding-bottom: 20px;">
                        <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                            <div class="table-responsive">
                                <table id="dg" class="easyui-datagrid" style="width:100%; height:auto;" pageSize="20" toolbar="#tb" singleSelect="true">
                                    <thead>
                                        <tr>
                                            <th data-options="field:'codigo',resizable:true" width="20%">Código</th>
                                            <th data-options="field:'fecha',resizable:true, align:'center'" width="20%">Fecha</th>
                                            <th data-options="field:'titulo',resizable:true" width="40%">Titulo</th>
                                            <th data-options="field:'archivo',resizable:true, align:'center', formatter: formatoArchivo" width="20%">Archivo</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="<?=dirname(base_url())?>/js/jquery-easy-ui/datagrid-filter.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#codigo").combobox({
                url: '<?=base_url()?>index.php/flashesc/getCodigos_flashes',
                valueField: 'id_flash',
                textField: 'cod_flash',
                //label: 'Código',
                //labelPosition: 'before',
                //labelWidth: 50,
                novalidate: true,
                icons: [{
                    iconCls: 'icon-clear',
                    handler: function(e){
                        $(e.data.target).combobox('clear');
                    }
                }]
            });

            $("#fec_desde").datebox({
                url: '#',
                novalidate: true,
                icons: [{
                    iconCls: 'icon-clear',
                    handler: function(e){
                        $(e.data.target).datebox('clear');
                    }
                }]
            });

            $("#fec_hasta").datebox({
                url: '#',
                novalidate: true,
                icons: [{
                    iconCls: 'icon-clear',
                    handler: function(e){
                        $(e.data.target).datebox('clear');
                    }
                }]
            });

            $("#texto").textbox({
                type: 'text',
                novalidate: true,
                icons: [{
                    iconCls: 'icon-clear',
                    handler: function(e){
                        $(e.data.target).textbox('clear');
                    }
                }]
            });

            /*
            $('#temas').tree({
                method: 'post',
                url: '<?=base_url()?>index.php/flashes/getTemas_flashes',
                animate: true,
                checkbox: true,
                lines: true
            });
            */

            $("#dg").datagrid({pagePosition : 'bottom', 
                         pagination:true, 
                         remoteFilter : true, 
                         clientPaging: false,
                         showFooter : true, 
                         url: "<?=base_url()?>index.php/flashesc/getFlashes_lista",
                         /*
                         onDblClickRow: function(index, row){
                            $("#dlg-temas").html("");
                            $("#dlg-concepto").html("");
                            $("#dlg-flash").dialog({
                                title: "Flash  " + row.codigo,
                                modal: true,
                                buttons:[{
                                    text: "Aceptar",
                                    handler: function(){$("#dlg-flash").dialog('close');}
                                }]
                            });
                            $("#dlg-flash").dialog('open').dialog('center');

                            $("#dlg-codigo").html(row.codigo);
                            $("#dlg-titulo").html(row.titulo);
                            $("#dlg-fecha").html(row.fecha);
                            switch(row.estado)
                            {
                                case '0':
                                    $("#dlg-estado").html('Cancelada');
                                    break;

                                case '1':
                                    $("#dlg-estado").html('Solucionada');
                                    break;

                                case '2':
                                    $("#dlg-estado").html('Pendiente');
                                    break;

                                default:
                                    $("#dlg-estado").html('Desconocido');
                            }

                            if (row.archivo == 1)
                                $("#dlg-archivo").html("<a href='#' onclick='doDownload(\""+row.codigo+"\")'>Descargar</a>");
                            else
                                $("#dlg-archivo").html("No disponible");
                            

                            $.ajax({
                                type: "POST",
                                data: {
                                    id: row.codigo
                                },
                                url: '<?=base_url()?>index.php/flashes/getInfo_flash',
                                success: function(data){
                                    response = jQuery.parseJSON(data);
                                    if (response.temas == null)
                                        $("#dlg-temas").html('-');
                                    else
                                        $("#dlg-temas").html(response.temas);
                                    $("#dlg-concepto").html(response.concepto);
                                }
                            }); 
                         }*/
                     });

        });
        /*
        $.fn.datebox.defaults.formatter = function(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return d+'/'+m+'/'+y;
        }
        */
        function doSearch()
        {
            params = {};

            if ($('input[name=codigo]').val() != '')
                params.codigo= $('input[name=codigo]').val();
            if ($('input[name=fec_desde]').val() != '')
                params.fec_desde= $('input[name=fec_desde]').val();
            if ($('input[name=fec_hasta]').val() != '')
                params.fec_hasta= $('input[name=fec_hasta]').val();
            if ($('input[name=texto]').val() != '')
                params.texto= $('input[name=texto]').val();

            // Temas:
            /*
            var temas = $('#temas').tree('getChecked');            

            if (temas.length > 0)
            {
                for (var i = 0 ; i < temas.length ; i++)
                {
                    temas[i] = temas[i].id;
                }
                params.temas = JSON.stringify(temas);
            }
            */

            /*
            var s = '';
            for (var i=0;i<temas.length;i++)
            {
                s += temas[i].id + " - " + temas[i].text + "\n";
            }
            alert("Temas: " + temas.length + "\n\n" + s);
            return;
            */
            
            if ($('input[name=codigo]').val() == '')
            {
                $('#codigo').combobox({
                    queryParams: params
                });
            }

            $('#dg').datagrid('load', params);  
            
        }

        function formatoArchivo(val, row){
            if (val == 1)
                return "<a href='#' onclick='doDownload(\""+row.codigo+"\")'><img src='<?=dirname(base_url())?>/img/pdf-icon.svg' style='width: 20px; margin: 2px;'></a>";
        }

        function formattersql(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            var h = date.getHours();
            var mi = date.getMinutes();
            var s = date.getSeconds();
            return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d)+' '+(h<10?('0'+h):h)+':'+(mi<10?('0'+mi):mi)+':'+(s<10?('0'+s):s);
        }

        function doDownload (val)
        {
            $.ajax({
                type: "POST",
                data: {
                    id: val
                },
                url: '<?=base_url()?>index.php/flashesc/getArchivo_flash',
                success: function(data){
                    response = jQuery.parseJSON(data);
                    if (response.status == "success")
                        window.location.assign('<?=base_url()?>index.php/flashesc/getFlash_download/' + val); 
                    else
                        alert("Error:\n" + response.msj);
                }
            });  
        }
    </script>
  </body>
</html>