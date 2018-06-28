<!DOCTYPE html>
<?php
include_once ("database/posts.php");
?>
<html>
    <head>
        <title>Blog Takenlijst</title>

        <meta name="author" content="Jelle van den Bosch" />
        <meta name="description" content="Blog Takenlijst Procedureel PDO" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script
                src="https://code.jquery.com/jquery-3.3.1.js"
                integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
                crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/main.css" type="text/css" />
    </head>
    <body>
        <div class="wrapper">
            <header class="header">
                <?php
                include_once ("includes/header.php");
                ?>
                <nav class="main-nav">
                    <?php
                    include_once("includes/main-nav.php");
                    ?>
                </nav>
            </header>
            <section class="content">
                <section id="main-content-wrapper">
                    <section id="posts-wrapper">
                        <?php
                        readPosts();
                        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['remove_id'])) {
                            removePost();
                        }
                        ?>
                    </section>
                </section>
            </section>
            <footer class="footer">
                <?php
                include_once ("includes/footer.php");
                ?>
            </footer>
        </div>
    </body>
</html>