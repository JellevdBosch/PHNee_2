<?php

require_once ("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['newPost'])) {
        $titleError = "";
        $contentError = "";
        createPost();
    } else if (isset($_POST['editPost'])) {
        updatePost();
    }
}

/**
 * make new posts
 */
function createPost() {
    include_once ("../post_template/post.php");
    date_default_timezone_set('Europe/Amsterdam');
    $conn = connect();
    $stmt = $conn->
    prepare("INSERT INTO blog_posts(title, content, date) 
      VALUES (?,?,?)");
    $stmt->execute(array($_POST['post_title'], $_POST['post_content'], date("Y-m-d H:i:s")));
    $_POST = null;
    header("Location: ../index.php");
}

/**
 * Edit a post
 */
function getUpdateData() {
    include_once ("../post_template/post.php");
    $conn = connect();

    $stmt = $conn->
    prepare("SELECT id, title, content, 
            DATE_FORMAT(blog_posts.date, '%d/%m/%Y') AS date
            FROM blog_posts
            WHERE id = ?");
    $stmt->execute(array($_GET['edit_id']));

    // set the resulting array to associative
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($result)) {
        foreach ($result as $row) {
            $id = $_GET['edit_id'];
            $title = $row['title'];
            $content = $row['content'];
            $date = $row['date'];
            echo postForm($id, $title, $content, $date);
        }
    } else {
        echo ("Error retrieving post!");
    }
}

function updatePost() {
    include_once ("../post_template/post.php");
    date_default_timezone_set('Europe/Amsterdam');
    $conn = connect();
    $stmt = $conn->
    prepare("UPDATE blog_posts SET title=?, content=?, date=? WHERE id=?");
    $stmt->execute(array($_POST['post_title'], $_POST['post_content'], date("Y-m-d H:i:s"), $_POST['id']));
    $_POST = null;
    header("Location: ../../index.php");
}

/**
 * Remove post
 */
function removePost() {
    include_once ("../post_template/post.php");
    connect();
    date_default_timezone_set('Europe/Amsterdam');
    $conn = connect();
    $stmt = $conn->
    prepare("DELETE FROM blog_posts WHERE id=?");
    $stmt->execute(array($_GET['remove_id']));
    $_POST = null;
    header("Location: ../../index.php");
}


/**
 * get posts
 */

function readPosts() {
    include_once ("post_template/post.php");
    $conn = connect();

    $stmt = $conn->
    prepare("SELECT id, title, content, DATE_FORMAT(blog_posts.date, '%H:%i:%s %d/%m/%Y') AS date 
                FROM blog_posts 
                ORDER BY date 
                DESC ");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($result)) {
        foreach ($result as $row) {
            $id = $row['id'];
            $title = $row['title'];
            $content = $row['content'];
            $date = $row['date'];
            echo post($id, $title, $content, $date);
        }
    } else {
        echo "<h3>There are no posts made yet!</h3>";
    }
}

