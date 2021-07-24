<?php
    session_start();
    $errors = ['emptyinput' => '', 'invalidusername' => '', 'invalidemail' => '', 'passwordmismatch' => '', 'userexists' => '', 'stmtfailed' => '', 'none' => ''];
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyinput") {
            $errors['emptyinput'] = "Fill in all the fields provided!";
        } else if ($_GET['error'] == "invalidusername") {
            $errors['invalidusername'] = "Enter a valid username";
        } else if ($_GET['error'] == "invalidemail") {
            $errors['invalidemail'] = "Enter a valid email address";
        } else if ($_GET['error'] == "passwordmismatch") {
            $errors['passwordmismatch'] = "Passwords do not match";
        } else if ($_GET['error'] == "userexists") {
            $errors['userexists'] = "Username or email already taken";
        } else if ($_GET['error'] == "stmtfailed") {
            $errors['stmtfailed'] = "Something went wrong";
        } else if ($_GET['error'] == "none") {
            $errors['none'] = "Sign up successful!";
            session_unset();
            session_destroy();
        }
    }

    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $confPassword = $_SESSION['confPassword'];
    } else {
        $name = $email = $username = $password = $confPassword = "";
    }
?>




<section>
    <h2>Sign Up</h2>
    <form action="includes/signup.inc.php" method="POST">
        <div><?php echo htmlspecialchars($errors['emptyinput']); ?></div>
        <div><?php echo htmlspecialchars($errors['userexists']); ?></div>
        <div><?php echo htmlspecialchars($errors['stmtfailed']); ?></div>
        <div><input type="text" placeholder="Name..." name="name" value="<?php echo htmlspecialchars($name); ?>" required></div>
        <div><input type="text" placeholder="Username..." name="username" value="<?php echo htmlspecialchars($username); ?>"  required></div>
        <div><?php echo htmlspecialchars($errors['invalidusername']); ?></div>
        <div><input type="text" placeholder="Email..." name="email" value="<?php echo htmlspecialchars($email); ?>"  required></div>
        <div><?php echo htmlspecialchars($errors['invalidemail']); ?></div>
        <div><input type="password" placeholder="Password..." name="password" value="<?php echo htmlspecialchars($password); ?>"  required></div>
        <div><input type="password" placeholder="Confirm Password..." name="confPassword" value="<?php echo htmlspecialchars($confPassword); ?>"  required></div>
        <div><?php echo htmlspecialchars($errors['passwordmismatch']); ?></div>
        <div><button type="submit" name="signup">Sign Up</button></div>
        <div><?php echo htmlspecialchars($errors['none']); ?></div>
    </form>
</section>

<?php
    
?>