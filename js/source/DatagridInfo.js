class DatagridInfo{
    constructor(nombre, id_datagrid, id_footer, id_toolbar, id_boton_agregar, id_boton_eliminar, id_boton_aceptar, id_boton_cancelar, campos_combobox, base_url, is_editable){
        this.nombre = nombre;
        this.datagrid = id_datagrid;
        this.footer = id_footer;
        this.toolbar = id_toolbar;
        this.boton_agregar = id_boton_agregar;
        this.boton_eliminar = id_boton_eliminar;
        this.boton_aceptar = id_boton_aceptar;
        this.boton_cancelar = id_boton_cancelar;
        this.editIndex = undefined;
        this.campos = campos_combobox;
        this.base_url = base_url;
        this.lista_IDCampos = [];       /*  Lista de nombres de los ids de todos los campos -> Para enviar al servidor solo los campos de valores. Se guarda una lista para evitar estar calculandola en cada submit al servidor */
        this.lista_camposTextbox = [];
        this.edit_active = false;       // Bandera para saber si se está editando una fila

        if (is_editable === true || is_editable === 'true' || is_editable === 1 || is_editable === '1'){
            // Con un if para hacerlo type safe
            this.is_editable = true;
        }
        else{
            this.is_editable = false;
        }
        
        
        this.DG_initDatagrid();
    }
    
    /*  Métodos de la clase  */
    
    /**
     * Inicializar las opciones intrinsecas del datagrid e inicializar los click event de los botones asociados
     */
    DG_initDatagrid(){
        let self = this;        // Es necesario hacer eso para tener otra referencia al objeto ya que en cada llamado this cambia de contexto
        
        $(self.datagrid).datagrid({
            footer: self.footer,
            toolbar: self.toolbar,
            fitColumns: true,
            singleSelect: true,
            idField: "id",
            url: self.base_url + "index.php/descripcion_cargos/getDatagridValues_descripcion",
            onClickCell: function(index, field, value){
                if (self.is_editable){
                    self.DG_onClickCell(index, field);
                }
            },
            onEndEdit: function(index, row, changes){
                if (self.is_editable){
                    self.DG_onEndEdit(index, row, $(this), self.campos);
                }
                self.edit_active = false;
            },
            onBeginEdit: function(index, row){                
                self.edit_active = true;               
            },
            onCancelEdit: function(index, row, changes){                
                self.edit_active = false;                
            }
        });
        
        /*  Eventos de botones del datagrid  */
        $(this.boton_agregar).click(function(e){
            e.preventDefault();
            self.DG_append();
        });
        
        $(this.boton_eliminar).click(function(e){
            e.preventDefault();
            self.DG_remove();
        });
        
        $(this.boton_aceptar).click(function(e){
            e.preventDefault();
            self.DG_accept();
        });
        
        $(this.boton_cancelar).click(function(e){
            e.preventDefault();
            self.DG_reject();
        });
        
    }
    
    DG_isEdit_active(){
        return this.edit_active;
    }
    
    DG_showError_editActive(){
        $.messager.alert('Error','Hay registros de ' + this.nombre + ' en edición. Valide o cancele estos registros','error');
    }
    
    DG_agregarCampo(nombre, nombre_id, childs = null){
        if (this.campos === null){
            this.campos = [];
        }
        
        this.campos.push(new CampoDatagrid(nombre, nombre_id, childs));
        
        this.DG_actualizar_listaCampos();
    }
    
    
    DG_agregarCampo_textbox(nombre){
        if (this.lista_camposTextbox == null){
            this.lista_camposTextbox = [];
        }
        
        this.lista_camposTextbox.push(nombre);
    }
    
    /**
     * Crear un campo del datagrid nuevo y retornarlo para poder agregarlo a un array.
     * @param {string} nombre Nombre del campo
     * @param {string} nombre_id Nombre del campo id.
     * @param {array} childs Arreglo de objetos CampoDatagrid con la lista de childs
     * @returns {CampoDatagrid}
     */
    static DG_getCampo_asChild(nombre, nombre_id, childs = null){
        return new CampoDatagrid(nombre, nombre_id, childs);
    }
    
    /**
     * Agregar una lista de campos al objeto de la forma mas basica posible. Los campos seguiran el estandar de nomenclatura utilizado y ninguno tendra childs.
     * @param {array} nombres Arreglo de strings con la lista de los nombres de los campos
     */
    DG_agregarCamposBasicos(nombres){
        if (this.campos === null){
            this.campos = [];
        }
        
        for (var i = 0 ; i < nombres.length ; i ++){
            this.campos.push(new CampoDatagrid(nombres[i], nombres[i] + "_id", null));
        }
        
        this.DG_actualizar_listaCampos();
    }
    
    /**
     * Actualizar la lista de ids de los campos.
     * Se debe llamar cada vez que se agrega un campo
     */
    DG_actualizar_listaCampos(){
        this.lista_IDCampos = [];
        
        this.DG_getIDs_campos(this.campos);
    }
    
    DG_getIDs_campos(campos){
        for (var i = 0 ; i < campos.length ; i ++){
            this.lista_IDCampos.push(campos[i].name_id);
            
            if (campos[i].childs !== null){
                this.DG_getIDs_campos(campos[i].childs);
            }
        }
    }
    
    
    DG_getValores_seleccionados(){
        var valores = $(this.datagrid).datagrid('getData');
        
        if (valores.total === 0){
            return null;
        }
        
        var resultado = [];
        for (var i = 0 ; i < valores.total ; i ++){
            var registro = {};
            for (var j = 0 ; j < this.lista_IDCampos.length ; j ++){
                registro[this.lista_IDCampos[j]] = valores.rows[i][this.lista_IDCampos[j]];
            }
            
            for (var j = 0 ; j < this.lista_camposTextbox.length ; j ++){
                registro[this.lista_camposTextbox[j]] = valores.rows[i][this.lista_camposTextbox[j]];
            }
            
            resultado.push(registro);
        }
        
        return resultado;
    }
    
    /**
     * Update the datagrid content by fetching data from server
     * @param {int} descripcion Identificador de la descripcion 
     */
    DG_fetchData(descripcion){
        let self = this;
        
        $(this.datagrid).datagrid('load', {
            id_descripcion: descripcion,
            datagrid: self.nombre
        });
    }
    
    DG_endEditing(){
        if (this.editIndex === undefined){return true;}
        if ($(this.datagrid).datagrid('validateRow', this.editIndex)){
            $(this.datagrid).datagrid('endEdit', this.editIndex);
            this.editIndex = undefined;
            return true;
        } else {
            return false;
        }
    }
    
    
    DG_onClickCell(index, field){
        if (this.editIndex !== index){
            if (this.DG_endEditing()){
                $(this.datagrid).datagrid('selectRow', index)
                        .datagrid('beginEdit', index);
                var ed = $(this.datagrid).datagrid('getEditor', {index:index,field:field});
                if (ed){
                    ($(ed.target).data('textbox') ? $(ed.target).textbox('textbox') : $(ed.target)).focus();
                }
                this.editIndex = index;
                
                this.DG_initCombos_dependientes(this.campos, {});

            } else {
                setTimeout(function(){
                    $(this.datagrid).datagrid('selectRow', this.editIndex);
                },0);
            }
        }
    }
    
    
    DG_onEndEdit(index, row, object, campos){
        let self = this;
        for (var i = 0 ; i < this.campos.length ; i ++) {
            var ed = object.datagrid('getEditor', {
                index: index,
                field: campos[i].name
            });
            row[campos[i].name] = $(ed.target).combobox('getText');
            row[campos[i].name_id] = $(ed.target).combobox('getValue');
            if (campos[i].childs !== undefined && campos[i].childs !== null){
                self.DG_onEndEdit(index, row, object, campos[i].childs);
            }
        }
    }
    
    
    DG_append(){
        let self = this;
        if (this.DG_endEditing()){
            $(this.datagrid).datagrid('appendRow',{});
            this.editIndex = $(this.datagrid).datagrid('getRows').length-1;
            $(this.datagrid).datagrid('selectRow', self.editIndex)
                     .datagrid('beginEdit', self.editIndex);

            // Ahora agregar un event handler al area para que al cambiarlo active el de conocimientos y cargue los valores para dicha area
            this.DG_initCombos_dependientes(self.campos, {});
        }
    }
    
    
    DG_remove(){
        let self = this;
        if (this.editIndex == undefined){return}
        $(this.datagrid).datagrid('cancelEdit', self.editIndex)
                 .datagrid('deleteRow', self.editIndex);
        this.editIndex = undefined;
    }
    
    
    DG_accept(){
        if (this.DG_endEditing()){
            $(this.datagrid).datagrid('acceptChanges');
        }
    }
    
    
    DG_reject(){
        $(this.datagrid).datagrid('rejectChanges');
        this.editIndex = undefined;
    }
    
    
    /**
    * 
     * Inicializar los combobox de un registro editable cuyos elementos dependen uno de otro.
     * Se requiere un array estandarizado donde aparte de los datos de cada elemento (columna) se tiene un arreglo llamado childs donde se detallan los objetos json de cada combobox dependiente.
     * 
     * @param {JSON} parent_params Objeto JSON con los parametros dados por el parent. Usado para pasar el valor seleccionado en el combobox anidado.
     * 
     */
    DG_initCombos_dependientes(campos, parent_params){
        /*
         * Es necesario obtener el elemento (combobox) llamando al datagrid y buscando el editory dos veces, una para cada combo.
         */
        if (campos !== undefined && campos !== null){
            let self = this;
            var row = $(this.datagrid).datagrid('getSelected');

            var valor_seleccionado = null;
            var params = {};
            for (var i = 0 ; i < campos.length ; i ++) {
                params = {};
                valor_seleccionado = null;
                if (row !== null){
                    if (typeof row[campos[i].name_id] !== undefined){
                        valor_seleccionado = row[campos[i].name_id];
                        params[campos[i].name] = valor_seleccionado;
                    }
                }

                $.extend(params, parent_params);        // Merge JSON objects into params

                // En la siguiente linea, al entrar al metodo datagrid, ya cambia el contexto del this por ende es necesario usar self
                $($(self.datagrid).datagrid('getEditor', {
                    index: self.editIndex,
                    field: campos[i].name
                }).target).combobox({
                    disabled: false,
                    method:'post',
                    queryParams:{
                        campo: campos[i].name,
                        seleccionado: valor_seleccionado,
                        parametros: JSON.stringify(parent_params),
                        indice_array: i
                    },
                    url: self.base_url + 'index.php/descripcion_cargos/getCombo_values',
                    onSelect: function(record){
                        if (typeof record['indice'] !== undefined){
                            var filtro = {};
                            filtro[campos[record.indice].name] = record.id;     // Fijar el valor seleccionado en este combo para pasarlo al child y que este lo pueda enviar como parte de sus parametros al servidor.
                            if (campos[record.indice].childs !== null){
                                self.DG_initCombos_dependientes(campos[record.indice].childs, filtro);      // Llamar la funcion de forma recursiva para inicializar el subarreglo de childs del elemento
                            }
                        }
                    }
                });
            }
        }
    }
    
    
    /*DG_initCombos_independientes(){
        let self = this;
        
        var row = $(this.datagrid).datagrid('getSelected');
        
        var valor_seleccionado = null;
        for (var i = 0 ; i < self.campos.length ; i ++) {
            valor_seleccionado = null;
            if (row !== null){
                if (typeof row[self.campos[i].name_id] !== undefined){
                    valor_seleccionado = row[self.campos[i].name_id];
                }
            }
            
            $($(self.datagrid).datagrid('getEditor', {
                index: self.editIndex,
                field: self.campos[i].name
            }).target).combobox({
                    method:'post',
                    queryParams:{
                        campo: self.campos[i].name,
                        seleccionado: valor_seleccionado
                    },
                    url: self.base_url + 'index.php/descripcion_cargos/getCombo_values',
                });
        }
    }*/
}