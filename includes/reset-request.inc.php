<?php
    // to avoid timing attacks, we use two tokens
    if (isset($_POST['reset-request-submit'])) {
        $selector = bin2hex(random_bytes(8)); // token that will go into the database
        $token = random_bytes(32); // regular token for user authentication

        $url = "www.muviedeck.com/create-new-password.php?selector=" . $selector . "validator=" . bin2hex($token);

        $expires = date("U") + 600;

        require("db-connection.php");

        $userEmail = $_POST['email'];

        // deletes any existing token for a particular user
        $sql = "DELETE FROM passwordReset WHERE passwordResetEmail = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $userEmail);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        

        // inserts the email and the two tokens into the database

        $sql = "INSERT INTO passwordReset(passwordResetEmail, passwordResetSelector, passwordResetToken, passwordResetExpires) VALUES(?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            
            header("Location: ../login.php?error=stmtfailed");
            exit();
        }
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        

        $to = $userEmail;
        $subject = "Reset your password for Moviedeck";
        $message = '<p>We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p>';
        $message .= '<p>Here is your password link: </br>';
        $message .= '<a href="' . $url . '">' . $url . '</a></p>';

        $headers = "From: Moviedeck <muviedeck@gmail.com>\r\n";
        $headers .= "Reply-To: muviedeck@gmail.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        mail($to, $subject, $message, $headers);

        header("Location: ../reset-password.php?reset=success");
        

    } else {
        header("Location: ../login.php");
        exit();
    }