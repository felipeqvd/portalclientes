/**
 * Script con funciones para administradores de descripcion de cargos.
 */

var base_url = document.getElementById("js-cargos-admin").getAttribute("base_url");

function initAdmin_functions(){
    
    $('#butAgregar_descripcion').click(function(e){
        e.preventDefault();
        
        habilitarElementos_descripcionCargos();
        abrirDialogo_descripcionCargos(false);
    });
    
    $('#butEditar_descripcion').click(function(e){
        e.preventDefault();
        
        initEdicion_descripcionCargos();
        abrirDialogo_descripcionCargos(true);
    });

    $('#butEliminar_descripcion').click(function(e){
        e.preventDefault();

        eliminar_descripcionCargo(); 
    });
}

/**
 * Habilitar los campos de edición del dialgo de descripcion de cargos.
 */
function habilitarElementos_descripcionCargos(){
    $('#fm-descripcion-cargo .easyui-combobox:not(.read_only)').combobox('enable');
    $('#fm-descripcion-cargo .easyui-textbox').textbox('enable');
    $('#fm-descripcion-cargo .easyui-tagbox').tagbox('enable');
}


function initEdicion_descripcionCargos(){
    habilitarElementos_descripcionCargos();
    
    $('#fm-descripcion-cargo .easyui-combobox.not-editable').combobox('disable');
    $('#fm-descripcion-cargo .easyui-textbox.not-editable').textbox('disable');
    $('#fm-descripcion-cargo .easyui-tagbox.not-editable').tagbox('disable');
}

function eliminar_descripcionCargo(){
    var row_selected = $('#dg-descripcion-cargos').datagrid('getSelected');
    
    if (row_selected){
        $.messager.confirm('Confirmación','¿Está seguro que desea eliminar este contacto?',function(r){
            if (r){
                $.post(base_url + "index.php/descripcion_cargos/eliminarDescripcion", 
                    {
                        id: row_selected.id
                    }, 
                    function(data){
                        if (data.success){
                            $('#dg-descripcion-cargos').datagrid('reload');
                            actualizarFiltrosDG_DescripcionCargos();
                            $.messager.alert('Descripción eliminada','La descripción fue eliminada','info');
                        }
                        else{
                            $.messager.alert('Error',data.msg,'error');
                        }
                    }, 
                    'json');
            }
        });
    }
    
}


