<section>
    <h2>Create new password</h2>
    <?php
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        
        if (empty($selector) || empty($validator)) {
            header("Location: reset-password.php?error=couldnotvalidate");
            exit();
        } else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>

                <form action="includes/reset-password.inc.php" method="POST">
                    <input type="hidden" name="selector" value="<?php echo htmlspecialchars($selector); ?>">
                    <input type="hidden" name="validator" value="<?php echo htmlspecialchars($validator); ?>">
                    <input type="password" name="newPassword" placeholder = "Enter a new password...">
                    <input type="password" name="confNewPassword" placeholder = "Repeat new password...">
                    <button type="submit" name="new-password-submit">Reset password</button>
                </form>

                <?php
            }
        }
    ?>

    <form action="includes/create-new-password.inc.php" method="POST">
        <input type="text" name="newPassword" placeholder = "New password...">
        <button type="submit" name="new-password-submit">Submit</button>
    </form>
 
</section>