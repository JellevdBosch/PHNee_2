<!DOCTYPE html>
<html>
<head>
    <title>Blog Takenlijst</title>

    <meta name="author" content="Jelle van den Bosch" />
    <meta name="description" content="Blog Takenlijst Procedureel PDO" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/main.css" type="text/css" />
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
        <section id="adminpanel-content-wrapper">
            <article id="adminpanel-content-title">
                <h3>Make a new post</h3>
            </article>
            <article id="adminpanel-content-form">
                <form method="post" action="../database/posts.php">
                    <input type="text" name="post_title" placeholder="Title"><br><br>
                    <textarea rows="4"  name="post_content" placeholder="Content"></textarea><br><br><br>
                    <input value="Submit" type="submit" name="newPost">
                </form>
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
