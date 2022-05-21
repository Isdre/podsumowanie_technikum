<?php
$email = '';
$password = '';
$terms = '';
$errorEmail = '';
$errorPassword = '';
$errorTerms = '';
$emailSent = '';

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
    <header><h1>Forum - </h1></header>
    <div class="container">
        <div class="articles">
            <h2>Artykuły</h2>
            <?php
                include('db_connect.php');
				$result = $mysqli->query("SELECT * FROM articles JOIN users ON users.id = articles.user_id ORDER BY articles.id DESC");
				foreach($result as $article){
					echo '<article class="single-article">';
					echo '<h3>' . $article['title'] . '- napisany przez ' . $article['username'] . '</h3>';
					echo '<div class="article-content">';
					echo '<p>' . $article['article'] . '</p>';
					echo '</div>';
					echo '<a href="delete.php?id=' . $article['id'] . '">';
					echo '<div class="ui label"><i class="remove icon"></i>Usuń/div>';
					echo '</a>';
					echo '</article>';
				}
			?>
        </div>
        <div class="account">
            
        </div>
    </div>
    <footer></footer>
</body>
</html>