/**
 * Clase para definir los filtros del datagrid 
 */
class datagridFilter {
    constructor(field,valueField,textField,url,datagrid) {
        this.field = field;
        this.type = 'combobox';
        this.options = {
            panelHeight:'200px',
            valueField: valueField,
            textField: textField,
            url:url,
            onChange:function(value){
                if (value == ''){
                    datagrid.datagrid('removeFilterRule', field);
                } else {
                    datagrid.datagrid('addFilterRule', {
                        field: field,
                        op: 'equal',
                        value: $(this).combobox('getValue')
                    });
                }
                datagrid.datagrid('doFilter');
            },
            icons: [{
                iconCls: 'icon-clear',
                handler: function(e){
                    $(e.data.target).combobox('clear');
                }
            }]
        }
    }    
}
/**
 * Clase para definir los filtros con datos locales
 */
class datagridLocalDataFilter {
    constructor(field,localData,datagrid) {
        this.field = field;
        this.type = 'combobox';
        this.options = {
            panelHeight:'200px',
            data:localData,
            onChange:function(value){
                if (value == ''){
                    datagrid.datagrid('removeFilterRule', field);
                } else {
                    datagrid.datagrid('addFilterRule', {
                        field: field,
                        op: 'equal',
                        value: $(this).combobox('getValue')
                    });
                }
                datagrid.datagrid('doFilter');
            },
            icons: [{
                iconCls: 'icon-clear',
                handler: function(e){
                    $(e.data.target).combobox('clear');
                }
            }]
        }
    }    
}

function assembleFilters(filters, dataGrid, princpalUrl){
    let arrayFilters = filters.map(function(filter){
        let filterObject = {};
        if (filter.type == 'combobox'){
            //filtros con la data local
            if(filter.local){
                filterObject = new datagridLocalDataFilter(filter.field, 
                    filter.data,                    
                    dataGrid
                );
            }else{
                //Para filtros con url
                let urlFilter = filter.url;
                if(princpalUrl != ''){
                    urlFilter = princpalUrl+filter.field;
                }
                filterObject = new datagridFilter(filter.field, 
                    filter.valueField, 
                    filter.textField, 
                    urlFilter,
                    dataGrid
                );
            }
            
        }else{
            filterObject = {
                field:filter.field,
                type:'label'
            }
        }
        return filterObject;
    });
    return arrayFilters;
}
