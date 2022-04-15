/**
 * FUNCIONES PARA VER LA DISTRIBUCIÓN DE LAS HORAS NO CARGABLES
 * 
 */
function loadTab_distribucion_nocargables() {
    //iniciar variables y asignar funciones    
    var referenciajs = document.getElementById("js_distribucion_nocargables");
    var base_url = referenciajs.getAttribute("parametro_base_url");    
    $("#exportar_distribucion_nocargables").click (function(){doExport_distribucion_nocargables();});
    var dg_distribucion_nocargables = $('#dg_distribucion_nocargables');
    dg_distribucion_nocargables.datagrid({
        pagePosition : 'bottom',
        remoteFilter : true,
        clientPaging: false,
        showFooter : true,
        url : base_url+"index.php/informescontratos/listar_distribucion_nocargables",
        pagination : true,
        onBeforeLoad: function (params){
            if ($('#ff_distribucion_nocargables input[name=fec_desde]').val() != '')
                params.fec_desde= $('#ff_distribucion_nocargables input[name=fec_desde]').val();
            if ($('#ff_distribucion_nocargables input[name=fec_hasta]').val() != '')
                params.fec_hasta= $('#ff_distribucion_nocargables input[name=fec_hasta]').val();            
        }
    });    
    $('#dd_distribucion_nocargables, #dh_distribucion_nocargables').datebox({
        onSelect: function(){
            dg_distribucion_nocargables.datagrid('load');
            actualizarFiltrosDatagrid_distribucion_nocargables();
        },
        icons: [{
            iconCls: 'icon-clear',
            handler: function(e){
                $(e.data.target).datebox('clear');
                dg_distribucion_nocargables.datagrid('load');
                actualizarFiltrosDatagrid_distribucion_nocargables();
            }
        }]
    });
    dg_distribucion_nocargables.datagrid('enableFilter', [
        {field:'cod_contra',
        type:'combobox',
        options:{
            panelHeight:'200px',
            valueField: 'cod_contra',
            textField: 'cod_contra2',
            url:base_url+'index.php/informescontratos/filtros_listar_distribucion_nocargables/cod_contra',
            onChange:function(value){
                if (value == ''){
                    dg_distribucion_nocargables.datagrid('removeFilterRule', 'cod_contra');
                } else {
                    dg_distribucion_nocargables.datagrid('addFilterRule', {
                        field: 'cod_contra',
                        op: 'equal',
                        value: $(this).combobox('getValue')
                    });
                }
                dg_distribucion_nocargables.datagrid('doFilter');
                actualizarFiltrosDatagrid_distribucion_nocargables();
            },
            icons: [{
                iconCls: 'icon-clear',
                handler: function(e){
                    $(e.data.target).combobox('clear');
                }
            }]
        }
        },{field:'nom_contra',
        type:'combobox',
        options:{
            panelHeight:'200px',
            valueField: 'cod_contra',
            textField: 'nom_contra',
            url:base_url+'index.php/informescontratos/filtros_listar_distribucion_nocargables/nom_contra',
            onChange:function(value){
                if (value == ''){
                    dg_distribucion_nocargables.datagrid('removeFilterRule', 'nom_contra');
                } else {
                    dg_distribucion_nocargables.datagrid('addFilterRule', {
                        field: 'nom_contra',
                        op: 'equal',
                        value: $(this).combobox('getValue')
                    });
                }
                dg_distribucion_nocargables.datagrid('doFilter');
                actualizarFiltrosDatagrid_distribucion_nocargables();
            },
            icons: [{
                iconCls: 'icon-clear',
                handler: function(e){
                    $(e.data.target).combobox('clear');
                }
            }]
        }
        },{field:'nom_sociox',
        type:'combobox',
        options:{
            panelHeight:'200px',
            valueField: 'cod_sociox',
            textField: 'nom_sociox',
            url:base_url+'index.php/informescontratos/filtros_listar_distribucion_nocargables/nom_sociox',
            onChange:function(value){
                if (value == ''){
                    dg_distribucion_nocargables.datagrid('removeFilterRule', 'nom_sociox');
                } else {
                    dg_distribucion_nocargables.datagrid('addFilterRule', {
                        field: 'nom_sociox',
                        op: 'equal',
                        value: $(this).combobox('getValue')
                    });
                }
                dg_distribucion_nocargables.datagrid('doFilter');
                actualizarFiltrosDatagrid_distribucion_nocargables();
            },
            icons: [{
                iconCls: 'icon-clear',
                handler: function(e){
                    $(e.data.target).combobox('clear');
                }
            }]
        }
        },{field:'nom_usuari',
        type:'combobox',
        options:{
            panelHeight:'200px',
            valueField: 'cod_usuari',
            textField: 'nom_usuari',
            url:base_url+'index.php/informescontratos/filtros_listar_distribucion_nocargables/nom_usuari',
            onChange:function(value){
                if (value == ''){
                    dg_distribucion_nocargables.datagrid('removeFilterRule', 'nom_usuari');
                } else {
                    dg_distribucion_nocargables.datagrid('addFilterRule', {
                        field: 'nom_usuari',
                        op: 'equal',
                        value: $(this).combobox('getValue')
                    });
                }
                dg_distribucion_nocargables.datagrid('doFilter');
                actualizarFiltrosDatagrid_distribucion_nocargables();
            },
            icons: [{
                iconCls: 'icon-clear',
                handler: function(e){
                    $(e.data.target).combobox('clear');
                }
            }]
        }
        },{field:'nom_mesxxx',
        type:'combobox',
        options:{
            panelHeight:'200px',
            valueField: 'cod_mesxxx',
            textField: 'nom_mesxxx',
            url:base_url+'index.php/informescontratos/filtros_listar_distribucion_nocargables/nom_mesxxx',
            onChange:function(value){
                if (value == ''){
                    dg_distribucion_nocargables.datagrid('removeFilterRule', 'nom_mesxxx');
                } else {
                    dg_distribucion_nocargables.datagrid('addFilterRule', {
                        field: 'nom_mesxxx',
                        op: 'equal',
                        value: $(this).combobox('getValue')
                    });
                }
                dg_distribucion_nocargables.datagrid('doFilter');
                actualizarFiltrosDatagrid_distribucion_nocargables();
            },
            icons: [{
                iconCls: 'icon-clear',
                handler: function(e){
                    $(e.data.target).combobox('clear');
                }
            }]
        }
        },{field:'anio',
        type:'combobox',
        options:{
            panelHeight:'200px',
            valueField: 'anio',
            textField: 'anio',
            url:base_url+'index.php/informescontratos/filtros_listar_distribucion_nocargables/anio',
            onChange:function(value){
                if (value == ''){
                    dg_distribucion_nocargables.datagrid('removeFilterRule', 'anio');
                } else {
                    dg_distribucion_nocargables.datagrid('addFilterRule', {
                        field: 'anio',
                        op: 'equal',
                        value: $(this).combobox('getValue')
                    });
                }
                dg_distribucion_nocargables.datagrid('doFilter');
                actualizarFiltrosDatagrid_distribucion_nocargables();
            },
            icons: [{
                iconCls: 'icon-clear',
                handler: function(e){
                    $(e.data.target).combobox('clear');
                }
            }]
        }
        },{field:'costo_funcionario_contrato',
        type:'label'
        },{field:'costo_funcionario_total',
        type:'label'
        },{field:'costo_funcionario_nocargables',
        type:'label'
        },{field:'costo_funcionario_nocargables_contrato',
        type:'label'
        },
    ]);
    cb_cod_contra_distribucion_nocargables = dg_distribucion_nocargables.datagrid('getFilterComponent', 'cod_contra');
    cb_nom_contra_distribucion_nocargables = dg_distribucion_nocargables.datagrid('getFilterComponent', 'nom_contra');
    cb_nom_sociox_distribucion_nocargables = dg_distribucion_nocargables.datagrid('getFilterComponent', 'nom_sociox');
    cb_nom_usuari_distribucion_nocargables = dg_distribucion_nocargables.datagrid('getFilterComponent', 'nom_usuari');
    cb_nom_mesxxx_distribucion_nocargables = dg_distribucion_nocargables.datagrid('getFilterComponent', 'nom_mesxxx');
    cb_anio_distribucion_nocargables = dg_distribucion_nocargables.datagrid('getFilterComponent', 'anio');

    function actualizarFiltrosDatagrid_distribucion_nocargables() {
        valor_cod_contra = cb_cod_contra_distribucion_nocargables.combobox('getValue');
        valor_nom_contra = cb_nom_contra_distribucion_nocargables.combobox('getValue');
        valor_nom_sociox = cb_nom_sociox_distribucion_nocargables.combobox('getValue');
        valor_nom_usuari = cb_nom_usuari_distribucion_nocargables.combobox('getValue');
        valor_nom_mesxxx = cb_nom_mesxxx_distribucion_nocargables.combobox('getValue');
        valor_anio = cb_anio_distribucion_nocargables.combobox('getValue');
        params = {};
        if (valor_cod_contra!= ''){params.cod_contra_dg= valor_cod_contra;}
        if (valor_nom_contra!= ''){params.nom_contra_dg= valor_nom_contra;}
        if (valor_nom_sociox!= ''){params.nom_sociox_dg= valor_nom_sociox;}
        if (valor_nom_usuari!= ''){params.nom_usuari_dg= valor_nom_usuari;}
        if (valor_nom_mesxxx!= ''){params.nom_mesxxx_dg= valor_nom_mesxxx;}
        if (valor_anio!= ''){params.anio_dg= valor_anio;}
        if (valor_cod_contra == ''){cb_cod_contra_distribucion_nocargables.combobox({queryParams: params});}
        if (valor_nom_contra == ''){cb_nom_contra_distribucion_nocargables.combobox({queryParams: params});}
        if (valor_nom_sociox == ''){cb_nom_sociox_distribucion_nocargables.combobox({queryParams: params});}
        if (valor_nom_usuari == ''){cb_nom_usuari_distribucion_nocargables.combobox({queryParams: params});}
        if (valor_nom_mesxxx == ''){cb_nom_mesxxx_distribucion_nocargables.combobox({queryParams: params});}
        if (valor_anio == ''){cb_anio_distribucion_nocargables.combobox({queryParams: params});}
    };

    function doExport_distribucion_nocargables() {
        dg_distribucion_nocargables = $('#dg_distribucion_nocargables');
        var filtered_rules = [];
        var cb_cod_contra = dg_distribucion_nocargables.datagrid('getFilterComponent', 'cod_contra');
        var val_cod_contra = cb_cod_contra.combobox('getValue');
        if (val_cod_contra != ''){
            filtered_rules.push({
                field: 'cod_contra',
                op:'equal',
                value:val_cod_contra
            });
        }
        var cb_nom_contra = dg_distribucion_nocargables.datagrid('getFilterComponent', 'nom_contra');
        var val_nom_contra = cb_nom_contra.combobox('getValue');
        if (val_nom_contra != ''){
            filtered_rules.push({
                field: 'nom_contra',
                op:'equal',
                value:val_nom_contra
            });
        }
        var cb_nom_sociox = dg_distribucion_nocargables.datagrid('getFilterComponent', 'nom_sociox');
        var val_nom_sociox = cb_nom_sociox.combobox('getValue');
        if (val_nom_sociox != ''){
            filtered_rules.push({
                field: 'nom_sociox',
                op:'equal',
                value:val_nom_sociox
            });
        }
        var cb_nom_usuari = dg_distribucion_nocargables.datagrid('getFilterComponent', 'nom_usuari');
        var val_nom_usuari = cb_nom_usuari.combobox('getValue');
        if (val_nom_usuari != ''){
            filtered_rules.push({
                field: 'nom_usuari',
                op:'equal',
                value:val_nom_usuari
            });
        }
        var cb_nom_mesxxx = dg_distribucion_nocargables.datagrid('getFilterComponent', 'nom_mesxxx');
        var val_nom_mesxxx = cb_nom_mesxxx.combobox('getValue');
        if (val_nom_mesxxx != ''){
            filtered_rules.push({
                field: 'nom_mesxxx',
                op:'equal',
                value:val_nom_mesxxx
            });
        }
        var cb_anio = dg_distribucion_nocargables.datagrid('getFilterComponent', 'anio');
        var val_anio = cb_anio.combobox('getValue');
        if (val_anio != ''){
            filtered_rules.push({
                field: 'anio',
                op:'equal',
                value:val_anio
            });
        }
        url_distribucion_nocargables = base_url+"index.php/informescontratos/excel_distribucion_nocargables";
        $('#rules_distribucion_nocargables').val(JSON.stringify(filtered_rules));
        $('#ff_distribucion_nocargables').form('submit', {
            method: 'post',
            url: url_distribucion_nocargables,
            queryParams:{
                filterRules: JSON.stringify(filtered_rules)
            }
        });
    };
};
