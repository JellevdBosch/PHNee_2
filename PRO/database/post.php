<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST) && !empty($_POST)) {
        if (isset($_POST['new'])) {
            createPost();
        } else if (isset($_POST['edit'])) {
            updatePost();
        }
    }
}

     function connection() {
        try {
            $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8';
            $conn = new PDO($dsn, DB_USER, DB_PASSWORD, array(
                PDO::ATTR_PERSISTENT => true
            ));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("A database error was encountered: " . $e->getMessage());
        }
        return $conn;
    }

    function createPost() {
        date_default_timezone_set('Europe/Amsterdam');
        $conn = connection();
        $title = test_input($_POST['post_title']);
        $content = test_input($_POST['post_content']);
        $stmt = $conn->
        prepare("INSERT INTO blog_posts(title, content, date) 
      VALUES (?,?,?)");
        $stmt->execute(array($title, $content, date("Y-m-d H:i:s")));
        $_POST = null;
        header("Location: ../index.php");
    }

    function readPosts() {
        $conn = connection();

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

/**
 * Edit a post
 */
function getUpdateData($id) {
    $conn = connection();

    $stmt = $conn->
    prepare("SELECT id, title, content, 
            DATE_FORMAT(blog_posts.date, '%d/%m/%Y') AS date
            FROM blog_posts
            WHERE id = ?");
    $stmt->execute(array($id));

    // set the resulting array to associative
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($result)) {
        return $result;
    } else {
        return ("Error retrieving post!");
    }
}


function updatePost() {
    date_default_timezone_set('Europe/Amsterdam');
    $conn = connection();
    $title = test_input($_POST['title']);
    $content = test_input($_POST['content']);
    $stmt = $conn->
    prepare("UPDATE blog_posts SET title=?, content=?, date=? WHERE id=?");
    $stmt->execute(array($title, $content, date("Y-m-d H:i:s"), $_POST['id']));
    $_POST = null;
    header("Location: ../../index.php");
}

    function deletePost() {
        connection();
        date_default_timezone_set('Europe/Amsterdam');
        $conn = connection();
        $stmt = $conn->
        prepare("DELETE FROM blog_posts WHERE id=?");
        $stmt->execute(array($_GET['remove_id']));
        $_POST = null;
        header("Location: ../../index.php");
    }

function post($id, $title, $content, $date)
{

    if (!empty($id) && !empty($title) && !empty ($content) && !empty ($date)) {
        if (isset($_SESSION['session_id']) && $_SESSION['session_id'] != "") {
            return
                "<article class = 'post'>
                <span class='post-id' style='display: none;'>$id</span>
                <h4 class='post-title'>"
                . $title .
                "</h4>
                <p class='post-content'>"
                . $content .
                "</p>
                <div class='post-info'>
                    <small class='post-edit'>
                        <a href='/post/edit.php/?edit_id=$id' class='post-edit-button'>Edit</a>
                    </small>
                    <small class='post-remove'>
                        <a href='/index.php/?remove_id=$id' type='button' class='post-remove-button'>Remove</a>
                    </small>
                    <small class='post-date'>
                        " . $date . "
                    </small>
                </div>   
            </article>";
        } else {
            return
                "<article class = 'post'>
                <span class='post-id' hidden style='display: none;'>$id</span>
                <h4 class='post-title'>"
                . $title .
                "</h4>
                <p class='post-content'>"
                . $content .
                "</p>
                <div class='post-info'>
                    <small class='post-date'>
                        " . $date . "
                    </small>
                </div>   
            </article>";
        }
    }
}