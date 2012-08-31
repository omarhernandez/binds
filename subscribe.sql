select 
	id_user_topic as idStory,
	type_user,

(CASE
when type_user = 1 then(select user_name from user where id_user = idStory)
when type_user = 2 then (select nombre_topico from data_topic where id_data_topic = idStory)
END) as username,

(CASE
when type_user = 2 then(select idTopico from data_topic where idTopico = idStory)
END) as topicID,

(CASE
when type_user = 1 then(select current_image_user from user where id_user = idStory)
when type_user = 2 then (select current_image from topico where idTopico = topicID)
END) as imagen,

(CASE
when type_user = 1 then(select quote from user where id_user = idStory)
when type_user = 2 then (select quote from topico where idTopico = topicID)
END) as quoteText,

(case
when type_user = 1 then (select bg from user where id_user= idStory)
END) as fondo,

(case
when type_user = 1 then (select name from data_user where id_data_user = idStory)
end ) as nombre,

(case
when type_user = 1 then (select lastname from data_user where id_data_user = idStory)
end ) as apellido

from subscribe,relationship 
where subscriber = 20 and idRelationship = subscribers