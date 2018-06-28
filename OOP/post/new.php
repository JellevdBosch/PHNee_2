<?php
include_once("../includes/header.php");
if (!empty($view->getErrors())) {
    $errormessage = $view->getErrors();
}else{
    $errormessage = "";
}
?>
<section class="content">
    <section id="posts-content-wrapper">
        <article id="posts-content-title">
            <h3>Make a new post</h3>
        </article>
        <article id="posts-content-form">
            <form method="post" action="<?php ROOT . 'database/post.php' ?>" id="new_post">
                <input type="text" name="post_title" placeholder="Title" value="" required><br><br>
                <textarea rows="4"  name="post_content" placeholder="Content"  required></textarea><br><br><br>
                <input value="Submit" type="submit" name="new_post">
            </form>
        </article>
    </section>
</section>
    <?php
    include('../includes/footer.php');
    ?>

