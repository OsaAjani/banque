<?php 
require_once 'banque.php'; 
require_once 'debut-page.php'; 

echo '<pre>';
$fichier=$_GET['fichier'];
require_once $fichier;
echo '</pre>';

require_once 'fin-page.php'; 

?>
