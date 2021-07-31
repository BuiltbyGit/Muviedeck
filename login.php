<?php
    session_start();
    $errors = ['loginerror' => '', 'emptyinput' => '', 'none' => ''];
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "loginerror") {
            $errors['loginerror'] = "Invalid username/Password";
        } else if ($_GET['error'] == "emptyinput") {
            $errors['emptyinput'] = "Fill in all the fields provided";
        }else if ($_GET['error'] == "none") {
            $errors['none'] = "Your account was created successfully ";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/queries.css">
    <title>Login - Muviedeck</title>
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
        <div class="login-main">
            <h1>Login</h1>
            <form action="includes/login.inc.php" class="login-form" method="post">
                <?php  if($errors['emptyinput']){
                    echo '<div class="error-message">'.htmlspecialchars($errors['emptyinput']).'</div>';
                }?>
                                <?php  if($errors['none']){
                    echo '<div class="success-message">'.htmlspecialchars($errors['none']).'</div>';
                }?>
            <input type="text" class="input-class" placeholder="Username" name="usernameOrEmail" value="<?php echo htmlspecialchars($usernameOrEmail); ?>">
            <input type="Password" class="input-class" placeholder="password" name="password" value="<?php echo htmlspecialchars($password); ?>" >
                            <?php  if($errors['loginerror']){
                    echo '<div class="error-message">'.htmlspecialchars($errors['loginerror']).'</div>';
                }?>
            <div class="forgot-pass"><a href="forgotpassword.html">Forgot Password</a></div>
<!--         </form> -->
            <button class="login-btn login-login-btn" type="submit" name="login">Login</button>
            </form>
            <div class="forgot-pass already"><a href="signup.php">Don't have an account? Sign up</a></div>
        </div>
    </div>
</body>
</html>