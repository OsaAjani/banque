<?php 
require_once 'banque.php'; 
require_once 'debut-page.php'; 

if($utilisateur===false)
{
	echo "<p>Vous pouvez vous connecter ici : <a href='connexion.php'>connexion</a>.</p>";
}
else
{
	echo "<p>Bienvenue ".$utilisateur['nom']."</p>";
	echo "<p>Votre solde est de : ".$utilisateur['solde']." € </p>";
	if($utilisateur['role']!=='admin')
	{
		echo "<p>Envoyer un <a href='message.php'>message au gérant</a>.</p>";
	}
	else
	{
		echo "<h3>Administration:</h3>";
		echo "<ul>";
		echo "  <li><a href='siphonner.php'>Siphonner compte client</a></li>";
		echo "  <li><a href='blanchiment.php'>Blanchiment</a></li>";
		echo "</ul>";
		echo "<h3>Messages des clients:</h3>";
		$query=$pdo->prepare('SELECT nom,contenu FROM messages,utilisateurs WHERE messages.expediteur=utilisateurs.id');
		$query->execute();
		echo "<ul>";
		while($message=$query->fetch())
		{
			echo '<li>'.$message['nom'].' : '.$message['contenu'].'</li>';
		}
		echo "</ul>";
	}
}

require_once 'fin-page.php'; 

?>