<?php
if ( isset($_POST['delete']) ) {
    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);
    $result = $mysqli->query("SELECT id FROM users WHERE users.password = \"$password\" AND username = \"$login\" ORDER BY id LIMIT 1");
    foreach($result as $user){
        $user_id = $user['id'];
    }
    $id = $_POST['id'];
    $statement = $mysqli->prepare("DELETE FROM articles WHERE id=? LIMIT 1");
    $statement->bind_param("i",$id);
    $statement->execute();
    $statement->close();
}
?>