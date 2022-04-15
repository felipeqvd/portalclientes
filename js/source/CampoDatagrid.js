class CampoDatagrid{
    
    /**
     * Crear un objeto nuevo CampoDatagrid suministrando todos sus componentes.
     * @param {string} nombre Nombre del campo tal cual como está en el datagrid y como se nombrará en el back end
     * @param {string} nombre_id Nombre que tendrá el id del valor seleccionado
     * @param {CampoDatagrid array} childs Arreglo de objetos CampoDatagrid que contiene todos los campos que dependen de este
     */
    constructor (nombre, nombre_id, childs){        
        if(childs !== null){
            if (! (childs[0] instanceof CampoDatagrid) || ! Array.isArray(childs)){
                this.childs = null;
            }
            else{
                this.childs = childs;
            }
        }
        else{
            this.childs = null;
        }
        
        this.name = nombre;
        this.name_id = nombre_id;
    }
    
    agregarChild(child){
        if (! (child instanceof CampoDatagrid)){
            return false;
        }
        
        if (this.childs === null){
            this.childs = [];
        }
        
        this.childs.push(child);
        
        return true;
    }
}