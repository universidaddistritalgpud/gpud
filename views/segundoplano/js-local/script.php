//Se Recarga la página x tiempo cuando no todos los procesamientos esta terminados.
$( document ).ready(function() {
    if($("#estado").val() == "recargar"){
		setTimeout('document.location.reload()',10000);
	}
});