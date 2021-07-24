<?php
    session_start();
    $errors = ['loginerror' => '', 'emptyinput' => ''];
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "loginerror") {
            $errors['loginerror'] = "Invalid username/Password";
        } else if ($_GET['error'] == "emptyinput") {
            $errors['emptyinput'] = "Fill in all the fields provided";
        } else {
            session_unset();
            session_destroy();
        }
    }

    if (isset($_SESSION['usernameOrEmail'])) {
        $usernameOrEmail = $_SESSION['usernameOrEmail'];
        $password = $_SESSION['password'];
    } else {
        $usernameOrEmail = "";
        $password = "";
    }

?>

<section>
    <h2>Log In</h2>
    <form action="includes/login.inc.php" method="POST">
        <div><?php echo htmlspecialchars($errors['emptyinput']); ?></div>
        <div><input type="text" name="usernameOrEmail" placeholder="Username/Email..." value="<?php echo htmlspecialchars($usernameOrEmail); ?>" required></div>
        <div><input type="password" name="password" placeholder="Password..." value="<?php echo htmlspecialchars($password); ?>"  required></div>
        <div><?php echo htmlspecialchars($errors['loginerror']); ?></div>
        <div><button type="submit" name="login">Log In</button></div>
    </form>
</section>