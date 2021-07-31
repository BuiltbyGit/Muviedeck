
<?php 

include_once '../includes/db-connection.php';

function escapeJsonString($value) { 
    $escapers = array("\'");
    $replacements = array("\\/");
    $result = str_replace($escapers, $replacements, $value);
    return $result;
}

$stmt = $conn->prepare('TRUNCATE TABLE gettopratedmoviesid');
$stmt->execute();


//This sends the API Request to get the movies from the rapidAPI IMDB API. The end point here is specified in the CURLOPT_URL Which is get most popular movies.

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-top-rated-movies",
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
}
$curl_response = curl_exec($curl);

//This is where i convert the response into an array as the response is not in an array.

$response = escapeJsonString($response);

$response = json_decode($response,true);

//this will loop through the response and insert the title id's into the database.
for ($i=0; $i < 50; $i++) { 
	$mainResponse = $response[$i]['id'];
	$getTitleexplode = explode("/", $mainResponse);
	$stmt = $conn->prepare('INSERT INTO gettopratedmoviesid (title) VALUES (?)');
	$stmt->bind_param('s', $getTitleexplode[2]);
	$stmt->execute();
	$stmt->close();
}