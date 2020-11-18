<?php

  /**
   *
   * Connect to database
   *
   * @param    choixId  $choixId choix de la connection 
   * @return   none
   *
   */
  function connectBD($choixId = "local") {

   /* Variables */
   if ($choixId=="local")
    { $bdd= "test";
      $host= "localhost";
      $user= "root";
      $pass= "";
    }
    elseif ($choixId=="mon.site") {
      $host= "sql.free.fr";
      $user= "mon.nom";
      $pass= "m.d.p";
      $bdd = "ma.base";
    } else {
      die('Site inconnu');
    }

    // TODO Connection : changer en PDO
    mysql_connect($host, $user, $pass) or die('pas de connexion');
    mysql_select_db($bdd) or die('base de données non trouvée');
  }

?>
