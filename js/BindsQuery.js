$(document).ready(function(){	
  
 
              
	//****************** delete post coments**********************************************************************
  
	// show remove buttons 
	$('.structChatComnt').live("mouseenter", function(e){
                  
		var idE  =  $(this);

		var temp    = idE.attr('id');

		var div =  $('#'+temp); // obtenemos el id del div actual
                  
		div.addClass('structChatComntHover'); 
                  
		//obtenemos el boton delete para que aparesca  
		$('#dlt'+temp).show();
                 
	});
                
                
                
	$('.structChatComnt').live("mouseleave", function(e){
		
                    
		var idE  =  $(this); // elemento onmouserover

		var temp    = idE.attr('id');

		var div =  $('#'+temp);
                  
                  
		div.removeClass('structChatComntHover')
             
		$('#dlt'+temp).hide();
                    
                
	});
             
	//**************************** para delete reply *****************************************************************
	$('.deletereply').live("click", function(e){
                  
                

	

		if(confirm('Are you sure you want to delete this comment?')==false){

			return false;
           
		}else{
                 
			var idcomentreply   =  $(this).attr('id').replace('dltreply',''); 
                 
			$('#chatResponse'+idcomentreply).slideToggle(400);  
                 
		}
  
	});
                 
	 
  
	//************************** para cuando si ya es delete  ***********************************************************
  
	$('.delete').live("click", function(e){
		
                    
		var temp    =  $(this).attr('id').replace('dlt','');

		if(confirm('Are you sure you want to delete this comment?')==false){

			return false;
           
		}else{
                 
			$('#'+temp).slideToggle(600);  
                 
		}
  
	});
             
  
	//*************************************************************************************************
  
  
	// poner opaco el boton para compartir

	$('#comentArea').bind('keyup', function() {                                // para comentarios!!!!
             
      
		var a =  $("#comentArea").val();
                        
		if(a != "")
		{				
			$('#coment').css('opacity', '1');
			        
                              
                                
                                
		}
		else
		{
			$('#coment').css('opacity', '.5');
                               
		}
	} );
		
	//*************************************************************************************************
	function showLastComent(data){ // osea el comentario que acabamos de introducir
   
		$("#hlcontainer").prepend( $(getComentFormat(data)).fadeIn('slow'));  // mostramos el contenido ( comentarios )    
   
		// restablecemos los valores
				 
		$("#comentArea").val("");
		$('#QuestionContainer').css('opacity', '1'); // el contenedor general del area de comentarios
		$('#coment').css('opacity', '.5'); // el boton lo reestablecemos
		$('#Sendingcoments').css('display','none'); // loader
		$('#QuestionContainer').slideToggle(300);
	} 
             
	//*************************************************************************************************
  
          
	//*************************************************************************************************
                      
	function setLoaders(){
		$('#Sendingcoments').css('display','block');
	}  
	//*************************************************************************************************
	// al hacer click en compartir enviar por ajax el coment
        
	$('#coment').bind('click',function(){
             
   			
		var a =  $("#comentArea").val();
			
		if(a != "" )
			
		{
                     
                             
  
			var jsonVar;  // sacamos la informacion de la web
                                    
			$('#QuestionContainer').css('opacity', '.5');  
                       
			jsonVar  =  getGlobalVars();
                       
         
                       
       
			$.ajax({
        
				type: "POST",
				//   url: "class/coment.php?coment="+a+"&"+"user_set=" +jsonVar.user_id_current+"&"+"user_profile="+jsonVar.id_user_view+"&"+"type=posted"+"&"+"post_type=Ncmnt",
       
				url: "class/coment.php?type=posted",
				dataType: "json",
				data : {
					"user_set":jsonVar.user_id_current,
					"coment": a,
					"user_profile": jsonVar.id_user_view,
					"post_type":"Ncmnt"
				},
				beforeSend: setLoaders ,
				success: showLastComent,
				error: errorOnSendingMessage,
				timeout: 5000
			});
 
		}
	});	
                          
	//**************************************************************************************     
	//**************************************************************************************  
	//**************************************************************************************  
	//**************************************************************************************  
	//****************************GET INPUT PARA COMENTAR  **************************  
	//**************************************************************************************  
	//*****

	function getInputComent(){
        
		var getInputComent ;
     
		getInputComent +=          
		"<div id='contentComentThread'>"+  
           
		"<textarea class=' shareintxtArea inputComent' type='text' id='comentThreadArea' ></textarea>"    
        
		+" <a id='getCmntThread' type='button'   class='buttonOrange listButton'   >Enviar</a>"
     
		+" <a id='cancelCmntThread'  class='buttonGray fixbttnComnt'   >Cancelar </a> "
       
            
		+ "  <img src='images/loader/p6.gif'   class='loader' id='sendingcomentreply'/> "         
                      
		+"</div>";
        
		return getInputComent; 
        
	}

	//**************************************************************************************  
	//**************************** FUNCIONES DE MULTITHREAD COMENT **************************  
	//**************************************************************************************  
	//// para eliminar .slideToggle(500);
	//************************************************************************************** 
	//**************************************************************************************  
	//************************************************************************************** 
 
	//<input class="inputComent" type="text" placeholder="say something about the coment">
 
	// show remove buttons 
          
          
	function removeAreaComentThread(){ // eliminamos el coment existente
           
		$("#contentComentThread").hide();
		$("#contentComentThread").remove();
	}


	function setLoadersReply(){
                 
		$('#sendingcomentreply').show();
                 
	}
            
	function hideLoadersReply(){
                 
		$('#sendingcomentreply').hide();
                 
	}
            

	function addAreaComentThread(areaContainerComent){  // agregamos nuevo coment
           

 

		// scalamos hasta llegar al padre DIV que contiene el id del comentario

		var parent    =  $(areaContainerComent).parent().parent().parent();

 
		parent.append(  $(getInputComent()).fadeIn('slow'));
                 
                
		$("#comentThreadArea").autoResize({
			textHold: "Escribe tu comentario",
			minHeight:19
		});
                           
                 
                 

		//************************************ ENVIAR COMENTARIO AL HACER CLICK***********************************************************************
		$('#getCmntThread').bind('click',function(){
             
               
			checkAndsendComentReply($(this).parent().parent().attr("datatypepost"));
	

		});
                        
		//************************************* PROCESO PARA ENVIAR COMENTARIO REPLY**********************************************************************
                        
                        
		function checkAndsendComentReply(typeposttosendcoment){
                             
			var coment =  $("#comentThreadArea").val();
                        
                 
			
			if(coment!= "Escribe tu comentario"  )
		    
			{
				        
				var jsonVar;  // sacamos la informacion de la web
				$('#contentComentThread').css('opacity', '.5');
				jsonVar  =  getGlobalVars();
                     
                     
				if(jsonVar.set_location =="cronology"){ // si estamos en cronologia entonces le pasamos el id del comentario que stamos agarrando
                           
					id_user_post = jsonVar.user_id_current;   
				// jsonVar.id_user_view  = parent.children('.imageUserTip').attr("href").replace("profile.php?id=","");
           
				}else{
                              
					id_user_post = jsonVar.current_id;

				}
                      
                     
                      
				var  datatype = $("#containerreplycmnt-"+parent.attr("id")+"-"+typeposttosendcoment).attr('datatype') ;

                    

              
				$.ajax({
                     
					type: "POST",
					url: "class/coment.php?type=posted",
                   
					data : {
						"user_set":  id_user_post,
						"coment": coment,
						//    "user_profile": jsonVar.id_user_view,
						"post_type":"response",
						"parent_id":parent.attr("id"),
						'datatype':datatype
					},
					dataType: "json",
					beforeSend: setLoadersReply ,
					success: function (data){
                  
                  
						$("#containerreplycmnt-"+parent.attr("id")+"-"+typeposttosendcoment).append(  $(getComentReplyFormat(data)).fadeIn('slow'));  // mostramos el contenido ( comentarios )    
   
						// restablecemos los valores
						removeAreaComentThread();   // entonces solo lo eliminamos
						hideLoadersReply();
                             
						newcomentcount = parseInt( $("#cnt-"+parent.attr("id")).text())+1;
               
               
						switch(newcomentcount){
                        
							case 1:{
                                        
								msg="comentario";
							}
							break;
							case 0:{
                                        
								msg="comentario";
							}
							break;
                   
							default:{
                                        
								msg="comentarios";
							}
							break;     
                        
						}
                   
						$("#cnt-"+parent.attr("id")).html( newcomentcount);
                    
						$("#msg-"+parent.attr("id")).html(msg);
                        
					},
					error: errorOnSendingMessage,
					timeout: 5000
                 
				});
                
 
			}
                             
		}
                        
                        
		//******************************* CANCELAR COMENTARIO HIJO *******************************************************  
    
		$('#cancelCmntThread').bind('click',function(){
             
			removeAreaComentThread()   // entonces solo lo eliminamos
		 
			
		});
               
               
               
	}
	//**************************** ENVIAR COMENTARIO HIJO *******************************************************  
 
	$('.setComent').live("click", function(e){
                  
               
		current_element= this;
           
		if(document.getElementById("contentComentThread") !== null ) // checar si ya existe el elemento para no insertarlo varias veces
                   
		{
                      
			if( $(current_element).parent().parent().parent().attr("id") ===  $("#contentComentThread").parent().attr("id")){ // si el click proviene del mismo comentario padre
                           
				removeAreaComentThread();// entonces solo lo eliminamos
                                  
			}else{ // si proviene de otro comentario
                           
                           
				removeAreaComentThread()   // entonces solo lo eliminamos
				addAreaComentThread(this)      // y lo agregamos al nuevo comentario padre               
                                                                    
			} 
  
		}else{
            
			addAreaComentThread(this); // lo agregamos porque no existe y es nuevo el coment
           
		}
		
	});

 
	function errorOnSendingMessage(){
                             
		alert("demasiado tiempo")
		$('#coment').css('opacity', '.5');
		$('#Sendingcoments').css('display','none');
                             
                             
	}
                        
 
	//**************************** VER COMENTARIOS HIJOS *************************************
 
	$('.containerreplycmntbtton').live("click", function(e){
 
 
		var id  =  $(this).parent().parent().parent().attr("id"); // id del padre

		typeposttosendcoment = $(this).parent().parent().parent().attr("datatypepost");  //  obetenos el tipo del post lo concatenamos y vemos si realmente es ese id

 
		cantidad = document.getElementById("containerreplycmnt-"+id+"-"+typeposttosendcoment).childNodes;  // contamos cuantos comentarios hijos estan mostrados actualmente
           
		cont= 0;
		for(i=0;i<cantidad.length;i++){
			if(cantidad[i].className != null){
				if(cantidad[i].className == "strctChatResponse" ){
					cont++;      
				}
			}
		}
           
           
          
		$('#showcomentreply').show();
           
           
		if( $("#cnt-"+id).text()!= cont){ // si los comentarios que ya se estan mostrando es igual al total de los comentarios entonces no se muestra nada 
			//porque todos ya se mostraron
 
			var   limit =  cont;   // el mostrar todos los comentairos  - limit ( limit son los comentarios que ya se estan mostrando)
             
                
                
                
			var  datatype = $("#containerreplycmnt-"+id+"-"+typeposttosendcoment).attr('datatype') ; // TIPO DE CONTENIDO A MOSTRAR SUS COMENTARIOS RESPUESTAS
			// esto es cuando le das click en el boton de mostrar mas comentarios , va i primero obtiene el tipo de contenido puede ser articulo pregunta comentario
			// cuando obtenemos el tipo de contenido , tomamos el tipo lo enviamos por php y enviamos la consulta seleccionando el table correspondiente si es 1.- coment 2.- articulo ect
       
                             
			$.ajax({
        
				type: "POST",
				url: "class/coment.php?",
				data:{
					"parent_request":id ,
					"type":"reply_coment",
					"deniedDisplay":limit,
					"datatype": datatype
				},
   
				dataType: "json",
				beforeSend: function(){} ,
				success: function (data){
  
					$("#containerreplycmnt-"+id+"-"+typeposttosendcoment).prepend(  $(getComentReplyFormat(data)).fadeIn('slow'));  // mostramos el contenido ( comentarios )    
                 
					$('#showcomentreply').hide();
				},
				error: errorOnSendingMessage,
				timeout: 5000
                 
			});
 
 
		}else{
			$("#containerreplycmnt-"+id+"-"+typeposttosendcoment).slideToggle(500);  
			$('#showcomentreply').hide(); 
		}
 
 
	//   $('#containerreplycmnt-'+id).append( $(getComentReplyFormat(data)).fadeIn('slow'));   //entonces hacemos referencia a sus comentchilds

	//.slideToggle(500);;
	});

     
//************************************************************************************* 



//*************************************************************************************

});
   
 
   
   
//***************************************************************************************  
function getStructurenoPost(){
       
       
	$(window).unbind();
	return " <span class='nameto npost'>No hay mas publicaciones...</span> ";
          
}
   
 
//**************************************************************************************  

