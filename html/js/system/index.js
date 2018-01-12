

	var enviar=function()
	{
			var txtUsuario=$("#username").val().trim();
			var txtPass=$("#pass").val().trim();
			mostrarEspera(translateReturn("Solicitando acceso..."));
			xajax_ingresar(txtUsuario,txtPass);
			return false;
	};
	
	var enviarInterno=function()
	{		
			mostrarEspera(translateReturn("Solicitando acceso..."));
			xajax_ingresarInterno();
			return false;
	};
	
	$(document).ready(function()
	{	
		$("#btnEnviar").click(enviar);
		$("#btnEnviarInterno").click(enviarInterno);
		//$("#frmLogin").submit(enviar);
	});
	 

