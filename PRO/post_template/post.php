<?php

function post($id, $title, $content, $date) {

    if (!empty($id) && !empty($title) && !empty ($content) && !empty ($date)) {
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
                        ". $date ."
                    </small>
                </div>   
            </article>";
    } else {
        die("Error receiving data!");
    }
}

function postForm($id, $title, $content, $date) {

    if (!empty($id) && !empty($title) && !empty ($content) && !empty ($date)) {
        return
            "<form method=\"post\" action=\"database/posts.php\">
                <input type='hidden' name='id' value='$id'>
                <input type=\"text\" value=' " . $title . " ' name=\"post_title\" placeholder=\"Title\"><br><br>
                <textarea rows=\"4\" name=\"post_content\">$content</textarea><br><br><br>
                <input value=\"Update\" type=\"submit\" name=\"editPost\">
            </form>";
    } else {
        die("Error receiving data!");
    }
}