//**************************************************************************************  
//**************************************************************************************  
//**************************************************************************************  
function GetallFeedContentProfile(data){ // aqui se formatea el feed del usuario en su storyboard
 
    

	GetallFeed(data,"#hlcontainer"); // enviamos el contenedor de storyboard "#hlcontainer" 
 
//  fixLastElementHeight();// hay casos en el que una columna queda mas grande que la otra entronces checamos el height y vemos quien tiene mas y hacemos el fix

 

}
 


function fixLastElementHeight(){
 
 

	left  =   $('#colleftFeed').children(":last-child");
	right =  $('#colrightFeed').children(":last-child");
 
	if( $(' #colleftFeed ').height()  > ( $('#colrightFeed').height()+160)  ) 
	{
      
		$('#colrightFeed').append( left  );
      
	}else{
		$('#colleftFeed').append( right );
	}
          
 
     
     
     
	//********************************************************************************* recursion
     
	if( ( $(' #colleftFeed ').height()  - $('#colrightFeed').height())  >= 250  ||  ( $('#colrightFeed').height()) -$(' #colleftFeed ').height()   >= 250 ){
		fixLastElementHeight()
	} // si sigue siendo grande OTRA VEZ vamos de regreso!
 
}

 
 

function appendInformationintoColum(index,content){ // para que todos envie aqui su informacion y desde aqui se manipule correctamente
     
 
 

	$((index % 2 == 0) ? "#colleftFeed " : "#colrightFeed ").append(     $(content).delay(index * 180).fadeTo('slow',1)          );
                 
    
}


