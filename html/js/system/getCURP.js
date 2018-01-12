var muestraCURP= function(){
	//$( "#fram1" ).contents().find( "input" ).css( "background-color", "#BADA55" );
	
	
	var re = /[^-a-zA-Z!,'?\s]/g; // to filter out unwanted characters
    var ifrm = document.getElementById('fram1');
    // reference to document in iframe
    var doc = ifrm.contentDocument? ifrm.contentDocument: ifrm.contentWindow.document;
    // get reference to greeting text box in iframed document
    var fld = doc.forms['ejemplForma2'].elements['strCURP'];
    var val = fld.value
    
    
	/**var iBody = $("#fram1").contents().find("body")
	var myContent = iBody.find("#strCURP");
	alert(myContent.val());
	
	var iframe = document.getElementById("fram1");
	var innerDoc =  iframe.contentWindow.document;
	console.log(innerDoc.body);**/

}

var inicializarControles=function(){
	
	$("#fram1").load(function(){
		$('#lblMensaje').text("Al terminar la validación cierre la ventana");
		
	});
}

$(document).ready(function(){inicializarControles()});