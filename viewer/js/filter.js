/*
var arr = new Array();
var markersArray = new Array();
var globalArr = new Array();

var mapOptions;
var map;
*/



   
/*
function post_ajax()
     {
        mapOptions = { center: new google.maps.LatLng(31.035, 31.374),zoom: 13, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
        map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions); 

                //var searchInput = getElementById(searchInput).value;

                if (window.XMLHttpRequest)
                  {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp1=new XMLHttpRequest();
                  }
                else
                  {// code for IE6, IE5
                  xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");
                  }
                xmlhttp1.onreadystatechange=function()
                  {
                  if (xmlhttp1.readyState==4 && xmlhttp1.status==200)  
                    {
                        //alert(xmlhttp1.responseText);
                       //document.getElementById("table-view").innerHTML=xmlhttp1.responseText;
                       var txt = xmlhttp1.responseText;
                       var arr = txt.split('/');
                       //alert(arr);
                        showMap(arr);
        			   
                    }
                  }
              
                xmlhttp1.open("GET","index.php?getFilter");
                xmlhttp1.send();
        
        }
function showMap(arr) {
        globalArr = arr;          
        for(i = 0; i < arr.length-1 ;i=i+9)    
            {
                
                var point = new google.maps.LatLng(arr[i+1],arr[i+2]);
                var image = 'viewer/images/icon/'+arr[i+7]+'.png';
                var name = arr[i+3];
                var marker = new google.maps.Marker({
                position: point ,
                map: map,
                icon: image,
                draggable:false,
                animation: google.maps.Animation.DROP,
                title: name
              });
              markersArray.push(marker);
              var contentString ='<IMG BORDER="0" style="width:50px; height:50px;" ALIGN="Left" SRC="viewer/images/logos/'+arr[i+4]+'">  '+'<a href="index.php?userid='+arr[i+8]+'">'+arr[i+3]+'</a>'+'</br>'+arr[i+6]+'</br>'+arr[i+5];
 
              addInfoWindow(marker,contentString);
              
              

              }


            
                    

    }

function showFilter(cat){
    
        clearMarkers();
        
        for(i = 0; i < globalArr.length-1 ;i=i+9)    
            {
                var point = new google.maps.LatLng(globalArr[i+1],globalArr[i+2]);
                var image = 'viewer/images/icon/'+globalArr[i+7]+'.png';
                var name = globalArr[i+3];
                var type = globalArr[i+7];
                if(type == cat) {
                    var marker = new google.maps.Marker({
                        position: point ,
                        map: map,
                        icon: image,
                        draggable:false,
                        animation: google.maps.Animation.DROP,
                        title: name
                    })
                 markersArray.push(marker);
                    
                var contentString ='<IMG BORDER="0" style="width:50px; height:50px;" ALIGN="Left" SRC="viewer/images/logos/'+globalArr[i+4]+'">  '+'<a href="index.php?userid='+globalArr[i+8]+'">'+globalArr[i+3]+'</a>'+'</br>'+globalArr[i+6]+'</br>'+globalArr[i+5];
                
                addInfoWindow(marker,contentString);
                
                
              }
              

            }

}

function addInfoWindow(marker,contentString)
{
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(contentString);
                infowindow.open(map,marker);
            
             });
             //infowindow.close();
}

function clearMarkers() {
    //alert(markersArray);
    for (var i = 0; i < markersArray.length; i++ ) {
    markersArray[i].setMap(null);
  }                
}




 function show(vars){
     $(function() { 
 				demo.add(function() {			
 					$('#map_canvas').gmap({'center': '31.04, 31.38', 'zoom': 13 }).bind('init', function(evt, map) { 
 						//$('#map_canvas').gmap('addControl', 'tags-control', google.maps.ControlPosition.TOP_LEFT);
 						$('#map_canvas').gmap('addControl', 'radios', google.maps.ControlPosition.TOP_LEFT);
 						var southWest = map.getBounds().getSouthWest();
 						var northEast = map.getBounds().getNorthEast();
 						var lngSpan = northEast.lng() - southWest.lng();
 						var latSpan = northEast.lat() - southWest.lat();
                             
 						var images = ['icon2/rest.png',
                          'icon2/cofe.png'];
 						var tags = ['Resturant', 'Coffe'];
 						//$('#tags').append('<option value="all">All</option>');
 						$.each(tags, function(i, tag) {
 							//$('#tags').append(('<option value="{0}">{1}</option>').format(tag, tag));
 							$('#radios').append(('<label style="margin-right:5px;display:block;"><input type="checkbox" style="margin-right:3px" value="{0}"/>{1}</label>').format(tag, tag));
 						});
 						for ( i = 0; i < 100; i+2 ) {
 							var temp = [];
 							for ( j = 0; j < Math.random()*5; j++ ) {
 								temp.push(tags[Math.floor(Math.random()*10)]);
 							}
 							$('#map_canvas').gmap('addMarker', { 'icon': 'icon2/'.vars[i], 'tags':temp, 'bound':true, 'position': new google.maps.LatLng(vars[i+1]) } ).click(function() {
 								var visibleInViewport = ( $('#map_canvas').gmap('inViewport', $(this)[0]) ) ? 'I\'m visible in the viewport.' : 'I\'m sad and hidden.';
 								$('#map_canvas').gmap('openInfoWindow', { 'content': $(this)[0].tags + '<br/>' +visibleInViewport }, this);
 							});
 						}
                         
 						$('input:checkbox').click(function() {
 							$('#map_canvas').gmap('closeInfoWindow');
 							$('#map_canvas').gmap('set', 'bounds', null);
 							var filters = [];
 							$('input:checkbox:checked').each(function(i, checkbox) {
 								filters.push($(checkbox).val());
 							});
 							if ( filters.length > 0 ) {
 								$('#map_canvas').gmap('find', 'markers', { 'property': 'tags', 'value': filters, 'operator': 'OR' }, function(marker, found) {
 									if (found) {
 										$('#map_canvas').gmap('addBounds', marker.position);
 									}
 									marker.setVisible(found); 
 								});
 							} else {
 								$.each($('#map_canvas').gmap('get', 'markers'), function(i, marker) {
 									$('#map_canvas').gmap('addBounds', marker.position);
 									marker.setVisible(true); 
 								});
 							}
 						});
 					});
 				}).load();
 			});
         }
 */