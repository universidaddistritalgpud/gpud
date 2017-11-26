 $(document).ready(function(){
   
   var modal = document.getElementById('myModal');

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	
 	if(document.getElementById("img1")){
 		var spanimg1 = document.getElementById('spanimg1');
     	var img1 = document.getElementById('img1');
     	
     	spanimg1.onclick = function(){
     		$("#myModal").modal("show");
		    //modal.style.display = "block";
		    modalImg.src = img1.src;
		    captionText.innerHTML = this.alt;
		    
		    document.getElementById("menu").style.display = 'none';
		    document.getElementById("footer").style.display = 'none';
		    $('body').css('overflow','hidden');
		}

	}  
	
	if(document.getElementById("img2")){
 		var spanimg2 = document.getElementById('spanimg2');
     	var img2 = document.getElementById('img2');
     	
     	spanimg2.onclick = function(){
     		$("#myModal").modal("show");
		    //modal.style.display = "block";
		    modalImg.src = img2.src;
		    captionText.innerHTML = this.alt;
		    
		    document.getElementById("menu").style.display = 'none';
		    document.getElementById("footer").style.display = 'none';
		    $('body').css('overflow','hidden');
		    
		}

	}  
	
	if(document.getElementById("img3")){
 		var spanimg3 = document.getElementById('spanimg3');
     	var img3 = document.getElementById('img3');
     	
     	spanimg3.onclick = function(){
	     	$("#myModal").modal("show");
		   // modal.style.display = "block";
		    modalImg.src = img3.src;
		    captionText.innerHTML = this.alt;
		    
		    document.getElementById("menu").style.display = 'none';
		    document.getElementById("footer").style.display = 'none';
		    $('body').css('overflow','hidden');
		    
		}

	}  
	
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");
	
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() { 
	    modal.style.display = "none";
	    document.getElementById("menu").style.display = 'block';
	    document.getElementById("footer").style.display = 'block';
	    $('body').css('overflow','scroll')
	}
	
	
	$(function() {
		// OPACITY OF BUTTON SET TO 0%
		$(".roll").css("opacity","1");
		 
		// ON MOUSE OVER
		$(".roll").hover(function () {
		 
		 	$(this).css('background', '#729fcf');
		 
			// SET OPACITY TO 70%
			//$(this).stop().animate({
			//opacity: .7
			//}, "fast");
			},
		 
			// ON MOUSE OUT
			function () {
			 
			 $(this).css('background', 'white');
			 
			// SET OPACITY BACK TO 50%
			//$(this).stop().animate({
			//opacity: 0
			//}, "slow");
			});
		});
                
  });
  
  
  function OpenStreetMap(){
    	
    	var longitud = 'getDefine(LONGITUD)';
    	var  latitud = 'getDefine(LATITUD)';
    	var punto = 'getDefine(PUNTO)';
    
    	map = new OpenLayers.Map("mapdiv");
	    map.addLayer(new OpenLayers.Layer.OSM());
	    
	    epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
	    projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)
	   
	    var lonLat = new OpenLayers.LonLat( longitud, latitud ).transform(epsg4326, projectTo);
	    
	    var zoom=17;
	    
	    map.setCenter (lonLat, zoom);
	
	    var vectorLayer = new OpenLayers.Layer.Vector("Overlay");
	    
	    // Define markers as "features" of the vector layer:
	    var feature = new OpenLayers.Feature.Vector(
	            new OpenLayers.Geometry.Point( longitud, latitud ).transform(epsg4326, projectTo),
	            {description:'<b>' + punto + '</b> <br>' + 'Latitud:   ' +  latitud + '<br>'
     							+ 'Longitud: ' +  longitud + '<br>'
     							} ,
	            {externalGraphic: 'views/procesamiento/img/marker.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
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
    
    OpenStreetMap();
