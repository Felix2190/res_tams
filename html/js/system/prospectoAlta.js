var colocarLOGLAT=function(marker)
	{
		var markerLatLng = marker.getPosition();
		$("#spLon").html(markerLatLng.lng());
		$("#spLat").html(markerLatLng.lat());
		
		$("#txtLon").val(markerLatLng.lng());
		$("#txtLat").val(markerLatLng.lat());
		
		
		
		
	};
	
	
	
	
	
	function initMap() 
	{
        var map = new google.maps.Map(document.getElementById('map'), 
       {
          center: {lat: 19.42526163890521, lng: -99.13742068223655},
          zoom: 11,
          mapTypeId: google.maps.MapTypeId.MAP
        });

        // Create the search box and link it to the UI element.
        /*
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() 
        {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
        */
        
        
        var myLatlng = new google.maps.LatLng(19.42526163890521, -99.13742068223655);
		
		
		infoWindow = new google.maps.InfoWindow();
		 
	    var marker = new google.maps.Marker({
	        position: myLatlng,
	        draggable: true,
	        map: map,
	        title:"Arrastre el marcador a la coordenada de la comunidad."
	    });
	    
	    google.maps.event.addListener(marker, 'dragend', function(){ colocarLOGLAT(marker); });
	    google.maps.event.addListener(marker, 'click', function(){ colocarLOGLAT(marker); });
	    
	    google.maps.event.addListener(map, 'click', function(e) {
	        var positionClick = e.latLng;
	        marker.setPosition(positionClick);
	        colocarLOGLAT(marker);
	        // if you don't do this, the map will zoom in
	      });
	    
	    colocarLOGLAT(marker);
        
        
      }
      









	var _habilitar=function()
	{
		$("#btnGuardar").html("Guardar");
		$("#btnGuardar").removeAttr("disabled");
		$("#btnCancelar").removeAttr("disabled");
	}; 
	var _deshabilitar=function()
	{
		$("#btnGuardar").html("Enviando...");
		$("#btnGuardar").attr("disabled","disabled");
		$("#btnCancelar").attr("disabled","disabled");
	};

	var guardarProspecto=function()
	{	
		var Contacto=$("#txtNombreContacto").val().trim();
		var RazonSocial=$("#txtRazonSocial").val().trim();
		var RFC=$("#txtRFC").val().trim();
		var Productos=$("#slcProductos").val();
		var Comentarios=$("#txtComentarios").val().trim();
		
		var categoria=$("#slcCategoria").val();
		var valor=$("#txtValorAnual").val().trim();
		var probabilidad=$("#txtProbabilidad").val().trim();
		var mes=$("#slcMes").val();
		
		
		var Longitud=$("#txtLon").val();
		var Latitud=$("#txtLat").val();
		
		if(categoria=="")
		{
			mostrarAviso("Selecciona la ca categor&iacute;a del prospecto.");
			return false;
		
		}
		
		if(Contacto=="")
		{
			mostrarAviso("Captura el nombre del contacto.");
			return false;
		
		}
		if(RazonSocial=="")
		{
			mostrarAviso("Captura la raz&oacute;n social del prospecto.");
			return false;
		
		}
		
		if(valor=="")
		{
			mostrarAviso("Captura el valor anual estimado.");
			return false;
		
		}
		
		if(probabilidad=="")
		{
			mostrarAviso("Captura la probabilidad de &eacute;xito.");
			return false;
		
		}
		
		if(mes=="")
		{
			mostrarAviso("Selecciona el mes esperado de cierre.");
			return false;
		}
		
		
		//mostrarAviso("Almacenando informaci&oacute;n...")
		
		//_deshabilitar();
		xajax_registrarProspecto(Contacto, RazonSocial, RFC, Productos, Comentarios,Longitud,Latitud,categoria, valor, probabilidad, mes);
		return false;
	};
	
	
	
	$(document).ready(function()
	{
		$("#btnGuardar").click(guardarProspecto);
		$("#frmLogin").submit(guardarProspecto);
		$("#slcProductos").select2();
		$("#slcMes").select2();
		$("#slcCategoria").select2();
		
		$("#txtValorAnual").numeric();
		$("#txtProbabilidad").numeric();
		
		
		//initMap();
	});
	 