//**************************************************************************************  
//*****************************GET COMENTS***********************************************  
//**************************************************************************************  

                
                
                
function GetallFeed(data,container) {
               
        

               
        
	var GetMessageQuery = "";   
	var jsonData  =  getGlobalVars(); // get data      
	var timespendmsg ="";
          
            
 


       
	$.each(data.lstNwPst, function(i,item) {
   
		var jsonVar = getGlobalVars();       
     
		var GetReplyMessageQuery="";//las respuestas a los comentarios
		var GetMessageQuery="";

		var url_path  =  (item.type_user == 1 ) ? "./" : "./interest/"; // formateamos la url
 
		//********************************************************************************************************************************** 
		// SI EXISTE MENSAJE REPLY ENTONCES LO ALMACENAMOS ANTES DE VER QUE CONTENIDO ES , CUANDO LO ALMACENAMOS PROCEDEMOS A APPEND JUNTO CON EL TIPO DE ARCHIVO
        
     
       
		if(item.text_coment_reply!=false && item.text_coment_reply!= undefined){
          
     



			// comentarios hijos
			GetReplyMessageQuery = " <div class='strctChatResponse' id='chatResponse"+ item.id_coment_reply +"'> " +
                         
                         
			"<a href='"+item.id_user_posted_reply+"'> <img width='34' class='image' src='userpic_thumb/"+ item.reply_current_image_user+"' /></a> " +
                     
			"  <div   class='UIContntComentsChat fixStructResponceCmnt'>" +
                      
			"  <a href='"+item.id_user_posted_reply+"'> <span class='name UI_reply'>"+ item.reply_user_name +"</span></a> "+
                   
                     
			" <div   class='UiMSGResponse'>"+ item.text_coment_reply +"</div> " +
                   
                 
			"</div > "+
                         
                         
			"   <div class='stateComent fixpositionThread'  > " +
			"   <ul >  "  
            
			+
                
			"  <li class='floatRight comenty  uiIcon icon  cronologyicon'> "+ item.timespend_reply+" </li> ";
          
       
       
			//  si el usuario logeado es el comentario que se esta listando o el usuario logeado es igual al que se esta viendo , entonces que pueda eliminar comentarios
			if(jsonData .user_id_global== item.id_user_posted_reply || jsonData .user_id_global== jsonData.global_id_view){ // si yo no soy el usuario entonces no puedo eliminar el comentario
          
				GetReplyMessageQuery += "  <li class='floatRight comenty deletereply' id=dltreply"+ item.id_coment_reply +" >   Eliminar </li> ";
			}
              
          
          
			GetReplyMessageQuery +=  "</ul>"+
		" </div>"+      
                   
        
                   
		"</div>";    
               
        
		}
		//*************************************************************************************************************************************
		// FORMATEAMOS EL NUMERO DE COMENTARIOS A PLURAL O SINGULAR
  
  
		if(item.text_coment_reply==false || item.text_coment_reply==undefined){ // para cuando no hay comentarios!!! y no hay replies
			item.coment_count_reply = 0;
			timespendmsg =" Comentarios ";
		}else{
               
			switch(item.coment_count_reply){ // formatear la fecha en los comentarios
                    
				case "0": {
                         
					timespendmsg ="Ningun comentario ";
				}
				break;
				case "1": {
                         
					timespendmsg =" comentario ";
				}
				break; 
                     
                    
				default: {
                         
					timespendmsg =" comentarios ";
				}
				break;
			}
		}
  
  


		var  datatypepost =1;
        
		//*********************  VERIFICAMOS EL TIPO DE CONTENNIDO***************************************************************************************************
   
		switch(item.type_post)  
		{   
			//************************************** COMENTARIOS *********************************************************************************     
			case "1":{
               
               
				GetMessageQuery = "";   
               
				GetMessageQuery += " <div class='structChatComnt cmntClss'   id="+ item.id_contenido +" datatypepost="+datatypepost+" > " ;
             

    
             
				if(jsonData .user_id_global== item.contenido_userset || jsonData .user_id_global== jsonData.global_id_view){ // si yo no soy el usuario entonces no puedo eliminar el comentario
             
					GetMessageQuery += "  <div class='delete' id=dlt"+ item.id_contenido +"> "+

					"  <img src='images/icon/close.png'/>"+
            
					"</div>" ;     
				}
               
            

				GetMessageQuery += "   <a href='"+ item.contenido_userset+"' class='imageUserTip'   >"+

				" <img src='userpic_thumb/"+ item.post_current_image_user+"'   width='50' class='image' /> "+
   
				" </a>  " +
                     
				" <div  class='UIContntComentsChat'> " +  
				" <a href='"+ item.contenido_userset +"' > " + 
				" <span  class='UITextUserComent FixUserData name fixName'  > " +
      
				item.user_name_set
                  
				+" </span> "+
                     
				"</a>" ;
                  
                 
                  
             
				if(jsonVar.set_location =="cronology" && item.id_own_coment!=false){ // si estamos en cronologia entonces le pasamos el id del comentario que stamos agarrando
                           
                           
                           
					if( item.user_name_set ==item.user_own_coment ){
                        
						item.user_own_coment = "  Compartio un comentario ";
                        
                              
						GetMessageQuery +=   "   <span class='nameto fixtext '>"+item.user_own_coment+"</span> "; 
    
					}else{
                        
						if(jsonVar.user_id_global== item.id_own_coment)
						{
							GetMessageQuery +=   "  <span class='nameto  fixtext'> compartio un comentario en tu </span><a href='"+item.id_own_coment+"'><span class='nameto name'></span></a> "; 
        
                             
						}else{
							GetMessageQuery +=   "  <span class='nameto fixtext'>Comento a </span><a href='"+item.id_own_coment+"'><span class='nameto name'>"+item.user_own_coment+"</span></a> "; 
        
						}
                      
					}
                 
                      
				}

				GetMessageQuery += "<span class='UITextUserComent date fixOptComent '>  </span> " +
				" <span class='UITextUserComent date fixOptComent'>  </span> " + 
                     
				" <div class='UiMSGResponse' style='float:left; '>"+
                      
				item.contenido_texto
                 
                         
				+ " </div> " +
                 
				" </div> " +
        
           
				"   <div class='stateComent' > " +
				"   <ul >  " +
        
				" <li class='floatRight comenty containerreplycmntbtton'><img src='images/icon/comnts.png' class='imageCmnt'/> " +
    
				" <span id='cnt-"+item.id_contenido+"' > "+item.coment_count_reply+"</span>  <span id='msg-"+item.id_contenido+"'>"+timespendmsg+" </span></li> " ;
          
				if(jsonData.fllw_permision == 1 || jsonData .user_id_global== jsonData.global_id_view){ // si soy su seguidor podre comentar
           
           
					GetMessageQuery += "    <li class='floatRight comenty setComent '><img src='images/icon/comnty.png' class='imageCmnt'/> Comentar  </li> " ;
           
				}
          
				if(jsonVar.set_location =="cronology"){
               
					GetMessageQuery += "    <li class='floatRight comenty setComent'><img src='images/icon/comnty.png' class='imageCmnt'/> Comentar  </li> " ;    
               
               
				}
 
				GetMessageQuery += "    <li class='floatLeft comenty  uiIcon icon  cronologyicon'> "+ item.date + "</li> " +
          
				"</ul>"+
				" </div>"; // empieza a meter los child comnets
 
 
				GetMessageQuery+=" <div id='containerreplycmnt-"+item.id_contenido+"-"+datatypepost+"'  datatype='1'> "+GetReplyMessageQuery + " </div></div>" ;
 
     
  

				if(jsonVar.set_location =="profile"){
             
 



					appendInformationintoColum(i,GetMessageQuery);

				//lo inyectamos      en columna 

				}else{
                                      
                                     
             
					$(container).append(  $(GetMessageQuery).delay(index * 180).fadeTo('slow',1)  );  //lo inyectamos      
               
             
				}
     
     

               
               
               
			}
			break;     
			//**************************************** ARTICULOS ************************************************************************************
			case "2":{
               

         
				var datatypepost =2;
      
				var  getFeedArticle="";
         
				getFeedArticle  += "   <div class='structChatComnt' id="+ item.id_contenido +" datatypepost="+datatypepost+" > "+       
      
                  
                  
				"      <div  class='headArtic'> "+
                      
				"<a href=' "+item.contenido_userset+"'   class='imageUserTip'> <img class='image imagtit ' width='50'  src='userpic_thumb/"+item.post_current_image_user+"'></a>";
                      
                  
				if(jsonVar.set_location =="cronology"  || jsonData.set_location == "view_list" ) {


					getFeedArticle  +=  "<span class='titart'><a href='"+item.contenido_userset+"'  class='colorMain'> "+item.user_name_set+

					"</a> <span class='gray'> publico un artículo en <a href='./"+url_path+item.id_came_from+"'>"+item.name_came_from+"</a></span></span>" ;
    

				}else{

					getFeedArticle  +=  "<span class='titart'><a href='"+item.contenido_userset+"'  class='tit_art_ui'> "+item.user_name_set+"</a> <span class='gray'>  </span></span>" ;

				}

                    
                      
                      
				/*    " <ul class='rankstartsfixedart'><li class=' left view' > <img height='11' style='padding-right: 5px; ' src='images/stars.png'> "+
                    "<span class='rankstar'>Ranking 165482</span> </li> "+*/
				getFeedArticle  +=   " <ul class='rankstartsfixedart'>    "+
                                           
				"   <li class='floatRight comenty add_to_list datatip spacing' > Agregar a Lista </li>" +
                      
				"   <li class='floatRight comenty  add_to_highlight  datatip spacing divbord' data='enviar a destacados'> Destacados</li>" +
                      
                      
				" </ul>"+
                      
                      
                      
                      
				"</div>" +
                  
                  
                     
				"      <div  class='UIContntComentsChat'>  " +
                      
				"    <span  class='UITextUserComent FixUserData name fixName'  > </span> " +
				"    <span class='UITextUserComent date fixOptComent ' >  </span> " +
				"    <span class='UITextUserComent date fixOptComent '>  </span> "+
				"     <span class='UITextUserComent date fixOptComent'>  </span> "+
                     
				"    <div class='UiMSG article' style='float:left; '> ";
                      
                      
 
 

				getFeedArticle  +=    item.contenido_texto+
                    
                         
				"   </div>"+
                 
				" </div>"+
                  
                  
				"   <div class='stateComent' > " +
				"   <ul >  " +
             
               
              
              
				"   <li class='floatRight  uiIcon icon  highlighicon comenty view  view_article'>Ver Completo </li>" +
             
              
              
				" <li class='floatRight comenty containerreplycmntbtton'><img src='images/icon/comnts.png' class='imageCmnt'/> " +
    
				" <span id='cnt-"+item.id_contenido+"' > "+item.coment_count_reply+"</span>  <span id='msg-"+item.id_contenido+"'>"+timespendmsg+" </span></li> " ;
          
				if(jsonData.fllw_permision == 1 || jsonData .user_id_global== jsonData.global_id_view){ // si soy su seguidor podre comentar
            
           
					getFeedArticle += "    <li class='floatRight comenty setComent '><img src='images/icon/comnty.png' class='imageCmnt'/> Comentar  </li> " ;
           
				}
           
 
          
				if(jsonVar.set_location =="cronology"){
               
					getFeedArticle += "    <li class='floatRight comenty setComent'><img src='images/icon/comnty.png' class='imageCmnt'/> Comentar  </li> " ;    
               
               
				}
 
				/*                       if(item.phototype != undefined){

                        

                         getFeedArticle  += "    <li class='floatLeft comenty  uiIcon icon  cronologyicon'> "+item.timespend  + "</li> " ;


                         }else{ */

				getFeedArticle  += "    <li class='floatLeft comenty  uiIcon icon  cronologyicon'> "+ item.date + "</li> " ;

				//}

                     
          
				getFeedArticle  +=  "</ul>"+
				" </div> <div id='containerreplycmnt-"+item.id_contenido+"-"+datatypepost+"' datatype='2'>" + // empieza a meter los child comnets
                  
                  
				GetReplyMessageQuery +          
                  
                  
				"  </div> </div>  ";
  
   
   
				getFeedArticle =   html_decode  ( getFeedArticle ); // convertimos codigo a html
   


    
   
				if(jsonVar.set_location =="profile"){
             
             
             
					appendInformationintoColum(i,getFeedArticle); // lo mandamos a introducir en su columna correspondiente
  
          
 
				}else{
                                      
                                  

					if( jsonData.set_location == "view_list"  ){ // si estamos en lista personal



						appendInformationintoColum(i,getFeedArticle); // lo mandamos a introducir en su columna correspondiente



					}else{

						$(container).append(   $(getFeedArticle).delay(i * 180).fadeTo('slow',1) );  //lo inyectamos

					}

                                   
           
                       
				}
   
   

     

			}
			break;
			//****************************************************************************************************************************************
			//****************************************************************************************************************************************
			//*********************************** video **********************************************************************************************
			//****************************************************************************************************************************************
			//****************************************************************************************************************************************
			case "4":{


				datatypepost =4;
				var  getFeedVideo="";
 

				getFeedVideo  += "   <div class='structChatComnt' id="+ item.id_contenido +" datatypepost="+datatypepost+" > "+       
      
                  
                  
				"      <div  class='headArtic'> "+
                      
				"<a href='"+item.contenido_userset+"'   class='imageUserTip'> <img class='image imagtit ' width='50'  src='userpic_thumb/"+item.post_current_image_user+"'></a>";
				

 


				if(jsonVar.set_location =="cronology") {


					getFeedVideo  +=  "   <span class='titart'> <a href='"+item.contenido_userset+"'  class='colorMain'>   "+item.user_name_set+" </a><span class='gray'>@  <a href='./"+item.id_came_from+"'>"+item.name_came_from+"</a></span></span>" ;
    

				}else{

					getFeedVideo  +=  "<span class='titart'><a href='"+item.contenido_userset+"'  class='colorMain'> "+item.user_name_set+"</a> <span class='gray'>  </span></span>" ;

				}



				getFeedVideo +=	"<ul class='rankstartsfixedart'>"+
				"<li class='floatRight comenty add_to_list datatip spacing' > Agregar a Lista </li>" +
				"<li class='floatRight comenty  add_to_highlight  datatip spacing divbord' data='enviar a destacados'> Destacados</li>" +
				"</ul>"+
				"</div>" +
					 
				"<div  class='UIContntComentsChat'>  " +

				"	<span  class='UITextUserComent FixUserData name fixName'  > </span> " +
				"  <span class='UITextUserComent date fixOptComent ' >  </span> " +
				"  <span class='UITextUserComent date fixOptComent '>  </span> "+
				"  <span class='UITextUserComent date fixOptComent'>  </span> "+
                     
				"  <div class='UiMSG' style='text-align: center; float:left; '> "+
				""+item.vid_obj+""+
				"	<div class='trip p_photo'>"+item.contenido_texto+"</div>"+
				"</div>"+
		
				"</div>"+
					 
					 
				"<div class='stateComent' > " +
				"   <ul >  " +
				"<li class='floatRight  uiIcon icon  highlighicon comenty view  view_article'>Ver Completo </li>" +
					 
				"	<li class='floatRight comenty containerreplycmntbtton'><img src='images/icon/comnts.png' class='imageCmnt'/> " +
				"	<span id='cnt-"+item.id_contenido+"' > "+item.coment_count_reply+"</span>  <span id='msg-"+item.id_contenido+"'>"+timespendmsg+"	 </span></li> " ;
				 
				if(jsonData.fllw_permision == 1 || jsonData .user_id_global== jsonData.global_id_view){ // si soy su seguidor podre comentar
					 
					 
					getFeedVideo += "<li class='floatRight comenty setComent '><img src='images/icon/comnty.png' class='imageCmnt'/> Comentar  </li> " ;	 
				}
				 
				var jsonVar  =  getGlobalVars(); // get data    
				 
				if(jsonVar.set_location =="cronology"){

					getFeedVideo += "<li class='floatRight comenty setComent'><img src='images/icon/comnty.png' class='imageCmnt'/> Comentar  </li>";
					 
					 
				}
				 
				 
				getFeedVideo += "    <li class='floatLeft comenty  uiIcon icon  cronologyicon'> "+ item.date + "</li> " +
					 
				"</ul>"+
				" </div> <div id='containerreplycmnt-"+item.id_contenido+"-"+datatypepost+"' datatype='5'>" + // empieza a meter los child comnets
				 
				 
				GetReplyMessageQuery +          
					 
					 
				"  </div> </div>  ";
				 
				
				 
				getFeedVideo =   html_decode  ( getFeedVideo ); // convertimos codigo a html
				 
				  
				if(jsonVar.set_location =="profile"){

 

					appendInformationintoColum(i,getFeedVideo); // lo mandamos a introducir en su columna correspondiente
				

				}else{


					if(jsonData.set_location == "view_list"  ){ // si estamos en lista personal



						appendInformationintoColum(i,getFeedVideo); // lo mandamos a introducir en su columna correspondiente



					}else{

						$(container).append(   $(getFeedVideo).delay(i * 180).fadeTo('slow',1) );  //lo inyectamos

					}

				}
				 
			}
			break;

			//****************************************************************************************************************************************
			//****************************************************************************************************************************************
			//*********************************** Fotos **********************************************************************************************
			//****************************************************************************************************************************************
			//****************************************************************************************************************************************			   
			case "5":{


				var datatypepost =5;
				var  getFeedPhoto="";
 

				getFeedPhoto  += "   <div class='structChatComnt' id="+ item.id_contenido +" datatypepost="+datatypepost+" > "+       
      
                  
                  
				"      <div  class='headArtic'> "+
                      
				"<a href='"+item.contenido_userset+"'   class='imageUserTip'> <img class='image imagtit ' width='50'  src='userpic_thumb/"+item.post_current_image_user+"'></a>";
				

				if(jsonVar.set_location =="cronology" || jsonData.set_location == "view_list" ) {


					getFeedPhoto  +=  "   <span class='titart'> <a href='"+item.contenido_userset+"'  class='colorMain'>   "+item.user_name_set+


					" </a><span class='gray'> publico una imagen en   <a href='./"+url_path+item.id_came_from+"'>"+item.name_came_from+"</a></span></span>" ;

    
				}else{


					getFeedPhoto  +=  "<span class='titart'><a href='"+item.contenido_userset+"'  class='colorMain'> "+item.user_name_set+"</a> <span class='gray'>  </span></span>" ;


				}


				getFeedPhoto +=	"<ul class='rankstartsfixedart'>"+
				"<li class='floatRight comenty add_to_list datatip spacing' > Agregar a Lista </li>" +
				"<li class='floatRight comenty  add_to_highlight  datatip spacing divbord' data='enviar a destacados'> Destacados</li>" +
				"</ul>"+
				"</div>" +
					 
				"<div  class='UIContntComentsChat'>  " +

				"	<span  class='UITextUserComent FixUserData name fixName'  > </span> " +
				"  <span class='UITextUserComent date fixOptComent ' >  </span> " +
				"  <span class='UITextUserComent date fixOptComent '>  </span> "+
				"  <span class='UITextUserComent date fixOptComent'>  </span> "+
                     
				"  <div class='UiMSG' style='text-align: center; float:left; '> "+
				"	<img class='imgP' src='photo/"+item.img_pho+"'/>"+
				"	<div class='trip p_photo'>"+item.contenido_texto+"</div>"+
				"</div>"+
		
				"</div>"+
					 
					 
				"<div class='stateComent' > " +
				"   <ul >  " +
				"<li class='floatRight  uiIcon icon  highlighicon comenty view  view_article'>Ver Completo </li>" +
					 
				"	<li class='floatRight comenty containerreplycmntbtton'><img src='images/icon/comnts.png' class='imageCmnt'/> " +
				"	<span id='cnt-"+item.id_contenido+"' > "+item.coment_count_reply+"</span>  <span id='msg-"+item.id_contenido+"'>"+timespendmsg+"	 </span></li> " ;
				 
				if(jsonData.fllw_permision == 1 || jsonData .user_id_global== jsonData.global_id_view){ // si soy su seguidor podre comentar
					 
					 
					getFeedPhoto += "<li class='floatRight comenty setComent '><img src='images/icon/comnty.png' class='imageCmnt'/> Comentar  </li> " ;	 
				}
				 
				var jsonVar  =  getGlobalVars(); // get data    
				 
				if(jsonVar.set_location =="cronology"){

					getFeedPhoto += "<li class='floatRight comenty setComent'><img src='images/icon/comnty.png' class='imageCmnt'/> Comentar  </li>";
					 
					 
				}
				 
				 
				getFeedPhoto += "    <li class='floatLeft comenty  uiIcon icon  cronologyicon'> "+ item.date + "</li> " +
					 
				"</ul>"+
				" </div> <div id='containerreplycmnt-"+item.id_contenido+"-"+datatypepost+"' datatype='5'>" + // empieza a meter los child comnets
				 
				 
				GetReplyMessageQuery +          
					 
					 
				"  </div> </div>  ";
				 
				
				 
				getFeedPhoto =   html_decode  ( getFeedPhoto ); // convertimos codigo a html
				 
				  
				if(jsonVar.set_location =="profile"){

 

					appendInformationintoColum(i,getFeedPhoto); // lo mandamos a introducir en su columna correspondiente
				

				}else{


					if(jsonData.set_location == "view_list"  ){ // si estamos en lista personal



						appendInformationintoColum(i,getFeedPhoto); // lo mandamos a introducir en su columna correspondiente



					}else{

						$(container).append(   $(getFeedPhoto).delay(i * 180).fadeTo('slow',1) );  //lo inyectamos

					}

				}
				 
			}
			break;
		}
  
	});
   
   


}    
 
