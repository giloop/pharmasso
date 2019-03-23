<?php
  function connectBD() {
   $choix = "local"; /* "www"; /*  */
   /* Variables */
   if ($choix=="local")
    { $bdd= "test";
      $host= "localhost";
      $user= "root";
      $pass= "";
    }
    else {
      $host= "";
      $user= "";
      $pass= "";
      $bdd = "";
    }
    mysql_connect($host, $user, $pass) or die('pas de connexion');
    mysql_select_db($bdd) or die('base de données non trouvée');
  }

?>
