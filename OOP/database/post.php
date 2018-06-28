<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST) && !empty($_POST)) {
        if (isset($_POST['new_post'])) {
            $post = new Post();
            $post_title = $_POST['post_title'];
            $post_content = $_POST['post_content'];
            $post_date = date("Y-m-d H:i:s");
            $post->createPost($post_title,$post_content,$post_date);
        } else if (isset($_POST['edit_post'])) {
            $post = new Post();
            $post_id = $_POST['post_id'];
            $post_title = $_POST['post_title'];
            $post_content = $_POST['post_content'];
            $post_date = date("Y-m-d H:i:s");
            $post->updatePost($post_id, $post_title,$post_content,$post_date);
        }
    }
}

class Post {

    private $post_id;
    private $post_title;
    private $post_content;
    private $post_date;
    private $connection;
    private $view;

    public function __construct() {
        $this->view = new View();
        $this->setConnection();
    }

    private function setConnection() {
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
        $this->connection = $conn;
    }

    public function createPost($post_title,$post_content, $post_date) {
        date_default_timezone_set('Europe/Amsterdam');
        $stmt = $this->connection->
        prepare("INSERT INTO blog_posts(title, content, date) 
        VALUES (?,?,?)");
        $stmt->execute(array($post_title, $post_content, $post_date));
        header("Location: ".SITE_ROOT);
        exit();
    }

    public function readPosts() {
        $stmt = $this->connection->
        prepare("SELECT id, title, content, DATE_FORMAT(blog_posts.date, '%H:%i:%s %d/%m/%Y') AS date 
                FROM blog_posts 
                ORDER BY date 
                DESC ");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            $array[] = array();
            foreach ($result as $row) {
                $id = $row['id'];
                $title = $row['title'];
                $content = $row['content'];
                $date = $row['date'];
                $this->setPost($id, $title, $content, $date);
                echo $this->getPost();
            }
        } else {
            echo "<h3>There are no posts made yet!</h3>";
        }
    }

    private function setPost($post_id,$post_title,$post_content,$post_date) {
        $this->post_id = $post_id;
        $this->post_title = $post_title;
        $this->post_content = $post_content;
        $this->post_date = $post_date;
    }

    private function getPost() {
        if (!empty($this->post_id) && !empty($this->post_title) && !empty ($this->post_content) && !empty ($this->post_date)) {
            return
                "<article class = 'post'>
                <span class='post-id' style='display: none;'>$this->post_id</span>
                <h4 class='post-title'>"
                . $this->post_title .
                "</h4>
                <p class='post-content'>"
                . $this->post_content .
                "</p>
                <div class='post-info'>
                    <small class='post-edit'>
                        <a href='" . SITE_ROOT . "post/edit.php/?edit_id=$this->post_id' class='post-edit-button'>Edit</a>
                    </small>
                    <small class='post-remove'>
                        <a href='" . SITE_ROOT . "post/remove.php/?remove_id=$this->post_id' type='button' class='post-remove-button'>Remove</a>
                    </small>
                    <small class='post-date'>
                        ". $this->post_date ."
                    </small>
                </div>   
            </article>";
        } else {
            die("Error receiving data!");
        }
    }

    public function getPostData($id) {
        $stmt = $this->connection->
        prepare("SELECT title, content
            FROM blog_posts
            WHERE id = ?");
        $stmt->execute(array($id));

        // set the resulting array to associative
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $array['edit_id'] = $id;
        $array['edit_title'] = $result['title'];
        $array['edit_content'] = $result['content'];
        return $array;
    }

    public function updatePost($post_id, $post_title,$post_content,$post_date) {
        date_default_timezone_set('Europe/Amsterdam');
        $stmt = $this->connection->
        prepare("UPDATE blog_posts SET title=?, content=?, date=? WHERE id=?");
        $stmt->execute(array($post_title, $post_content,$post_date, $post_id));
        header("Location: ".SITE_ROOT);
        exit();
    }

    public function deletePost($post_id) {
        date_default_timezone_set('Europe/Amsterdam');
        $stmt = $this->connection->
        prepare("DELETE FROM blog_posts WHERE id=?");
        $stmt->execute(array($post_id));
        header("Location: ".SITE_ROOT);
        exit();
    }
}