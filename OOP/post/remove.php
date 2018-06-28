<?php
define('ROOT', dirname(dirname(__FILE__)).'/');
include('' . ROOT . 'config/config.php');
include('' . ROOT . 'library/functions.php');
$view = new View();
include('' . ROOT . 'database/post.php');
$view->setSiteTitle('Remove Post');
if (!empty($view->getErrors())) {
    $errormessage = $view->getErrors();
}else{
    $errormessage = "";
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET) && !empty($_GET)) {
        if (isset($_GET['remove_id'])) {
            $post = new Post();
            $post_id = $_GET['remove_id'];
            $post->deletePost($post_id);
        }
    }
}
?>

<!doctype html>
<head>
    <title>PHP | <?php echo $view->getSiteTitle();?></title>
</head>
<div>
    <?php echo $errormessage; ?>
</div>


