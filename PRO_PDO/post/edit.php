<?php
include("../database/posts.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Takenlijst</title>

    <meta name="author" content="Jelle van den Bosch" />
    <meta name="description" content="Blog Takenlijst Procedureel PDO" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/main.css" type="text/css" />
</head>
<body>
<div class="wrapper">
    <header class="header">
        <?php
        include_once("../includes/header.php");
        ?>
        <nav class="main-nav">
            <?php
            include_once("../includes/main-nav.php");
            ?>
        </nav>
    </header>
    <section class="content">
        <section id="edit-content-wrapper">
            <article id="edit-content-title">
                <h3>Edit a post</h3>
            </article>
            <article id="edit-content-form">
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                        if (isset($_GET['edit_id'])) {
                            getUpdateData();
                        }
                    }
                ?>
            </article>
        </section>
    </section>
    <footer class="footer">
        <?php
        include_once("../includes/footer.php");
        ?>
    </footer>
</div>
</body>
</html>
