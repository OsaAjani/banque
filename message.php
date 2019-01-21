<?php 
require_once 'banque.php'; 
require_once 'debut-page.php'; 

if($utilisateur===false)
{
	echo "<p>Vous devez être connecté pour envoyer un message au gérant.</p>";
	die('erreur');
}


// Traitement de la soumission  du formulaire
if(isset($_POST['contenu']))
{
	// Construire la requête SQL avec les champs saisis par l'utilisateur dans le formulaire
	$sql="INSERT INTO messages (expediteur,contenu) VALUES ('".$utilisateur['id']."',:contenu)";
	// Faire la requête SQL
	$query=$pdo->prepare($sql);
    $query->execute(['contenu' => $_POST['contenu']]);
	// Rediriger vers la page d'accueil
	header('Location: index.php');
}

echo "<form method='POST'>";
echo "<p>Message à envoyer: <input type='text' name='contenu'/></p>";
echo "</form>";

require_once 'fin-page.php'; 

?>
