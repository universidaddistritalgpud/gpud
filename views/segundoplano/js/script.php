/* $("#sidenav").hide();
$("#botonprocesar").hide();

$('#puerto').filestyle({
	buttonText : 'Buscar Archivo Rinex',
	buttonName : 'btn-primary',
	size : 'nr'
});

$("#puerto").on("change", function(e) {
	
	var globalData;
	
	$('#datepicker').datepicker('remove');

	var fileInput = $("#puerto");
	var data = new FormData();
    data.append("puerto", fileInput[0].files[0]);
    
	$.ajax({
        url: '<?php echo "http://localhost/workspace/tesisPPP/index.php?url=procesar/ft/information/dfadfafd" ?>', 
        type: "POST", 
        dataType: "json",            
        data: data, 
        contentType: false,                  
        processData:false,        
        success: function(data)   
        {
            if(data.isRinex == true){
            	
            	globalData = data;
            	
            	$('#datepicker').datepicker('setDate', new Date(data.date['year'] + " " + data.date['month'] + " " + data.date['day'] ));
            	$('#date').html(data.date['day'] + "-" + data.date['monthText'] + "-" + data.date['year']);
            	$('#daygnss').html(data.daygnss);
            	$('#weekgnss').html(data.weekgnss);
            	$('#dayofyear').html(data.dayofyear);
            	$('#typeantenna').html(data.antenna);
            	$('#station').html(data.markerName);
            	$('#julian').html(data.dayjulian);
            	$('#dayofweek').html(data.date['dayText']);
            	
            	map(data);
            	
            	$("#sidenav").show();
            	
            	$( "#sidenav" ).focus();
            	
            	$("#botonprocesar").show();
            		
            }else {
            	$('#puerto').filestyle('clear');
            	
            	alert("El archivo seleccionado no corresponde a un archivo de tipo RINEX, \n por favor verifique e intente de nuevo.");
            	
            	$("#sidenav").hide();
            	
            	$( "#alerta1" ).focus();
            	
            	globalData = [];
            }
            
        }
    });
    
    function map(data){
    
    	var mapCanvas = document.getElementById("map");

 		var contentString = '<div id="content">'
     							+ 'Latitud: ' +  data.position['latitude'] + '<br>'
     							+ 'Longitud: ' +  data.position['longitude'] + '<br>'
     							+ 'Nombre del Punto: ' + data.markerName + '<br>'
      							+ '</div>';

  		var infowindow = new google.maps.InfoWindow({
    		content: contentString
  		});

	  	var myLatLng = {lat: data.position['latitude'], lng: data.position['longitude']};

  		var map = new google.maps.Map(document.getElementById('map'), {
    		zoom: 15,
    		mapTypeId: google.maps.MapTypeId.HYBRID,
    		center: myLatLng
  		});
  		
  		var marker = new google.maps.Marker({
    		position: myLatLng,
    		map: map,
    		title: 'BOGOT'
  		});
  				
		infowindow.open(map, marker);
 		
 		marker.addListener('click', function() {
    		infowindow.open(map, marker);
  		});
  		
  		google.maps.event.trigger(map, 'resize');
 		
    }
    
});

$("#botonprocesar").on("click", function(e) {

	var urlPostProcess;
	
	$('#datepicker').datepicker('remove');

	var fileInput = $("#puerto");
	var data = new FormData();
    data.append("puerto", fileInput[0].files[0]);
    
	$.ajax({
        url: '<?php echo "http://localhost/workspace/tesisPPP/index.php?url=procesar/ft/upload/dfadfafd" ?>', 
        type: "POST", 
        dataType: "json",            
        data: data, 
        async: false,
        contentType: false,                  
        processData:false,        
        success: function(data)   
        {
        	urlPostProcess = 'http://localhost/workspace/tesisPPP/index.php?url=postprocesar/ft/model-' + data.strucFolder.prefijo + '-' + data.markerName;
        }
    });
    
    $.ajax({
		url: urlPostProcess, 
		type: "POST", 
		dataType: "json",            
		data: data, 
		contentType: false,                  
		processData:false,        
		success: function(data)   
		{
		       	
		}
    });
    
});
*/