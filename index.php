<!DOCTYPE HTML>
<?php include("functions.php"); ?>
<html>
	<head>
		<title>La pharmasso - stop au gaspillage de médicaments</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="assets/js/jquery.min.js"></script>
  	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    
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
		<section>
			<h2>Liste des médicaments disponibles</h2>
			<!-- Formulaire de recherche -->
			<form id="recherche">
				<div class="row uniform 50%">
					<div class="6u 12u$(xsmall)">
						<label for="nomMed"><span>Recherche de médicaments</span>
						<input id="nomMed" name="nomMed" type="text" value="" placeholder="Nom ou partie du médicament"/></label>
					</div>
					<div class="12u">
						<ul class="actions"><li><input type="submit" value="Chercher" class="button fit small"/></li></ul>
					</div>
				</div>
			</form>
			<p id="result"> </p>
			<!-- Tableau des médicaments -->
			<div id="table-pharma"><?php afficherTableDiv(); ?></div>
			<!-- Lien page ajout -->
			<h3><a href="ajoutMedocs.php">Ajouter vos médicaments</a></h3>
		
		</section>

		<!-- Space before footer
		<section><p><br/><br/></p></section> -->

	</div>
</section>

<!-- Footer -->
	<footer id="footer">
		<div class="copyright">
			Une idée originale de <b>Prisca</b> !
			<br/>Code: <b>Giloop</b>
		</div>
	</footer>

<!-- Scripts -->
<script>
// Variable to hold request
var request;
// Bind to the submit event of our form
$("#recherche").submit(function(event){

    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);

    // Let's select and cache all the fields
    var $inputs = $form.find("input, select, button, textarea");

    // Serialize the data in the form
    var serializedData = $form.serialize();

    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "formRecherche.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Debug message 
		// $("#result").text("Ajout OK : "+response);
		// TODO Update table text
		$("#table-pharma").html(response);
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        // console.error("The following error occurred: "+textStatus, errorThrown);
		$("#result").text("The following error occurred: "+errorThrown);
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });
    
});
</script>
</body>
</html>
