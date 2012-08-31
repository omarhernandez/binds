$(document).ready(function(){
	jsonVarGlobal = globalVars(); 
	$("#suscriptionsT").click(function(){
		$.ajax({
			url		:		"subscriptions/class/getSusbcriptionsProfile.php",
			type	:		"POST",
			dataType	:	"json",
			data		:	{
				"currUser"	:	jsonVarGlobal.user_id_global,
				"from"		:	0,
				"to"		:	6
			},
			success		:	showUsersandTopics,
			error		:	errorDisplay
			
		})
	})
})

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function showUsersandTopics(data){
	var contUser = 0;
	var contInter = 0;
	var finalString = "";
	var stringContainer = "<div class='containerSubscription' id='followingContainer'>";
	stringContainer+= "<div class='sepa'></div><h2 class='kind'>Personas</h2><div class='sepa'></div>";
	
	var stringInterestContainer = "<div class='containerSubscription' id='interestContainer'>";
	stringInterestContainer+= "<div class='sepa'></div><h2 class='kind'>Intereses</h2><div class='sepa'></div>"
	
	$.each(data.result, function(i,item){
		if(item.type_user == 1){
			contUser++;
			stringContainer+="<ul><li>";
			stringContainer+= "<a class='name_follow' href='"+ item.idStory +"'>";
			stringContainer+="<img class='imgPfl' src='userpic_thumb/"+item.imagen+"'/>";
			stringContainer+= "</a>";
			stringContainer+="</li>";
			stringContainer+="<li> <a class='name name_follow' href='" + item.idStory + "'>"+item.username+"</a></li>";
			stringContainer+="<li><div><p>"+item.nombre+"</p><p>"+item.apellido+"</p></div></li></ul>";
		}
		else{
			if(item.type_user == 2){
				contInter++;
				stringInterestContainer+="<ul><li>";
				stringInterestContainer+= "<a class='name_follow' href='interest/"+ item.idStory +"'>";
				stringInterestContainer+="<img class='imgPfl' src='userpic_thumb/"+item.imagen+"'/>";
				stringInterestContainer+= "</a>";
				stringInterestContainer+="</li>";
				stringInterestContainer+="<li> <a class='name name_follow' href='interest/" + item.idStory + "'>"+item.username+"</a></li>";
				//stringInterestContainer+="<li><div><p>"+item.name+"</p><p>"+item.lastname+"</p></div></li>"
				stringInterestContainer += "</ul>";
			}
		}
	})
	
	if(contUser > 6)
		stringContainer+= "<div class='buttonGray' id='seeAllPer'>Ver todos</div>";
	
	stringContainer+= '</div>'
	stringInterestContainer += '</div>'
	if(contInter >6)
		stringInterestContainer += "<div class='buttonGray' id='seeAllTopics'>Ver todos</div>"
	
	if(contUser > 0 && contInter > 0 )
		finalString = stringContainer + stringInterestContainer;
	else{
		if (contInter > 0)
			finalString = stringInterestContainer;
		else if(contUser > 0)
			finalString = stringContainer;
		else
			finalString = "<div>No estas suscrito a nadie</div>"
	}
	
	$("#suscriptionsPanel").html(finalString);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#seeAllPer").live("click",function(){
	$.ajax({
		url		:		"subscriptions/class/getSusbcriptionsProfile.php",
		type	:		"POST",
		dataType	:	"json",
		data		:	{
			"currUser"	:	jsonVarGlobal.user_id_global,
			"from"		:	6,
			"to"		:	50
		},
		success		:	showAllUsers,
		error		:	errorDisplay
			
	})
})
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function showAllUsers(data){

	var stringUserContainer = "";
	$.each(data.result, function(i,item){
		stringUserContainer+="<ul><li>";
		stringUserContainer+= "<a class='name_follow' href='"+ item.id_user +"'>";
		stringUserContainer+="<img class='imgPfl' src='userpic_thumb/"+item.current_image_user+"'/>";
		stringUserContainer+= "</a>";
		stringUserContainer+="</li>";
		stringUserContainer+="<li> <a class='name name_follow' href='" + item.id_user + "'>"+item.user_name+"</a></li>";
		stringUserContainer+="<li><div><p>"+item.name+"</p><p>"+item.lastname+"</p></div></li></ul>";
		
	})
	
	$("#separadorIntereses").fadeOut("fast");
	$("#seeAllPer").fadeOut("fast" , function(){
		$("#followingContainer").append($(stringUserContainer).fadeIn("slow"));
	});
	
	$("#seeAllPer,#separadorIntereses").remove();
//var incru = 
	
//$(stringContainer).fadeIn("6000");
}


//////////////////////////////////////////////////////////////////////////////
function errorDisplay(jqXHR, textStatus, errorThrown){
	binds.error();
}
