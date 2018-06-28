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
    // prepare and bind
    $stmt = mysqli_prepare($conn, "INSERT INTO blog_posts(title, content, date) 
      VALUES (?,?,?)");
    mysqli_stmt_bind_param($stmt, 'sss', $_POST['post_title'], $_POST['post_content'], date("Y-m-d H:i:s"));
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../index.php");
}

/**
 * Edit a post
 */
function getUpdateData() {
    include_once ("../post_template/post.php");
    $conn = connect();

    $id = $_GET['edit_id'];

    $query = "SELECT id, title, content, 
            DATE_FORMAT(blog_posts.date, '%d/%m/%Y') AS date
            FROM blog_posts
            WHERE id = $id";

    if ($result = mysqli_query($conn, $query)) {
        /* fetch associative array */
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['title'];
            $content = $row['content'];
            $date = $row['date'];
            echo postForm($id, $title, $content, $date);
        }
        /* free result set */
        mysqli_free_result($result);
    } else {
        echo ("Error retrieving post!");
    }
    mysqli_close($conn);
}

function updatePost() {
    include_once ("../post_template/post.php");
    date_default_timezone_set('Europe/Amsterdam');
    $conn = connect();
    $stmt = mysqli_prepare($conn, "UPDATE blog_posts SET title=?, content=?, date=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'sssi', $_POST['post_title'], $_POST['post_content'], date("Y-m-d H:i:s"), $_POST['id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: /");
}

/**
 * Remove post
 */
function removePost() {
    include_once ("post_template/post.php");
    date_default_timezone_set('Europe/Amsterdam');
    $conn = connect();
    $stmt = mysqli_prepare($conn, "DELETE FROM blog_posts WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'i', $_GET['remove_id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../index.php");
}


/**
 * get posts
 */

function readPosts() {
    include_once ("post_template/post.php");
    $conn = connect();

    $query = "SELECT id, title, content, DATE_FORMAT(blog_posts.date, '%H:%i:%s %d/%m/%Y') AS date 
                FROM blog_posts 
                ORDER BY date 
                DESC ";

    if ($result = mysqli_query($conn, $query)) {
        /* fetch associative array */
        if (!empty($result)){
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $title = $row['title'];
                $content = $row['content'];
                $date = $row['date'];
                echo post($id, $title, $content, $date);
            }
        }
        /* free result set */
        mysqli_free_result($result);
    } else {
        echo ("Error retrieving post!");
    }
    mysqli_close($conn);
}