//****************************GET MENSAJE DE QUE NO HAY FEED  **************************  
//**************************************************************************************  
//**************************************************************************************  
 
function getMessageNoFeed(){
        
	var getNoFeedMessage = "" ;
     
	getNoFeedMessage += "   <div class='' > "+         
                     
                     
	"      <div  class='UIContntComentsChat'>  " +
                      
	"    <span  class='UITextUserComent FixUserData name fixName'  > </span> " +
	"    <span class='UITextUserComent date fixOptComent ' >  </span> " +
	"    <span class='UITextUserComent date fixOptComent '>  </span> "+
	"     <span class='UITextUserComent date fixOptComent'>  </span> "+
                     
	"    <div class='UiMSG' style='float:left; '> "+
                         
	"No hay ningun contenido en el storyboard "+
                    
                         
	"   </div>"+
                 
	" </div>"+
	"   </div>  ";
        
        
	return getNoFeedMessage; 
        
}
//**************************************************************************************  
//**************************************************************************************  
 
 
function getComentReplyFormat(data){
        
	var jsonData  =  getGlobalVars(); // get data    
	var getComentReply ="" ;
     
	$.each(data.reply_post, function(i,item) {
		; 
     
		getComentReply += " <div class='strctChatResponse'  id='chatResponse"+ item.id_coment_reply +"'> " +
                         
                         
		" <a href='"+ item.id_user+"'> <img width='50' class='image' src='userpic_thumb/"+ item.current_image_user+"' /></a> " +
                     
		"  <div   class='UIContntComentsChat fixStructResponceCmnt'>" +
                      
		" <a href="+ item.id_user+"'> <span class='UITextUserComent FixUserData name fixName'>"+ item.user_name +"</span></a> "+
                   
                     
		" <div   class='UiMSGResponse'>"+ item.coment +"</div> " +
                   
                 
		"</div> "+
                         
                         
		"   <div class='stateComent fixpositionThread' > " +
             
		"   <ul >  "  
            
		+
                
		"  <li class='floatRight comenty  uiIcon icon  cronologyicon'> "+ item.timespend+" </li> ";
          
          
		//  si el usuario logeado es el comentario que se esta listando o el usuario logeado es igual al que se esta viendo , entonces que pueda eliminar comentarios
		if(jsonData .user_id_global== item.id_user || jsonData .user_id_global== jsonData.global_id_view){ // si yo no soy el usuario entonces no puedo eliminar el comentario
          
			getComentReply += "  <li class='floatRight comenty deletereply' id=dltreply"+ item.id_coment_reply +" >   Eliminar </li> ";
		}
          
          
		getComentReply += "</ul>"+
	" </div>"+      
                         
	"</div>";       
                
	}); 
     
	return getComentReply; 
        
}
//**************************************************************************************  
//**************************************************************************************  

