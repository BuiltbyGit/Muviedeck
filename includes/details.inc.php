<?php
    
    include("db-connection.php");
    if (isset($_POST['add'])){
        $MoviePoster = mysqli_real_escape_string($conn, $_POST['MoviePoster']);
        $MovieTitle = mysqli_real_escape_string($conn, $_POST['MovieTitle']);
        $MovieRating = mysqli_real_escape_string($conn, $_POST['MovieRating']);
        $MoviePlot = mysqli_real_escape_string($conn, $_POST['MoviePlot']);
        $MovieId = mysqli_real_escape_string($conn, $_POST['MovieId']);
        $MovieCast = mysqli_real_escape_string($conn, $_POST['MovieCast']);
        $MovieRuntime = mysqli_real_escape_string($conn, $_POST['MovieRunTime']);

        // Checks if a movie already exists in the watchlist so it is not added more than once
        $sql = "SELECT * FROM watchlist WHERE MovieId = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $MovieId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ($movieInWatchlist = mysqli_fetch_assoc($result)) {
            header("Location: ../index.php?error=moviealreadyinwatchlist");
            exit();
        } else {
            mysqli_stmt_close($stmt);
        }        


        // Populates the Watchlist Table with data from the getMovieMeta Table
        $sql = "INSERT INTO watchlist(MoviePoster, MovieTitle, MovieRating, MoviePlot, MovieId, MovieCast, MovieRuntime) VALUES (?, ?, ?, ?, ?, ?, ?);";        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sssssss", $MoviePoster, $MovieTitle, $MovieRating, $MoviePlot, $MovieId, $MovieCast, $MovieRuntime);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: ../index.php?status=success");
        exit();
    } else {
        header("Location: ../index.php?");
        exit();
    }
        