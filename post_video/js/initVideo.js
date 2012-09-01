var nombreVideo;
var isNonblank_re    = /\S/;

$(document).ready(function(){
	
	jsonVarGlobal = globalVars();
	
	$("#setNw__vid").click(function(){
		
		sendToMyHighlight ="";
        
		sendToMyHighlight +=  "<div id='videoBoxContainer'><table class='forms' id='tablaVideofromurl'>";
     
		sendToMyHighlight+= "<tr>";
     
		sendToMyHighlight+= "<td>";
     
		sendToMyHighlight+= '<span class="pbox"> Desde URL :</span>  ';
		
		sendToMyHighlight+= "</td>";
		
		sendToMyHighlight+= "<td>";
		
		sendToMyHighlight +=  '<div class="response_query">'+
		'<input id="URL_video_data" class="live-tipsy" type="text"'+
		' original-title="Pega la URL del video">'+
		'</div>';
		
		sendToMyHighlight+= '<div id="errorVidLoad" ></div>';
           
		sendToMyHighlight +=  '<a class="buttonOrange right" type="button" id="videoFromURL">Visualizar</a>';
            
		sendToMyHighlight+="</td>";
            
		sendToMyHighlight+="</tr>";            
            
		sendToMyHighlight +=  "</table >";
            
		//Tabla2
            
		/*sendToMyHighlight+= "<table id='sepVid'>"

		sendToMyHighlight+= "<tr> <td id='separadorV'> <div id='barraLeft'></div> <p>O</p> <div id='barraRi'></div></td></tr>";
            
		sendToMyHighlight+="</table>";*/
            
		//Tabla3
            
		/*sendToMyHighlight +=  "<table class='forms' id='uplVidBttn'>";
     
		sendToMyHighlight+= "<tr>";
       
		sendToMyHighlight+= "<td>";
          		 
		sendToMyHighlight+='<form id="vidInput" enctype="multipart/form-data" name="formUp" method="post">'+
		'<input id="fileVideo" class="file" type="file" name="video"/>'+
		'</form>';
	  
		sendToMyHighlight+= "</td>";
		
		sendToMyHighlight+= "</tr>";

		sendToMyHighlight +=  '</table >';*/
				
		sendToMyHighlight+='</div>';
            
		sendToMyHighlight+="<div id='videoDisplay'></div>"
            		 
		binds.box({ // damos formato al box
			title:"Agregar Video" ,
			height:"auto",
			width: "780",
			top :"25%",
			content : sendToMyHighlight,
			onClose	:	function(){
				
				$("#videoDisplay").fadeOut(100);
			}
		});
            
		$('input.live-tipsy').tipsy({ // llamamos el tipsy ( tooltip)
			live:true , 
			trigger: 'focus', 
			gravity: 'w'
		});
  
	})
	

	$("#videoFromURL").live("click",function(){
		var text = $("#URL_video_data").val();
		if (text != "" && text != " "){
			$('#show-loader-box').show();
			$("#videoDisplay").html("");
			//$("#uplVidBttn").fadeOut("fast")
			//$("#separadorV").fadeOut("fast");
			
			insertVideoFromURL(text);
			setTimeout(function() {
				$("#videoDisplay").delay(100).fadeIn("slow")        
				$('#show-loader-box').hide();
			}, 1000);
		}
	})
	
	$("#vidInput").live("change",function(){
		uplVideo()
	})


	$("#descareaV").live("click",function(){
		var desc = $("#descareaV").val();
		if(desc === "Describe tu video"){
			$("#descareaV").val("");
		}
	});
	
	
	$("#descareaV").live("keyup",function(){
		var len = this.value.length;
		if (len > 300) {
			//this.value = this.value.substring(0, 300);
			$('#charLeftV').css("color", "red");
			$("#bttnVpost").css("opacity","0.4");
		}
		else{
			$('#charLeftV').css("color", "black");
			$("#bttnVpost").css("opacity","1");
		}
		$('#charLeftV').html(300 - len);
	});
	
	
	$("#bttnVpost").live("click",function(){
		if(($("#descareaV").val() != "Describe tu video") && ($("#descareaV").val() != "") &&  ($("#descareaV").val().length <301 ) ){ 
           		
			$.ajax({
				type: "POST",
				url: "post_video/class/uploadVideo.php",
				data:{
					content	:	nombreVideo,
					desc	:	"<p>"+$("#descareaV").val()+ "</p>" ,   
					create_ :	jsonVarGlobal.user_id_current  ,     
					setdata :	jsonVarGlobal.data
					
				},
				success: showStory,
				error: errorVideo,
				timeout: 7000
			});             
		}
	})
})



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function checkID(idV,typeV){
	$.ajax({
		type	:	"POST",
		url		:	"post_video/class/c_if_exist.php",
		data	:	{
			id		:	idV,
			type	:	typeV
		},
		dataType	:	"JSON",
		success	:	displayIfVideoExist,
		error	:	errorVideo
	})
}