////******************************************************************************
// agregar eventos  y estandarizar los exploradores
 
 
function getComentFormat(data){
     
     
	var jsonData  =  getGlobalVars(); // get data    
  
     
	$.each(data.lstNwPst, function(i,item) {
     
     
		GetMessageQuery = "";   
               
		GetMessageQuery += " <div class='structChatComnt' id="+ item.id_coment +" datatypepost=1 > " ;
             
          
    
             
		if(jsonData .user_id_global== item.contenido_userset || jsonData .user_id_global== jsonData.global_id_view){ // si yo no soy el usuario entonces no puedo eliminar el comentario
             
			GetMessageQuery += "  <div class='delete' id=dlt"+ item.id_coment +"> "+

			"  <img src='images/icon/close.png'/>"+
            
			"</div>" ;     
		}
               
            

		GetMessageQuery += "<div class='containerImage'>  <a href='"+ item.id_user+"' class='imageUserTip'   >"+

		" <img src='userpic_thumb/"+ item.current_image_user+"'   width='66' class='image' /> "+
   
		" </a></div> " +
                     
		" <div  class='UIContntComentsChat'> " +  
		" <a href='"+ item.id_user +"' > " + 
		" <span  class='UITextUserComent FixUserData name fixName'  > " +
      
		item.user_name
                  
		+" </span> "+
                     
		"</a>" ;
                  
                 
               

		GetMessageQuery += "<span class='UITextUserComent date fixOptComent '>  </span> " +
		" <span class='UITextUserComent date fixOptComent'>  </span> " + 
                     
		" <div class='UiMSG' style='float:left; '>"+
                      
		item.coment
                 
                         
		+ " </div> " +
                 
		" </div> " +
        
           
		"   <div class='stateComent' > " +
		"   <ul >  " +
        
		" <li class='floatRight comenty containerreplycmntbtton'><img src='images/icon/comnts.png' class='imageCmnt'/> " +
    
		" <span id='cnt-"+item.id_coment+"' > 0 </span>  <span id='msg-"+item.id_coment+"'> comentarios </span></li> " ;
          
		if(jsonData.fllw_permision == 1 || jsonData .user_id_global== jsonData.global_id_view){ // si soy su seguidor podre comentar
            
           
			GetMessageQuery += "    <li class='floatRight comenty setComent '><img src='images/icon/comnty.png' class='imageCmnt'/> Comentar  </li> " ;
           
		}
          
          
            

		GetMessageQuery += "    <li class='floatLeft comenty  uiIcon icon  cronologyicon'> "+ item.timespend + "</li> " +
          
		"</ul>"+
		" </div>"; // empieza a meter los child comnets
 
 
		GetMessageQuery+=" <div id='containerreplycmnt-"+item.id_coment+"-1'  datatype='1'>   </div></div>" ;
 
       
	});       
      
	return GetMessageQuery;   
}


 
//************************************************************************************************************************************
//***********************************************************************************************************************************


