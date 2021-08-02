<?php
    if (isset($_POST['new-password-submit'])) {
        $selector = $_POST['selector'];
        $validator = $_POST['validator'];
        $newPassword = $_POST['newPassword'];
        $confNewPassword = $_POST['confNewPassword'];

        if (empty($newPassword) || empty($confNewPassword)) {
            header("Location: ../reset-password.php?error=emptyinput");
            exit();
        }

        if ($newPassword !== $confNewPassword) {
            header("Location: ../reset-password.php?error=passwordMismatch");
            exit();
        }

        $currentDate = date("U");

        require_once('db-connection.php');
        $sql = "SELECT * FROM passwordReset WHERE passwordResetSelector = ? AND passwordResetExpires = $currentDate;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../reset-password.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $selector);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$row = mysqli_fetch_assoc($result)) {
            header("Location: ../reset-password.php?error=somethingwentwrong");
            exit();
        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row['passwordResetToken']);
            if ($tokenCheck === false) {
                header("Location: ../reset-password.php?error=tokenMismatch");
                exit();
            } else if ($tokenCheck === true) {
                $tokenEmail = $row['passwordResetEmail'];

                $sql = "SELECT * FROM users WHERE usersEmail =?;";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../reset-password.php?error=stmtfailed");
                    exit();
                } 

                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (!$row = mysqli_fetch_assoc($result)) {
                    header("Location: ../reset-password.php?error=somethingwentwrong");
                    exit();
                } else {
                    $sql = "UPDATE users SET usersPassword = ? WHERE usersEmail = ?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../reset-password.php?error=stmtfailed");
                        exit();
                    }

                    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ss", $hashedNewPassword, $tokenEmail);
                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_close($stmt);
                    

                    $sql = "DELETE FROM passwordReset WHERE passwordResetEmail = ?;";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../reset-password.php?error=stmtfailed");
                        exit();
                    }

                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_close($stmt);
                    

                    header("Location: ../login.php?error=none");
                    exit();
                }

                mysqli_stmt_close($stmt);

            }
        }

        mysqli_stmt_close($stmt);

    } else {
        header("Location: ../index.php");
        exit();
    }