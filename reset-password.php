<?php
    $message = $error = '';
    if (isset($_GET['reset'])) {
        if ($_GET['reset'] == "success") {
            $message = 'Success. Check your email!';
        }  
    }

    $error_message = 'Please resubmit your password reset request';
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyinput") {
            $error = "Error. Some fields were left empty." . $error_message;
        } else if ($_GET['error'] == "passwordMismatch") {
            $error = "Error. Passwords do not match." . $error_message;
        } else if ($_GET['error'] == "stmtfailed") {
            $error = "Error. Something went wrong." . $error_message;
        } else if ($_GET['error'] == "somethingwentwrong") {
            $error = "Error. Something went wrong." . $error_message;
        } else if ($_GET['error'] == "couldnotvalidate") {
            $error = "We could not validate your request." . $error_message;
        }
    }
?>

<section>
    <h2>Reset your password</h2>
    <p>An email will be sent to you with instructions on how to reset your password.</p>

    <form action="includes/reset-request.inc.php" method="POST">
        <input type="text" name="email" placeholder = "Email address...">
        <button type="submit" name="reset-request-submit">Submit</button>
    </form>

    <div><?php echo htmlspecialchars($message); ?></div>
    <div><?php echo htmlspecialchars($error); ?></div>

</section>