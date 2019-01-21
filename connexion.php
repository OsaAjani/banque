<?php 
require_once 'banque.php'; 
require_once 'debut-page.php'; 

// Traitement de la soumission  du formulaire
if(isset($_POST['nom']))
{
	// Construire la requête SQL avec les champs saisis par l'utilisateur dans le formulaire
	$sql="SELECT * FROM utilisateurs WHERE nom='".$_POST['nom']."' AND motdepasse='".$_POST['motdepasse']."'";
	// Faire la requête SQL
	$query=$pdo->prepare($sql);
	$query->execute();

	if($query===false)
	{
		echo 'La requete SQL a echouée : <pre>'.htmlentities($sql).'</pre>';
	}
	else
	{
		// La requete SQL a reussie, chercher la première ligne retournée
		$nouveauUtilisateur=$query->fetch();
		// Si aucune ligne trouvée... c'est que le nom ou le mot de passe ne sont pas bons.
		if($nouveauUtilisateur===null)
		{
			echo "<p>Connexion échouée.</p>";
			echo "<p>Banque $nomBanque accorde une grande importance à la sécurité de ses clients.<br/>";
			echo "Toute tentative d'utilisation frauduleuse sera pousuivie.</p>";
			$utilisateur=false;
		}
		else
		{
			// La connexion a réussie : enregistrer l'utilisateur dans la variable de session
			session_regenerate_id(true);
			$_SESSION['utilisateur']=$nouveauUtilisateur;
			// Rediriger vers la page d'accueil
			header('Location: index.php');
		}
	}
}

// Affichage du formulaire de connexion, uniquement pour les utilisateurs pas encore connectés.
if($utilisateur!==false)
{
	echo "<p>Vous êtes déjà connectés. <a href='deconnexion.php'>déconnexion</a>.</p>";
}
else
{
	echo "<form method='POST'>";
	echo "<p>Nom: <input type='text'     name='nom'       /></p>";
	echo "<p>Mdp: <input type='text' name='motdepasse'/></p>";
	echo "<p><input type='submit' value='Connexion'/></p>";
	echo "</form>";
}

require_once 'fin-page.php'; 

?>
