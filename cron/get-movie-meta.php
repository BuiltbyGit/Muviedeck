<?php

include_once '../includes/db-connection.php';
$movietitle = $conn->query('SELECT * FROM gettopmovieid');
$result = $movietitle->num_rows;
if($movietitle->num_rows > 0){
	while ($row = $movietitle->fetch_assoc()) {

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-details?tconst=".$row['title'],
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: imdb8.p.rapidapi.com",
		"x-rapidapi-key: fea82aca20msh09e0680190c7a7ep178f22jsna58827443fdf"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
	}
}

