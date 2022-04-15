/**
 * FUNCIONES PARA DAR FORMATO
 * 
 */


function formatRedond_millar(val,row){
    return formatMillar(Math.round(val).toString());
}
function formatMillar(number){
    var result = '';
    var signon = '';
    if(number.substring(0, 1)=='-'){
        signon = '-'
        number = number.substring(1, number.length);
    }
    while( number.length > 3 ){
        result = '.' + number.substr(number.length - 3) + result;
        number = number.substring(0, number.length - 3);
    }
    result = signon + number + result;
    return result;
}


