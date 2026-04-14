<?php 
include 'inc/header.php'; 
include 'dbconnect.php'; 

$query = $pdo->query("SELECT especes.*, type.nom AS type_nom
FROM especes
JOIN type ON especes.id_type = type.id_type
");
$especes = $query->fetchAll();
?>

<main class="container">
    <h1>La Biologie</h1>
    <div class="menu"> <?php foreach($especes as $espece): ?>
            <div class="carte">
                <h3><?php echo htmlspecialchars($espece['nom']); ?></h3>
                <p><em><?php echo htmlspecialchars($espece['nom_science']); ?></em></p>
                <p>Type : <?php echo htmlspecialchars($espece['type_nom']); ?></p>
                <p> <?php echo htmlspecialchars($espece['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'inc/footer.php'; ?>