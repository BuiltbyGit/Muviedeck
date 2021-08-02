<?php
    include_once('includes/db-connection.php');
    if (isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM topmoviemeta WHERE MovieId = ?;";
        include_once('includes/watchlist.details.inc.php');
   
    } else if (isset($_GET['id_top_rated'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id_top_rated']);
        $sql = "SELECT * FROM topratedmoviemeta WHERE MovieId = ?;";
        include_once('includes/watchlist.details.inc.php');

    } else if (isset($_GET['id_top_series'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id_top_series']);
        $sql = "SELECT * FROM popularseriesmeta WHERE MovieId = ?;";
        include_once('includes/watchlist.details.inc.php');

    } else if (isset($_GET['id_coming_movies'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id_coming_movies']);
        $sql = "SELECT * FROM comingmoviesmeta WHERE MovieId = ?;";
        include_once('includes/watchlist.details.inc.php');
    }
    
    else {
        header("Location: index.php");
        exit();
    }    
?>


<div>
    <div style="margin-bottom: 100px;">
        Image: <?php echo $movie['MoviePoster']; ?>
        <h2 style="margin-bottom: 20px; text-align: center;">Title: <?php echo $movie['MovieTitle']; ?></h2>
        <p>Avg Rating: <?php echo $movie['MovieRating']; ?></p>
        <div>Plot: <?php echo $movie['MoviePlot']; ?></div> 
        <div>Cast: <?php echo $movie['MovieCast']; ?></div>
        <div>Runtime: <?php echo $movie['MovieRunTime']; ?></div>
        <form action="includes/details.inc.php" method="POST">
			<a href="#"><button>Watch now</button></a>
            <input type="hidden" name="MovieId" value="<?php echo htmlspecialchars($movie['MovieId']); ?>">
            <input type="submit" name="add" value="Add to Watchlist">

            <input type="hidden" name="MoviePoster" value="<?php echo htmlspecialchars($MoviePoster); ?>">
            <input type="hidden" name="MovieTitle" value="<?php echo htmlspecialchars($MovieTitle); ?>">
            <input type="hidden" name="MovieRating" value="<?php echo htmlspecialchars($MovieRating); ?>">
            <input type="hidden" name="MoviePlot" value="<?php echo htmlspecialchars($MoviePlot); ?>">
            <input type="hidden" name="MovieCast" value="<?php echo htmlspecialchars($MovieCast); ?>">
            <input type="hidden" name="MovieRunTime" value="<?php echo htmlspecialchars($MovieRuntime); ?>">

        </form>
            
        
    </div>
</div>
