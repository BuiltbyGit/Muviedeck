<?php 

include_once 'includes/db-connection.php';

$glanceMovies = $conn->query('SELECT * FROM topmoviemeta LIMIT 5');
$PopularMovies = $conn->query('SELECT * FROM topmoviemeta');
$TopRatedMovies = $conn->query('SELECT * FROM topratedmoviemeta');
$PopularSeriesMeta = $conn->query('SELECT * FROM popularseriesmeta');
$ComingMoviesMeta = $conn->query('SELECT * FROM comingmoviesmeta');
 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/queries.css">
	    <link rel="stylesheet" crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==">
	<title>Muviedeck - Discover New Movies</title>
</head>
<body id="overflow-tweak" class="overflow-hidden">
	<div id="preloader" class="preloader-add">
		<div class="preloader-main">
			<div class="preloader-logo">
			Muviedeck
		</div>
		<div class="splash-loader"></div>
		</div>
		

	</div>
	<nav class="navigationbar">
                <ul class="menu">
            <li class="logo"><a href="#">Muviedeck</a></li>
            <li class="item"><a href="#">Home</a></li>
            <li class="item"><a href="#" class="active">Popular</a></li>
            <li class="item"><a href="#">Watchlist</a></li>
            <li class="item login-cont">
            	<form action="login.php">
            	<button class="login-btn">Login</button>
            </form></li>
          <li class="toggle"><a href="#"><i class="fas fa-bars"></i></a></li>
  </ul>
      </nav>
	<section class="movies-showcase" id="movies-showcase">
		<?php 
		if($glanceMovies->num_rows > 0){
			while($row = $glanceMovies->fetch_assoc()){
				echo '<div class="movie-showcase" style="
		background: linear-gradient(180deg, #0a0e4612, #0c1154), url('.$row['MoviePoster'].');
		">
			<div class="title-genre-year">
				<h1>'.$row['MovieTitle'].'</h1>
				<div class="year-genre">
					<p>'.$row['MovieReleaseDate'].
						'</p>
					<p>'.$row['MovieRating'].'</p>
				</div>
				<div class="movie-plot">
					'.$row['MoviePlot'].'
				</div>
				<div class="selection-btn">
					<button class="select-btn">Watch Now</button>
					<button class="select-btn select-btn-transparent">Add to watchlist</button>
				</div>
			</div>
		</div>';
			}
		}

		 ?>
		</section>
		<section class="popular-movies">
			<h1 class="section-title">Popular Movies Right Now</h1>
			<div class="movie-container popular-movie-container">
				<div class="button-scroll-container scroll-left">
				<button class="scroll-btn scroll-btn-left" id="scroll-btn-left"><</button>
				</div>
				<?php 
				if($PopularMovies->num_rows > 0){
while($row = $PopularMovies->fetch_assoc()){
	echo '<div class="movie-snip">
					<div class="movie-img" style="background: url('.$row['MoviePoster'].');">
					</div>
					<h1>'.$row['MovieTitle'].'</h1>
					<p><span class="meta"></span>'.$row['MovieRating'].'</p>
				</div>';
}
				 
				}
				?>
				<div class="button-scroll-container scroll-right">
				<button class="scroll-btn scroll-btn-right" id="scroll-btn-right">></button>
				</div>
			</div>
		</section>
				<section class="popular-movies">
			<h1 class="section-title">Top Rated Movies</h1>
			<div class="movie-container new-movie-container">
				<div class="button-scroll-container scroll-left">
				<button class="scroll-btn new-movies-btn-left"><</button>
				</div>
				<?php 
				if($TopRatedMovies->num_rows > 0){
while($row = $TopRatedMovies->fetch_assoc()){
	echo '<div class="movie-snip">
					<div class="movie-img" style="background: url('.$row['MoviePoster'].');">
					</div>
					<h1>'.$row['MovieTitle'].'</h1>
					<p><span class="meta"></span>'.$row['MovieRating'].'</p>
				</div>';
}
				 
				}
				?>
				
				<div class="button-scroll-container scroll-right">
				<button class="scroll-btn new-movies-btn-right">></button>
				</div>
			</div>
		</section>
				<section class="popular-movies">
			<h1 class="section-title">Top Series Right Now</h1>
			<div class="movie-container top-series-container">
				<div class="button-scroll-container scroll-left">
				<button class="scroll-btn scroll-btn-left top-series-btn-left"><</button>
				</div>
				<?php 
				if($PopularSeriesMeta->num_rows > 0){
while($row = $PopularSeriesMeta->fetch_assoc()){
	echo '<div class="movie-snip">
					<div class="movie-img" style="background: url('.$row['MoviePoster'].');">
					</div>
					<h1>'.$row['MovieTitle'].'</h1>
					<p><span class="meta"></span>'.$row['MovieRating'].'</p>
				</div>';
}
				 
				}
				?>
				<div class="button-scroll-container scroll-right">
				<button class="scroll-btn scroll-btn-right top-series-btn-right">></button>
				</div>
			</div>
		</section>
		<section class="popular-movies">
			<h1 class="section-title">Upcoming Movies</h1>
			<div class="movie-container new-series-container">
				<div class="button-scroll-container scroll-left">
				<button class="scroll-btn scroll-btn-left new-series-btn-left"><</button>
				</div>

				<?php 
				if($ComingMoviesMeta->num_rows > 0){
while($row = $ComingMoviesMeta->fetch_assoc()){
	echo '<div class="movie-snip">
					<div class="movie-img" style="background: url('.$row['MoviePoster'].');">
					</div>
					<h1>'.$row['MovieTitle'].'</h1>
					<p><span class="meta"></span>'.$row['MovieRating'].'</p>
				</div>';
}
				 
				}
				?>
				
				<div class="button-scroll-container scroll-right">
				<button class="scroll-btn scroll-btn-right new-series-btn-right">></button>
				</div>
			</div>
		</section>
		<script src="assets/js/jquery-min.js"></script>
		<script src="assets/js/jsScroll"></script>
		<script src="assets/js/main.js" defer></script>
	</section>
</body>
</html>