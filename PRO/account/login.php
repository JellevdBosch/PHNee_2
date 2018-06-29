<?php
include_once("../includes/header.php");
?>
    <section class="content">
        <section id="login-content-wrapper">
            <div class="login-card">
                <h1>Log-in</h1><br>
                <form action="../database/account.php" method="post">
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" name="login" class="login login-submit" value="login">
                </form>
            </div>
        </section>
    </section>
<?php
include('../includes/footer.php');
?>