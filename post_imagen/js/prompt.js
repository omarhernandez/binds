nombreimagen = "";

$(document).ready(function(){
	jsonVarGlobal = globalVars();               
	
	$("#setNw__pic").live("click", function(){
        
		sendToMyHighlight ="";
		
		sendToMyHighlight +=  "<div id='inside'><table class='forms' id='tablafromurl'>";
		
		sendToMyHighlight+= "<tr>";
		
		sendToMyHighlight+= "<td>";
		
		sendToMyHighlight+= '<span class="pbox"> Desde URL :</span>  ';
		
		sendToMyHighlight+= "</td>";
		
		sendToMyHighlight+= "<td>";
		
		sendToMyHighlight +=  '<div class="response_query">'+
		'<input id="URL_data" class="live-tipsy" type="text"'+
		' original-title="Pega la URL de la imagen que deseas agregar">'+
		'</div>';
	
		sendToMyHighlight+= '<div id="errorPicLoad" ></div>';
		
		sendToMyHighlight +=  '<a class="buttonOrange right" type="button" id="fromURL">Visualizar</a>';
		
		sendToMyHighlight+="</td>";
		
		sendToMyHighlight+="</tr>";            
		
		sendToMyHighlight +=  "</table >";
            
		//Tabla2
            
		sendToMyHighlight+= "<table id='sep'>"

		sendToMyHighlight+= "<tr> <td id='separador'> <div id='barrita'></div> <p id='o'>O</p> <div id='barrita2'></div></td></tr>";
            
		sendToMyHighlight+="</table>";
            
		//Tabla3
            
		sendToMyHighlight +=  "<table class='forms' id='uplBttn'>";
     
		sendToMyHighlight+= "<tr>";
       
		sendToMyHighlight+= "<td>";
          		 
		sendToMyHighlight+='<form id="imageProc" enctype="multipart/form-data" name="formUp" method="post">'+
		'<input id="fileImage" class="file" type="file" name="foto"/>'+
		'</form>';
	  
		sendToMyHighlight+= "</td>";
															
            
		sendToMyHighlight+= "</tr>";

		sendToMyHighlight +=  '</table >';
				
		sendToMyHighlight+='</div>';
            
		sendToMyHighlight+="<div id='picapic'></div>"
            		 
		binds.box({ // damos formato al box
			title:"Agregar Imagen" ,
			height:"auto",
			width: "600",
			top :"25%",
			content : sendToMyHighlight
		});
            
		$('input.live-tipsy').tipsy({ // llamamos el tipsy ( tooltip)
			live:true , 
			trigger: 'focus', 
			gravity: 'w'
		});
     
	});
	
	
	$("#fileImage").live("change",function(){
		$('#show-loader-box').show();
		$("#picapic").html("");
		$("#picapic").hide();
		

		$("#sep").fadeOut(200, function(){
			$("#tablafromurl").fadeOut("fast")
		});
		
		binds.UploadMedia({
			Type		: "Imagen",
			idForm		: "#imageProc",
			idAppend	: "#picapic"
		});
		
		//succesfulUplPC();
	});
    
	$("#fromURL").live("click", function(){
		var dire = $("#URL_data").val();
		$('#show-loader-box').show();
		getFromURL(dire);
	});
});

function succesfulUplPC(){
	setTimeout(function(){
			$('#show-loader-box').hide();
			setDescription()
			$("#picapic").fadeIn("slow")
		},600)	//ponemos los otros
}

function treatImage(datos){
	$('#show-loader-box').hide();
	$("#picapic").hide();
	var bol =  datos.rslImage.rems;
	//Si se recibio una imagen 
	if(bol ==='true'){
		//Quitamos los elementos  
		
		$("#sep").fadeOut(200, function(){
		
			$("#uplBttn").fadeOut(100);
			$("#sep").delay(100).remove();
			$("#uplBttn").delay(100).remove();
		});
		$("#picapic").html("<div id='picLoadContainer'><img width='210' src='photo/"+datos.rslImage.nombre+"'/></div>")//,function(){

		setTimeout(function(){
			setDescription()
			$("#picapic").fadeIn("slow")
		},300)	//ponemos los otros
	}
        
	else{
		var error1 = datos.rslImage.rems;
		displayErrorinPic(error1)
	}
}

function displayErrorinPic(error){
	$("#errorPicLoad").html(error).fadeIn("slow",function(){
			$(this).delay(1200).fadeOut("slow");
		});
}

function getFromURL(dire){
	$.ajax({
		type: "POST",
		url: "post_imagen/class_post_imagen/getImageURL.php",
		data : {
			"en": dire
		},
		dataType: "json",
		success: treatImage,
		error: errorOnSendingLink,
		timeout: 50000
	});
}

function errorOnSendingLink(){
	binds.error();
}



$("#descarea").live("click",function(){
	var desc = $("#descarea").val();
	if(desc === "Describe tu imagen"){
		$("#descarea").val("");
	}
});
				
$("#descarea").live("keyup",function(){
	var len = this.value.length;
	if (len > 300) {
		//this.value = this.value.substring(0, 300);
		$('#charLeft').css("color", "red");
		$("#bttnpost").css("opacity","0.4");
	}
	else{
		$('#charLeft').css("color", "black");
		$("#bttnpost").css("opacity","1");
	}
	$('#charLeft').html(300 - len);
})
				
//boton enviar

function setLoader(){
	$('#show-loader-box').show();
}

function showAllPi(){
			
	$('#show-loader-box').hide();		
	
	$(".bindsbox").delay(10).fadeOut("slow" , function(){ 
		$(this).remove();
		$('.block').remove() ;
		$(".tipsy").remove();                 
	});
   
	window.location ="profile.php?id="+jsonVarGlobal.user_id_current;
}

function errorOnSendMsg(){
	binds.error();
}

function setDescription(){
	$("#picapic").append('<div id="desPicContainer" ><div class="response_query">'+
		'<textarea id="descarea" class="areatext" type="text"'+
		' original-title="Describe tu imagen" cols="30" rows="3" >'+
		'Describe tu imagen</textarea></div></div>');
	$("#picapic").append('<h2 id="charLeft">300</h2>')
	$("#picapic").append('<div class="fixBlue" id="bttnpost">Postear</div>');

}



//**************************************************************************************************************************************


$("#bttnpost").live("click", function(){
	if(($("#descarea").val() != "Describe tu imagen") && ($("#descarea").val() != "") &&  ($("#descarea").val().length <301 ) ){ 
		if ( nombreimagen== ""){   
			nombreimagen  =   $("#picLoadContainer:first").children("img").attr("src").replace("photo/","");
		}             
		//alert("");
		$.ajax({
			type: "POST",
			url: "post_imagen/class_post_imagen/upload_Photo.php",
			data:{
				content:	nombreimagen, 
				desc: "<p>"+$("#descarea").val()+ "</p>" ,   
				create_   :   jsonVarGlobal.user_id_current  ,     
				setdata   :     jsonVarGlobal.data
			},
			beforeSend: setLoader ,
			success: showAllPi,
			error: errorOnSendMsg,
			timeout: 7000
		});             
	}
	
});
