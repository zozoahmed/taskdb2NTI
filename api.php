<?php
 
 $payload = json_encode(["title" => "Update title"]);


$option = [
	"http" => [
		"method" =>"PATCH" ,
		"header" => "Content-type : application/json; charset=UTF-8",
		"content" => $payload
	]
	];
	$context = stream_context_create($option);
	$data = file_get_contents("https://wikimedia.org/api/rest_v1/metrics/pageviews/per-article/en.wikipedia/all-access/all-agents/Tiger_King/daily/20210901/20210930"  , 
	false,$context) ;

	var_dump($data);
	print_r($http_response_header);
##############################3


//  $api_url = 'https://wikimedia.org/api/rest_v1/metrics/pageviews/per-article/en.wikipedia/all-access/all-agents/Tiger_King/daily/20210901/20210930';

//  $json_data = file_get_contents($api_url);

//  $response_data = json_decode($json_data);

//  $user_data = $response_data->data;

//  $user_data = array_slice($user_data, 0, 9);

//  //print_r($user_data);

//  foreach ($user_data as $user) {
// 	echo "name: ".$user->employee_name;
// 	echo "<br />";
// 	echo "name: ".$user->employee_age;
// 	echo "<br /> <br />";
// }

###################

?>