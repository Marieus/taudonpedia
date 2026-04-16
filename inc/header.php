<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title> Encyclopédie Sous Marine</title>
</head>
<body>

<header>
    <div class="banniere">
        <a href="index.php" class="logo">
            <div class="logo-image"><img src="images\LOGO_COP_300x300.png" alt="logo Caen Plongée"></div>
            <div class="logo-texte">Taudon<span>Pédia</span></div>
        </a>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="biologie.php" <?php if(basename($_SERVER['PHP_SELF']) == 'biologie.php') echo 'class="active"'; ?>>Biologie</a>
            <a href="epaves.php" <?php if(basename($_SERVER['PHP_SELF']) == 'epaves.php') echo 'class="active"'; ?>>Épaves</a>
        </nav>    
    </div>
</header>
<main>
