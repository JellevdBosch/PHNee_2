<?php
include_once("includes/header.php");
?>
    <section class="content">
        <section id="main-content-wrapper">
            <section id="posts-wrapper">
                <?php
                readPosts();
                if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset  ($_GET['remove_id'])) {
                    deletePost();
                }
                ?>
            </section>
        </section>
    </section>
<?php
include('includes/footer.php');
?>