<?php
// You can access the values posted by jQuery.ajax
// through the global variable $_POST, like this:
// On utilise les name du formulaire
bSuccess = true;
if(isset($_POST['nom']) && $_POST['nom']!='' && isset($_POST['medecine']) && $_POST['medecine']!='' ){
	echo "ok";
} else {
	echo "ko";	
}

?>
