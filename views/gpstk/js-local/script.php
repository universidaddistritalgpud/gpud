$("#encrypt(sidenav)").hide();
$("#encrypt(botonprocesar)").hide();

var request_uri = location.protocol + "//" + location.hostname + location.pathname;

var result;
var params;
var information;

var statusMap = false;

var file_rinex = false;
var file_load_oceanic = false;

$('#encrypt(puerto)').filestyle({
	buttonText : 'Buscar Archivo',
	buttonName : 'btn-primary',
	size : 'nr'
});

$('#encrypt(cargas_oceanicas)').filestyle({
	buttonText : 'Buscar Archivo',
	buttonName : 'btn-primary',
	size : 'nr'
});


	$("#encrypt(puerto)").on("change", function(e) {
		
		var globalData;
		
		$('#modalLoad').addClass('modalLoadUpload').removeClass('modalLoad');
		
		$('#datepicker').datepicker('remove');
	
		var fileInput = $("#encrypt(puerto)");
		var data = new FormData();
	    data.append("puerto", fileInput[0].files[0]);
	    
	    
		$.ajax({
	        url: request_uri + '?url=procesar/ft/information/dfadfafd', 
	        type: "POST", 
	        dataType: "json",            
	        data: data, 
	        contentType: false,                  
	        processData:false,        
	        success: function(data)   
	        {
	            if(data.isRinex == true){
	            	
	            	globalData = data;
	            	information = data;
	            	
	            	$('#datepicker').datepicker('setDate', new Date(data.date['year'] + " " + data.date['month'] + " " + data.date['day'] ));
	            	$('#date').html(data.date['day'] + "-" + data.date['monthText'] + "-" + data.date['year']);
	            	$('#daygnss').html(data.daygnss);
	            	$('#weekgnss').html(data.weekgnss);
	            	$('#dayofyear').html(data.dayofyear);
	            	$('#typeantenna').html(data.antenna);
	            	$('#station').html(data.markerName);
	            	$('#julian').html(data.dayjulian);
	            	$('#dayofweek').html(data.date['dayText']);
	            	
	            	$("#encrypt(sidenav)").show();
	            		            	
	            	$('html,body').animate({
        				scrollTop: $("#alerta3").offset().top
    				}, 2000);
	            	
	            	file_rinex = true;
	            	
	            	if(file_rinex == true && file_load_oceanic == true){
	            		$("#encrypt(botonprocesar)").show();
	            	}
	            	
	            	OpenStreetMap(data);
	            	
	            		
	            }else {
	            
	            	$("#encrypt(botonprocesar)").hide();
	            
	               	file_rinex = false;
	            
	            	$('#encrypt(puerto)').filestyle('clear');
	            	
	            	alert("El archivo seleccionado no corresponde a un archivo de tipo RINEX, \n por favor verifique e intente de nuevo.");
	            	
	            	$("#encrypt(sidenav)").hide();
	            	
	            	globalData = [];
	            }
	            
	        }
	    });
	    
    });
        
    $("#encrypt(cargas_oceanicas)").on("change", function(e) {
	
		$('#modalLoad').addClass('modalLoadUpload').removeClass('modalLoad');
		
		$('#datepicker').datepicker('remove');
	
		var fileInput = $("#encrypt(cargas_oceanicas)");
		var data = new FormData();
	    data.append("cargas_oceanicas", fileInput[0].files[0]);

		$.ajax({
	        url: request_uri + '?url=procesar/ft/cargas/dfadfafd', 
	        type: "POST", 
	        dataType: "json",            
	        data: data, 
	        contentType: false,                  
	        processData:false,        
	        success: function(data)   
	        {

	            if(data.isLoads == true){
	            	
	            	 file_load_oceanic = true;
	            	
	            	if(file_rinex == true && file_load_oceanic == true){
	            		$("#encrypt(botonprocesar)").show();
	            		$('html,body').animate({
        					scrollTop: $("#sidenav").offset().top
    					}, 2000);
	            	}
	            		
	            }else {
	            
	               	alert("El archivo seleccionado no corresponde a un archivo de Cargas Oceánicas, \n por favor verifique e intente de nuevo.");
	            
	            	$("#encrypt(botonprocesar)").hide();
	            
	            	file_load_oceanic = false;
	            	
	            	$('#encrypt(cargas_oceanicas)').filestyle('clear');
	            	
	            	
	            	$( "#encrypt(alerta2)" ).focus();
	            	
	            }
	            
	        }
	        
	    });
	});
    
    function OpenStreetMap(data){
    	
    	if(statusMap == false){
	    	map = new OpenLayers.Map("mapdiv");
    	}
    	
    	statusMap = true;
    	
	    map.addLayer(new OpenLayers.Layer.OSM());
	    
	    epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
	    projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)
	   
	    var lonLat = new OpenLayers.LonLat( data.position['longitude'] ,data.position['latitude'] ).transform(epsg4326, projectTo);
	    
	    var zoom=17;
	    
	    map.setCenter (lonLat, zoom);
	
	    var vectorLayer = new OpenLayers.Layer.Vector("Overlay");
	    
	    // Define markers as "features" of the vector layer:
	    var feature = new OpenLayers.Feature.Vector(
	            new OpenLayers.Geometry.Point( data.position['longitude'], data.position['latitude'] ).transform(epsg4326, projectTo),
	            {description:'<b>' + data.markerName + '</b> <br>' + 'Latitud:   ' +  data.position['latitude'] + '<br>'
     							+ 'Longitud: ' +  data.position['longitude'] + '<br>'
     							} ,
	            {externalGraphic: 'views/cargarinfo/img/marker.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
	        );    
	    vectorLayer.addFeatures(feature);
	    
	    map.addLayer(vectorLayer);
	 
	    
	    //Add a selector control to the vectorLayer with popup functions
	    var controls = {
	      selector: new OpenLayers.Control.SelectFeature(vectorLayer, { onSelect: createPopup, onUnselect: destroyPopup })
	    };
	
	    function createPopup(feature) {
	      feature.popup = new OpenLayers.Popup.FramedCloud("pop",
	          feature.geometry.getBounds().getCenterLonLat(),
	          null,
	          '<div class="markerContent">'+feature.attributes.description+'</div>',
	          null,
	          true,
	          function() { controls['selector'].unselectAll(); }
	      );
	      //feature.popup.closeOnMove = true;
	      map.addPopup(feature.popup);
	    }
	
	    function destroyPopup(feature) {
	      feature.popup.destroy();
	      feature.popup = null;
	    }
	    
	    feature.popup = new OpenLayers.Popup.FramedCloud("pop",
	          feature.geometry.getBounds().getCenterLonLat(),
	          null,
	          '<div class="markerContent">'+feature.attributes.description+'</div>',
	          null,
	          true
	      );

	      map.addPopup(feature.popup);
	    
	    map.addControl(controls['selector']);
	    controls['selector'].activate();
      
    }
    
$("#encrypt(botonprocesar)").on("click", function(e) {

	$('#modalLoad').addClass('modalLoad').removeClass('modalLoadUpload');

	$('#datepicker').datepicker('remove');

	var fileInput = $("#encrypt(puerto)");
	var data = new FormData();
    data.append("puerto", fileInput[0].files[0]);
    
    var fileInput_cargas_oceanicas = $("#encrypt(cargas_oceanicas)");
	var data_cargas_oceanicas = new FormData();
    data.append("cargas_oceanicas", fileInput_cargas_oceanicas[0].files[0]);
    
	$.ajax({
        url: request_uri + '?url=procesar/ft/upload/dfadfafd', 
        type: "POST", 
        dataType: "json",            
        data: data,
        async: true,
        contentType: false,                  
        processData:false,        
        success: function(data)   
        {
        	
        	if(data.notLoadOceanic){
        		alert("Ela archivo de cargas oceánicas no contiene información de la estación a procesar.");
        	}else{
        		$("#encrypt(botonprocesar)").hide();
        		params = 'model-' + data.strucFolder.prefijo + '-' + data.markerName;
        		location.href= request_uri + "?url=segundoplano/pg/" + params;
        	}
        	
        }
    });
    
});

