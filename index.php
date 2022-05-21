<?php
$user_id = 0;
if(isset($_POST['id'])){
    $user_id = $_POST['id'];
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Forum</title>
</head>
<body>
    <header><h1>Forum</h1></header>
    <div class="container">
    <div class="account">
            <?php
            if($user_id != 0)
            {
                echo "<h3>Zalogowany</h3>";
                $result = $mysqli->query("SELECT * FROM users WHERE id = $user_id ORDER BY id LIMIT 1");
                foreach($result as $user){
                echo "<p>Witaj " . $user['username'] . "</p><br>";
                }
            }else
            {
            echo "<h3>Zaloguj się</h3>";
                echo "<form method=\"post\" action=\"index.php\">";
                echo "<input type=\"checkbox\" id=\"LogSing\" name=\"LogSing\" checked hidden>";
                echo "<label for=\"Login\">Nazwa użytkownika:</label><br>";
                echo "<input type=\"text\" id=\"login\" name=\"login\"><br>";
                echo "<label for=\"password\">Hasło:</label><br>";
                echo "<input type=\"text\" id=\"password\" name=\"password\">";
                echo "</form>";
            echo "<h3>Zarejestuj się</h3>";
                echo "<form method=\"post\" action=\"index.php\">";
                echo "<input type=\"checkbox\" id=\"LogSing\" name=\"LogSing\" hidden>";                
                echo "<label for=\"Login\">Nazwa użytkownika:</label><br>";
                echo "<input type=\"text\" id=\"login\" name=\"login\"><br>";
                echo "<label for=\"password\">Hasło:</label><br>";
                echo "<input type=\"text\" id=\"password\" name=\"password\">";
                echo "</form>";
            }
            ?>

        </div>
        <div class="articles">
            <h2>Artykuły</h2>
            <?php
                include('db_connect.php');
				$result = $mysqli->query("SELECT articles.id,title,article,username,user_id FROM articles JOIN users ON users.id = articles.user_id ORDER BY articles.id DESC");
				foreach($result as $article){
					echo '<article class="single-article">';
					echo '<h3>' . $article['title'] . '</h3>';
					echo '<div class="article-content">';
					echo '<p>' . $article['article'] . '</p>';
					echo '</div>';
                    echo '<h4> Napisany przez ' . $article['username'] . '</h4>';
                    if($user_id == $article['user_id'] ){
                    echo '<a class = "delete_button" href="delete.php?id=' . $article['id'] . '">';
                    echo '<div class="ui label"><i>Usuń</i></div>';
					echo '</a>';
                    }
					echo '</article>';
				}
			?>
        </div>
        
    </div>
    <footer></footer>
</body>
</html>