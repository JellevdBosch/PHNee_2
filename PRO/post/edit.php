<?php
include_once("../includes/header.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET) && !empty($_GET)) {
        if (isset($_GET['edit_id'])) {
            $post_id = $_GET['edit_id'];
            $edit_data[0] = getUpdateData($post_id);
        }
    }
}
?>

<section class="content">
    <section id="posts-content-wrapper">
        <article id="posts-content-title">
            <h3>Edit Post</h3>
        </article>
        <?php
        //var_dump($edit_data);
        ?>
        <article id="posts-content-form">
            <form method="post" action="<?php ROOT . 'database/post.php' ?>" id="edit_post">
                <input hidden type='hidden' readonly='readonly' name='id' value='<?php echo $edit_data[0][0]['id']; ?>'>
                <input type="text" name="title" placeholder="Title" value="<?php echo $edit_data[0][0]['title']; ?>" required><br><br>
                <textarea rows="4"  name="content" placeholder="Content"  required><?php echo $edit_data[0][0]['content']; ?></textarea><br><br><br>
                <input value="Submit" type="submit" name="edit">
            </form>
        </article>
    </section>
</section>
<?php
include('../includes/footer.php');
?>

