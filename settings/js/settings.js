
var isNonblank_re    = /\S/;

$(document).ready(function(){
	jsonVarGlobal = globalVars();
	$.ajax({
		type	:	"POST",
		url		:	"settings/class/getData.php",
		data	:	{
			id	:	jsonVarGlobal.user_id_current
		},
		dataType:	"json",
		success	:	insertData,
		error	:	errorInInsertData
	})
	
	$("#quote").live("keyup",function(){
		var texto = $(this).val()
		if(texto.length>250)
			$(this).val(texto.substr(0, 250));
	})


})


function insertData(datos){
	$("#username").val(datos.query[0].user_name);
	$("#url").val(datos.query[0].url)
	$("#quote").val(unescape(datos.query[0].quote))
}

function errorInInsertData(){
	binds.error()
}

$("#saveChanges").live("click",function(){
	var usn = isNonblank($("#username").val())
	var url = isNonblank($("#url").val())
	var quote = isNonblank($("#quote").val())
	if(!usn || !url ||!quote){
		showErrorOnupload("Informacion incompleta", "Ningun campo debe quedar en blanco")
	}
	else{
		$("#edit").submit();
	}	
})

function isNonblank (s) {
   return String (s).search (isNonblank_re) != -1
}

function showErrorOnupload(titleB,contenido){
	binds.box({
			title	: titleB,
			content	:	contenido,
			top		:	"25%",
			height	:	"100"
		});
}