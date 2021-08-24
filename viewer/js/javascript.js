function deleteImage(menu_id) {
    
    
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
                document.getElementById(menu_id).style.display="none";
                document.getElementById(menu_id+5).style.display="none";
                //document.getElementsByName('delete').style.display="none";
                //document.forms['control-panel']['delete'].style.display="none";
                
           
                //var node = document.getElementById(menu_id);
                //var node2 =document.getElementById(menu_id+1)                
            	//node.parentNode.removeChild(node);
                //node2.parentNode.removeChild(node2);			   
            }
        }
              
        xmlhttp1.open("GET","index.php?delete="+menu_id);
        xmlhttp1.send();
    
}
   // upload image
