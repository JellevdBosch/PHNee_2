<?php
include_once("../includes/header.php");
if (!empty($view->getErrors())) {
    $errormessage = $view->getErrors();
}else{
    $errormessage = "";
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET) && !empty($_GET)) {
        if (isset($_GET['edit_id'])) {
            $post = new Post();
            $post_id = $_GET['edit_id'];
            $edit_data[0] = $post->getPostData($post_id);
        }
    }
}
?>

<section class="content">
    <section id="posts-content-wrapper">
        <article id="posts-content-title">
            <h3>Edit Post</h3>
        </article>
        <article id="posts-content-form">
            <form method="post" action="<?php ROOT . 'database/post.php' ?>" id="edit_post">
                <input type='hidden' readonly='readonly' name='post_id' value='<?php echo $edit_data[0]['edit_id']; ?>'>
                <input type="text" name="post_title" placeholder="Title" value="<?php echo $edit_data[0]['edit_title']; ?>" required><br><br>
                <textarea rows="4"  name="post_content" placeholder="Content"  required><?php echo $edit_data[0]['edit_content']; ?></textarea><br><br><br>
                <input value="Submit" type="submit" name="edit_post">
            </form>
        </article>
    </section>
</section>
<?php
include('../includes/footer.php');
?>

