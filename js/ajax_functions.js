var referenciajs = document.getElementById("js_ajax_functions");
var base_url = referenciajs.getAttribute("parametro_base_url");
// JavaScript Document

function restore_pass()
{
	var usr_emailx = $("#login-pass-restore");
	if (usr_emailx.val().length < 1)
	{
		alert("Por favor escriba un correo electrónico.");
		return false;
	}
	else
	{
    	var data = $(".pass-restore").serializeArray();
    	$("#modal_pass_restore").html('<div class="modal-body"><p>Verificando la dirección de correo electrónico. Por favor espere...<p></div>');
    	$("#modal_pass_restore").load(base_url+'index.php/login/recuperarcontrasena', data);
	}
}

function pass_cambiar()
{
	var clv_usuari = $("#clv_usuari");
	var clv_usuari_confirm = $("#clv_usuari_confirm");
	
	if (clv_usuari.val().length < 1 && clv_usuari_confirm.val().length < 1)
	{
		alert("Los campos no deben quedar en blanco.");
		return false;
	}
	else if (clv_usuari.val() != clv_usuari_confirm.val())
	{
		clv_usuari.addClass("error");
		clv_usuari_confirm.addClass("error");
		alert("Debe escribir la misma contraseña en los dos campos.");
		return false;
	}
	else if (clv_usuari.val() == clv_usuari_confirm.val())
	{
    	var data = $(".pass_cambiar").serializeArray();
    	$("#pass_cambiar").html('<p>Cambiando su contraseña. Por favor espere...</p>');
    	$("#pass_cambiar").load(base_url+'index.php/login/restore/', data);
	}
}
