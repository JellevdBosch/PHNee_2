<?php
include_once("includes/header.php");
if (!empty($view->getErrors())) {
    $errormessage = $view->getErrors();
}else{
    $errormessage = "";
}
?>
    <section class="content">
        <section id="main-content-wrapper">
            <?php
            echo $errormessage;
            ?>
            <section id="posts-wrapper">
                <?php
                $post = new Post();
                $post->readPosts();
                ?>
            </section>
        </section>
    </section>
<?php
include('includes/footer.php');
?>