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
        $user = $_POST['user'];
        $password = $_POST['password'];
        if($user != "" && $password != ""){
            $req = $pdo ->query("SELECT * FROM users where pseudo = '$user'");
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
        <form action="" method="POST" class="barre_recherche">
            <label for="user">Nom d'utilisateur</label>
            <input type="user" placeholder="Nom d'utilisateur" id="user" name="user" required >
            <label for="password">Mot de passe</label>
            <input type="password" placeholder="Mot de passe" id="password" name="password" required >
            <input type="submit" value="Se Connecter" name="submit" class="submit">
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

