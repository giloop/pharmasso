<!doctype HTML>
<?php
   include("functions.php");
   $year = date("Y"); $month = date("MM");
?>
<html>
	<head>
  	<meta charset="utf-8">
		<title>La pharmasso - stop au gaspillage de médicaments</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <script src="assets/js/jquery.min.js"></script>
  	<script src="assets/js/jquery.scrolly.min.js"></script>
	  <script src="assets/js/skel.min.js"></script>
	  <script src="assets/js/util.js"></script>
	  <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script>
     $( function() {
       var userList = <?php listerUsersJS(); ?>;
       $( "#users" ).autocomplete({
         source: userList
       });
     } );
     $( function() {
       var medFrequents = [
        "DOLIPRANE", "EFFERALGAN", "DAFALGAN", "LEVOTHYROX", "IMODIUM", "KARDEGIC", "SPASFON", "ISIMIG", "TAHOR", "SPEDIFEN", "VOLTARENE", "ELUDRIL", "IXPRIM", "PARACETAMOL BIOGARAN", "FORLAX", "MAGNE B6", "HELICIDINE", "CLAMOXYL",
        "PIASCLEDINE", "LAMALINE", "GAVISCON", "DAFLON", "ANTARENE", "RHINOFLUIMUCIL", "PLAVIX", "MOPRAL", "SUBUTEX", "AERIUS", "ORELOX", "INEXIUM", "METEOSPASMYL", "AUGMENTIN", "TOPLEXIL", "PIVALONE", "VASTAREL", "ADVIL", "EUPANTOL", "DEXERYL", "RENUTRYL", "", "XANAX", "EMLAPATCH", "LASILIX", "ENDOTELON", "DEROXAT", "TEMESTA", "EFFEXOR", "PARACETAMOL SANDOZ", "VENTOLINE", "SOLUPRED", "DEXTROPROPOXYPHENE PARAC BIOG", "PNEUMOREL", "INIPOMP", "PREVISCAN", "ASPEGIC", "GINKOR", "CRESTOR", "MEDIATOR", "SERESTA", "MOTILIUM", "PARACETAMOL MERCK", "CELESTENE", "AMLOR", "DIAMICRON", "TANAKAN", "ATARAX", "DERINOX", "XYZALL", "DEXTROPROPOXYPHENE PARAC SAND", "SERETIDE", "COVERSYL", "PROPOFAN", "HEXAQUINE", "DIFFU-K", "APROVEL", "PARIET", "ZALDIAR", "DIPROSONE", "PARACETAMOL TEVA", "BETADINE", "LYSANXIA", "ALODONT", "LEXOMIL", "DACRYOSERUM", "FUCIDINE", "STILNOX", "KETUM", "STABLON", "ART", "BIOCALYPTOL", "THIOVALONE", "DEBRIDAT", "PYOSTACINE", "TIORFAN", "SPECIAFOLDINE", "OGAST", "RIVOTRIL", "TOPALGIC", "NASONEX", "COAPROVEL"
       ];
       $( "#meds" ).autocomplete({
         source: medFrequents
       });
     } );
  </script>
	</head>
<body>
<section id="main">
  <div class="inner">
    <!-- Formulaire -->
    <section>
      <h2>Ajouter un médicament</h2>
      <p>Avant de choisir un nom d'utilisateur, vérifiez qu'il n'est pas déjà utilisé dans la liste des médicaments.</p>
      <p>Il n'est pas nécessaire de remettre votre téléphone et/ou mail si vous l'avez rempli une fois.</p>
      <p><span class="required">(*) Champs obligatoires</span></p>
      <form id="ajout">
      <div class="row uniform 50%">
        <div class="6u 12u$(xsmall)">
          <label for="users"><span>Nom utilisateur <span class="required">*</span></span>
          <input id="users" name="nom" type="text" value="" class="required" /></label>
        </div>
        <div class="6u 12u$(xsmall)">
          <label for="tel"><span>Téléphone</span>
          <input id="nom" name="tel" type="text" value="" class="required" /></label>
        </div>
        <div class="12u$">
          <label for="mail"><span>Email</span>
          <input id="nom" name="mail" type="text" value="" class="required" /></label>
        </div>
        <div class="12u$">
          <label for="meds"><span>Nom du médicament <span class="required">*</span></span>
          <input id="meds" name="medecine" type="text" class="required"></label>
        </div>
        <div class="6u 12u$(xsmall)">
          <label for="qtite"><span>Quantité <span class="required">*</span></span>
          <input id="qtite" name="quantite" type="text" class="required"></label>
        </div>
        <div class="3u 12u$(xsmall)">
          <label for="mois"><span>Péremption, mois</span>
          <div class="select-wrapper">
            <select name="mois" id="mois">
            <?php for ($i=1;$i<=12; $i++) {
              if ($i==1) { $select = ' selected="selected"'; } else { $select = '';}
              echo sprintf('<option%s>%02d</option>',  $select, $i);
              } ?>
            </select>
          </div></label>
        </div>
        <div class="3u 12u$(xsmall)">
          <label for="annee"><span>année <span class="required">*</span></span>
          <div class="select-wrapper">
            <select name="annee" id="annee">
            <?php for ($i=0;$i<=10; $i++) {
              if ($i==0) { $select = ' selected="selected"'; } else { $select = '';}
              echo sprintf('<option%s>%04d</option>', $select, intval($year)+$i);
              } ?>
              </select>
          </div>
          </label>
        </div>
        <div class="12u$">
          <input type="submit" value="Ajouter" class="special"/>
        </div>
      </form>
      <p id="result"> </p>
    </section>

    <!-- Table -->
    <section>
      <div class="inner">
          <h2>Liste des médicaments disponibles</h2>
          <?php afficherTableDiv(); ?>
      </div>
    </section>

    <section>
      <header><h3><a href="index.php">Retour à l'accueil</h3></header>
      <!-- Space before footer -->
      <p><br/><br/></p>
    </section>

  </div>
</section>

<!-- Footer -->
<footer id="footer">
		<div class="copyright">
			&copy; Design: <a href="https://templated.co">TEMPLATED</a>.
		</div>
	</footer>

<script>
// Variable to hold request
var request;
// Bind to the submit event of our form
$("#ajout").submit(function(event){

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
        url: "form.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        // console.log("Hooray, it worked!"+response);
        $("#result").text("Yes : "+response);
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
