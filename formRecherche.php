<?php
include("functions.php");

// You can access the values posted by jQuery.ajax
// through the global variable $_POST, like this:
// On utilise les nom du formulaire
$erreur = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["nomMed"])) {
		$nomMed = "";
	} else {
		$nomMed = test_input($_POST["nomMed"]);
		// check if nomMed only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z0-9éèàùîêâôëï%\* ]*$/",$nomMed)) {
			$erreur = $erreur." Le nom cherché doit contenir uniquement des lettres, chiffres et des espaces.";
		}
	}
} else {
	$erreur = "données non postés";
}

if (empty($erreur)) {

	// Les champs sont OK : ajout à la base 
	afficherTableRecherche($nomMed);
} else {
	echo "<p>Erreur : ".$erreur."</p>";
}

?>
