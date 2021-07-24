<?php

    function emptyInputSignup($name, $username, $email, $password, $confPassword) {
        $error_exists;
        if (empty($name) || empty($username) || empty($email) || empty($password) || empty($confPassword)) {
            $error_exists = true;
        } else {
            $error_exists = false;
        }
        return $error_exists;
    }

    function invalidUsername($username) {
        $error_exists;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $error_exists = true;
        } else {
            $error_exists = false;
        }
        return $error_exists;
    }


    function invalidEmail($email) {
        $error_exists;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_exists = true;
        } else {
            $error_exists = false;
        }
        return $error_exists;
    }

    function passwordMismatch($password, $confPassword) {
        $error_exists;
        if ($password != $confPassword) {
            $error_exists = true;
        } else {
            $error_exists = false;
        }
        return $error_exists;
    }

    function usernameOrEmailExists($conn, $username, $email) {
        $sql = "SELECT * FROM users WHERE usersUsername = ? OR usersEmail = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row;
        } else {
            $error_exists = false;
            return $error_exists;
        }
        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $name, $email, $username, $password) {
        $sql = "INSERT INTO users(usersName, usersEmail, usersUsername, usersPassword) VALUES(?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=stmtfailed");
            exit();
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: ../signup.php?error=none");
        exit();
    }

    function emptyInputLogin($usernameOrEmail, $password) {
        $error_exists;
        if (empty($usernameOrEmail) || empty($password)) {
            $error_exists = true;
        } else {
            $error_exists = false;
        }
        return $error_exists;
    }

    function loginUser($conn, $usernameOrEmail, $password) {
        $userExists = usernameOrEmailExists($conn, $usernameOrEmail, $usernameOrEmail);
        if ($userExists === false) {
            header("Location: ../login.php?error=loginerror");
            exit();
        } else {
            $checkedPassword = password_verify($password, $userExists['usersPassword']);
            if ($checkedPassword === false) {
                header("Location: ../login.php?error=loginerror");
                exit();
            } else if ($checkedPassword === true) {
                session_start();
                $_SESSION['name'] = $userExists['usersName'];
                $_SESSION['username'] = $userExists['usersUsername'];
                header("Location: ../index.php");
                exit();

            }

        }
    }