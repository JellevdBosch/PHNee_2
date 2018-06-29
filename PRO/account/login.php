<?php
include_once("../includes/header.php");
if (!empty($view->getErrors())) {
    $errormessage = $view->getErrors();
}else{
    $errormessage = "";
}
?>
    <section class="content">
        <section id="login-content-wrapper">
            <?php
            echo $errormessage;
            ?>
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