function displayIfVideoExist(datos){

	if(datos.query.exist){
		if(datos.query.tipo === "youtube"){
			nombreVideo ='<iframe width="465" height="262" src="http://www.youtube.com/embed/'+datos.query.id+'?wmode=transparent"'+
			'frameborder="0" allowfullscreen></iframe>'
		
			$("#videoDisplay").append('<iframe width="380" height="213" src="http://www.youtube.com/embed/'+datos.query.id+'?wmode=transparent" '+
				'frameborder="0"></iframe>')

		}
		else{

			nombreVideo = '<iframe class="video" src="http://player.vimeo.com/video/'+datos.query.id+'" width="465" height="262"'+ 
			'frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			
			$("#videoDisplay").append('<iframe src="http://player.vimeo.com/video/'+datos.query.id+'" width="380" height="213" '+
				'frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>')
		}
		
		setDescripcionV();
	}
	else
		showErrorInURL();	
}

function uplVideo(){
	$("#videoDisplay").html("");
	$('#show-loader-box').show();
	binds.UploadMedia({
		Type		: "Video",
		idForm		: "#vidInput",
		idAppend	: "#videoDisplay",
		phpFileTratment	:	"class/video_verification_upload.php"
	});
	$("#uplVidBttn").fadeOut("fast")
	$("#separadorV").fadeOut("fast");
	setDescripcionV()
		
	setTimeout(function() {
		$("#videoDisplay").delay(100).fadeIn("slow")        
		$('#show-loader-box').hide();
	}, 1000);

}

function insertVideoFromURL(text){
	if(isNonblank(text) || text != ""){
		//primero checamos por youtube
		var n = text.match("youtube")
		if (n != null && n != undefined){
		
			var myRe = /v\=([\-\w]+)/
			var id = myRe.exec(text);
			if(id == null || id == undefined || id == "")
				showErrorInURL();
			else
				checkID(id[1],"youtube")
		}
	
		//si no checamos por vimeo
		else{
			n = text.match("vimeo")
			//http://vimeo.com/3612941 
			//
			if(n != null && n != undefined){
				id = text.search(".com/")
				var ids = text.slice(id+5);
				console.log(ids);
				if(ids == null || ids == undefined || ids == "")
					showErrorInURL();
				else
					checkID(ids,"vimeo")
			}
			else
				showErrorInURL()
		}	
	}
	else
		showErrorInURL()
}

function errorVideo(){
	binds.error();
}

function setDescripcionV(){
	$("#videoDisplay").append('<div id="desVidContainer" ><div class="response_query">'+
		'<textarea id="descareaV" class="areatext" type="text"'+
		' original-title="Describe tu video" cols="30" rows="3" >'+
		'Describe tu video</textarea></div><div class="fixBlue" id="bttnVpost">Postear</div><h2 id="charLeftV">300</h2></div>');
}

function showStory(){
	$('#show-loader-box').hide();
	$(".bindsbox").delay(10).fadeOut("slow" , function(){ 
		$(this).remove();
		$('.block').remove() ;
		$(".tipsy").remove();                 
	});
	
	window.location ="profile.php?id="+jsonVarGlobal.user_id_current;
}

function isNonblank (s) {
	return String (s).search (isNonblank_re) != -1
}

function showErrorInURL(){
	$("#errorVidLoad").html("URL invalido").fadeIn("slow",function(){
		$(this).delay(1200).fadeOut("slow");
	});
}