<?php 

    include_once('db-connection.php');
    
    // Glance movies
    // Gets data from the topMovieMeta table

    if (isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM topmoviemeta WHERE MovieId = ?;";
        include_once('watchlist.includes.inc.php');
    }

    // Popular movies 

    else if (isset($_POST['add-popular'])) {
        $id = $_POST['id_popular'];
        $sql = "SELECT * FROM topmoviemeta WHERE MovieId = ?;";
        include_once('watchlist.includes.inc.php');

    // Top Rated movies
    } else if (isset($_POST['add-top-rated'])) {
        $id = $_POST['id_top_rated'];
        $sql = "SELECT * FROM topratedmoviemeta WHERE MovieId = ?;";
        include_once('watchlist.includes.inc.php');
    }
    
    // Top Rated series
    else if (isset($_POST['add-top-series'])) {
        $id = $_POST['id_top_series'];
        $sql = "SELECT * FROM popularseriesmeta WHERE MovieId = ?;";
        include_once('watchlist.includes.inc.php');
    }
    
    // Upcoming Movies
    else if (isset($_POST['add-upcoming-movies'])) {
        $id = $_POST['id_upcoming_movies'];
        $sql = "SELECT * FROM comingmoviesmeta WHERE MovieId = ?;";
        include_once('watchlist.includes.inc.php');
    }
    
    else {
        header("Location: ../index.php");
        exit();
    }