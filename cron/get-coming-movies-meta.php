<?php

include_once '../includes/db-connection.php';
ini_set('max_execution_time', 920);


$stmt = $conn->prepare('TRUNCATE TABLE comingmoviesmeta');
$stmt->execute();


	function escapeJsonString($value) { 
    $escapers = array("\'");
    $replacements = array("\\/");
    $result = str_replace($escapers, $replacements, $value);
    return $result;
}


$movietitle = $conn->query('SELECT * FROM getcomingmoviesid');
$result = $movietitle->num_rows;
if($movietitle->num_rows > 0){
	while ($row = $movietitle->fetch_assoc()) {
		$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://series-movies-imdb.p.rapidapi.com/movie/details/".$row['title'],
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: series-movies-imdb.p.rapidapi.com",
		"x-rapidapi-key: fea82aca20msh09e0680190c7a7ep178f22jsna58827443fdf"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
$response = escapeJsonString($response);

$response = json_decode($response,true);

	$movieId = $response['movieId'];
	echo $movieId;
	$movieTitle = $response['movieTitle'];
	$movieRating = $response['movieRating'];
	$movieRuntime = $response['movieRunTime'];
	$moviePlot = $response['movieStoryLine'];
	$moviePoster = $response['moviePosterUrl'];
	$movieReleaseDate = $response['movieReleasedAt'];
	$movieLanguage = $response['movieLanguages'][0]['languageName'];
	$movieCast = $response['movieTopCasting'];
			unset($castresult);
	foreach ($movieCast as $key => $value) {
		$castresult[] = $key .' - '.$value['actorBirthName'];
		$castResultImplode = implode(",", $castresult);
	}
	$movieMainCast = $castResultImplode;
	$stmt = $conn->prepare('INSERT INTO comingmoviesmeta (MovieId, MovieTitle, MovieRating, MovieRunTime, MoviePlot, MoviePoster, MovieReleaseDate, MovieCast, MovieLanguage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
	$stmt->bind_param('sssssssss', $movieId, $movieTitle, $movieRating, $movieRuntime, $moviePlot, $moviePoster, $movieReleaseDate, $movieMainCast, $movieLanguage);
	$stmt->execute();
	$stmt->close();
 }

	}
}