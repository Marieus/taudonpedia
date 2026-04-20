<?php 
session_start();
include 'inc/header.php';

if (!isset($_SESSION['user_pseudo'])) {
    header('Location: ../login.php');
    exit();
}
?>
<h1> Administration</h1>

<?php 
include 'inc/footer.php';
?>