<?php
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (!$movie = mysqli_fetch_assoc($result)) {
        header("Location: index.php?error=somethingwentwrong");
        exit();
    }

    mysqli_stmt_close($stmt);

    $MoviePoster = $movie['MoviePoster'];
    $MovieTitle = $movie['MovieTitle'];
    $MovieRating = $movie['MovieRating'];
    $MoviePlot = $movie['MoviePlot'];
    $MovieId = $movie['MovieId'];
    $MovieCast = $movie['MovieCast'];
    $MovieRuntime = $movie['MovieRunTime'];