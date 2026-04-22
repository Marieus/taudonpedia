<?php 
session_start();
if (!isset($_SESSION['user_pseudo'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title> Administration TaudonPedia</title>
</head>
<body>
    
<header>
    <div class="banniere">
        <a href="index.php" class="logo">
            <div class="logo-image"><img src="images/LOGO_COP_300x300.png" alt="logo Caen Plongée"></div>
            <div class="logo-texte">Taudon<span>Pédia</span></div>
        </a>
        <nav>
            <p>Utilisateur : <strong><?php echo htmlspecialchars($_SESSION['user_pseudo']); ?></strong></p>
            <a href="index.php">Accueil</a>
            <a href="biologie.php" <?php if(basename($_SERVER['PHP_SELF']) == 'biologie.php') echo 'class="active"'; ?>>Biologie</a>
            <a href="epaves.php" <?php if(basename($_SERVER['PHP_SELF']) == 'epaves.php') echo 'class="active"'; ?>>Épaves</a>
            <a href="logout.php" class="btn-logout" class="active">Se déconnecter</a>
        </nav>    
    </div>
</header>
<?php 
include 'inc/dbconnect.php';

$onglet = isset($_GET['onglet']) ? $_GET['onglet'] : 'photo';

if ($onglet == 'photo') {
    $req = $pdo->query("
        SELECT photo.*, photographe.nom AS nom_photographe, especes.nom AS nom_especes, lieu.nom AS nom_lieu
        FROM photo 
        LEFT JOIN photographe ON photo.id_photographe = photographe.id_photographe
        LEFT JOIN especes ON photo.id_especes = especes.id_especes
        LEFT JOIN lieu ON photo.id_lieu = lieu.id_lieu
        ORDER BY photo.id_photo DESC");
} else if ($onglet == 'especes') {
    $req = $pdo->query("
    SELECT especes.*, type.nom AS nom_type
    FROM especes 
    LEFT JOIN type ON especes.id_type = type.id_type
    ORDER BY especes.id_especes DESC");
} else if ($onglet == 'lieu') {
    $req = $pdo->query("
    SELECT * 
    FROM lieu 
    ORDER BY id_lieu DESC");
} else if ($onglet == 'photographe') {
    $req = $pdo->query("
    SELECT * 
    FROM photographe 
    ORDER BY id_photographe DESC");
} else if ($onglet == 'type') {
    $req = $pdo->query("
    SELECT * 
    FROM type 
    ORDER BY id_type DESC");
} 

$donnees = $req->fetchAll();
?>

<main class='onglets_admin'>
    <h1>Administration</h1>
    <div class="menu_admin">
        <a href="admin.php?onglet=photo" class="<?php echo ($onglet == 'photo') ? 'active' : ''; ?>">Photo</a>
        <a href="admin.php?onglet=especes" class="<?php echo ($onglet == 'especes') ? 'active' : ''; ?>">Espèces</a>
        <a href="admin.php?onglet=lieu" class="<?php echo ($onglet == 'lieu') ? 'active' : ''; ?>">Lieu</a>
        <a href="admin.php?onglet=photographe" class="<?php echo ($onglet == 'photographe') ? 'active' : ''; ?>">Photographe</a>
        <a href="admin.php?onglet=type" class="<?php echo ($onglet == 'type') ? 'active' : ''; ?>">Famille</a>
    </div>
    <div class="admin_section">
        <a href="ajouter_<?php echo $onglet; ?>.php" class="btn-ajouter">
            <i class="fa-solid fa-plus"></i> Ajouter dans <?php echo $onglet; ?>
        </a>
    </div>
    <table class="panneau_admin">
        <thead>
            <?php if($onglet == 'photo'): ?>
                <tr>
                    <th>Photo</th>
                    <th>Chemin</th>
                    <th>Photographe</th>
                    <th>Date</th>
                    <th>Espèce</th>
                    <th>Lieu</th>
                    <th>Actions</th>
                    
                </tr>
            <?php elseif($onglet == 'especes'): ?>
                <tr>
                    <th>Nom</th>
                    <th>Nom Scientifique</th>               
                    <th>Description</th>               
                    <th>Couleur</th>               
                    <th>Type</th>               
                    <th>Actions</th>
                </tr>
            <?php elseif($onglet == 'lieu'): ?>
                <tr>
                    <th>Nom</th>
                    <th>Coordonnées</th>
                    <th>Profondeur</th>
                    <th>Actions</th>
                </tr>
            <?php elseif($onglet == 'photographe'): ?>
                <tr>
                    <th>Nom</th>
                    <th>Âge</th>
                    <th>Niveau</th>
                    <th>Materiel</th>
                    <th>Actions</th>
                </tr>
            <?php elseif($onglet == 'type'): ?>
                <tr>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            <?php endif; ?>
                
            
        </thead>
        <tbody>
            <?php foreach($donnees as $d): ?>
                <tr>
                    <?php if($onglet == 'photo'): ?>
                        <td><img src="./<?php echo $d['chemin'] ?>" ></td>
                        <td><p><?php echo $d['chemin'] ?></p></td>
                        <td><p><?php echo $d['nom_photographe'] ?></p></td>
                        <td><p><?php echo $d['date_photo'] ?></p></td>
                        <td><p><?php echo $d['nom_especes'] ?></p></td>
                        <td><p><?php echo $d['nom_lieu'] ?></p></td>
                    <?php elseif($onglet == 'especes'): ?>
                        <td><?php echo htmlspecialchars($d['nom']); ?></td>
                        <td><?php echo htmlspecialchars($d['nom_science']); ?></td>
                        <td><?php echo htmlspecialchars($d['description']); ?></td>
                        <td><?php echo htmlspecialchars($d['couleur']); ?></td>
                        <td><?php echo htmlspecialchars($d['nom_type']); ?></td>
                    <?php elseif($onglet == 'lieu'): ?>
                        <td><?php echo htmlspecialchars($d['nom']); ?></td>
                        <td><?php echo htmlspecialchars($d['coordonnees']); ?></td>
                        <td>- <?php echo htmlspecialchars($d['profondeur']); ?> m</td>
                    <?php elseif($onglet == 'photographe'): ?>
                        <td><?php echo htmlspecialchars($d['nom']); ?></td>
                        <td><?php echo htmlspecialchars($d['age']); ?></td>
                        <td><?php echo htmlspecialchars($d['niveau']); ?></td>
                        <td><?php echo htmlspecialchars($d['materiel']); ?></td>
                    <?php elseif($onglet == 'type'): ?>
                        <td><?php echo htmlspecialchars($d['nom']); ?></td>
                    <?php endif; ?>
                        <td>
                            <a href="modifier.php?type=<?php echo $onglet; ?>&id=<?php echo $d['id_'.$onglet]; ?>">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="supprimer.php?type=<?php echo $onglet; ?>&id=<?php echo $d['id_'.$onglet]; ?>" style="color:red;">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>    
                </tr>
            <?php endforeach; ?>    
        </tbody>
    </table>
<?php 
include 'inc/footer.php';
?>