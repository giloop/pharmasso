<?php
include("functions.php");

// You can access the values posted by jQuery.ajax
// through the global variable $_POST, like this:
// On utilise les nom du formulaire
$erreur = "";
$tel = "";
$mail = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["nom"])) {
		$erreur = $erreur." Le nom est requis.";
	} else {
		$nom = test_input($_POST["nom"]);
		// check if nom only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$nom)) {
			$erreur = $erreur." Le nom doit contenir uniquement des lettres et des espaces.";
		}
	}
	if (empty($_POST["medecine"])) {
		$erreur = $erreur." Un médicament est requis.";
	} else {
		$med = test_input($_POST["medecine"]);
	}
	
	if (!empty($_POST["tel"])) {
		$tel = test_input($_POST["tel"]);
		$tel = preg_replace('/\s+/', '', $tel);
		if (!preg_match("/^[0-9 ]*$/",$tel) || strlen($tel)!=10) {
			$erreur = $erreur." Le téléphone ne doit contenir que 10 chiffres.";
		}
	}

	if (!empty($_POST["mail"])) {
		$email = test_input($_POST["mail"]);
		// check if e-mail address is well-formed
		if (!preg_match("/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+.[a-zA-Z]+$/", $email)) {
			$erreur = $erreur." L'email n'a pas un format correct.";
		}
	}

	$med = test_input($_POST['medecine']);
	$qtite = test_input($_POST['quantite']);
	$mois = test_input($_POST['mois']);
	$annee = test_input($_POST['annee']);
	
} else {
	$erreur = "données non postés";
}

if (empty($erreur)) {

	// Les champs sont OK : ajout à la base 
	ajouterPharma($nom, $med, $tel, $mail, $qtite, $mois.'/'.$annee);
	// Debug: 
	// echo "Champs reçus $nom, $med, $tel, $mail, $qtite, $mois/$annee";
	// Mise à jour table-pharma
	afficherTableDiv();
} else {
	echo "Erreur : ".$erreur;
}

?>
