

$(document).ready(function(){
                  $("#search").keyup(function(){
                                    var termino		=	$("#search").val();
                                    $.ajax({
                                                      url			:	"class/instantsearch/class/s__terms.php",
                                                      type		:	"POST",
                                                      dataType	:	"json",
                                                      data		:	{
                                                                        "query" : termino
                                                      },
                                                      success		:	showQuery,
                                                      error		:	displayError
                                    })
                  })
	
	
	
})

function showQuery(datos){
	
}

function displayError(){
                  binds.error();
}