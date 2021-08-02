<?php
    include_once('includes/db-connection.php');
    if (isset($_POST['remove'])) {
        $title_to_delete = mysqli_real_escape_string($conn, $_POST['title-to-delete']);
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id-to-delete']);
        print_r($_POST);
    

        $sql = "DELETE FROM watchlist WHERE watchlistId = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $id_to_delete);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: watchlist.php?status=deletesuccessful");
        exit();
    
        
    } else {
        header("Location: index.php");
        exit();
    }

