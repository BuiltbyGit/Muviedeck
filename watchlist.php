<?php
    include_once('includes/db-connection.php');

    // Checks if the watchlist is empty or not
    $sql = "SELECT * FROM watchlist";
    $result = mysqli_query($conn, $sql);
    if (!$movies = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
        $message = "Watchlist is empty";
    } else {
        $message = "Your watchlist";
    }

    // Gets all movies in the watchlist table
    $sql = "SELECT * FROM watchlist";
    $result = mysqli_query($conn, $sql);
    $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);


?>

    <div>

        <h1 style="margin-bottom: 20px; text-align: center;"><?php echo $message; ?></h1>
        <?php foreach($movies as $movie) { ?>
            <div style="margin-bottom: 100px;">
                Image: <?php echo $movie['MoviePoster']; ?>
                <h2>Title: <?php echo $movie['MovieTitle']; ?></h2>
                <p>Avg Rating: <?php echo $movie['MovieRating']; ?></p>
                <div>Plot: <?php echo $movie['MoviePlot']; ?></div> 
                <div>Cast: <?php echo $movie['MovieCast']; ?></div>
                <div>Runtime: <?php echo $movie['MovieRuntime']; ?></div>
                <form action = "removeFromWatchlist.php" method="POST">
                    <input type="hidden" name="id-to-delete" value="<?php echo htmlspecialchars($movie['watchlistId']); ?>">
                    <input type="hidden" name="title-to-delete" value="<?php echo htmlspecialchars($movie['MovieTitle']); ?>">
                    <button>Watch</button>
                    <button type="submit" name="remove">Remove</button>        
                </form>
            </div>
    </div>
	    
<?php } ?>




