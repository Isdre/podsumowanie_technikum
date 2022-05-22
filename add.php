<?php
if ( isset($_POST['add']) ) {
    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);
    $title = strip_tags($_POST['title']);
    $result = $mysqli->query("SELECT id FROM users WHERE users.password = \"$password\" AND username = \"$login\" ORDER BY id LIMIT 1");
    foreach($result as $user){
        $user_id = $user['id'];
    }
    $content = strip_tags($_POST['content']);
    $statement = $mysqli->prepare("INSERT articles (title,article,user_id) VALUES (?,?,?)");
    $statement->bind_param("ssi",$title,$content,$user_id);
    $statement->execute();
    $statement->close();
}
?>