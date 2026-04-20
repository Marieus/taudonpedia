<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    include 'dbconnect.php';
    $ERR_msg = "";   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username != "" && $password != ""){
            $req = $pdo ->query("SELECT * FROM users where pseudo = '$username'");
            $rep = $req->fetch();
            if($rep){
                if(password_verify($password, $rep['password'])) {
                    echo "Connexion réussie !";

                } else {
                $ERR_msg = "Mot de passe incorrect";
                }
            } else {
                $ERR_msg = "Utilisateur introuvable";
            }
        }
    }

    ?>
    <div class="connexion">
        <h2>Connexion</h2>
        <form action="" method="POST">
            <input type="username" placeholder="Nom d'utilisateur" id="username" name="username" required >
            <input type="password" placeholder="Mot de passe" id="password" name="password" required >
            <input type="submit" value="Se Connecter" name="submit" class="submit_login">
        </form>
    </div>
    <?php 
    if(!empty($ERR_msg)){
        ?>
        <p><?php echo $ERR_msg ?></p>
        <?php
    }
    ?>
</body>
</html>

