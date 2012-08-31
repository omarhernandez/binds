<?php

$id = $_POST["id"];
$type = $_POST["type"];
echo json_encode(array("query" => checkIfVideoExist($id, $type)));

function checkIfVideoExist($id, $type) {
	$resultado = array();
	if ($type == "youtube") {
		$headers = get_headers('http://gdata.youtube.com/feeds/api/videos/' . $id);
		if (!strpos($headers[0], '200')) {
			$resultado["exist"] = false;
			return $resultado;
		} else {
			$resultado["exist"] = true;
			$resultado["id"] = $id;
			$resultado["tipo"] = "youtube";
			return $resultado;
		}
	}
	else{
		//http://vimeo.com/api/v2/username/1209348.json
		$headers = get_headers('http://vimeo.com/api/v2/video/' . $id.".json");
		if (!strpos($headers[0], '200')) {
			$resultado["exist"] = false;
			return $resultado;
		} else {
			$resultado["exist"] = true;
			$resultado["id"] = $id;
			$resultado["tipo"] = "vimeo";
			return $resultado;
		}
	}
}

?>
