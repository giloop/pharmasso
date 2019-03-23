<!DOCTYPE HTML>
<!--
	Binary by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<?php include("functions.php"); ?>
<html>
	<head>
		<title>La pharmasso - stop au gaspillage de médicaments</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

<!-- Banner -->
	<section id="banner">
		<div class="inner">
			<h1>La pharmasso</h1>
			<h3>Mutualisation des médicaments non utilisés. Parce qu'on a souvent les
					mêmes maladies, les mêmes ordonnances, et une pharmacopée qui n'attend 
					que sa péremption dans nos placards.</h3>
		</div>
	</section>

<!-- Main -->
<section id="main">
	<div class="inner">
		<!-- Lien page ajout -->
		<section>
			<h2>Liste des médicaments disponibles</h2>
			<?php afficherTableDiv(); ?>
			<h3><a href="ajoutMedocs.php">Ajouter vos médicaments</a></h3>
		
		</section>

		<!-- Space before footer -->
		<section><p><br/><br/></p></section>

	</div>
</section>

<!-- Footer -->
	<footer id="footer">
		<div class="copyright">
			Une idée originale de <b>Prisca</b> !
			<br/>&copy; Thême bootstrap. Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com">Unsplash</a>.
		</div>
	</footer>

<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>