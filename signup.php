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
            header('location: login.php?error=none');
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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/queries.css">
    <title>Sign Up - Muviedeck</title>
</head>
<body>

    <div class="login-banner">

        <div class="login-banner-main">
                <nav class="navigationbar login-nav-override">
                <ul class="menu">
            <li class="logo"><a href="index.php">Muviedeck</a></li>
            <li class="item"><a href="#">Home</a></li>
            <li class="item"><a href="#" class="active">Popular</a></li>
            <li class="item"><a href="#">Watchlist</a></li>
          <li class="toggle"><a href="#"><i class="fas fa-bars"></i></a></li>
  </ul>
      </nav>
            <h1>Muviedeck</h1>
            <p>Discover Movies, TV Series, Upcoming Movies and Trends</p>
        </div>
        <div class="login-main signup-main">
            <h1>Sign Up</h1>
            <form action="includes/signup.inc.php" class="login-form" method="post">
            <?php  if($errors['emptyinput']){
                    echo '<div class="error-message">'.htmlspecialchars($errors['emptyinput']).'</div>';
                }elseif ($errors['userexists']) {
                    echo '<div class="error-message">'.htmlspecialchars($errors['userexists']).'</div>';
                }elseif ($errors['stmtfailed']) {
                    echo '<div class="error-message">'.htmlspecialchars($errors['stmtfailed']).'</div>';
                }?>
            <input type="text" class="input-class" placeholder="Fullname" name="name" value="<?php echo htmlspecialchars($name); ?>" >
            <input type="text" class="input-class" placeholder="Email" name="email" value="<?php echo htmlspecialchars($email); ?>"  >
            <?php  if($errors['invalidemail']){
                    echo '<div class="error-message">'.htmlspecialchars($errors['invalidemail']).'</div>';
                }?>
            <input type="text" class="input-class" placeholder="Username" name="username" value="<?php echo htmlspecialchars($username); ?>" >
            <?php  if($errors['invalidusername']){
                    echo '<div class="error-message">'.htmlspecialchars($errors['invalidusername']).'</div>';
                }?>
            <input type="Password" class="input-class" placeholder="password" name="password" value="<?php echo htmlspecialchars($password); ?>"  >
            <input type="Password" class="input-class" placeholder="Retype Password" name="confPassword" value="<?php echo htmlspecialchars($confPassword); ?>">
            <?php  if($errors['passwordmismatch']){
                    echo '<div class="error-message">'.htmlspecialchars($errors['passwordmismatch']).'</div>';
                }?>
            <div class="forgot-pass input-check-box">
                <input type="checkbox" class="input-check" required>I agree to the&nbsp;
                <a href="forgotpassword.html"> Terms and Condition of the site.</a></div>
            <button class="login-btn login-login-btn" type="submit" name="signup">Sign Up</button>
            </form>
            <div class="forgot-pass already"><a href="login.php">Already have an account? Sign in</a></div>
        </div>
    </div>
</body>
</html>