<?php
include('db_connect.php');
$user_id = 0;
$LogSign_error = "";
$email_error = "";
$login_error = "";
$register_error = "";
if(isset($_POST['Sign']) || isset($_POST['Log'])){
    if(isset($_POST['Sign']))
    {   
        $login = strip_tags($_POST['rej_login']);
        $password = strip_tags($_POST['rej_password']);
        $email = strip_tags($_POST['rej_email']);
        $result =  $mysqli->query("SELECT COUNT(*) AS \"Z\" FROM users WHERE email = \"$email\" OR username = \"$login\";");
        $count = 0;
        foreach($result as $row){
            $count = $row['Z'];
        }
        if($count == 0){
		    $statement = $mysqli->prepare("INSERT users (username,password,email) VALUES (?,?,?)");
		    $statement->bind_param("sss",$login,$password,$email);
		    $statement->execute();
	    	$statement->close();
        }else{
            $register_error = "Email lub nazwa użytkownika jest już zajęta.";
        }
    }else{
        $login = strip_tags($_POST['login']);
        $password = strip_tags($_POST['password']);
        $result = $mysqli->query("SELECT id FROM users WHERE users.password = \"$password\" AND username = \"$login\" ORDER BY id LIMIT 1");
        foreach($result as $user){
            $user_id = $user['id'];
        }
        if($user_id == 0)
        {
            $login_error = "Hasło lub nazwa użytkownika jest błęda.";
        }
    }
}
include("add.php");
include("delete.php");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Forum</title>
    <script src="jquery-3.6.0.min.js"></script>
