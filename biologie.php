<?php 
include 'inc/header.php'; 
include 'dbconnect.php'; 

$query = $pdo->query("
SELECT especes.*, type.nom AS type_nom, photo.chemin
FROM especes
JOIN type ON especes.id_type = type.id_type
LEFT JOIN photo ON especes.id_especes = photo.id_especes
GROUP BY especes.id_especes
");
$especes = $query->fetchAll();
?>

<main class="container">
    <h1>La <span>Biologie</span></h1>
        <div class="menu"> <?php foreach($especes as $espece): ?>
            <a href="fiche_espece.php">
                <div class="carte">
                    <img src="<?php echo !empty($espece['chemin']) ? $espece['chemin'] : 'images/default.jpg'; ?>" alt="Image de l'espèce">
                    <h3><?php echo htmlspecialchars($espece['nom']); ?></h3>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'inc/footer.php'; ?>