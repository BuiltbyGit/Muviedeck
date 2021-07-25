<?php
    include_once('db-connection.php');
    include_once('functions.inc.php');

    if (isset($_POST['login'])) {
        session_start();
        $usernameOrEmail = $_SESSION['usernameOrEmail'] = mysqli_real_escape_string($conn, $_POST['usernameOrEmail']);
        $password = $_SESSION['password'] = mysqli_real_escape_string($conn, $_POST['password']);
        
        if (emptyInputLogin($usernameOrEmail, $password)) {
            header("Location: ../login.php?error=emptyinput");
            exit();
        }

        loginUser($conn, $usernameOrEmail, $password);

    } else {
        header("Location: ../login.php");
        exit();
    }