</head>
<body>
    <header><h1>Forum</h1></header>
    <div class="container">
    <div class="account">
            <?php
            if($user_id != 0)
            {
                echo "<h3>Zalogowany</h3>";
                $result = $mysqli->query("SELECT username FROM users WHERE id = $user_id ORDER BY id LIMIT 1");
                foreach($result as $user){
                echo "<p>Witaj " . $user['username'] . "</p><br>";
                echo "<a href=\"index.php\" class=\"sub_button\">Wyloguj</a>";
                }
            }else
            {
            echo "<h3>Zaloguj się</h3>";
                
                echo "<form method=\"post\" action=\"index.php\">";
                echo "<input type=\"checkbox\" id=\"Log\" name=\"Log\" checked hidden>";
                echo "<label for=\"login\">Nazwa użytkownika:</label><br>";
                echo "<input type=\"text\" id=\"login\" name=\"login\" placeholder=\"Nazwa użytkownika\" required><br>";
                echo "<label for=\"password\">Hasło:</label><br>";
                echo "<input type=\"text\" id=\"password\" name=\"password\" placeholder=\"Hasło\" required><br>";
                echo "<input type=\"submit\" class=\"sub_button\" value=\"Zaloguj się\">";
                echo "</form>";
                if($login_error != ""){
                    echo "<div class=\"error\">" . $login_error;
                    echo "</div>";
                }
            echo "<h3>Zarejestuj się</h3>";
                echo "<form method=\"post\" action=\"index.php\" id=\"rej\">";
                echo "<input type=\"checkbox\" id=\"Sign\" name=\"Sign\" checked hidden>";                
                echo "<label for=\"rej_login\">Nazwa użytkownika:</label><br>";
                echo "<input type=\"text\" id=\"rej_login\" name=\"rej_login\" placeholder=\"Nazwa użytkownika\" required><br>";
                echo "<div id=\"rej_log_com\" class=\"com\"></div>";
                echo "<label for=\"rej_email\">Email:</label><br>";
                echo "<input type=\"text\" id=\"rej_email\" name=\"rej_email\" placeholder=\"Email\" required><br>";
                echo "<div id=\"rej_email_com\" class=\"com\"></div>";
                echo "<label for=\"rej_password\">Hasło:</label><br>";
                echo "<input type=\"text\" id=\"rej_password\" name=\"rej_password\" placeholder=\"Hasło\" required><br>";
                echo "<div id=\"rej_pass_com\" class=\"com\"></div>";
                echo "<label for=\"reg\">Zapoznałem się z regulaminem</label><br>";
                echo "<input type=\"checkbox\" id=\"reg\" name=\"reg\" checked required><br>"; 
                echo "<input type=\"submit\" class=\"sub_button\" value=\"Zarejestuj się\">";
                echo "</form>";
                if($register_error != ""){
                    echo "<div class=\"error\">" . $register_error;
                    echo "</div>";
                }
            }
            ?>
        </div>
        <div class="articles">      
            <?php
                if($user_id != 0)
                {
                    echo "<h3>Dodaj wątek</h3>";
                    echo '<article class="single-article">';
					echo "<form method=\"post\" action=\"index.php\">";
                    echo "<input type=\"text\" name=\"login\" id=\"login\" value=\"$login\" hidden>";
                    echo "<input type=\"text\" name=\"password\" id=\"password\" value=\"$password\" hidden>";
					echo "<label for=\"title\">Tytuł</label><br>";
					echo "<input type=\"text\" name=\"title\" id=\"title\" required><br>";
				    echo "<div class=\"required field\">";
					echo "<label>Treść wątku</label><br>";
					echo "<textarea name=\"content\" id=\"content\" required></textarea>";
					echo "</div>";
					echo "<div class=\"required field\">";
					echo "</div>";
					echo "<input type=\"submit\" class=\"sub_button\" id=\"add\" name=\"add\" value=\"Dodaj wątek\"></input>";
					echo "</form>";
                    echo '</article>';
                }
                echo "<h3>Wątki</h3>";
				$result = $mysqli->query("SELECT articles.id as \"id\",title,article,username,user_id FROM articles JOIN users ON users.id = articles.user_id ORDER BY articles.id DESC");
				foreach($result as $article){
					echo '<article class="single-article">';
					echo '<h3>' . $article['title'] . '</h3>';
					echo '<div class="article-content">';
					echo '<p>' . $article['article'] . '</p>';
					echo '</div>';
                    echo '<h4> Napisany przez ' . $article['username'] . '</h4>';
                    if($user_id == $article['user_id'] ){
                    echo "<form method=\"post\" action=\"index.php\">";
                    echo "<input type=\"text\" name=\"id\" id=\"id\" value=\"" . $article['id'] . "\" hidden>";
                    echo "<input type=\"text\" name=\"login\" id=\"login\" value=\"$login\" hidden>";
                    echo "<input type=\"text\" name=\"password\" id=\"password\" value=\"$password\" hidden>";
                    echo "<input type=\"submit\" class=\"sub_button delete_button\" id=\"delete\" name=\"delete\" value=\"Usuń\"></input>";
					echo "</form>";
                    }
					echo '</article>';
				}
			?>
        </div>
        
    </div>
    <footer>Gilbert Guszcza</footer>
    <script>
        const sub = $("#rej").find(".sub_button");
        const log_com = $("#rej").find("#rej_log_com");
        const pass_com = $("#rej").find("#rej_pass_com");
        const email_com = $("#rej").find("#rej_email_com");
        let a = true;
        let b = true;
        let c = true;

        function sub_button(a,b,c)
        {   
            if(a & b & c){
            sub.prop('disabled', false);
            }
            else{
            sub.prop('disabled', true);
            }
        }

        function ValidateEmailAddress(emailString) {
        // check for @ sign
        var atSymbol = emailString.indexOf("@");
        if(atSymbol < 1) return false;
            
        var dot = emailString.indexOf(".");
        if(dot <= atSymbol + 2) return false;
            
        // check that the dot is not at the end
        if (dot === emailString.length - 1) return false;
            
        return true;
        }

        $("#rej").ready(function() {
        $("input#rej_password").on('blur', function() {
            let l = $(this).val().length;
            if(l < 6 || l > 20){
                $(this).addClass("pass-error");
                pass_com.text("Hasło powinno składać się z conajmniej 6 oraz maksymalnie 20 znaków.");
                a = false
            }
            else{
                $(this).removeClass("pass-error");
                pass_com.empty();
                a = true;
            }
            sub_button(a,b,c)
        });
        $("input#rej_login").on('blur', function() {
            let l = $(this).val().length;
            if(l < 6 || l > 20){
                $(this).addClass("log-error");
                log_com.text("Nazwa użytkownika powinna składać się z conajmniej 6 oraz maksymalnie 20 znaków.");
                b = false
            }
            else{
                $(this).removeClass("log-error");
                log_com.empty();
                b = true
            }
            sub_button(a,b,c)
        });
        $("input#rej_email").on('blur', function() {
            let email = $(this).val();
            if(!ValidateEmailAddress(email)){
                $(this).addClass("email-error");
                c = false
            }
            else{
                $(this).removeClass("email-error");
                c = true
            }
            sub_button(a,b,c)
        });
        });
    </script>   
</body>
</html>