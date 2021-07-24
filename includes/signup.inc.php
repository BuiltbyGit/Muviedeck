<?php
    include_once('db-connection.php');
    if (isset($_POST['signup'])) {
        session_start();
        $name  = $_SESSION['name'] = mysqli_real_escape_string($conn, $_POST['name']);
        $username = $_SESSION['username'] = mysqli_real_escape_string($conn, $_POST['username']);
        $email  = $_SESSION['email']= mysqli_real_escape_string($conn, $_POST['email']);
        $password  = $_SESSION['password']= mysqli_real_escape_string($conn, $_POST['password']);
        $confPassword  = $_SESSION['confPassword']= mysqli_real_escape_string($conn, $_POST['confPassword']);

        
        
        include_once('functions.inc.php');
        include_once('db-connection.php');

        if (emptyInputSignup($name, $username, $email, $password, $confPassword)) {
            header("Location: ../signup.php?error=emptyInput");
            exit();
        }

        if (invalidUsername($username)) {
            header("Location: ../signup.php?error=invalidusername");
            exit();
        }

        if (invalidEmail($email)) {
            header("Location: ../signup.php?error=invalidemail");
            exit();
        }

        if (passwordMismatch($password, $confPassword)) {
            header("Location: ../signup.php?error=passwordmismatch");
            exit();
        }

        if (usernameOrEmailExists($conn, $username, $email)) {
            header("Location: ../signup.php?error=userexists");
            exit();
        }

        createUser($conn, $name, $email, $username, $password);

    } else {
        header("Location: ../signup.php");
        exit();
    }