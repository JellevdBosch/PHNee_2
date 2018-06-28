<?php
define('ROOT', dirname(dirname(__FILE__)).'/');


include('' . ROOT . 'config/config.php');
include('' . ROOT . 'library/functions.php');
$view = new View();
include('' . ROOT . 'database/post.php');

$fun = new functions();
$url = $fun->curPage();
switch ($url) {
    case 'posts':
        $view->setSiteTitle('Blog Posts');
        break;
    case 'new':
        $view->setSiteTitle('New Post');
        break;
    case 'edit':
        $view->setSiteTitle('Edit Post');
        break;
    default:
        $view->setSiteTitle('Blog Posts');
        break;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <meta name="author" content="Jelle van den Bosch">
    <!-- making sure the website can be installed as webapp on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5" />

    <title>PHP | <?php echo $view->getSiteTitle();?></title>

    <meta name="description" content="Blog Takenlijst Procedureel PDO" />
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo '' . SITE_ROOT . 'public/css/main.css' ?>" type="text/css" />
</head>
<body>
    <div class="wrapper">

<header class="header">
    <div id="header-wrap">
        <div id="main-title">
            <h2>Takenlijst</h2>
        </div>
    </div>
    <nav class="main-nav">
        <div id="main-nav-wrapper">
            <ul id="main-nav-list">
                <li class="main-nav-item"><a href='/'>Posts</a> </li>
                <li class="main-nav-item"><a href='/post/new.php'>New Post</a></li>
            </ul>
        </div>
    </nav>
</header>