function getGlobalVars(){ //esta funcion devuelve un json con las vars que estan en el user
     
     
	return  globalVars();
         
}
 
// para enter y funcione
function keyP13(oEvento){
	var iAscii;

	if (oEvento.keyCode)
		iAscii = oEvento.keyCode;
	else if (oEvento.which)
		iAscii = oEvento.which;
	else
		return false;

	if (iAscii == 13)
	{
             
		document.getElementById('login').submit();
             
	}

	return true;
} 


/*  NEW AGE */

//**********************************************************************************************************/
//**********************************************************************************************************/
//**********************************************************************************************************/
   
/* Vaciar los input siempre al iniciar la pagina*/

window.element  =  document.getElementsByTagName("input"); // global scope     
   

var Inputs = {  // FUNCIONES ENLAZADAS A INPUTS
        
 
  
       
	init : function(){
       
		for(i=0;i<element.length;i++){
      
			if(element[i].type != "button"  )
				element[i].value="";
    
        
      
		}
	},
	/**************************************************/
	checkInputEvent : function(){  // funcion para dar evento en blur a input
       
       
		for(i=0;i<element.length;i++) { 

			addEventHandler(element[i] ,"blur", Inputs.checkValueUndefined); 
          
   
		}
	},
   
	checkValueUndefined  : function () {  // funcion para buscar espacios antes de cualquier caracter en los input
         
		var spaces;
		spaces=0;
		for(i=0;i<this.value.length;i++){
              
			if(this.value[i] == ' '){
				spaces++;
			}  
		}
         
     
     
		if( typeof this.value == 'undefined'  || this.value[0] == ' ' ){
               
			this.value =  this.value.substr(spaces,this.value.length )  // remplza todo el texto eliminando los espacios
                  
		} 
        
     
         
	}      
           
           
}
 
// decodificar html 


function html_decode (str) {
     
	return String(str).replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
    
}
 