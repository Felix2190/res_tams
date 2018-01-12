
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#foto').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

var guardar = function(){
	var nombre = $("#nombre").val();
	var codigo = $("#codigo").val();
	//var foto = $("#foto").[0].src();
	var tipo = $("#tipo").val();
	var costoOrigen = $("#costoOrigen").val();
	var costoFobmx = $("#costoFobmx").val();
	var costoMx = $("#costoMx").val();
	var margenPesos = $("#margenPesos").val();
	var margenPorcentaje = $("#margenPorcentaje").val();
	var precioVenta = $("#precioVenta").val();
	var inventariable = $("#inventariable").val();
	var comisionMaxima = $("#comisionMaxima").val();
	var descuentoMaximo = $("#descuentoMaximo").val();
	var estatus = $("#estatus").val();
	
	if(nombre==""){
		mostrarAviso("Favor de capturar nombre.");
		return false;
	}else{
	
	}
	if(codigo==""){
		mostrarAviso("Favor de capturar c&oacute;digo.");
		return false;
	}else{
		
	}
	if(foto==""){

	}else{
		
	}
	if(tipo==""){
		mostrarAviso("Favor de seleccionar tipo.");
		return false;
	}else{
		
	}
	if(costoOrigen==""){
		mostrarAviso("Favor de capturar costo de origen.");
		return false;
	}else{
		
	}
//	Costo FOBMX US (default 0%, tasa definida arbitrariamente para cada producto y es el resutlado del orígen*tasa)
//	if(costoFobmx==""){
//		
//	}else{
//		
//	}
	//Costo MXN (Se define el tipo de cambio y en caso de ser orígen USD se convierte a MXN, en caso de que sea local, no hay conversión, se pone el mismo costo de orígen)
	if(costoMx==""){

	}else{
		
	}
	//Margen en pesos (Fórmula pendiente, tome (precio venta - costo MXN))
	if(margenPesos==""){

	}else{
		
	}
	//Margen en porcentaje (Fórmula pendiente, tome (precio venta - costo MXN)*100)
	if(margenPorcentaje==""){

	}else{
		
	}
	if(precioVenta==""){
		mostrarAviso("Favor de capturar precio de venta.");
		return false;
	}else{
		
	}
	if(inventariable==""){
		mostrarAviso("Favor de seleccionar si es inventariable.");
		return false;
	}else{
		
	}
	if(comisionMaxima==""){

	}else{
		
	}
	if(descuentoMaximo==""){
		mostrarAviso("Favor de capturar el descuento maximo.");
		return false;
	}else{
		
	}
	if(estatus==""){
		mostrarAviso("Favor de seleccionar el estatus.");
		return false;
	}else{
		
	}
	
	//xajax_
}

function margenPesos(){
	//Margen en pesos = precio venta MXN - costo MXN
	cm = $("#costoMx").val();
 	pv = $("#precioVenta").val();
	if(cm.length>0 && pv.length>0){
		costo = parseFloat($("#costoMx").val().trim()).toFixed(2);
		precio = parseFloat($("#precioVenta").val().trim()).toFixed(2);		
		if((!isNaN(costo)) && (!isNaN(precio))){
			margen = precio - costo;
			$("#margenPesos").val(margen);
		}else{
			$("#margenPesos").val(0);
		}
		
	}
}

function margenPorcentaje(){
	//Margen en porcentaje - Margen en Pesos/Precio de Venta * 100
	mp = $("#margenPesos").val();
 	pv = $("#precioVenta").val();
	if(mp.length>0 && pv.length>0){
		margen = parseFloat($("#margenPesos").val().trim()).toFixed(2);
		precio = parseFloat($("#precioVenta").val().trim()).toFixed(2);		
		if((!isNaN(costo)) && (!isNaN(precio))){
			margen = (margen / precio)* 100 ;
			$("#margenPorcentaje").val(margen);
		}else{
			$("#margenPorcentaje").val(0);
		}
		
	}
}

var inicializarControles=function()
	{	
  	   //$("#btnGuardar").click(guardar);  
	$("#btnEliminar").click(function (){ $("#RemoveBrochure").val("si"); $("#brochureFile").hide(); });
  	 $("#frmRegistro").submit(guardar);
  	 $('.entero').numeric();
     $('.decimal').numeric(",");
          
 	$("#costoOrigen").blur(function(){$("#costoMx").val($("#costoOrigen").val());});
 	//Margen en pesos = precio venta MXN - costo MXN
 	$("#costoMx").blur(margenPesos);
 	$("#precioVenta").blur(margenPesos);
 	//Margen en porcentaje - Margen en Pesos/Precio de Venta * 100
 	$("#margenPesos").blur(margenPorcentaje);
 	$("#precioVenta").blur(margenPorcentaje);
     
	};
	$(document).ready(function(){inicializarControles()});